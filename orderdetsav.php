<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizzashop";

    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $productName = mysqli_real_escape_string($conn, $_POST['product-name']);
    $customerName = mysqli_real_escape_string($conn, $_POST['customer-name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $quantity = (int)$_POST['quantity'];
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $paymentMethod = mysqli_real_escape_string($conn, $_POST['payment-method']);

    
    $prices = [
        'S' => 100,
        'M' => 150,
        'L' => 200
    ];

    
    if (isset($prices[$size])) {
        $totalPrice = $prices[$size] * $quantity;
    } else {
        $totalPrice = 0; 
    }

    
    $qry = "INSERT INTO orders (product_name, customer_name, addresss, phone, quantity, sizee, total_price, payment_method) VALUES ('$productName', '$customerName', '$address', '$phone', '$quantity', '$size', '$totalPrice', '$paymentMethod')";

    
    if (mysqli_query($conn, $qry)) {
        echo "<script>
                      alert('Order placed successfully!you can not cancle order after 10 min,If you want to cancel cancle it within 10 min. OK!');
                      window.location.href = 'myorders.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    
    mysqli_close($conn);
    exit();
}
?>
