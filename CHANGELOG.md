# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project follows Semantic Versioning.

---

## [0.8.1] - 2026-07-01

### Added
- Comprehensive automated test suite covering full warehouse system
- Authentication tests (login, register, logout, email verification, password reset, password update)
- Profile management tests (update profile, delete account, validation rules)
- Supplier module tests (CRUD operations, validation, role-based access control)
- Product module tests (admin creation, staff restriction enforcement)
- Purchase Order lifecycle tests:
  - Create purchase orders
  - Validation handling
  - Approve workflow
  - Receive workflow with stock updates
  - Cancel workflow
  - Stock movement tracking verification
- Role-based access control test coverage across all modules

### Fixed
- Fixed database constraint issues discovered during testing (e.g. ordered_by handling in purchase orders)
- Fixed factory inconsistencies for test environment (Category, WarehouseLocation, etc.)
- Fixed sidebar crash caused by null role relationship in authenticated users
- Fixed duplicate helper function redeclaration issue in test suite
- Fixed inconsistent test failures due to missing required model fields

### Improved
- Stabilized full test suite to 43/43 passing tests (104 assertions)
- Improved reliability of factories under SQLite in-memory testing
- Improved controller consistency across purchase order workflow
- Improved test coverage across all core ERP modules
- Improved system resilience against null relationships and missing data

## [0.8.0] - 2026-07-01

### Added
- Role-based dashboard UI with dynamic sections per user role
- WarehousePro redesigned layout (sidebar + top navigation structure)
- Professional notification UI with dropdown bell and unread badge counter
- Enhanced user dropdown menu (Profile, Role display, Logout)
- Modern ERP-style sidebar with active state highlighting
- Clean separation of navigation based on roles (Admin / Manager / Staff)

### Improved
- Improved UI/UX consistency across entire application layout
- Improved navigation structure for warehouse workflows
- Better visual hierarchy in dashboard KPIs and statistics cards
- More intuitive role-based user experience across modules

## [0.7.0] - 2026-06-30

### Added
- Role-Based Access Control (RBAC) implementation
- Role middleware for route-level authorization
- Product authorization policy
- Purchase Order authorization policy
- Role helper methods in the User model
- Blade authorization checks for role-based UI rendering
- Protected administrative routes based on user roles
- Authorization checks for Purchase Order approval, receiving, and cancellation
- Authorization checks for Product creation, editing, and deletion

### Improved
- Application security through layered authorization (Middleware + Policies + Blade)
- Route protection for administrative and warehouse management features
- User interface by hiding unauthorized actions and navigation elements
- Separation of business authorization logic using Laravel Policies
- Overall system security by preventing unauthorized access to protected resources

## [0.6.1] - 2026-06-27

### Added
- Event-driven notification system implementation
- Purchase Order notifications (full lifecycle support)
  - PO Created → Manager notifications
  - PO Approved → Warehouse staff notifications
  - PO Received → Admin notifications
- Low Stock detection event system
- Database notifications integration using Laravel Notifications table
- Email + database dual-channel notification support
- Role-based notification dispatching (warehouse manager targeting)
- Event & Listener architecture for warehouse workflows
- Purchase Order lifecycle event hooks
- Centralized notification handling via Laravel Events


### Improved
- Decoupled business logic using Events and Listeners
- Improved scalability of notification system
- Cleaner separation between controllers and notification logic
- Better maintainability of stock and purchase order workflows
- Enhanced warehouse operational visibility through alerts
- Standardized event naming and workflow structure


## [0.6.0] - 2026-06-27

### Added
- Warehouse Dashboard module
- Dashboard Service layer for business logic
- Warehouse Key Performance Indicators (KPIs)
- Business analytics for warehouse reporting
- Dashboard statistics including:
    - Total Products
    - Low Stock Items
    - Pending Purchase Orders
    - Total Suppliers
    - Today's Stock In
    - Today's Stock Out
- Recent Stock Movements activity feed
- Laravel Cache implementation for dashboard statistics

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