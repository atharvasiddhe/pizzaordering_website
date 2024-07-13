# Cheesy Bytes Pizza Shop

## Overview
Cheesy Bytes is an online pizza ordering system that allows customers to browse, select, and order pizzas online. The system is built using HTML, CSS, JavaScript, PHP, and MySQL (XAMPP). The project includes features like user authentication, dynamic order forms, and an admin panel for order management.

## Features
- User Registration and Login
- Browse Pizzas with dynamic pricing based on size and quantity
- Add items to the cart
- Place orders with different payment options (COD, UPI, QR Scan)
- View order history
- Admin panel for managing orders and delivery status

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL (using XAMPP)
- **Server**: XAMPP

## Setup Instructions

### Prerequisites
- XAMPP installed on your system
- Basic knowledge of HTML, CSS, JavaScript, and PHP

### Installation
1. **Clone the repository:**
    ```bash
    git clone https://github.com/atharvasiddhe/pizzaordering_website.git
    cd cheesy-bytes
    ```

2. **Setup XAMPP:**
    - Start Apache and MySQL from the XAMPP control panel.

3. **Database Configuration:**
    - Open phpMyAdmin by navigating to `http://localhost/phpmyadmin/`.
    - Create a new database named `cheesy_bytes`.
    - Import the `cheesy_bytes.sql` file located in the `database` folder of the project repository to set up the required tables.

4. **Configure Database Connection:**
    - Open `config.php` file in the root directory of the project.
    - Update the database configuration to match your local setup:
    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cheesy_bytes";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

5. **Run the Application:**
    - Move the project folder to the `htdocs` directory in your XAMPP installation.
    - Open a web browser and navigate to `http://localhost/pizzaorder`.

## Usage

### User Guide
1. **Registration and Login:**
    - New users can register by clicking on the "Register" link and filling in the required details.
    - Registered users can log in using their email and password.

2. **Order Pizza:**
    - Browse through the available pizzas and select desired size and quantity.
    - Add the selected items to the cart.
    - Proceed to checkout and choose the preferred payment method.
    - Confirm the order to place it.

3. **Order History:**
    - After logging in, users can view their order history by navigating to the "My Orders" section.

### Admin Guide
1. **Access Admin Panel:**
    - Log in as an admin user.
    - Navigate to the admin panel to view and manage orders.

2. **Manage Orders:**
    - View pending orders and mark them as delivered.
    - Delivered orders will be removed from the pending orders list.

## Contributing
Contributions are welcome! Please fork this repository and submit a pull request for any features, bug fixes, or enhancements.

## License
This project is licensed under the MIT License.

## Acknowledgments
- Thanks to all contributors and open-source libraries used in this project.

