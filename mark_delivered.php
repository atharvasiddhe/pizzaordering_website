<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizzashop";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $query = "DELETE FROM orders WHERE id='$order_id'";
    if (mysqli_query($conn, $query)) {
        echo "Order marked as delivered and deleted.";
    } else {
        echo "Error deleting order: " . mysqli_error($conn);
    }


    mysqli_close($conn);

    
    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "Invalid request.";
}
?>
