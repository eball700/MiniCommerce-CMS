# Technical Documentation

## MiniCommerce CMS

### 1. Introduction

This document describes the architecture, implementation decisions and
technical details of the MiniCommerce CMS project.

The application was developed as a technical assignment for a Mid-Level
Full-Stack PHP Developer position. The primary objective was to build a
complete CMS and small eCommerce application using **plain PHP 8** without
relying on any PHP framework or CMS platform.

------------------------------------------------------------------------

# 2. Technical Requirements

Implemented technologies:

-   PHP 8.2
-   MySQL 
-   PDO
-   HTML5
-   CSS3
-   Vanilla JavaScript

Frameworks intentionally NOT used:

-   Laravel
-   Symfony
-   CodeIgniter
-   CakePHP
-   Slim
-   Laminas
-   WordPress
-   Magento
-   WooCommerce
-   Drupal
-   Joomla
-   PrestaShop

------------------------------------------------------------------------

# 3. Architecture

The application follows a lightweight custom MVC-style architecture.

Responsibilities are separated into:

-   Controllers
-   Repositories
-   Services
-   Views
-   Layouts
-   Configuration
-   Database layer

Application flow:

Browser → Router → Controller → Repository → PDO → MySQL → View

Controllers coordinate requests.

Repositories encapsulate SQL.

Views contain presentation logic only.

Services provide reusable infrastructure such as database connectivity.

------------------------------------------------------------------------

# 4. Project Structure

```text
app/
 ├── Controllers/
 ├── Core/
 ├── Helpers/
 ├── Models/
 ├── Repositories/
 ├── Services/
 ├── Views/
 │    ├── admin/
 │    ├── layouts/
 │    └── public/
config/
database/
public/
 ├── assets/
 ├── uploads/
routes/
storage/
```

The project structure separates business logic, presentation, routing, configuration and reusable services to improve maintainability, readability and scalability.

------------------------------------------------------------------------

# 5. Database Design

Main entities:

-   users
-   pages
-   products
-   categories
-   settings

Relationships:

-   Products belong to categories.
-   Website configuration is stored in settings.
-   CMS pages are loaded dynamically.

------------------------------------------------------------------------

# 6. Authentication

Authentication uses PHP sessions.

Implemented features:

-   Login
-   Logout
-   Session persistence
-   Route protection
-   Admin authorization checks

No JWT or third-party authentication libraries were used because they
were unnecessary for the assignment scope.

------------------------------------------------------------------------

# 7. Security

Security measures implemented:

-   Prepared SQL statements
-   PDO parameter binding
-   CSRF token validation
-   Output escaping using htmlspecialchars()
-   Session authentication
-   Basic authorization
-   Delete confirmation
-   Validation of request data

The project avoids SQL injection by never concatenating user supplied
values directly into SQL queries.

------------------------------------------------------------------------

# 8. CMS

The CMS allows administrators to:

-   Create pages
-   Edit pages
-   Delete pages
-   Publish or draft pages

Only published pages appear in the public navigation.

------------------------------------------------------------------------

# 9. Product Management

Administrators can:

-   Create products
-   Edit products
-   Delete products
-   Upload images
-   Assign categories
-   Configure featured status
-   Control publication status

------------------------------------------------------------------------

# 10. Featured Products

Multiple products may be marked as featured.

The homepage intentionally displays only the newest three featured
products by querying with LIMIT 3.

This satisfies the assignment requirement of displaying a maximum of
three featured products while keeping administration flexible.

------------------------------------------------------------------------

# 11. Shopping Cart

The shopping cart is session-based.

Implemented functionality:

-   Add product
-   Update quantity
-   Remove product
-   Cart badge
-   Demo checkout modal

The checkout modal intentionally replaces real payment processing
because the assignment explicitly states that payment integration is not
required.

------------------------------------------------------------------------

# 12. Website Settings

Website configuration is stored in the settings table.

Current dynamic settings:

-   Site title
-   Contact email

The contact page renders the configured email dynamically through a
placeholder replacement strategy.

------------------------------------------------------------------------

# 13. UI / UX

Design goals:

-   Clean layout
-   Responsive design
-   Consistent styling
-   Simple administration
-   Accessible navigation

Additional improvements:

-   Modern homepage hero
-   Unified visual style
-   Footer
-   Cart badge
-   Responsive tables
-   Responsive forms
-   Responsive admin dashboard

------------------------------------------------------------------------

# 14. Responsive Design

The interface was tested on desktop, tablet and mobile viewport sizes.

Responsive behaviour includes:

-   Flexible navigation
-   Responsive product grid
-   Responsive forms
-   Table wrappers with horizontal scrolling
-   Prevention of page-level horizontal scrolling

JavaScript is not required for essential application functionality.

------------------------------------------------------------------------

# 15. Validation

Server-side validation is implemented for:

-   Authentication
-   Pages
-   Products
-   Settings

Client-side JavaScript is used only to improve user experience and never
replaces server-side validation.

------------------------------------------------------------------------

# 16. Coding Principles

Development focused on:

-   Separation of concerns
-   Readability
-   Maintainability
-   Reusability
-   Simplicity

Repositories isolate SQL from controllers, reducing duplication and
making future maintenance easier.

------------------------------------------------------------------------

# 17. Assignment Compliance

The implementation satisfies the assignment by providing:

-   Plain PHP implementation
-   Custom MVC structure
-   Responsive frontend
-   Protected administration area
-   CMS functionality
-   Product management
-   Shopping cart
-   Website settings
-   Session authentication
-   Basic permission checks
-   Prepared statements
-   CSRF protection

------------------------------------------------------------------------

# 18. Known Limitations

The following features were intentionally excluded because they were
outside the assignment scope:

-   Customer accounts
-   Order processing
-   Payment gateway integration
-   Inventory management
-   Shipping
-   Email notifications

------------------------------------------------------------------------

# 19. Future Enhancements

Possible future improvements:

-   Search
-   Pagination
-   Order history
-   User roles
-   API endpoints
-   Automated testing
-   Logging
-   Image optimization

------------------------------------------------------------------------

# 20. Conclusion

The project demonstrates how a complete CMS and small eCommerce
application can be implemented using plain PHP while maintaining a clear
architecture, secure coding practices and responsive user experience.

The solution intentionally avoids PHP frameworks and CMS platforms,
fulfilling the technical constraints of the assignment while remaining
extensible and maintainable.
