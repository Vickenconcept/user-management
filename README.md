
## User Management System API - README

## Overview
This repository contains a Laravel-based User Management System API. The API facilitates user profile management within an application, enabling functionalities such as user creation, retrieval, updating, and deletion. It also includes authentication mechanisms using Laravel Passport for user registration, login, and logout.

### Requirements

1. ### Model and Migration
A User model is defined with attributes name, email, password, and roles to distinguish between 'admin' and 'user' roles.
Migration script creates a users table with the aforementioned fields.

2. ### Routes and Controllers
RESTful API routes are defined to handle user management operations.
Controller methods are implemented for CRUD operations on users with appropriate data validation.

3. ### Authentication
Laravel Passport is utilized for user authentication, enabling functionalities like registration, login, and logout.
API routes are secured to ensure only authenticated users can perform user management operations. Deletion is restricted to users with the 'admin' role.

4. ### Testing
Comprehensive test coverage includes scenarios for user registration, login, and error handling.


## Setup Instructions

To set up the project locally, follow these steps:

- Clone the repository from GitHub: git clone <repository_url>

- Install project dependencies: composer install

- Copy .env.example to .env and configure your environment variables (database connection, etc.)

- Generate application key: php artisan key:generate

- Run database migrations: php artisan migrate

- Start the Laravel development server: php artisan serve

- Running Tests

To execute tests, run the following command:

php artisan test
