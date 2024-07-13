<?php
session_start();


if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$usernamess = $_SESSION['username'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzashop";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM orders WHERE customer_name = '" . mysqli_real_escape_string($conn, $usernamess) . "'";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Pizza Ordering Website</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: inline-block;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            max-width: 600px;
            margin: 80px auto 20px; 
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .order-details {
            margin: 20px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .order-details h3 {
            margin-top: 0;
        }
        .cancel-button {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="myorders.php">My Orders</a>
        <a href="logout.php">Logout</a>
    </nav>

    <header class="header">
        <div class="container">
            <h1>My Orders</h1>
        </div>
    </header>

    <div class="container">
        <?php
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                
                while ($order = mysqli_fetch_assoc($result)) {
                    
                    $orderTime = strtotime($order['order_time']);
                    $currentTime = time();
                    $timeDifference = $currentTime - $orderTime;
                    $minutesDifference = floor($timeDifference / 60);

                    if ($minutesDifference <= 10) {
                        echo '<div class="order-details">
                                <h3>Order Details</h3>
                                <p><strong>Product Name:</strong> ' . htmlspecialchars($order['product_name']) . '</p>
                                <p><strong>Customer Name:</strong> ' . htmlspecialchars($order['customer_name']) . '</p>
                                <p><strong>Delivery Address:</strong> ' . nl2br(htmlspecialchars($order['addresss'] ?? '')) . '</p>
                                <p><strong>Phone Number:</strong> ' . htmlspecialchars($order['phone'] ?? '') . '</p>
                                <p><strong>Quantity:</strong> ' . htmlspecialchars($order['quantity'] ?? '') . '</p>
                                <p><strong>Size:</strong> ' . htmlspecialchars($order['sizee'] ?? '') . '</p>
                                <p><strong>Total Price:</strong> ₹' . htmlspecialchars($order['total_price'] ?? '') . '</p>
                                <form method="post" action="cancel.php">
                                    <input type="hidden" name="customer_name" value="' . htmlspecialchars($order['customer_name'] ?? '') . '">
                                    <input type="hidden" name="product_name" value="' . htmlspecialchars($order['product_name'] ?? '') . '">
                                    <button type="submit" class="cancel-button" name="cancel_order">Cancel Order</button>
                                </form>
                              </div>';
                    } else {
                        echo '<div class="order-details">
                                <h3>Order Details</h3>
                                <p><strong>Product Name:</strong> ' . htmlspecialchars($order['product_name']) . '</p>
                                <p><strong>Customer Name:</strong> ' . htmlspecialchars($order['customer_name']) . '</p>
                                <p><strong>Delivery Address:</strong> ' . nl2br(htmlspecialchars($order['address'] ?? '')) . '</p>
                                <p><strong>Phone Number:</strong> ' . htmlspecialchars($order['phone'] ?? '') . '</p>
                                <p><strong>Quantity:</strong> ' . htmlspecialchars($order['quantity'] ?? '') . '</p>
                                <p><strong>Size:</strong> ' . htmlspecialchars($order['size'] ?? '') . '</p>
                                <p><strong>Total Price:</strong> ₹' . htmlspecialchars($order['total_price'] ?? '') . '</p>
                                <p><strong>Cannot cancel after 10 minutes.</strong></p>
                              </div>';
                    }
                }
            } else {
                echo '<p>No orders placed yet.</p>';
            }
        } else {
            echo '<p>Failed to fetch orders. Please try again later.</p>';
        }

        
        mysqli_close($conn);
        ?>
    </div>

</body>

</html>
