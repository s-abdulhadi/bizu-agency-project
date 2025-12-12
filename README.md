# Bizu Agency Website

A modern, full-stack agency website built with **Laravel 11** and **Tailwind CSS**. This comprehensive platform features a dynamic frontend with AJAX search, e-commerce functionality with shopping cart, admin dashboard for content management, and a complete contact system.

---

## 🚀 Features

### Public Features
- **Dynamic Homepage** with featured services, portfolio showcase, and testimonials
- **Services Management** - Browse and view detailed service offerings
- **Portfolio Gallery** - Showcase of completed projects with detailed case studies
- **Product Catalog** - E-commerce product listings with categories
- **Shopping Cart** - Full cart functionality for products and services
- **Checkout System** - Complete order processing with guest checkout support
- **Contact Form** - Message submission with database storage and validation
- **AJAX Search** - Real-time search across services, portfolios, and products
- **Testimonials** - Client reviews and feedback display
- **Responsive Design** - Mobile-first, fully responsive across all devices

### Admin Features
- **Dashboard** - Overview of orders, users, and content
- **Service Management** - Full CRUD operations for services
- **Portfolio Management** - Create, edit, and delete portfolio items
- **Product Management** - Complete product CRUD with image uploads
- **Order Management** - View and manage customer orders
- **User Management** - View and manage registered users
- **Contact Management** - View submitted contact messages

### Authentication
- User registration and login
- Admin role-based access control
- Protected admin routes
- Session-based authentication

---

## 📋 Tech Stack

- **Backend Framework**: [Laravel 11](https://laravel.com)
- **Frontend**: Blade Templates with custom CSS
- **Styling**: Custom CSS with modern design system
- **Bundler**: [Vite](https://vitejs.dev)
- **Database**: MySQL / MariaDB (SQLite supported for development)
- **PHP Version**: 8.2+

---

## 🛠️ Prerequisites

Ensure you have the following installed:

- **PHP 8.2 or higher** with extensions:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath
  - Fileinfo
- **Composer** (latest version)
- **Node.js** (v18+) & **NPM**
- **MySQL** or **MariaDB** (or use SQLite for development)

---

## 📦 Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd my-agency-website
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

**Option A: Using MySQL/MariaDB**

1. Create a database:
```sql
CREATE DATABASE bizu_agency;
```

2. Update `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bizu_agency
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**Option B: Using SQLite (Development)**

1. Create database file:
```bash
touch database/database.sqlite
```

2. Update `.env` file:
```env
DB_CONNECTION=sqlite
# Comment out other DB_* variables
```

### 5. Run Migrations

```bash
# Run all migrations
php artisan migrate

# Optional: Seed database with sample data
php artisan db:seed
```

### 6. Storage Setup

```bash
# Create symbolic link for public storage
php artisan storage:link
```

### 7. Build Assets

```bash
# For development
npm run dev

# For production
npm run build
```

---

## 💻 Usage

### Starting the Development Server

```bash
# Start Laravel server
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

### Creating an Admin User

**Method 1: Update existing user**
```sql
UPDATE users SET is_admin = 1 WHERE email = 'your-email@example.com';
```

**Method 2: Register and update**
1. Register a new account at `/register`
2. Update the user in database:
```sql
UPDATE users SET is_admin = 1 WHERE id = 1;
```

### Accessing Admin Panel

1. Login at `/login` with admin credentials
2. Navigate to `/admin` to access the dashboard

---

## 📊 Database Schema

### Core Tables

**users**
- User accounts with authentication
- `is_admin` flag for admin access

**categories**
- Product categories
- Used for organizing products

**services**
- Service offerings
- Includes pricing, descriptions, and featured flag

**portfolios**
- Portfolio items/case studies
- Client work showcase with images

**products**
- E-commerce products
- Multiple images, pricing, stock management

**orders**
- Customer orders
- Tracks order status, totals, tax, discount

**order_items**
- Individual items in orders
- Supports both products and services

**testimonials**
- Client testimonials
- Published/unpublished status

**contacts**
- Contact form submissions
- Status tracking (new/read/replied)

---

## 🔌 API Endpoints

The application exposes RESTful API endpoints:

```
GET  /api/services     - List all services
GET  /api/portfolios   - List all portfolio items
GET  /api/products     - List all products
```

---

## 🎨 Frontend Pages

### Public Routes
- `/` - Homepage
- `/about` - About page
- `/services` - Services listing
- `/services/{slug}` - Service details
- `/portfolio` - Portfolio gallery
- `/portfolio/{slug}` - Portfolio item details
- `/products` - Product catalog
- `/products/{slug}` - Product details
- `/testimonials` - Testimonials page
- `/contact` - Contact form
- `/cart` - Shopping cart
- `/checkout` - Checkout process

### Admin Routes (Protected)
- `/admin` - Dashboard
- `/admin/services` - Manage services
- `/admin/portfolio` - Manage portfolio
- `/admin/products` - Manage products
- `/admin/orders` - View orders
- `/admin/users` - Manage users

### Authentication Routes
- `/login` - User login
- `/register` - User registration
- `/logout` - Logout (POST)

---

## 🧪 Testing

### Manual Testing Checklist

**Authentication:**
- [ ] User registration works
- [ ] User login works
- [ ] Admin access restricted properly

**Public Features:**
- [ ] Homepage loads with data
- [ ] Services page displays correctly
- [ ] Portfolio gallery works
- [ ] Product catalog functional
- [ ] Search returns results
- [ ] Cart operations work
- [ ] Checkout process completes
- [ ] Contact form submits

**Admin Features:**
- [ ] Dashboard accessible
- [ ] Service CRUD operations
- [ ] Portfolio CRUD operations
- [ ] Product CRUD operations
- [ ] Order viewing works
- [ ] User management works

---

## 📁 Project Structure

```
my-agency-website/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   ├── PageController.php
│   │   ├── AuthController.php
│   │   ├── CartController.php
│   │   └── ...
│   └── Models/             # Eloquent models
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── resources/
│   └── views/
│       ├── admin/         # Admin panel views
│       ├── pages/         # Public pages
│       ├── partials/      # Reusable components
│       └── layouts/       # Layout templates
├── routes/
│   ├── web.php           # Web routes
│   └── api.php           # API routes
└── public/
    └── storage/          # Public storage link
```

---

## 🔒 Security Features

- CSRF protection on all forms
- Password hashing with bcrypt
- SQL injection prevention via Eloquent ORM
- XSS protection through Blade templating
- Admin route middleware protection
- Input validation on all forms

---

## 🚀 Deployment

### Production Checklist

1. **Environment Configuration**
```bash
# Set to production
APP_ENV=production
APP_DEBUG=false

# Update APP_URL
APP_URL=https://yourdomain.com
```

2. **Optimize Application**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. **Build Assets**
```bash
npm run build
```

4. **Set Permissions**
```bash
chmod -R 755 storage bootstrap/cache
```

5. **Run Migrations**
```bash
php artisan migrate --force
```

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👥 Support

For support, email hello@bizu.agency or create an issue in the repository.

---

## 🎯 Future Enhancements

- Email notifications for orders and contacts
- Payment gateway integration
- Advanced analytics dashboard
- Blog/news section
- Multi-language support
- Social media integration
- Advanced search filters
- Customer reviews system

---

**Built with ❤️ by the Bizu Team**
