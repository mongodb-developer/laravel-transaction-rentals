# Laravel Transaction Rentals

**This project is the sample project used as part of the [Laravel Transactions Learning Bytes](https://learn.mongodb.com/courses/laravel-transactions) on MongoDB learning platform.**

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

### MongoDB Laravel Integration

- [Docs](https://www.mongodb.com/docs/drivers/php/laravel-mongodb/current/)

Laravel is accessible, powerful, and provides tools required for large, robust applications.



This repository contains the code for a sample application demonstrating the use of MongoDB transactions with Laravel. The application simulates a rental service for different types of items.

## Prerequisites

Before running the application, ensure you have the following installed:

- PHP 7.3 or higher
- Composer
- Laravel 6.x or higher
- MongoDB Atlas account and cluster
- MongoDB PHP driver

## Installation

Follow these steps to set up and run the application:

1. **Clone the repository:**

   ```
   git clone https://github.com/mongodb-developer/laravel-transaction-rentals.git
   cd laravel-transaction-rentals
   ```

2. **Install dependencies:**

   ```
   composer install
   ```

3. **Set up environment variables:**

   Copy the `.env.example` file to `.env` and update the MongoDB Atlas connection settings.

   ```
   cp .env.example .env
   ```

   Update the following variables in the `.env` file with your MongoDB Atlas connection details:

   ```
    DB_URI="..."
   ```

   You will find your MongoDB Atlas connection string in the Atlas UI under "Connect".

## Load the dataset

In your database use "sample_airbnb.rentals" collection.

1. Use [Atlas data explorer](https://www.mongodb.com/docs/atlas/atlas-ui/documents/#insert-documents) to upload the following [rentals.json](https://raw.githubusercontent.com/mongodb-developer/symfony-mongodb-atlas-rentals/main/data/symfony.rentals.json) array into the "Insert Document" json array to upload initial rentals

2. We can use the [mongosh](https://www.mongodb.com/docs/mongodb-shell/install/) shell to insert some data into the rentals collection.

## Usage

To run the application, use the following command:

```
php artisan serve
```

Visit `http://localhost:8000` in your web browser to access the application.

## Features

- **Transaction Management:** Demonstrates the use of MongoDB transactions for rental operations.

## Code Overview

### Models

- `Item`: Represents an item available for rent.
- `Rental`: Represents a rental transaction.
- `User`: Represents a user in the system.

### Controllers

- `ItemController`: Manages the CRUD operations for items.
- `RentalController`: Manages the rental transactions.
  
### Routes

- `web.php`: Contains the web routes for the application.


## Contributing

Contributions are welcome! Please submit a pull request for any changes you would like to make.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgements

This project is maintained by the MongoDB Developer team. For more information, visit the [official website](https://www.mongodb.com).

