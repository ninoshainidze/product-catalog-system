# 🛒 Laravel Product Catalog

A simple product catalog with API & Blade frontend, background job updates, and performance optimizations using Eloquent, caching, and Redis queue.

---

## 🚀 Setup Instructions

### Requirements

- PHP 8.1+
- Composer
- MySQL/PostgreSQL
- Redis (for queues and caching)
- Laravel 10+

### Installation

```bash
git clone https://github.com/ninoshainidze/product-catalog-system.git
cd product-catalog
composer install
cp .env.example .env
php artisan key:generate

```

### Configure .env
- Update the following:
```bash
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
```
### Then run
```bash
php artisan migrate --seed
```
## Background Jobs & Scheduler Setup
- Queue Worker

```bash
php artisan queue:work
```
### What it does
Every 10 minutes:

- Picks 1,000 random products
- Randomizes their price and stock
- Dispatches each update via a job
- Logs the update to storage/logs/product_update.log

### 🔌 API Docs
Base URL
```bash
GET /api/products
```

### Example Request
```bash
GET /api/products?category=electronics&sort=price_desc&page=2
```

### Query Parameters

| Parameter   | Type   | Description                              | Example                     |
|-------------|--------|------------------------------------------|-----------------------------|
| `category`  | string | Filter by category `slug`                | `/api/products?category=clothing` |
| `sort`      | string | Sort by price. Accepts `price_asc` or `price_desc` | `/api/products?sort=price_desc` |
| `page`      | int    | Pagination (default: 1)                  | `/api/products?page=2`      |

---
