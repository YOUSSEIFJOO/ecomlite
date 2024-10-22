
# Ecommerce Lite - Laravel Project

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)


## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
    - [Configuration](#configuration)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [Acknowledgements](#acknowledgements)
- [Additions](#additions)
- [Contact](#contact)


## Introduction

This project is a simplified RESTful API built with Laravel for managing products and orders
in a small e-commerce system. It provides the core functionality required for managing an online store,
including product listings, order placement, and basic search functionality. The API is designed
with clean code principles and optimized for performance using features such as caching, pagination,
and event handling.


## Features

- **Product Management:** Create, update, delete, and search products with support for filtering by price and category.
Order Placement: Users can place orders for products, with automatic stock validation and updates.
- **API Authentication:** Secured endpoints using Laravel Sanctum to ensure only authenticated users can access sensitive actions.
- **Caching:** Optimized product retrieval using caching for better performance.
- **Event Handling:** Events trigger actions like sending notifications when an order is placed.
- **Validation:** Robust validation of user input to ensure data integrity, including product availability checks.
RESTful Endpoints: Adheres to RESTful principles with proper HTTP status codes and structured JSON responses.



## Getting Started


### Prerequisites

Make sure you have the following software installed :
- PHP >= 8.0
- Composer
- MySQL
- Laravel 9.x


### Installation

Follow these steps to set up the project locally :

```bash
# Clone the repository
git clone https://github.com/YOUSSEIFJOO/ecomlite.git ecomlite

# Navigate into the project directory
cd ecomlite

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Configuration

1- Copy the .env.example file to .env and set your environment variables :

```bash
cp .env.example .env
```

2- Set your database credentials in the .env file :

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecomlite-db
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

3- Generate the application key :

```bash
php artisan key:generate
```

4- Migrate the database :

```bash
php artisan migrate
```


### Usage

To start the local server and test the application, use :

```bash
php artisan serve
```

**Put These Values inside your .env :**
```bash
API_KEY_SWAGGER_DOCS=9073d1808f1911ef8d830d5be99a1e44
SECRET_API_KEY=6e880ef08f7b11ef95ac175a6e3eb139
```

You can now access the application at http://localhost:8000.


### API Endpoints

**At rhe first run :**

```bash
php artisan serve
```

**Then open this URL in your browser :**

```bash
http://127.0.0.1:8000/ecomlite/apis/9073d1808f1911ef8d830d5be99a1e44
```


### Contributing

If you'd like to contribute :

```bash
1- Fork the repository.
2- Create your feature branch (git checkout -b feature/your-feature).
3- Commit your changes (git commit -m 'Add your feature').
4- Push to the branch (git push origin feature/your-feature).
5- Open a pull request.
```


### Acknowledgements

- Laravel framework for its simplicity, flexibility, and power in building modern web applications.
- The open-source community for providing helpful packages and tools that enhance development.
- MySQL for reliable database management.
- Cache systems like Redis for optimizing performance in large-scale applications.


### Additions

1. **Laravel Octane**: Explained as a way to improve performance with steps to install and run Octane.
2. **Redis**: Highlighted for caching, with instructions to configure it in the `.env` file.

- This will give the project a professional touch while indicating performance-focused suggestions for further improvements.

- **Note** : When you try to use ( **Laravel Octane** && **Redis** ) Ensure you installed the requirements on your machine at the first.


### Contact

Developed by <a href="https://www.linkedin.com/in/yousseif" target="_blank">Yousseif Nady</a>. Reach out at [yousseif@example.com]() for any questions or inquiries.
