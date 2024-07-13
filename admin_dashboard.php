<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.html');
    exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzashop";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .order-details {
            padding: 20px;
            border-bottom: 1px solid #ccc;
        }
        .order-details:last-child {
            border-bottom: none;
        }
        .delivered-button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .delivered-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h2>
        <h3>Orders:</h3>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($order = mysqli_fetch_assoc($result)) {
                echo '<div class="order-details">
                        <h3>Order ID: ' . htmlspecialchars($order['id']) . '</h3>
                        <p><strong>Product Name:</strong> ' . htmlspecialchars($order['product_name']) . '</p>
                        <p><strong>Customer Name:</strong> ' . htmlspecialchars($order['customer_name']) . '</p>
                        <p><strong>Delivery Address:</strong> ' . nl2br(htmlspecialchars($order['addresss'])) . '</p>
                        <p><strong>Phone Number:</strong> ' . htmlspecialchars($order['phone']) . '</p>
                        <p><strong>Quantity:</strong> ' . htmlspecialchars($order['quantity']) . '</p>
                        <p><strong>Size:</strong> ' . htmlspecialchars($order['sizee']) . '</p>
                        <p><strong>Total Price:</strong> ₹' . htmlspecialchars($order['total_price']) . '</p>
                        <form method="post" action="mark_delivered.php">
                            <input type="hidden" name="order_id" value="' . htmlspecialchars($order['id']) . '">
                            <button type="submit" class="delivered-button" name="mark_delivered">Mark Delivered</button>
                        </form>
                      </div>';
            }
        } else {
            echo '<p>No orders found.</p>';
        }

        
        mysqli_close($conn);
        ?>
    </div>

</body>
</html>
