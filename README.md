# MiniCommerce CMS

## Overview

MiniCommerce CMS is a custom-built web application developed as a
technical assignment for a Mid-Level Full-Stack PHP Developer position.

The objective was to design and implement a small CMS with basic
eCommerce functionality **without using any PHP framework or CMS
platform**.

The application was implemented entirely in **plain PHP 8**, HTML5, CSS3
and vanilla JavaScript using a lightweight MVC-style architecture
designed specifically for this project.

------------------------------------------------------------------------

# Assignment Goals

The project was required to provide:

-   Public website
-   Protected administration panel
-   CMS page management
-   Product management
-   Shopping cart
-   Website settings
-   Responsive interface
-   Secure authentication

All requested functionality has been implemented while respecting every
technical restriction of the assignment.

------------------------------------------------------------------------

# Main Features

## Public Website

-   Dynamic homepage
-   Dynamic navigation generated from published CMS pages
-   Maximum of three featured products on homepage
-   Product catalogue
-   Product details page
-   Shopping cart
-   Demo checkout dialog (no real payment as required by assignment)
-   Dynamic website title
-   Dynamic contact email
-   Responsive layout

## Administration

-   Session based login
-   Dashboard
-   CMS Page CRUD
-   Product CRUD
-   Website settings
-   Featured product management
-   Draft / Published status
-   Image upload
-   Logout

------------------------------------------------------------------------

# Technology Stack

  Technology        Details
  ----------------- ---------------------
  PHP               8.2
  Database          MySQL 
  Database Access   PDO
  SQL Security      Prepared Statements
  Frontend          HTML5 + CSS3
  JavaScript        Vanilla JavaScript
  Architecture      Custom MVC
  Authentication    PHP Sessions
  Security          CSRF Protection

No Laravel, Symfony, CodeIgniter, Slim, WordPress, Magento, WooCommerce
or any other framework/platform has been used.

------------------------------------------------------------------------

# Architecture

The project follows a lightweight custom MVC-style architecture.

Responsibilities are separated into:

-   Controllers
-   Repositories
-   Services
-   Views
-   Layouts
-   Configuration
-   Database scripts
-   Public assets

Application flow:

Browser

↓

Router

↓

Controller

↓

Repository

↓

PDO

↓

MySQL

↓

View

------------------------------------------------------------------------

# Project Structure

``` text
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

------------------------------------------------------------------------

# Security

The application implements several security mechanisms.

-   Session based authentication
-   Admin authorization checks
-   CSRF protection
-   Prepared SQL statements
-   Output escaping using htmlspecialchars()
-   Input validation
-   Delete confirmation before destructive actions

------------------------------------------------------------------------

# UI / UX

The interface was intentionally designed to remain simple, clean and
responsive.

Implemented improvements include:

-   Modern homepage hero
-   Responsive navigation
-   Responsive tables
-   Responsive forms
-   Consistent styling across public and admin sections
-   Shopping cart badge
-   Demo checkout modal
-   Responsive administration interface

Core functionality remains fully usable even when JavaScript is
disabled. JavaScript is used only as progressive enhancement where
appropriate.

------------------------------------------------------------------------

# Responsive Design

The project has been manually tested on desktop, laptop, tablet and
mobile viewport sizes.

Responsive improvements include:

-   Mobile navigation
-   Flexible product grid
-   Responsive forms
-   Responsive tables
-   Horizontal scrolling only inside large tables
-   No page-level horizontal scrolling

------------------------------------------------------------------------

# Default Administrator

Email

``` text
admin@example.com
```

Password

``` text
admin123
```

These credentials are intended only for demonstration purposes.

------------------------------------------------------------------------

# Assignment Compliance

  Requirement                Status
  -------------------------- --------
  Plain PHP implementation   ✅
  No PHP Framework           ✅
  No CMS Platform            ✅
  Custom MVC Architecture    ✅
  Responsive Frontend        ✅
  Session Authentication     ✅
  Admin Area                 ✅
  CMS CRUD                   ✅
  Product CRUD               ✅
  Shopping Cart              ✅
  Website Settings           ✅
  PDO                        ✅
  Prepared Statements        ✅
  CSRF Protection            ✅
  Vanilla JavaScript         ✅
  Basic Permission Checks    ✅

------------------------------------------------------------------------

# Design Decisions

Several implementation decisions were intentionally made to satisfy both
the assignment and common software engineering practices.

-   The homepage displays **a maximum of three featured products**,
    while allowing multiple products to be marked as featured in the
    administration panel.
-   Contact information is loaded dynamically from Website Settings.
-   Checkout is intentionally implemented as a demonstration modal
    because real payment processing was explicitly outside the
    assignment scope.
-   Business logic is separated from presentation using repositories and
    controllers.

------------------------------------------------------------------------

# Future Improvements

The following features could be added in a production version:

-   User registration
-   Customer accounts
-   Orders
-   Payment gateway integration
-   Inventory management
-   Product search
-   Pagination
-   Email notifications
-   Image optimization

------------------------------------------------------------------------

# Installation

See **INSTALLATION_GUIDE.md**.

------------------------------------------------------------------------

# Technical Documentation

See **TECHNICAL_DOCUMENTATION.md** for implementation details,
architectural decisions and development notes.

------------------------------------------------------------------------

# Author

**Amir Arabi**

Technical Assignment --- Mid-Level Full-Stack PHP Developer

Developed entirely in plain PHP without using any PHP framework or CMS
platform.
