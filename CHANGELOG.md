# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project follows Semantic Versioning.

---

## [0.5.1] - 2026-06-25

### Added
- Purchase Order approval workflow (Pending → Approved → Received → Cancelled)
- Purchase Order approval functionality
- Purchase Order receiving process with stock integration
- Automatic stock increment when Purchase Order is received
- Stock Movement creation from Purchase Order receiving
- Business rules for Purchase Order cancellation restrictions
- End-to-end Purchase Order lifecycle testing scenarios

### Improved
- Purchase Order workflow reliability and state management
- Inventory consistency across stock movements and purchase orders
- Data integrity between products, stock movements, and purchase orders
- ERP-style workflow structure (approval-based system)
- System validation for state transitions (prevent invalid actions)

---

## [0.5.0] - 2026-06-25

### Added
- Purchase Orders module implementation
- Purchase Order creation with supplier selection
- Dynamic purchase order items (multiple products per order)
- Purchase Order status tracking
- Purchase Order details view page
- Product-level quantity assignment in purchase orders
- Created-by user tracking for purchase orders
- Tailwind CSS-based UI for Purchase Orders (index, create, show)

### Improved
- Purchase order workflow structure
- Relationship handling between suppliers, products, and orders
- UI consistency across all modules
- Better readability in purchase order tables and detail view

---

## [0.4.1] - 2026-06-24

### Added
- Supplier module implementation (CRUD)
- Supplier management system (Company, Contact Person, Email, Phone, Status)
- Supplier activation/inactivation feature
- Tailwind CSS-based UI for Supplier module (index, create, edit)

### Improved
- Form validation consistency for supplier data
- UI consistency with existing modules
- Clean separation of form partials for reusability

---

## [0.4.0] - 2026-06-24

### Added
- Stock Movements module implementation
- Stock In functionality
- Stock Out functionality
- Stock Adjustment functionality
- Stock movement history tracking
- Product quantity management
- Stock movement reason tracking
- User activity tracking for stock movements
- Tailwind CSS-based UI for Stock Movements

### Improved
- Automatic inventory updates based on stock movement types
- Stock availability validation for Stock Out operations
- Consistent UI design across all modules

---

## [0.3.0] - 2026-06-23

### Added
- Categories module (CRUD operations)
- Warehouse Locations module (CRUD operations)
- Products module (CRUD operations)
- Zone, Rack, and Shelf warehouse structure
- Product image upload functionality
- Category and warehouse location relationships for products
- Tailwind CSS-based UI for Categories, Products, and Warehouse Locations

### Improved
- Category validation using Form Requests
- Product management workflow
- Structured category and warehouse location management
- Consistent UI design across all implemented modules

---

## [0.2.0] - 2026-06-19

### Added
- Role management system implementation
- User roles functionality
- Role-based middleware
- Admin authorization system

---

## [0.1.0] - 2026-06-18

### Added
- Initial project planning and structure
- Documentation setup
- GitHub repository initialization
- Laravel 12 installation
- Breeze authentication scaffolding
- Tailwind CSS setup
- Database configuration