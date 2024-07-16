# Ecommerce App Documentation

Welcome to the documentation for the Ecommerce App! This guide will help you get started with setting up the application environment and understanding its features.

## Installation

Follow these steps to set up the Ecommerce App locally:

### Prerequisites

- PHP >= 8.2
- Composer
- Docker (for Docker setup)
- Redis

### Step 1: Clone the repository

```bash
git clone https://github.com/ahmedsalah95/ecommerce
cd ecommerce-app

```
### Step 2: Install PHP dependencies

```bash
composer install

```
### Step 3: Set up environment variables

Duplicate .env.example to .env and configure your database settings and other environment variables.


### Step 4: Generate application key
```bash
php artisan key:generate

```

### Step 5: Set up Passport for API authentication
```bash
php artisan passport:install
```

### Step 6: Migrate and seed the database
```bash
php artisan migrate --seed
```

### Step 7: Start the Laravel development server
```bash
php artisan serve
```

### Setting up Redis

```bash
composer require predis/predis
```

in the .env file add these lines

```bash
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
REDIS_CLIENT=predis
```

### Docker Setup
Ensure Docker is installed and running on your system.
```bash
docker-compose up -d --build
```

To stop docker 
```bash
docker-compose down
```
