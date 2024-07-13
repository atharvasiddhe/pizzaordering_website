<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
    
    $customerName = $_POST['customer_name'];
    $productName = $_POST['product_name'];

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizzashop";

    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $stmt = $conn->prepare("DELETE FROM orders WHERE customer_name = ? AND product_name = ?");
    $stmt->bind_param("ss", $customerName, $productName);

    if ($stmt->execute()) {
        echo "<script>alert('Cancelled order successfully!');
                      window.location.href = 'myorders.php';
              </script>";
    } else {
        echo "<script>alert('Failed to cancel order. Please try again later.');
                      window.location.href = 'myorders.php';
              </script>";
    }

    $stmt->close();
    mysqli_close($conn);
} else {
    
    header('Location: myorders.php');
    exit();
}
?>
