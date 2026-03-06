# Neura POS v1.2 - Business-Specific Setup Guides

Setup instructions tailored for different business types.

---

## Table of Contents

- [Retail Store Setup](#retail-store-setup)
- [Restaurant/Cafe Setup](#restaurantcafe-setup)
- [Pharmacy Setup](#pharmacy-setup)
- [Supermarket/Multi-Outlet Setup](#supermarketmulti-outlet-setup)
- [Online Store with POS Setup](#online-store-with-pos-setup)

---

## Retail Store Setup

### Perfect For
Clothing stores, electronics retailers, bookshops, furniture stores, etc.

### Initial Configuration

#### 1. Company Setup
```
Company Name: Your Store Name
Business Type: Retail
Time Zone: Your local timezone
Support Email: support@yourstore.com
```

#### 2. Number System Setup
Go to **Masters** → **Prefix & Number Settings**:
- **Invoice Prefix**: INV (Invoice INV-001, INV-002, etc.)
- **Quote Prefix**: QUOTE (QUOTE-001, etc.)
- **Purchase Order Prefix**: PO (PO-001, etc.)
- **Return Prefix**: RET (RET-001, etc.)

#### 3. Item Setup for Retail
```
Example: T-Shirt
├── SKU: TSHIRT-NAVY-L
├── Category: Apparel → Shirts
├── Unit: Pieces (Pcs)
├── Size/Color: Navy/Large (use tags/variants)
├── Purchase Price: $5
├── Selling Price: $15
├── Markup: 200%
├── Reorder Level: 20 units
└── Stock: 100 units
```

#### 4. Payment Methods
- Cash
- Card (Set up payment gateway integration)
- Check
- Store Credit

#### 5. Customers
- Create frequent buyer profiles for discounts
- Set credit limits for wholesale customers
- Track purchase history for recommendations

#### 6. Suppliers
Add all product suppliers with:
- Lead time (days to deliver)
- Minimum order quantity
- Price list

#### 7. Staff Roles
- **Store Manager**: Full access
- **Cashier**: Sales only
- **Stock Manager**: Inventory only
- **Accountant**: Reports & payments only

### Daily Operations
1. **Morning**: Review inventory levels, check low-stock alerts
2. **Throughout Day**: Process sales, handle customer inquiries
3. **Evening**: Reconcile cash drawer, generate sales summary
4. **Weekly**: Order stock, reconcile accounts
5. **Monthly**: Inventory count, sales analysis

### Key Features to Use
- **Inventory Tracking**: Monitor stock levels in real-time
- **Sales by Category**: Analyze which products sell best
- **Customer Loyalty**: Track repeat customers
- **Reports**: Daily sales, inventory, profit margins

---

## Restaurant/Cafe Setup

### Perfect For
Restaurants, cafes, bars, quick-service restaurants, food delivery

### Initial Configuration

#### 1. Company Setup
```
Company Name: Your Restaurant Name
License Number: Food license number (if available)
Cuisine Type: Indian/Italian/Chinese/etc.
Opening Hours: 10:00 AM - 11:00 PM
```

#### 2. Table/Seating Setup
Create "Items" for table management or use a table mapping system:
```
Tables:
├── Indoor
│   ├── Table 1 (2 seats)
│   ├── Table 2 (4 seats)
│   └── Table 3 (6 seats)
├── Outdoor
│   ├── Table 4 (2 seats)
│   └── Table 5 (4 seats)
└── Private Room
    └── Table 6 (10 seats)
```

#### 3. Menu/Items Setup
```
Category: Appetizers
├── Spring Rolls
│   ├── SKU: SR-001
│   ├── Price: $3.99
│   ├── Preparation Time: 8 mins
│   └── Ingredients: Spring roll wrapper, veggies...
│
├── Bruschetta
│   ├── SKU: BR-001
│   ├── Price: $4.99
│   ├── Preparation Time: 5 mins
│   └── Ingredients: Bread, tomato, basil...

Category: Main Course
├── Biryani (with variants: Chicken/Mutton/Veg)
├── Butter Chicken
├── Fish Curry
└── Paneer Tikka

Category: Beverages
├── Coffee (Small/Medium/Large)
├── Tea
├── Juice
├── Soda
└── Beer/Wine (with age verification if required)

Category: Desserts
├── Cheesecake
├── Ice Cream
└── Gulab Jamun
```

#### 4. Items with Variants (Size/Portion)
Example - Pizza:
```
Item: Margarita Pizza
├── Small (10"): $8.99
├── Medium (12"): $11.99
└── Large (14"): $14.99
```

Use **Modifiers** for add-ons:
```
Extra:
├── Extra Cheese: +$1.50
├── Extra Sauce: +$0.50
├── Bacon: +$2.00
└── Mushrooms: +$1.00

Drinks:
├── Add Shots (Alcohol): +$2.00
└── No Sugar (Beverages)
```

#### 5. Payment Methods
- Cash
- Card
- UPI/Digital Payment
- Table Billing (Pay Later)

#### 6. Staff Roles
- **Manager**: Full access, reports
- **Cashier**: Process payments & orders
- **Waiter**: Take orders, view kitchen status
- **Chef**: Receive orders, update status
- **Kitchen**: Cook and manage kitchen orders

#### 7. Special Configurations
- **Delivery Address**: If offering delivery
- **Service Tax**: Set applicable taxes (usually 5% in India)
- **Tip Options**: Enable tipping at checkout
- **Reservation System**: Customer booking preferences

### Daily Operations
1. **Morning**: Staff briefing, menu review
2. **Before Opening**: Test POS, verify printer, check till
3. **During Service**: 
   - Process orders and payments
   - Track kitchen status
   - Handle special requests
   - Manage table reservations
4. **After Hours**: 
   - Cash reconciliation
   - Daily sales report
   - Inventory count for perishables
   - Kitchen cleanup checklist

### Key Features
- **Kitchen Display**: Real-time order status
- **Table Management**: Track which tables are occupied
- **Order Modifiers**: Track customizations and add-ons
- **Delivery/Takeout**: Separate order types
- **Inventory (Daily)**: Track consumed ingredients
- **Cost of Goods Sold**: Calculate profit margins on dishes

---

## Pharmacy Setup

### Perfect For
Retail pharmacies, chemist shops, health stores

### Initial Configuration

#### 1. Company Setup
```
Company Name: Pharmacy Name
License Number: Drug License / Pharmacy Registration
Owner: Pharmacist Name & License Number
City: Location
Contact: Phone & Email
```

#### 2. Item Setup - Medicines
**IMPORTANT**: Track batch numbers and expiry dates

```
Category: Pain Relief
├── Aspirin 500mg
│   ├── SKU: ASP-500-100
│   ├── Name: Aspirin 500mg (100 tablets)
│   ├── Manufacturer: Bayer
│   ├── Batch Number: BAT-2024-001
│   ├── Expiry Date: 12/2026
│   ├── Cost Price: $2.50
│   └── Selling Price: $4.99
│
├── Ibuprofen 200mg
│   ├── SKU: IBU-200-50
│   ├── Name: Ibuprofen 200mg (50 tablets)
│   └── Expiry Date: 06/2025

Category: Antibiotics (Prescription Required)
├── Amoxicillin 500mg
├── Azithromycin
└── Ciprofloxacin

Category: OTC Items
├── Multi-vitamins
├── Cough Syrup
├── Antacids
└── Cold Tablets

Category: Health Products
├── Blood Pressure Monitor
├── Glucose Meter
├── Thermometer
└── First Aid Kit
```

#### 3. Prescription Management
Enable **Prescription Tracking**:
- File copy of prescription
- Prescription expiry tracking
- Pharmacist verification notes
- Refill tracking

#### 4. Supplier Setup
```
Suppliers:
├── Major Pharma Distributor
├── Generic Medicine Supplier
├── Specialty Medication Supplier
└── Medical Devices Distributor

Terms:
├── Credit Period: 30/60 days
├── Minimum Order: $500
└── Delivery Time: 2-3 days
```

#### 5. Payment Methods
- Cash
- Card
- Insurance Claims
- Store Credit
- Subscription/Membership

#### 6. Staff Roles
- **Pharmacist-in-Charge**: Full access, prescription verification
- **Pharmacist**: Manage medications
- **Manager**: Inventory & payments
- **Cashier**: Process transactions
- **Stock Attendant**: Inventory management

#### 7. Critical Settings
- **Expiry Alert**: Set to 30 days before expiry
- **Low Stock Alert**: Set based on usage patterns
- **Batch Tracking**: MUST enable
- **Prescription Mode**: MUST enable
- **License Display**: Show at checkout if required

### Daily Operations
1. **Morning**: 
   - Check expiry alerts
   - Review low-stock items
   - Receive new deliveries
   
2. **Throughout Day**: 
   - Verify prescriptions
   - Process sales
   - Answer health queries
   
3. **Evening**: 
   - Cash reconciliation
   - Inventory update
   - Expiry tracking
   
4. **Weekly**: 
   - Review slow-moving inventory
   - Clean up expired batches
   - Reconcile with suppliers
   
5. **Monthly**: 
   - Regulatory compliance check
   - License renewal status
   - Turnover analysis

### Key Features
- **Batch Number Tracking**: Essential for recalls
- **Expiry Management**: Prevent selling expired products
- **Prescription Verification**: Legal compliance
- **Interaction Checking**: Alert on drug interactions (if available)
- **Cost Analysis**: Track margins on different products
- **Insurance Claims**: Integration for health insurance

### Compliance Requirements
- Maintain prescription records
- Track batch numbers properly
- Regular stock verification
- Cold storage monitoring (if applicable)
- Annual license renewal
- Audit trail for controlled medications

---

## Supermarket/Multi-Outlet Setup

### Perfect For
Supermarkets, grocery chains, general stores with multiple locations

### Initial Configuration

#### 1. Company Setup
```
Company Name: Supermarket/Chain Name
Head Office: Address
Number of Outlets: 3+ stores
Management Structure: Corporate
Central Warehouse: Yes/No
```

#### 2. Multi-Location Setup
Create warehouse for each store:
```
Warehouses:
├── Store 1 (Main Branch)
│   └── Location: Downtown
├── Store 2 (East Branch)
│   └── Location: Suburb Area
├── Store 3 (West Branch)
│   └── Location: Shopping Mall
└── Central Warehouse
    └── Distribution Center
```

#### 3. Item Categories
```
Groceries:
├── Vegetables (Produce)
├── Fruits (Produce)
├── Dairy & Eggs
├── Bakery
├── Beverages
├── Snacks
├── Packaged Foods
├── Oils & Spices
├── Frozen Foods
├── Meat & Seafood
└── Personal Care & Household

Each category with:
├── SKU
├── Supplier
├── Cost Price
├── Retail Price
├── Stock at each outlet
└── Reorder level
```

#### 4. Inventory Management
Enable **Stock Transfer** between locations:
```
Store 1 → Store 2 (Transfer 50 units of Item X)
Store 2 → Store 1 (Transfer back if not sold)
```

Enable **Central Warehouse Replenishment**:
```
HQ Warehouse → Store 1 (weekly)
HQ Warehouse → Store 2 (weekly)
HQ Warehouse → Store 3 (weekly)
```

#### 5. Pricing Strategy
- **Base Price**: Corporate decision, all outlets follow
- **Promotional Pricing**: By outlet manager
- **Volume Discounts**: If applicable
- **Member Discounts**: Loyalty program integration

#### 6. Payment Methods
- Cash
- Card
- UPI/Digital
- Loyalty Points/Gift Card
- Store Credit (for bulk buyers)

#### 7. Staff Structure
```
Corporate Level:
├── General Manager
├── Operations Manager
├── Inventory Manager
└── Finance Manager

Per Store:
├── Store Manager
├── Shift Supervisor
├── Cashiers (2-3)
├── Stock Attendants
└── Customer Service
```

#### 8. Reporting Requirements
- **Daily**: Sales per outlet, cash reconciliation
- **Weekly**: Stock levels across outlets, transfers
- **Monthly**: Profit/loss per outlet, budget vs actual
- **Quarterly**: Category performance, supplier analysis

### Daily Operations

**Central Level:**
1. Monitor sales across all outlets
2. Authorize stock transfers
3. Approve pricing changes
4. Review inventory shortages

**Store Level:**
1. Morning: Receive stock from warehouse
2. Throughout Day: Manage sales, shelf restocking
3. Evening: Cash reconciliation per till
4. Close: Generate daily report

### Key Features
- **Multi-Location Dashboard**: Compare store performance
- **Centralized Purchasing**: Better supplier discounts
- **Stock Transfer**: Efficient inventory allocation
- **Price Management**: Consistent pricing
- **Loyalty Program**: Customer retention
- **Budget Management**: Control per-store spending
- **Supplier Management**: Bulk orders from warehouse

### Challenges & Solutions
| Challenge | Solution |
|-----------|----------|
| Stock inconsistencies | Implement cycle counting |
| Stockouts at one store | Use inter-store transfers |
| Shrinkage | Regular audits, CCTV |
| Product expiry | Monitor batch dates |
| Pricing errors | Centralized price list |
| Supplier delays | Backup suppliers |

---

## Online Store with POS Setup

### Perfect For
E-commerce businesses that also have physical pickup/offline sales

### Initial Configuration

#### 1. Company Setup
```
Company Name: Online/Physical Brand
Website: yourbusiness.com
Warehouse Address: Fulfillment center address
Return Policy: URL link
Shipping Partners: List integration details
```

#### 2. Sales Channels
Configure multiple sales channels:
```
Channels:
├── In-Store Sales (POS)
├── Website Sales (E-commerce)
├── Mobile App Sales
├── Social Media Sales (Facebook, Instagram)
└── Marketplace (Amazon, Flipkart, etc.) if applicable
```

#### 3. Product Sync
All products should be:
```
Available on:
├── Physical Store (POS)
├── Website
├── Mobile App
├── All Marketplaces

With synchronized:
├── Pricing
├── Stock levels
├── Descriptions & Images
└── Reviews & Ratings
```

#### 4. Inventory Strategy
```
Stock Allocation:
├── 30% for in-store
├── 40% for online orders
├── 30% buffer for returns/damage

Real-time updates:
├── Customer buys online → Stock decreases
├── Customer buys in-store → Stock decreases
├── Automatic low-stock alerts → Reorder
```

#### 5. Order Management
```
Order Workflow:
├── Online Order Placed
├── Payment Confirmation
├── Pick from Warehouse
├── Pack & Quality Check
├── Label & Ship
├── Delivery
└── Return/Refund (if applicable)

Simultaneously:
├── In-store customers browsing
├── POS processing transactions
├── Stock being allocated
```

#### 6. Fulfillment Options
Enable multiple fulfillment methods:
- **Ship to Home**: Standard delivery
- **Store Pickup**: Customer picks up from store
- **Same-Day Delivery**: If available in area
- **Local Delivery**: Partner delivery

#### 7. Payment Methods
- Credit/Debit Card (Stripe, PayPal, Razorpay)
- Digital Wallets (Apple Pay, Google Pay, UPI)
- Cash on Delivery (if available)
- Bank Transfer
- EMI options

#### 8. Staff Roles
```
Corporate:
├── E-commerce Manager
├── Operations Manager
├── Customer Service Manager
└── Finance Manager

Store:
├── Store Manager
├── POS Cashiers
└── Fulfillment Staff

Warehouse:
├── Warehouse Manager
├── Pickers & Packers
└── QC Inspector
```

### Daily Operations

**E-commerce Level:**
```
Morning:
├── Review overnight orders
├── Generate pick lists
├── Update shipping status

Throughout Day:
├── Process new orders
├── Handle customer inquiries
├── Update delivery status

Evening:
├── Generate daily sales report
├── Reconcile payments
├── Plan next day shipments
```

**Store Level:**
```
Morning:
├── Receive stock from warehouse
├── Stock daily items
├── Prepare for in-store customers

Throughout Day:
├── Process POS sales
├── Handle in-store inquiries
├── Pick items for online orders (if applicable)

Evening:
├── Cash reconciliation
├── Stock replenishment planning
```

### Challenges & Solutions

| Challenge | Solution |
|-----------|----------|
| Double-selling (same inventory) | Real-time sync, buffer stock |
| Payment failures | Multiple payment gateways |
| Shipping delays | Multiple couriers, tracking |
| Returns & refunds | Clear policy, easy process |
| Customer mis-match | ASIN/SKU standardization |
| Warehouse delays | Dedicated fulfillment team |

### Integration Checklist
- [ ] Website connected to POS
- [ ] Inventory synced across channels
- [ ] Payment gateway integrated
- [ ] Shipping partner API connected
- [ ] Customer data unified
- [ ] Reports consolidated
- [ ] Stock levels auto-update
- [ ] Order notifications working

---

## General Tips for All Business Types

### 1. User Training
- Create simple guides for each role
- Schedule training sessions
- Provide written/video tutorials
- Designate a "super user" for troubleshooting

### 2. Data Entry Accuracy
- Double-check initial data entry
- Standardize units and measurements
- Use consistent SKU format
- Regular data audits

### 3. Regular Backups
- Daily database backups
- Weekly full system backups
- Test restore procedures monthly

### 4. Security
- Different passwords for each user
- Regular password changes
- Limit access by role
- Monitor suspicious activities

### 5. Scaling
- Start small, add features gradually
- Test before full implementation
- Document all customizations
- Plan for growth

---

**Version**: 1.2  
**Last Updated**: March 2026
