# Installer Security & Best Practices

This document outlines all security best practices implemented in the Neura POS installer system.

## 1. Installation Protection

### Force Installation Before App Access
- **Middleware**: `CheckInstallation` (App\Http\Middleware\CheckInstallation.php)
- **Behavior**: 
  - Checks if `storage/installed` file exists
  - Redirects unauthenticated users to `/install` if not installed
  - Allows `/install` routes to be accessed during installation
  - After installation, all protected routes require the app to be installed
- **Routes Protected**: All authenticated routes in `routes/web.php`

### Installation Detection
- **Method**: File-based (not .env-based)
- **File**: `storage/installed` (created with timestamp)
- **Benefit**: Can't be bypassed by modifying .env
- **Created By**: `app/Services/Installer/InstalledFileManager.php`

## 2. Post-Installation Behavior

### Redirect on Re-Install Attempt
- **Config**: `config/installer.php`
- **Setting**: `'installedAlreadyAction' => 'route'`
- **Redirect Route**: `'installedAlreadyActionRoute' => 'login'`
- **Message**: `'installedAlreadyActionMessage' => 'Application is already installed.'`

### Middleware Handler
```php
// app/Http/Middleware/Installer/CanInstall.php
if ($this->alreadyInstalled()) {
    return redirect()->route('login')->with('info', 'Application is already installed.');
}
```

## 3. Production Security

### Disable Installer in Production
- **Configuration**: `config/app.php`
- **.env Setting**: `INSTALLER_ENABLED=false`
- **Guard**: Routes are wrapped with condition check
  ```php
  if (config('app.installer_enabled', true)) {
      // Install and update routes
  }
  ```
- **Database Backup**: Automatic backup before installation

### How to Disable in Production
```bash
# In .env file
INSTALLER_ENABLED=false
```

When disabled:
- `/install` routes return 404
- `/update` routes return 404
- No one can access installer

## 4. Audit Logging

### Installation Audit Trail
- **File**: `app/Services/Installer/InstalledFileManager.php`
- **Logs**: Every installation and update to `storage/logs/laravel.log`

### Logged Information
Installation:
```php
[
    'timestamp' => now(),
    'database' => env('DB_DATABASE'),
    'app_url' => config('app.url'),
    'php_version' => phpversion(),
    'laravel_version' => app()->version(),
]
```

Update:
```php
[
    'timestamp' => now(),
    'database' => env('DB_DATABASE'),
    'app_url' => config('app.url'),
]
```

## 5. Database Backup

### Automatic Pre-Installation Backup
- **File**: `app/Services/Installer/FinalInstallManager.php`
- **Location**: `storage/backups/`
- **Format**: `{database_name}_Y-m-d_H-i-s.sql`
- **Execution**: Runs before generating app key

### Backup Command
```php
mysqldump -h {dbHost} -u {dbUser} {dbName} > storage/backups/{dbName}_timestamp.sql
```

### Error Handling
- Backup failures are logged but don't stop installation
- Logged to `storage/logs/laravel.log`

## 6. Database Security

### Connection Validation
- **File**: `app/Http/Controllers/Installer/EnvironmentController.php`
- **Checks**:
  - Connects to MySQL server without database
  - Checks if database exists with SHOW DATABASES
  - Auto-creates database if missing
  - Tests connection to new database

### Why This Matters
- Prevents "database doesn't exist" errors during installation
- Allows fresh installations on any database server
- Validates credentials before proceeding

## 7. Environment Variable Protection

### Safe .env Handling
- **File**: `app/Services/Installer/EnvironmentManager.php`
- **Validation**: All values validated before saving
- **Format**: 
  ```
  APP_KEY=base64:{generated_key}
  DB_HOST=127.0.0.1
  DB_PASSWORD="" (safely escaped)
  ```
- **Backup**: Previous .env is not overwritten without validation

## 8. Middleware Stack

### Install Routes Middleware
```php
Route::group(['middleware' => ['web', 'install']], ...)
```
- `web`: Standard Laravel web middleware
- `install`: `app/Http/Middleware/Installer/CanInstall.php`

### Update Routes Middleware  
```php
Route::group(['middleware' => ['web', 'update']], ...)
```
- Only runs pending migrations
- Requires existing `storage/installed` file

### Main App Routes Middleware
```php
Route::middleware(['auth', 'check.installation'])->group(...)
```
- `auth`: User authentication required
- `check.installation`: Ensures app is installed

## 9. Access Control

### Installation Phase
- Anyone can access `/install`
- All system checks bypass authentication

### Post-Installation Phase
- Admin must login to access app
- Regular users must login
- All routes protected by `auth` middleware
- Installation check prevents access if not installed

### Update Phase
- Only admins with migration permissions can run `/update`
- Uses `CanUpdate` middleware
- Checks for pending migrations

## 10. Configuration Summary

### config/installer.php
```php
'installedAlreadyAction' => 'route',  // Redirect instead of 404
'installedAlreadyActionRoute' => 'login',  // Where to redirect
'installedAlreadyActionMessage' => 'Application is already installed.',
'updaterEnabled' => 'true',  // Allow updates
```

### config/app.php
```php
'installer_enabled' => env('INSTALLER_ENABLED', true),  // Control en ability
```

### .env
```
INSTALLER_ENABLED=true   # Set to false in production
```

## 11. Deployment Checklist

- [ ] Run installer in development/staging
- [ ] Verify `storage/installed` file created
- [ ] Check `storage/logs/laravel.log` for audit trail
- [ ] Verify database backup in `storage/backups/`
- [ ] Set `INSTALLER_ENABLED=false` in production `.env`
- [ ] Test that `/install` returns 404 in production
- [ ] Verify users can login normally
- [ ] Verify `/update` requires authentication

## 12. Troubleshooting

### Installer Not Accessible
```bash
# Check if file exists
ls storage/installed

# Delete to re-run installer
rm storage/installed

# Clear caches
php artisan cache:clear
php artisan config:clear
```

### Can't Login After Installation
```bash
# Verify database migrations
php artisan migrate:status

# Re-seed if needed
php artisan db:seed

# Check audit log
tail -f storage/logs/laravel.log
```

### Database Backup Failed
- Check `storage/logs/laravel.log` for errors
- Ensure MySQL credentials are correct
- Verify `storage/backups/` directory is writable
- Installation continues even if backup fails

### Production Access to Installer
```bash
# Emergency: Disable installer
# Edit .env
INSTALLER_ENABLED=false

# Never remove storage/installed in production manually
```

## 13. Files Modified/Created

### New Files
- `app/Http/Middleware/CheckInstallation.php` - Installation check
- `storage/backups/` - Database backup directory

### Modified Files
- `config/app.php` - Added `installer_enabled`
- `config/installer.php` - Changed default redirect action
- `routes/installer.php` - Added `installer_enabled` check
- `routes/web.php` - Added `check.installation` middleware
- `app/Http/Kernel.php` - Registered `check.installation` middleware
- `app/Http/Middleware/Installer/CanInstall.php` - Updated redirect logic
- `app/Services/Installer/InstalledFileManager.php` - Added audit logging
- `app/Services/Installer/FinalInstallManager.php` - Added database backup
- `.env.example` - Added `INSTALLER_ENABLED` option

## 14. Support

For issues or questions regarding installer security:
1. Check `storage/logs/laravel.log`
2. Review audit trail in installation marker file
3. Check database backups in `storage/backups/`
4. Verify .env configuration matches requirements

---

**Last Updated**: March 4, 2026
**Installer Version**: 2.5
**Laravel Version**: 10.x
