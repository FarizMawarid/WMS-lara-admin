# WMS-lara-admin

A comprehensive Warehouse Management System (WMS) administration panel built with Laravel and modern web technologies.

## Overview

WMS-lara-admin is a full-featured warehouse management system designed to streamline inventory, logistics, and administrative operations. The admin panel provides an intuitive interface for managing warehouse operations efficiently.

## Tech Stack

- **Backend Framework**: Laravel (PHP)
- **Frontend Templating**: Blade
- **Styling**: CSS, SCSS
- **Frontend Interactivity**: JavaScript

### Language Composition
- Blade: 49.8%
- PHP: 39.7%
- JavaScript: 5.9%
- CSS: 4.5%
- SCSS: 0.1%

## Features

- Comprehensive warehouse management dashboard
- Inventory tracking and management
- Order processing and fulfillment
- User role and permission management
- Admin panel for system configuration
- Responsive design for various devices

## Installation

### Requirements
- PHP 7.4 or higher
- Composer
- Node.js and npm (for frontend dependencies)
- MySQL or compatible database

### Setup

1. Clone the repository:
```bash
git clone https://github.com/FarizMawarid/WMS-lara-admin.git
cd WMS-lara-admin
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install frontend dependencies:
```bash
npm install
```

4. Create environment configuration:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env` and run migrations:
```bash
php artisan migrate
```

7. (Optional) Seed the database:
```bash
php artisan db:seed
```

8. Build frontend assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Development

### Running the Development Server

```bash
php artisan serve
```

### Compiling Assets

For development with hot reload:
```bash
npm run dev
```

For production build:
```bash
npm run build
```

## Directory Structure

```
WMS-lara-admin/
├── app/              # Application logic and models
├── resources/        # Views (Blade templates) and raw assets
├── routes/           # Application routes
├── database/         # Migrations and seeders
├── public/           # Publicly accessible files
├── storage/          # Application storage
└── tests/            # Unit and feature tests
```

## Usage

After installation and setup, access the admin panel through your web browser. Log in with your credentials to manage warehouse operations, inventory, and other administrative tasks.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

Please check the repository for the appropriate license file.

## Support

For issues, questions, or suggestions, please open an issue in the GitHub repository.

---

**Repository**: [FarizMawarid/WMS-lara-admin](https://github.com/FarizMawarid/WMS-lara-admin)
