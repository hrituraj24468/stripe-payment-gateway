# Stripe Payment Gateway Integration in PHP

This project demonstrates how to integrate Stripe Payment Gateway into a PHP application for processing payments. The application includes a registration form where users can input their details and pay for a course.

## Table of Contents
Features

Prerequisites

Installation

Usage

Files

Screenshots

## Features
- Registration form to collect user details.

- Integration with Stripe Payment Gateway to process payments.

- Store transaction details in a MySQL database.

- Display payment success or failure messages.

## Prerequisites
- PHP 7.2 or higher
- MySQL Database
- Composer (for dependency management)
- Stripe account (for obtaining API keys)

### Installation
- ### Clone the repository:

```bash
git clone https://github.com/yourusername/stripe-payment-integration-php.git
```
- ### Navigate to the project directory:
```bash
cd stripe-payment-integration-php
```
- ### Install dependencies:
```bash
composer install
```
- ### Configure the database:

- Create a MySQL database.
- Import the provided database.sql file to create the necessary tables.
- Update the connection.php file with your database credentials:
```php
<?php
$host = 'your_host';
$username = 'your_username';
$password = 'your_password';
$dbname = 'your_database';
$con = mysqli_connect($host, $username, $password, $dbname);
if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}
?>
```
- ### Set up Stripe:

- Obtain your Stripe API keys from the Stripe dashboard.
- Update the Stripe API keys in the stripe_payment.php file:

```php
$stripe = array(
    "SecretKey" => "your_secret_key",
    "PublishableKey" => "your_publishable_key"
);
\Stripe\Stripe::setApiKey($stripe['SecretKey']);

```

## Usage
- Open the application:

- Run the PHP built-in server or deploy the application on a web server:
```php
php -S localhost:8000
```
- Open a web browser and navigate to 
```bash
http://localhost:8000/.
```
- Fill in the registration form:

Enter your name, email, course, and amount.
Provide valid card details.
Submit the form:

Upon successful payment, you will see a success message along with transaction details.
In case of a failure, an error message will be displayed.
