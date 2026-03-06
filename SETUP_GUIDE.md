# Neura POS v1.2 - Complete Setup Guide

A comprehensive step-by-step guide to set up and run Neura POS for the first time.

---

## Table of Contents

1. [System Requirements](#system-requirements)
2. [Installation Steps](#installation-steps)
3. [First-Time Login](#first-time-login)
4. [Initial Business Setup](#initial-business-setup)
5. [Running the Application](#running-the-application)
6. [Troubleshooting](#troubleshooting)

---

## System Requirements

Before installing Neura POS, ensure your system meets these requirements:

### Software Requirements
- **PHP**: 8.4.5 or higher
- **MySQL**: 5.7 or higher (9.6+ recommended)
- **Node.js**: 18+ (for asset compilation)
- **Composer**: Latest version

### PHP Extensions Required
- `php-mysql` (PDO MySQL driver)
- `php-intl` (Internationalization)
- `php-zip` (ZIP archive handling)
- `php-mbstring` (Multi-byte string handling)
- `php-curl` (HTTP requests)
- `php-json` (JSON handling)
- `php-openssl` (SSL/TLS support)
- `php-tokenizer` (PHP tokenizer)
- `php-gd` (Image handling)

### Hardware Requirements
- **Disk Space**: Minimum 2GB free space
- **RAM**: Minimum 2GB (4GB+ recommended for production)
- **CPU**: Multi-core processor recommended

### System Access
- Administrator/Root access to install PHP extensions
- Write permissions to the application directory
- Access to MySQL administration

---

## Installation Steps

### Step 1: Download/Clone the Application

```bash
# Option A: If you have a ZIP file
unzip neura-pos-v2.5.zip
cd "Neura POS v2.5"

# Option B: If cloning from Git
git clone <repository-url>
cd neura-pos
```

### Step 2: Verify PHP Version and Extensions

Open PowerShell/Terminal and run:

```bash
php --version
php -m | Select-String "mysql|intl|zip|pdo"
```

**Expected output** should show PHP 8.4.5+ and list the extensions above.

If extensions are missing, enable them in `php.ini`:

**Windows (PowerShell with Admin):**
```powershell
$phpIniPath = (php -r "echo php_ini_loaded_file();")
# Edit the file and uncomment:
# extension=pdo_mysql
# extension=intl
# extension=zip
```

**Linux/Mac:**
```bash
sudo phpenmod pdo_mysql intl zip
sudo systemctl restart php-fpm  # or apache2
```

### Step 3: Create MySQL Database

Open MySQL command line or phpMyAdmin and create the database:

```sql
CREATE DATABASE neurapos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON neurapos.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
```

**Note:** Replace `root` with your MySQL username if different. If MySQL root has a password, use: `'root'@'localhost' IDENTIFIED BY 'your_password'`

### Step 4: Install PHP Dependencies

Navigate to the application directory and run:

```bash
composer install
```

This installs all PHP packages (Laravel framework, libraries, etc.).

### Step 5: Create and Configure .env File

Copy the example environment file:

```bash
copy .env.example .env
```

Edit the `.env` file with your database credentials:

```env
APP_NAME=NeuraPOS
APP_ENV=production          # Use 'local' for development
APP_DEBUG=false             # Set to 'true' to see detailed errors during setup
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1          # MySQL server address
DB_PORT=3306               # MySQL port (default: 3306)
DB_DATABASE=neurapos       # Database name
DB_USERNAME=root           # MySQL username
DB_PASSWORD=               # MySQL password (empty if no password)

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io # Email server (leave as-is for now)
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=support@neurapos.com
```

### Step 6: Generate Application Key

```bash
php artisan key:generate
```

This creates a unique encryption key for your application.

### Step 7: Run Database Migrations

```bash
php artisan migrate:fresh --seed --force
```

This creates all database tables and seeds default data including the admin user.

**What this does:**
- Drops all existing tables (fresh)
- Creates new tables from migrations
- Seeds default data (users, roles, settings, etc.)
- Creates admin account: `username: admin`, `password: 12345678`

### Step 8: Clear Application Cache

```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
```

---

## First-Time Login

### Access the Application

1. Start the development server:
   ```bash
   php artisan serve
   ```

2. Open your browser and visit: **http://localhost:8000**

3. You'll see the Neura POS login page

### Default Credentials

- **Username/Email**: `admin`
- **Password**: `12345678`

### Login Options

You can login using either:
- **Username**: `admin`
- **Email**: `admin@example.com`

Both use the same password: `12345678`

### After First Login

⚠️ **IMPORTANT**: Change the default password immediately:
1. Click on your profile icon (top-right)
2. Go to **Settings** → **Profile**
3. Update your password

---

## Initial Business Setup

After logging in, configure your business information:

### 1. Company Setup

1. Navigate to **Settings** → **Company**
2. Enter your business details:
   - **Company Name**: Your business name
   - **Email**: Business email address
   - **Phone**: Contact number
   - **Address**: Business address
   - **Tax ID**: Business tax/VAT ID (if applicable)
   - **Logo**: Upload your company logo

### 2. SMTP/Email Configuration

1. Go to **Settings** → **SMTP Settings**
2. Configure email server:
   - **Host**: Your SMTP server (e.g., smtp.gmail.com)
   - **Port**: SMTP port (usually 587 for TLS, 465 for SSL)
   - **Username**: Email account username
   - **Password**: Email account password
   - **Encryption**: TLS or SSL

### 3. Currency & Localization

1. Navigate to **Settings** → **Application Settings**
2. Set:
   - **Currency**: Your local currency
   - **Date Format**: Your preferred format
   - **Language**: Default language (English, Hindi, Arabic)

### 4. Payment Types

1. Go to **Masters** → **Payment Types**
2. Add payment methods you accept:
   - Cash
   - Card (VISA, Mastercard, etc.)
   - Check
   - Bank Transfer
   - UPI/Digital Wallet

### 5. Warehouses

1. Navigate to **Masters** → **Warehouses**
2. Add your warehouse/store locations:
   - **Warehouse Name**: Name/location identifier
   - **Address**: Physical location
   - **Manager**: Assigned manager name

### 6. Item Categories

1. Go to **Masters** → **Item Categories**
2. Create product categories:
   - Electronics
   - Clothing
   - Food & Beverage
   - Books
   - etc. (based on your business)

### 7. Items/Products

1. Navigate to **Masters** → **Items**
2. Add your products:
   - **Item Name**: Product name
   - **SKU**: Stock keeping unit (unique identifier)
   - **Category**: Select category
   - **Unit**: Measurement unit (Kg, Pcs, Liters, etc.)
   - **Purchase Price**: Cost price
   - **Selling Price**: Retail price
   - **Stock**: Initial quantity

### 8. Supplier Management

1. Go to **Masters** → **Suppliers**
2. Add your suppliers:
   - **Supplier Name**: Company name
   - **Email/Phone**: Contact information
   - **Address**: Business address
   - **Tax ID**: Supplier tax number

### 9. Customer Profiles (Optional)

1. Navigate to **Masters** → **Customers**
2. Add regular customers:
   - **Customer Name**: Full name
   - **Email/Phone**: Contact details
   - **Address**: Delivery address
   - **Credit Limit**: Maximum credit allowed (if applicable)

### 10. Users & Roles

1. Go to **Settings** → **Users**
2. Create additional user accounts:
   - **Username**: Unique login name
   - **Email**: User email address
   - **Role**: Assign role (Admin, Manager, Cashier, etc.)

---

## Running the Application

### Development Environment

Start the Laravel development server:

```bash
php artisan serve
```

Then open: **http://localhost:8000**

### Production Environment

For production deployment:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run:
   ```bash
   php artisan optimize
   php artisan config:cache
   php artisan route:cache
   ```

4. Use a production web server (Apache, Nginx) instead of `php artisan serve`

5. Ensure SSL certificate is installed (HTTPS)

---

## Troubleshooting

### Issue 1: "Could not connect to the database"

**Solution:**
1. Verify MySQL is running:
   - Windows: Check Services for MySQL
   - Linux: `sudo systemctl status mysql`
   
2. Check credentials in `.env`:
   ```bash
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=neurapos
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Test connection:
   ```bash
   php artisan db:show
   ```

### Issue 2: "Class 'PDO' not found"

**Solution:**
Missing PHP MySQL extension. Enable it:

```bash
php -m | Select-String "pdo_mysql"
```

If not listed, enable in `php.ini` and restart PHP/web server.

### Issue 3: "Migration table not found"

**Solution:**
Run migrations:
```bash
php artisan migrate
```

### Issue 4: "Permission denied" errors

**Solution:**
Ensure Laravel storage directory is writable:

```bash
# Windows PowerShell (as Admin)
icacls "storage" /grant Users:F /T

# Linux/Mac
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Issue 5: "Class not found" errors

**Solution:**
Clear application cache:
```bash
php artisan cache:clear
php artisan config:clear
composer dump-autoload
```

### Issue 6: Login fails with correct credentials

**Solution:**
1. Clear config cache:
   ```bash
   php artisan config:clear
   php artisan view:clear
   ```

2. Verify admin user exists in database:
   ```bash
   php artisan tinker
   >>> App\Models\User::where('username', 'admin')->first()
   ```

3. If not found, reseed:
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

### Issue 7: "No suitable servers found"

**Solution:**
If using MySQLi, install MySQL native driver:
```bash
# Check if installed
php -i | Select-String "mysqlnd"

# If missing, enable in php.ini:
# extension=mysqlnd
```

---

## Common Workflows

### First Day Checklist

- [ ] Change admin password
- [ ] Set company information
- [ ] Configure email (SMTP)
- [ ] Set currency and language
- [ ] Add payment types
- [ ] Create warehouses
- [ ] Add product categories
- [ ] Add items/inventory
- [ ] Add suppliers
- [ ] Create user accounts for staff

### Daily Operations

1. **Start of Day**: Review previous day sales and stock levels
2. **During Day**: Process sales, record purchases, manage inventory
3. **End of Day**: Generate reports, reconcile cash, backup data

### Monthly Tasks

- Generate sales reports
- Reconcile accounts
- Review inventory levels
- Update customer credit limits
- Backup database

---

## Support & Documentation

- **Admin Panel**: http://localhost:8000/dashboard
- **Settings**: http://localhost:8000/settings
- **Reports**: http://localhost:8000/reports
- **Users**: http://localhost:8000/users

For technical issues, check:
- Application logs: `storage/logs/laravel.log`
- Database logs: MySQL error log

---

## Security Best Practices

1. **Change Default Password**: Always change the default admin password
2. **Use Strong Passwords**: Minimum 8 characters with mixed case and numbers
3. **Regular Backups**: Back up your database daily
4. **Update Software**: Keep PHP, MySQL, and dependencies updated
5. **HTTPS**: Use SSL certificates in production
6. **User Roles**: Limit permissions based on job roles
7. **Activity Logs**: Monitor user activities and transactions

---

## Next Steps

After Initial Setup:
1. Train staff on system usage
2. Set up backup procedures
3. Configure receipts/invoice templates
4. Integrate payment methods (if applicable)
5. Set up analytics and reporting
6. Plan for data migration from previous system (if applicable)

---

**Version**: 2.5  
**Last Updated**: March 2026  
**Support**: Contact your system administrator or support team
