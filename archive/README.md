# Vendor Package Archive

This directory contains archived/backup copies of vendor packages that have been removed from the project.

## rachidlaasri/laravel-installer (Archived: March 4, 2026)

### Why Archived
The `rachidlaasri/laravel-installer` package was originally used for application installation. All functionality has been migrated to **app-level code** for better control and maintainability.

### Migration Details
**Original Package**: `rachidlaasri/laravel-installer` (dev-master)
**Repository**: https://github.com/askaralimkndr/LaravelInstaller.git

**Replaced With** (App-Level Implementation):
- `app/Http/Controllers/Installer/` - 7 controllers
- `app/Services/Installer/` - 7 service classes
- `app/Http/Middleware/Installer/` - 2 middleware classes
- `app/Events/Installer/` - 2 event classes
- `app/Providers/InstallerServiceProvider.php` - Service provider
- `routes/installer.php` - Installer routes
- `app/Http/Middleware/CheckInstallation.php` - Installation check middleware

### Benefits of Migration
 **Full Control**: Direct access to all installer code  
 **Customization**: Easy to modify installer behavior  
 **No Vendor Dependency**: Package can be removed without breaking functionality  
 **Better Debugging**: Clear error messages and logging  
 **Security**: Added audit logging and database backups  
 **Production Safety**: Can disable installer in production via config  

### Removal Process
1.  Backed up vendor package to `archive/vendor-installer-backup/rachidlaasri/`
2.  Removed from `composer.json` require section
3.  Removed custom repository from `composer.json`
4.  Run `composer update` to remove from vendor/
5.  Verified app-level installer still works

### Files in This Archive
```
archive/vendor-installer-backup/rachidlaasri/
└── laravel-installer/
    ├── config/
    ├── public/
    ├── src/
    │   ├── Controllers/
    │   ├── Events/
    │   ├── Helpers/
    │   ├── Middleware/
    │   └── Providers/
    ├── composer.json
    ├── LICENSE
    └── README.md
```

### Restoration (If Needed)
To restore the vendor package:

1. Add back to `composer.json`:
```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/askaralimkndr/LaravelInstaller.git"
    }
],
"require": {
    "rachidlaasri/laravel-installer": "dev-master"
}
```

2. Run: `composer update rachidlaasri/laravel-installer`

3. Update `config/app.php`:
```php
RachidLaasri\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class,
```

**Note**: Restoration should not be necessary as all functionality exists in app-level code.

### Documentation
For current installer implementation, see:
- `INSTALLER_SECURITY.md` - Security best practices
- `SETUP_GUIDE.md` - Installation guide
- `QUICK_REFERENCE.md` - Command reference

### Verification
To verify the installer works without the vendor package:
```bash
# Delete storage/installed file
rm storage/installed

# Clear caches
php artisan cache:clear
php artisan config:clear

# Test installer (after composer update)
# Visit: http://localhost:8000/install
```

---

**Archive Created**: March 4, 2026  
**Laravel Version**: 10.x  
**Neura POS Version**: 1.2  
**Status**:  Safe to Remove
