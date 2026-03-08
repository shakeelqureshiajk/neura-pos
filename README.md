# Neura POS v2.5

A powerful, multi-tenant Point of Sale (POS) system built with **Laravel 10** for retail stores, restaurants, pharmacies, supermarkets, and online commerce. Designed for businesses in Pakistan, US, Middle East, and Europe.

## 🎯 Key Features

- ✅ **Multi-Tenant Architecture** - Serve multiple businesses from one installation
- ✅ **Multi-Language Support** - English, Urdu, Arabic, Hindi
- ✅ **Multi-Currency** - 11+ currencies with dynamic exchange rates (PKR as default)
- ✅ **Inventory Management** - Real-time stock tracking, low-stock alerts, batch/serial tracking
- ✅ **Sales & Purchases** - Invoices, quotations, orders, returns, payments
- ✅ **Vendor & Customer Management** - Contact info, payment history, credit limits
- ✅ **Financial Reports** - Balance sheet, trial balance, expense reports, GST compliance
- ✅ **Role-Based Access Control** - Admin, Manager, Cashier, Stock Manager, Accountant roles
- ✅ **SMS & Email Notifications** - Twilio & Vonage SMS, email alerts
- ✅ **Export/Print** - PDF generation, Excel export, thermal printing
- ✅ **Mobile-Ready UI** - Responsive design for tablets and phones

---

## 🏢 Use Cases

| Business Type | Key Features |
|---|---|
| **Retail Store** | Inventory tracking, POS, sales analytics, customer loyalty |
| **Restaurant/Cafe** | Table management, order management, kitchen printing, bill splitting |
| **Pharmacy** | Batch tracking, expiry alerts, prescription management, GSTR-2B |
| **Supermarket** | Multi-outlet, warehouse management, real-time sync, bulk sales |
| **Online Store** | Product catalog, order management, payment gateway integration |

---

## 💻 System Requirements

### Software
- **PHP**: 8.1 or higher
- **MySQL**: 5.7+ or MariaDB 10.2+
- **Node.js**: 16+ (for assets)
- **Composer**: Latest version

### PHP Extensions
- `pdo_mysql`, `intl`, `zip`, `mbstring`, `curl`, `json`, `openssl`, `gd`

### Hardware
- **Disk**: 2GB minimum
- **RAM**: 2GB minimum (4GB+ recommended)
- **CPU**: Multi-core processor

### Supported Markets
- 🇵🇰 Pakistan (PKR)
- 🇺🇸 United States (USD)
- 🇸🇦 Saudi Arabia (SAR)
- 🇦🇪 UAE (AED)
- 🇮🇹 🇪🇸 🇫🇷 Europe (EUR)
- And 6+ more currencies

---

## 🚀 Quick Start

### 1. Clone Repository
```bash
git clone https://github.com/shakeelqureshiajk/neura-pos.git
cd neura-pos
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=neurapos
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database
```bash
php artisan migrate:fresh --seed
```

### 5. Build Assets & Run
```bash
npm run build
php artisan serve
```

**Access**: http://localhost:8000  
**Default Login**: `admin` / `12345678`

---

## 📦 Project Structure

```
neura-pos/
├── app/
│   ├── Enums/              # Language, App enums
│   ├── Http/Controllers/   # Business logic
│   ├── Models/             # Database models
│   ├── Services/           # Business services
│   ├── Traits/             # Reusable mixins
│   └── View/Components/    # Blade components
├── database/
│   ├── migrations/         # Schema changes
│   └── seeders/            # Sample data (CurrencySeeder, LanguageSeeder)
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Tailwind styles
│   └── js/                 # Frontend logic
├── routes/                 # API & web routes
├── config/                 # App configuration
├── lang/                   # Translation files (en, ur, ar, hi)
└── public/                 # Assets, flags, libraries
```

---

## 🌐 Language & Currency Configuration

### Languages
Manage in **Settings → General → Language**:
- **English** (en) - LTR
- **Urdu** (ur) - RTL  
- **Arabic** (ar) - RTL
- **Hindi** (hi) - LTR

Add more by creating folders in `lang/`

### Currencies
Select primary currency in **Settings → General → Primary Currency**:
- **PKR** - Pakistani Rupee (default, base rate = 1.0)
- **USD** - US Dollar
- **EUR**, **GBP**, **AED**, **SAR**, **KWD**, **OMR**, **QAR**, **BHD**, **INR**

Exchange rates auto-update; edit in currency admin panel.

---

## 📊 Core Modules

### Sales Module
- Create invoices, quotations, orders
- Customer discounts, tax calculations
- Payment tracking, receipt printing
- Sale returns & credit notes

### Purchase Module
- Create purchase orders, bills
- Supplier management, payment tracking
- Purchase returns & debit notes
- Goods received notes (GRN)

### Inventory
- Real-time stock levels by warehouse
- Batch/serial number tracking
- Stock transfers between warehouses
- Stock adjustments with reasons
- Low-stock alerts, reorder levels

### Finance
- Chart of accounts
- Journal entries
- Balance sheet, trial balance
- Expense tracking
- GST/VAT compliance (GSTR-1, GSTR-2B)

### Reports
- Sales by date, category, customer
- Customer due payments
- Inventory transaction history
- Expense breakdown
- Warehouse-wise stock reports

### Masters
- Item categories, brands, units
- Customers, suppliers, payment types
- Tax rates & tax groups
- Warehouse & stock locations
- Users, roles, permissions

---

## 🔐 Security & Access Control

**Roles**:
- **Admin** - Full system access
- **Manager** - Sales, purchase, reports
- **Cashier** - POS sales only
- **Stock Manager** - Inventory only
- **Accountant** - Finance & reports only

**Permissions**: 180+ granular permissions (create, edit, delete, view)

---

## 🛠️ Key Dependencies

| Package | Purpose |
|---|---|
| `laravel/framework` | Web framework |
| `stancl/tenancy` | Multi-tenancy |
| `spatie/laravel-permission` | Role-based access control |
| `yajra/laravel-datatables` | Advanced tables |
| `mpdf/mpdf` | PDF generation |
| `phpoffice/phpspreadsheet` | Excel export |
| `twilio/sdk` | SMS via Twilio |
| `vonage/client` | SMS via Vonage |
| `spatie/image` | Image optimization |
| `jackiedo/timezonelist` | Timezone management |

---

## 📚 Documentation

- **[SETUP_GUIDE.md](SETUP_GUIDE.md)** - Complete installation & configuration
- **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** - Common commands & troubleshooting
- **[BUSINESS_SETUP_GUIDES.md](BUSINESS_SETUP_GUIDES.md)** - Setup for retail, restaurant, pharmacy, etc.
- **[documentation/](documentation/)** - Feature-by-feature guides (HTML format)

---

## 🔧 Common Commands

```bash
# Development
php artisan serve                          # Start dev server
php artisan tinker                         # Interactive shell

# Database
php artisan migrate                        # Run migrations
php artisan migrate:fresh --seed           # Reset & reseed
php artisan db:seed --class=CurrencySeeder # Seed currencies

# Cache & Config
php artisan cache:clear                    # Clear cache
php artisan config:clear                   # Clear config cache
php artisan view:clear                     # Clear views

# Assets
npm run dev                                # Development mode
npm run build                              # Production build
npm run watch                              # Watch for changes
```

---

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Check MySQL is running
# Verify .env credentials
php artisan db:show
```

### Extension Missing
```bash
# Check installed extensions
php -m | grep -E "mysql|intl|zip"

# Enable extension in php.ini, then restart PHP
```

### Assets Not Loading
```bash
npm install
npm run build
# Clear browser cache (Ctrl+Shift+Delete)
```

---

## 📝 License

This project is licensed under the MIT License - see [LICENSE](LICENSE) for details.

---

## 👋 Support & Contribution

- **Report Issues**: [GitHub Issues](https://github.com/shakeelqureshiajk/neura-pos/issues)
- **Feature Requests**: Welcome! Open an issue with `[FEATURE]` prefix
- **Contributions**: Fork, branch, commit, and submit a pull request

---

## 🌟 Recent Updates (v2.5)

✨ **Multi-Language & Multi-Currency Enhancements**:
- ✅ Added Urdu language (RTL) support
- ✅ Kept Arabic, Hindi, and English
- ✅ Added 11+ currencies with dynamic exchange rates
- ✅ PKR set as primary/base currency
- ✅ Selectable primary currency in settings (no code changes needed)
- ✅ All historical exchange rates update relative to selected base currency

---

**Made with ❤️ for businesses worldwide**

