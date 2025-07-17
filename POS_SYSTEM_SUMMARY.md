# School POS System - Laravel Implementation

## Overview
A comprehensive Point of Sale (POS) system built with Laravel 12.x specifically designed for school environments. The system supports managing products, customers (students/staff), sales transactions, and provides a modern web-based interface for cashier operations.

## Key Features

### 1. Product Management
- **Categories**: Organize products with color-coded categories
- **Inventory Tracking**: Real-time stock monitoring with low-stock alerts
- **Product Information**: SKU, barcode, pricing, descriptions, and images
- **Stock Levels**: Automatic stock deduction on sales with minimum level alerts

### 2. Customer Management
- **Student/Staff Profiles**: Manage students and staff with unique IDs
- **Account Balance**: Support for prepaid account system
- **Customer Types**: Students, Staff, and Visitors
- **Quick Search**: Fast customer lookup by name, ID, or email

### 3. Point of Sale Interface
- **Intuitive Design**: Modern, responsive web interface
- **Category Filtering**: Quick product browsing by category
- **Shopping Cart**: Real-time cart management with quantity adjustments
- **Payment Methods**: Cash, Card, and Account Balance payments
- **Receipt Generation**: Automatic receipt printing with transaction details

### 4. Sales Management
- **Transaction History**: Complete sales records with filtering
- **Receipt Reprinting**: Access to historical receipts
- **Sales Reports**: Revenue tracking and transaction analysis
- **Payment Tracking**: Monitor different payment methods

### 5. System Features
- **Tax Calculation**: Automatic tax computation (configurable)
- **Change Calculation**: Automatic change calculation for cash payments
- **Stock Validation**: Prevents overselling with real-time stock checks
- **Responsive Design**: Works on desktop, tablet, and mobile devices

## Technical Implementation

### Database Schema
```
Categories:
- id, name, description, color, is_active, timestamps

Products:
- id, name, description, sku, barcode, category_id, price, cost
- stock_quantity, min_stock_level, image, is_active, track_quantity, timestamps

Customers:
- id, name, email, phone, student_id, type (student/staff/visitor)
- class_grade, balance, is_active, timestamps

Sales:
- id, sale_number, customer_id, user_id, subtotal, tax_amount
- discount_amount, total_amount, paid_amount, change_amount
- payment_method, status, notes, timestamps

Sale_Items:
- id, sale_id, product_id, product_name, product_sku
- unit_price, quantity, total_price, timestamps
```

### Controllers
- **POSController**: Handles POS interface and transaction processing
- **ProductController**: CRUD operations for products with search functionality
- **CategoryController**: Category management
- **CustomerController**: Customer management with search
- **SaleController**: Sales reporting and transaction history

### Models with Relationships
- **Category**: hasMany Products
- **Product**: belongsTo Category, hasMany SaleItems
- **Customer**: hasMany Sales
- **Sale**: belongsTo Customer/User, hasMany SaleItems
- **SaleItem**: belongsTo Sale/Product

### Key Routes
```
GET /pos                    - POS Interface
POST /pos/process-sale      - Process Transaction
GET /pos/receipt/{sale}     - View Receipt

Resource routes for:
- /products
- /categories
- /customers
- /sales

API routes for search functionality
```

## Sample Data Included

### Categories
- Food & Beverages
- School Supplies
- Uniforms
- Books
- Sports Equipment
- Electronics

### Products
- Various items in each category with realistic pricing
- Stock quantities and minimum levels set
- SKU and barcode systems implemented

### Customers
- Sample students with IDs and account balances
- Staff members with different access levels
- Guest/visitor accounts

## Installation & Setup

1. **Database Setup**: Run migrations and seeders
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

2. **Storage Setup**: Link storage for product images
   ```bash
   php artisan storage:link
   ```

3. **Server Start**: Launch development server
   ```bash
   php artisan serve
   ```

## Usage Instructions

### For Cashiers
1. Access the POS interface at `/pos`
2. Select products by clicking on them
3. Choose customer (optional)
4. Select payment method
5. Enter payment amount
6. Process sale and print receipt

### For Administrators
- Manage products at `/products`
- Manage categories at `/categories`
- Manage customers at `/customers`
- View sales reports at `/sales`

## Security Features
- CSRF protection on all forms
- Input validation on all endpoints
- SQL injection prevention through Eloquent ORM
- XSS protection through Blade templating

## Performance Optimizations
- Database indexing on frequently queried fields
- Eager loading of relationships
- Pagination for large datasets
- Optimized queries with proper joins

## Future Enhancements
- User authentication and role-based access
- Advanced reporting and analytics
- Barcode scanning integration
- Receipt printing to thermal printers
- Multi-location support
- Discount and promotion system
- Inventory management alerts
- Integration with school management systems

## Technology Stack
- **Backend**: Laravel 12.x (PHP 8.4+)
- **Frontend**: Bootstrap 5.3, jQuery 3.6
- **Database**: SQLite (configurable to MySQL/PostgreSQL)
- **Icons**: Font Awesome 6.4
- **Styling**: Custom CSS with Bootstrap components

## File Structure
```
school_pos_system/
├── app/
│   ├── Http/Controllers/
│   │   ├── POSController.php
│   │   ├── ProductController.php
│   │   ├── CategoryController.php
│   │   ├── CustomerController.php
│   │   └── SaleController.php
│   └── Models/
│       ├── Category.php
│       ├── Product.php
│       ├── Customer.php
│       ├── Sale.php
│       └── SaleItem.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── pos/
│   │   ├── index.blade.php
│   │   └── receipt.blade.php
│   └── products/
│       └── index.blade.php
└── routes/web.php
```

This POS system provides a solid foundation for school retail operations with room for customization and expansion based on specific institutional needs.