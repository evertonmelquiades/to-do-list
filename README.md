
# Laravel To-Do Project

  

This Laravel project is designed for make a To-Do App using Laravel, Vue, SQLite.

  

## Table of Contents

  

- [Getting Started](#getting-started)

- [Prerequisites](#prerequisites)

- [Installation](#installation)

- [Usage](#usage)

- [Documentation](#documentation)

- [Testing](#testing)

- [Deployment](#deployment)

- [Built With](#built-with)

- [Contributing](#contributing)

- [License](#license)

- [Acknowledgments](#acknowledgments)

  

## Getting Started

  

These instructions will help you set up the project on your local machine.

  

### Prerequisites

  

Make sure you have the following installed:

  

- PHP (>= 8.2)

- Composer

- Node.js (for JavaScript and CSS compilation)

- MySQL or other database of your choice

  

### Installation

  

1. Clone the repository:
```bash

git clone https://github.com/evertonmelquiades/to-do-list
```
2. Navigate to the project directory:
```bash
cd your-repository
```
3. Install PHP dependencies:
```bash
composer install
```
4. Install JavaScript dependencies:
```bash
npm install or yarn install
```
5. Copy the `.env.example` file to `.env` and configure your database connection:
```bash
cp .env.example .env
```
###### Update the database configuration in the `.env` file with your database credentials.
6. Generate the application key:
```bash
php artisan key:generate
```
7. Run database migrations:
```bash
php artisan migrate
```
8. Run UserFactory:
```bash
php artisan db:seed
```
9. Serve the application:
```bash
php artisan serve
```
>Admin access: 
>Email: admin@admin.com
>Password: admin123

### Testing

##### Run this code for run tests
```bash
php artisan test
```

### Built With
- Laravel - The PHP framework used
- Vue.js - JavaScript framework frontend
