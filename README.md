# ITN-Distribution-Web-App
This repository contains a simple web application designed for real-time data entry and management of ITN (Insecticide-Treated Nets) distribution campaigns. The application features a web form for data collection, secure user authentication, database integration using SQLite, and API endpoints for data retrieval and submission.

## Key Features

- **Web Form**: A user-friendly form for data entry with fields such as Household ID, Household Head Name, Number of Family Members, ITNs Distributed, and Distribution Date.
- **Data Validation and Error Handling**: Ensures that all required fields are filled in correctly, with appropriate error messages for invalid input.
- **Basic Authentication**: Provides a simple login system with secure password hashing to protect user credentials.
- **Database Integration**: Utilizes SQLite for storing and retrieving ITN distribution records.
- **API Endpoints**: Offers POST and GET endpoints for submitting and retrieving data, respectively, with proper validation and error handling.
- A view page for authenticated users to see the list of ITN distribution records they have entered.

# Technologies Used

- **Frontend**: HTML, CSS, and JavaScript
- **Backend**: PHP
- **Database**: SQLite
- **API Integration**: PHP scripts for handling API requests
- **Security**: Password hashing using bcrypt for secure authentication


# Setup Instructions
## Prerequisites
Before setting up the web application, ensure you have the following installed on your system:

- PHP 7.4+
- SQLite (built-in with PHP)
- A web server (e.g., Apache, Nginx, or the PHP built-in server)
- Git (to clone the repository)

## Step 1: Clone the Repository
1. Open a terminal (Command Prompt, PowerShell, or Git Bash).

2. Clone the GitHub repository using the following command:

```bash

git clone https://github.com/smartgeek85/ITN-Distribution-Web-App.git
```
Replace your-username with your GitHub username.

3. Change to the cloned directory:

```bash

cd ITN-Distribution-Web-App
```
## Step 2: Configure the Database
1. Create an SQLite database file named ``itntasko_campaign.db`` in the ``api`` folder (you can use SQLite tools or PHP to do this).

2. Run the following SQL commands to create the ``distribution`` table:

```sql

CREATE TABLE distribution (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    household_id TEXT NOT NULL,
    household_head TEXT NOT NULL,
    family_members INTEGER NOT NULL,
    itn_distributed INTEGER NOT NULL,
    distribution_date DATE NOT NULL
);

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);
```
- You can do this by opening the SQLite command line:
```bash

sqlite3 api/itn_distribution.db
```
- Then, paste the SQL code above to create the tables.
## Step 3: Configure PHP Settings
1. Open the config.php file located in the api directory, and make sure your database connection settings are correct:

```php

<?php
// Database configuration
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
```
2. Ensure that the ``config.php`` file has read/write access permissions (you can change permissions using ``chmod`` if necessary):

```bash

chmod 755 api/config.php
```
## Step 4: Start the Web Server
You have two options for running the web application:

Option 1: Using PHP Built-in Server
1. Start the server by running this command in your project directory:

```bash

php -S localhost:8000
```
2. Open your browser and navigate to ```http://localhost:8000``` to access the web application.
### Option 2: Using Apache or Nginx
1. Copy the entire ``ITN-Distribution-Web-App`` directory to your web server's root directory (e.g., ``htdocs`` for XAMPP, ``www`` for WAMP, or ``/var/www/html`` for Linux).
2. Start your Apache or Nginx server.
3. Open your browser and navigate to ``http://localhost/ITN-Distribution-Web-App``.
## Step 5: Testing the Application
- Go to ``http://localhost:8000`` (or your local Apache/Nginx URL) to see the ITN Distribution data entry form.
- Test the login system by creating a user account directly in the ``users`` table using the SQLite command line or any SQLite GUI tool.
## Step 6: Using the API Endpoints
1. POST Request: To submit ITN distribution data, send a POST request to ``http://localhost:8000/api/post_data.php`` with JSON data in the body, for example:

```json

// Prepare the SQL statement to insert data
$stmt = $conn->prepare('INSERT INTO distribution (user_assigned, household_id, household_name, family_members, itns_distributed, distribution_date) 
                      VALUES (?, ?, ?, ?, ?, ?)');

$stmt->bindValue(1, $data['username'], PDO::PARAM_STR);
$stmt->bindValue(2, $household_id, PDO::PARAM_STR);
$stmt->bindValue(3, $data['household_name'], PDO::PARAM_STR);
$stmt->bindValue(4, $data['family_members'], PDO::PARAM_INT);
$stmt->bindValue(5, $data['itns_distributed'], PDO::PARAM_INT);
$stmt->bindValue(6, date('Y-m-d H:i:s'), PDO::PARAM_STR);

// Execute the insert query
if ($stmt->execute()) 
{
    echo json_encode(["message" => "Data successfully submitted.", "household_id" => $household_id]);
}
else 
{
    echo json_encode(["error" => "Failed to submit data."]);
    http_response_code(500);
}

```
2. GET Request: To retrieve all distribution records, send a GET request to ``http://localhost:8000/api/get_data.php``. This will return the data in JSON format.



## Step 7: User Authentication Setup
For basic authentication, you’ll need to register users directly in the ``users`` table. Use the following steps:

1. Hash your password using bcrypt. You can use a PHP script or an online bcrypt hash generator to create a hashed password.
```php

<?php
echo password_hash("your_password", PASSWORD_DEFAULT);
?>
```
2. Insert the hashed password and username into the ``users`` table:

```sql

INSERT INTO users (username, password) VALUES ('admin', '$2y$10$exampleHashedPassword');
```
Replace ``$2y$10$exampleHashedPassword`` with your generated hash.

## Troubleshooting Tips
Ensure the itn_distribution.db file has the correct permissions to be accessed by the PHP application. Use chmod to change permissions if needed:
```bash

chmod 777 api/itn_distribution.db
```
Check your PHP error logs if you encounter any issues while running the application.
