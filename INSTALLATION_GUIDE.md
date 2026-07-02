# Installation Guide

## MiniCommerce CMS

This guide explains how to install and run the project locally.

------------------------------------------------------------------------

# 1. System Requirements

-   PHP 8.2
-   Apache Web Server
-   MySQL 
-   XAMPP (recommended)

------------------------------------------------------------------------

# 2. Project Location

Extract or clone the project into:

``` text
C:\xampp\htdocs\minicommerce-cms
```

------------------------------------------------------------------------

# 3. Create the Database

Create a database, for example:

``` text
minicommerce_cms
```

------------------------------------------------------------------------

# 4. Import the Database

Import the SQL file located in the project's `database` directory.

------------------------------------------------------------------------

# 5. Configure Database Connection

Update the database configuration with your local credentials.

Example:

``` text
Host: localhost
Database: minicommerce_cms
Username: root
Password:
```

------------------------------------------------------------------------

# 6. Run the Application

## Public Website

``` text
http://localhost/minicommerce-cms/public
```

## Administration Panel

``` text
http://localhost/minicommerce-cms/public/admin/login
```

------------------------------------------------------------------------

# 7. Upload Directory

Ensure this directory exists and is writable:

``` text
public/uploads
```

------------------------------------------------------------------------

# 8. Default Administrator

Email

``` text
admin@example.com
```

Password

``` text
admin123
```

------------------------------------------------------------------------

# 9. Verify the Installation

Verify the following pages:

-   Home
-   About
-   Contact
-   Products
-   Product Details
-   Cart
-   Admin Login
-   Dashboard
-   Manage Pages
-   Manage Products
-   Website Settings

------------------------------------------------------------------------

# 10. Troubleshooting

## Cannot connect to database

-   Check MySQL is running.
-   Verify database credentials.
-   Verify the database name.

## Images are missing

-   Verify `public/uploads` exists.
-   Verify uploaded files are present.

## Login fails

-   Verify the administrator account exists.
-   Verify PHP sessions are enabled.

## Page not found

-   Verify the URL contains `/public`.
-   Verify Apache is running.

------------------------------------------------------------------------

# 11. Notes

-   The project is built entirely in plain PHP.
-   No PHP framework or CMS platform is required.
-   No external Composer dependencies are required.

------------------------------------------------------------------------

# 12. Additional Documentation

For architecture and implementation details see:

``` text
TECHNICAL_DOCUMENTATION.md
```
