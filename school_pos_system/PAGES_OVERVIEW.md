# School POS System - Pages Overview

## 🏠 **Main Navigation**
```
┌─────────────────────────────────────────────────────────────────────────────────┐
│ 🎓 School POS System    [POS] [Products] [Categories] [Customers] [Sales] [Admin]│
└─────────────────────────────────────────────────────────────────────────────────┘
```

## 1. 🛒 **POS Interface** (`/pos`) - Main Cashier Page

```
┌─────────────────────────────────────────┬─────────────────────────────┐
│ 📦 Products                             │ 🛒 Cart                     │
│ [Search...] [Category Filter]           │                             │
│                                         │ Customer: [Select Customer] │
│ [All] [Food] [Supplies] [Uniforms]...   │                             │
│                                         │ ┌─────────────────────────┐ │
│ ┌─────┐ ┌─────┐ ┌─────┐ ┌─────┐        │ │ Cart is empty           │ │
│ │🍔   │ │🥤   │ │🍪   │ │📓   │        │ │                         │ │
│ │Sand │ │Juice│ │Cook │ │Note │        │ └─────────────────────────┘ │
│ │$4.50│ │$2.00│ │$1.50│ │$3.25│        │                             │
│ └─────┘ └─────┘ └─────┘ └─────┘        │ Subtotal: $0.00             │
│                                         │ Tax (10%): $0.00            │
│ ┌─────┐ ┌─────┐ ┌─────┐ ┌─────┐        │ Total: $0.00                │
│ │✏️   │ │👕   │ │📚   │ │⚽   │        │                             │
│ │Pen  │ │Shirt│ │Book │ │Ball │        │ Payment: [Cash ▼]           │
│ │$0.75│ │$18.0│ │$45.0│ │$25.0│        │ Paid: [____]                │
│ └─────┘ └─────┘ └─────┘ └─────┘        │ Change: $0.00               │
│                                         │                             │
│ [More products...]                      │ [💳 Checkout]               │
│                                         │ [🗑️ Clear Cart]             │
└─────────────────────────────────────────┴─────────────────────────────┘
```

**Features:**
- ✅ Click products to add to cart
- ✅ Category tabs for easy browsing
- ✅ Real-time search functionality
- ✅ Customer selection with balance display
- ✅ Multiple payment methods (Cash, Card, Account)
- ✅ Automatic tax and change calculation
- ✅ Stock level indicators

## 2. 📦 **Products Management** (`/products`)

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│ 📦 Products                                                      [➕ Add Product]│
├─────────────────────────────────────────────────────────────────────────────────┤
│ Image  │ Name              │ SKU        │ Category    │ Price  │ Stock │ Actions │
├─────────────────────────────────────────────────────────────────────────────────┤
│ 🍔     │ Chicken Sandwich  │ FOOD-001   │ Food & Bev  │ $4.50  │ ✅ 50  │ ✏️ 🗑️  │
│ 🥤     │ Orange Juice      │ FOOD-002   │ Food & Bev  │ $2.00  │ ✅ 100 │ ✏️ 🗑️  │
│ 🍪     │ Chocolate Cookie  │ FOOD-003   │ Food & Bev  │ $1.50  │ ✅ 80  │ ✏️ 🗑️  │
│ 📓     │ Spiral Notebook   │ SUPPLY-001 │ Supplies    │ $3.25  │ ✅ 200 │ ✏️ 🗑️  │
│ ✏️     │ Blue Pen          │ SUPPLY-002 │ Supplies    │ $0.75  │ ✅ 500 │ ✏️ 🗑️  │
│ 👕     │ School Polo Shirt │ UNIFORM-001│ Uniforms    │ $18.00 │ ⚠️ 75  │ ✏️ 🗑️  │
│ 📚     │ Math Textbook     │ BOOK-001   │ Books       │ $45.00 │ ✅ 60  │ ✏️ 🗑️  │
│ ⚽     │ Soccer Ball       │ SPORT-001  │ Sports      │ $25.00 │ ⚠️ 20  │ ✏️ 🗑️  │
└─────────────────────────────────────────────────────────────────────────────────┘
```

**Features:**
- ✅ Complete product inventory management
- ✅ Stock level indicators (Green=Good, Yellow=Low, Red=Out)
- ✅ Category badges with color coding
- ✅ Edit/Delete functionality
- ✅ Pagination for large inventories

## 3. 👥 **Customer Management** (`/customers`)

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│ 👥 Customers                                                    [➕ Add Customer]│
├─────────────────────────────────────────────────────────────────────────────────┤
│ Name              │ ID          │ Type    │ Grade    │ Balance │ Status │ Actions │
├─────────────────────────────────────────────────────────────────────────────────┤
│ John Smith        │ STU-2024-001│ Student │ Grade 10A│ $25.00  │ Active │ ✏️ 🗑️  │
│ Emily Johnson     │ STU-2024-002│ Student │ Grade 9B │ $30.50  │ Active │ ✏️ 🗑️  │
│ Michael Brown     │ STU-2024-003│ Student │ Grade 11C│ $15.75  │ Active │ ✏️ 🗑️  │
│ Dr. Jennifer M.   │ STAFF-001   │ Staff   │ -        │ $50.00  │ Active │ ✏️ 🗑️  │
│ Robert Anderson   │ STAFF-002   │ Staff   │ -        │ $35.00  │ Active │ ✏️ 🗑️  │
│ Guest User        │ -           │ Visitor │ -        │ $0.00   │ Active │ ✏️ 🗑️  │
└─────────────────────────────────────────────────────────────────────────────────┘
```

**Features:**
- ✅ Student, Staff, and Visitor management
- ✅ Account balance tracking
- ✅ Student ID system
- ✅ Grade/Class tracking
- ✅ Contact information management

## 4. 📊 **Sales Reports** (`/sales`)

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│ 📊 Sales                                                                        │
│ [Date From] [Date To] [Customer Filter] [Payment Method] [🔍 Filter]            │
├─────────────────────────────────────────────────────────────────────────────────┤
│ Sale #        │ Date/Time      │ Customer      │ Payment │ Total  │ Actions      │
├─────────────────────────────────────────────────────────────────────────────────┤
│ SALE-20250717-│ Jul 17, 2025   │ John Smith    │ Cash    │ $12.65 │ 👁️ 🧾        │
│ 0001          │ 14:30:25       │ (STU-2024-001)│         │        │              │
│ SALE-20250717-│ Jul 17, 2025   │ Walk-in       │ Card    │ $8.25  │ 👁️ 🧾        │
│ 0002          │ 14:45:12       │               │         │        │              │
│ SALE-20250717-│ Jul 17, 2025   │ Emily Johnson │ Account │ $25.50 │ 👁️ 🧾        │
│ 0003          │ 15:10:33       │ (STU-2024-002)│         │        │              │
└─────────────────────────────────────────────────────────────────────────────────┘
│ Total Sales: $46.40 | Total Transactions: 3                                    │
└─────────────────────────────────────────────────────────────────────────────────┘
```

**Features:**
- ✅ Complete transaction history
- ✅ Date range filtering
- ✅ Customer and payment method filters
- ✅ Sales totals and analytics
- ✅ Receipt reprinting

## 5. 🧾 **Receipt Page** (`/pos/receipt/{id}`)

```
┌─────────────────────────────────────┐
│             SCHOOL STORE            │
│         Point of Sale System        │
│          123 School Street          │
│        Education City, EC 12345     │
│         Phone: (555) 123-4567       │
├─────────────────────────────────────┤
│ Receipt #: SALE-20250717-0001       │
│ Date: Jul 17, 2025 14:30:25         │
│ Cashier: Admin User                 │
│ Customer: John Smith (STU-2024-001) │
├─────────────────────────────────────┤
│ Item           Qty  Price    Total  │
├─────────────────────────────────────┤
│ Chicken Sand.   1   $4.50    $4.50 │
│ Orange Juice    2   $2.00    $4.00 │
│ Blue Pen        3   $0.75    $2.25 │
├─────────────────────────────────────┤
│ Subtotal:                   $10.75  │
│ Tax (10%):                   $1.08  │
│ TOTAL:                      $11.83  │
├─────────────────────────────────────┤
│ Payment Method: Cash                │
│ Amount Paid:             $15.00     │
│ Change:                   $3.17     │
├─────────────────────────────────────┤
│         Thank you for your          │
│            purchase!                │
│          Have a great day!          │
│                                     │
│      Items sold are not             │
│         returnable.                 │
└─────────────────────────────────────┘
```

**Features:**
- ✅ Professional receipt layout
- ✅ Complete transaction details
- ✅ School branding
- ✅ Auto-print functionality
- ✅ Thermal printer ready format

## 6. 🏷️ **Categories Management** (`/categories`)

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│ 🏷️ Categories                                                  [➕ Add Category]│
├─────────────────────────────────────────────────────────────────────────────────┤
│ Name              │ Description                    │ Color   │ Products │ Actions │
├─────────────────────────────────────────────────────────────────────────────────┤
│ Food & Beverages  │ Cafeteria items, snacks...     │ 🟢      │ 3        │ ✏️ 🗑️  │
│ School Supplies   │ Stationery, notebooks...       │ 🔵      │ 3        │ ✏️ 🗑️  │
│ Uniforms          │ School uniforms and access...  │ ⚫      │ 2        │ ✏️ 🗑️  │
│ Books             │ Textbooks and educational...   │ 🟡      │ 2        │ ✏️ 🗑️  │
│ Sports Equipment  │ Sports gear and equipment      │ 🔴      │ 1        │ ✏️ 🗑️  │
│ Electronics       │ Calculators, tablets...        │ 🟦      │ 1        │ ✏️ 🗑️  │
└─────────────────────────────────────────────────────────────────────────────────┘
```

**Features:**
- ✅ Color-coded category system
- ✅ Product count per category
- ✅ Category descriptions
- ✅ Edit/Delete with protection

## 🎯 **Key System Features**

### **Real-time Functionality**
- ✅ Live stock updates
- ✅ Instant cart calculations
- ✅ Real-time search
- ✅ Dynamic pricing

### **Payment Processing**
- ✅ Cash with change calculation
- ✅ Card payments
- ✅ Account balance deduction
- ✅ Payment validation

### **Inventory Management**
- ✅ Stock level monitoring
- ✅ Low stock alerts
- ✅ Automatic stock deduction
- ✅ SKU and barcode system

### **School-Specific Features**
- ✅ Student ID integration
- ✅ Staff accounts
- ✅ Grade level tracking
- ✅ Prepaid balance system

### **Responsive Design**
- ✅ Works on desktop, tablet, mobile
- ✅ Bootstrap 5.3 styling
- ✅ Modern UI/UX
- ✅ Accessibility features

---

**Access the system at:** `http://localhost:8000/pos`

**Login:** No authentication required (demo mode)

**Sample Data:** Pre-loaded with realistic school store inventory