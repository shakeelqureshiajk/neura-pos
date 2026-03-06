# Neura POS v1.2 - Quick Reference Card

Fast reference for common tasks and commands.

---

## Quick Start

### First Run
```bash
# 1. Install dependencies
composer install

# 2. Configure environment
copy .env.example .env
# Edit .env with your database credentials

# 3. Generate app key
php artisan key:generate

# 4. Set up database
php artisan migrate:fresh --seed --force

# 5. Run application
php artisan serve
```

**Access**: http://localhost:8000  
**Default Login**: `admin` / `12345678`

---

## Essential Commands

### Database
```bash
php artisan migrate              # Run pending migrations
php artisan migrate:fresh        # Drop all tables and re-run migrations
php artisan migrate:fresh --seed # Migrations + seed data
php artisan db:show              # Show database info
```

### Cache & Config
```bash
php artisan cache:clear          # Clear all caches
php artisan config:clear         # Clear config cache
php artisan view:clear           # Clear compiled views
php artisan optimize             # Optimize application
```

### User & Auth
```bash
php artisan db:seed --class=AdminSeeder  # Re-seed admin user
php artisan tinker               # Interactive shell
```

### Application
```bash
php artisan serve                # Start dev server (http://localhost:8000)
php artisan route:list           # Show all routes
php artisan --version            # Check Laravel version
```

---

## Database Connection Issues

### Check if MySQL is running
```bash
# Windows
Get-Service | Select-String -Pattern "MySQL"

# Linux
sudo systemctl status mysql

# macOS
brew services list | grep mysql
```

### Test MySQL connection
```bash
php artisan db:show
```

### If connection fails:
Check `.env` file:
```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=neurapos
DB_USERNAME=root
DB_PASSWORD=            # (empty if no password)
```

### Verify MySQL databases exist
```sql
SHOW DATABASES;
USE neurapos;
SHOW TABLES;
```

---

## Admin User

### Default Credentials
- **Username**: `admin`
- **Email**: `admin@example.com`
- **Password**: `12345678`

### Change Password
1. Login to application
2. Profile icon (top-right) → Settings → Profile
3. Update password

### Reset Admin User
```bash
php artisan db:seed --class=AdminSeeder
# Resets to default credentials
```

---

## Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| "Connection refused" | Start MySQL server |
| "Unknown database" | Create database: `CREATE DATABASE neurapos;` |
| "Class not found" | Run `composer dump-autoload` |
| "Permission denied" | Run installer/commands with proper permissions |
| "No such file" | Run `php artisan storage:link` |
| "Sealing failed" | Set `APP_DEBUG=true` to see error details |
| White blank page | Check `storage/logs/laravel.log` for errors |

---

## PHP Extension Check

### Verify all required extensions
```bash
php -m | Select-String "pdo_mysql|intl|zip|curl|json|mbstring"
```

### If missing extensions:
1. Locate php.ini:
   ```bash
   php -i | Select-String "Loaded Configuration File"
   ```

2. Edit relevant lines:
   ```ini
   extension=pdo_mysql
   extension=intl
   extension=zip
   extension=curl
   extension=json
   extension=mbstring
   ```

3. Restart PHP/web server

---

## File Structure

```
neura-pos/
├── app/                      # Application code
│   ├── Http/Controllers/     # Request handlers
│   ├── Models/               # Database models
│   └── Services/             # Business logic
├── config/                   # Configuration files
├── database/
│   ├── migrations/           # Database schemas
│   └── seeders/              # Initial data
├── resources/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript
│   └── views/                # HTML templates
├── routes/                   # URL routes
├── storage/                  # Logs, cache, uploads
├── vendor/                   # Dependencies (auto-generated)
├── .env                      # Environment config
├── artisan                   # CLI command tool
└── composer.json             # Dependencies list
```

---

## Port Change

If port 8000 is in use, use a different port:

```bash
php artisan serve --port=8001
# Then access: http://localhost:8001
```

---

## Deployment Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Run `php artisan key:generate`
- [ ] Run `php artisan optimize`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Set proper file permissions (755 for folders, 644 for files)
- [ ] Configure web server (Apache/Nginx)
- [ ] Install SSL certificate
- [ ] Set up regular backups
- [ ] Configure monitoring & error tracking
- [ ] Change all default passwords

---

## Key URLs

| Page | URL |
|------|-----|
| Login | `/login` |
| Dashboard | `/dashboard` |
| Reports | `/reports` |
| Settings | `/settings` |
| Users | `/users` |
| Items | `/items` |
| Suppliers | `/suppliers` |
| Customers | `/customers` |
| Purchases | `/purchases` |
| Sales | `/sales` |

---

## Default Roles

- **Admin**: Full system access
- **Manager**: Can manage users, reports, settings
- **Cashier**: Can process sales and payments
- **Inventory**: Can manage stock and transfers
- **Accountant**: Can view reports and transactions

---

## Backup & Recovery

### Backup database
```sql
mysqldump -u root -p neurapos > backup.sql
```

### Restore database
```sql
mysql -u root -p neurapos < backup.sql
```

### Backup entire application
```bash
# Make zip of project (exclude vendor folder)
Compress-Archive -Path . -DestinationPath backup.zip -Exclude "vendor", "storage"
```

---

## Useful Laravel Commands

```bash
php artisan list                 # All available commands
php artisan make:model Comment   # Create new model
php artisan make:controller API/UserController  # Create controller
php artisan make:migration create_users_table   # Create migration
php artisan tinker              # Interactive shell
```

---

## Debugging

### Enable debug mode
Edit `.env`:
```env
APP_DEBUG=true
```

### Check logs
```bash
tail -f storage/logs/laravel.log      # Linux/Mac
Get-Content storage/logs/laravel.log  # PowerShell (last 50 lines)
```

### Laravel Tinker (interactive console)
```bash
php artisan tinker
>>> App\Models\User::all()
>>> App\Models\User::find(1)
>>> exit()
```

---

## Environment Variables Reference

```env
# App
APP_NAME=NeuraPOS
APP_ENV=local                    # local or production
APP_KEY=base64:...              # Generated by: php artisan key:generate
APP_DEBUG=false                 # true for development, false for production
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=neurapos
DB_USERNAME=root
DB_PASSWORD=

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

---

**Version**: 1.2  
**Last Updated**: March 2026
