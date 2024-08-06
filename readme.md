Stripe Payment Gateway Integration in PHP
This project demonstrates how to integrate Stripe Payment Gateway into a PHP application for processing payments. The application includes a registration form where users can input their details and pay for a course.

Table of Contents
Features
Prerequisites
Installation
Usage
Files
Screenshots
License
Features
Registration form to collect user details.
Integration with Stripe Payment Gateway to process payments.
Store transaction details in a MySQL database.
Display payment success or failure messages.
Prerequisites
PHP 7.2 or higher
MySQL Database
Composer (for dependency management)
Stripe account (for obtaining API keys)
Installation
Clone the repository:

bash
Copy code
git clone https://github.com/yourusername/stripe-payment-integration-php.git
Navigate to the project directory:

bash
Copy code
cd stripe-payment-integration-php
Install dependencies:

bash
Copy code
composer install
Configure the database:

Create a MySQL database.
Import the provided database.sql file to create the necessary tables.
Update the connection.php file with your database credentials:
php
Copy code
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
Set up Stripe:

Obtain your Stripe API keys from the Stripe dashboard.
Update the Stripe API keys in the stripe_payment.php file:
php
Copy code
$stripe = array(
    "SecretKey" => "your_secret_key",
    "PublishableKey" => "your_publishable_key"
);
\Stripe\Stripe::setApiKey($stripe['SecretKey']);
Usage
Open the application:

Run the PHP built-in server or deploy the application on a web server:
bash
Copy code
php -S localhost:8000
Open a web browser and navigate to http://localhost:8000/.
Fill in the registration form:

Enter your name, email, course, and amount.
Provide valid card details.
Submit the form:

Upon successful payment, you will see a success message along with transaction details.
In case of a failure, an error message will be displayed.
Files
index.html: Contains the registration form.
stripe_payment.php: Processes the payment using Stripe.
connection.php: Contains database connection details.
success.php: Displays the payment success or failure message.
css/stripe.css: Styles for the success page.
Screenshots
Registration Form

Payment Success
