<?php
session_start();


if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}


$prices = [
    'S' => 100,
    'M' => 150,
    'L' => 200
];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $productName = $_POST['product-name'];
    $customerName = $_POST['customer-name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    $totalPrice = $prices[$size] * $quantity;
    $paymentMethod = $_POST['payment-method'];

    
    $_SESSION['order'] = [
        'product-name' => $productName,
        'customer-name' => $customerName,
        'address' => $address,
        'phone' => $phone,
        'quantity' => $quantity,
        'size' => $size,
        'total-price' => $totalPrice,
        'payment-method' => $paymentMethod
    ];

    
    echo "<script>alert('Order placed successfully! Redirecting to My Orders...');
          window.location.href = 'myorders.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Pizza Ordering Website</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .order-form {
            display: flex;
            flex-direction: column;
        }
        .order-form label {
            margin: 10px 0 5px;
        }
        .order-form input, .order-form textarea, .order-form select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .order-form button {
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .order-form button:hover {
            background-color: #d32f2f;
        }
        .price-box {
            padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            font-size: 0.9rem;
        }
    </style>
    <script>
        
        function getParameterByName(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        
        function autofillProductName() {
            const productName = getParameterByName('product');
            if (productName) {
                document.getElementById('product-name').value = productName;
            }
        }

        
        const prices = {
            'S': 100,
            'M': 150,
            'L': 200
        };

        
        function updatePrice() {
            const size = document.getElementById('size').value;
            const quantity = parseInt(document.getElementById('quantity').value, 10);
            const price = prices[size] * quantity;

            document.getElementById('total-price').value = `₹${price}`;
        }

        
        function validatePhoneNumber() {
            const phone = document.getElementById('phone').value;
            const phoneError = document.getElementById('phone-error');
            const phoneRegex = /^[0-9]{10}$/;
            
            if (!phoneRegex.test(phone)) {
                phoneError.textContent = 'Please enter a valid 10-digit phone number.';
                return false;
            } else {
                phoneError.textContent = '';
                return true;
            }
        }

        
        function handleSubmit(event) {
            if (!validatePhoneNumber()) {
                event.preventDefault();
            }
        }

        
        window.onload = () => {
            autofillProductName();
            updatePrice();
        };
    </script>
</head>

<body>

    <header class="header">
        <div class="container">
            <h1>Order Your Favorite Item</h1>
            <p>Fill out the form below to place your order</p>
        </div>
    </header>

    <div class="container">
        <form id="order-form" class="order-form" method="post" onsubmit="handleSubmit(event)" action="orderdetsav.php">
            <label for="product-name">Product Name</label>
            <input type="text" id="product-name" name="product-name" readonly>

            <label for="customer-name">User Name</label>
            <input type="text" id="customer-name" name="customer-name" placeholder="Enter your login username only" required>

            <label for="address">Delivery Address</label>
            <textarea id="address" name="address" rows="4" required></textarea>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required oninput="validatePhoneNumber()">
            <div id="phone-error" class="error"></div>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" required onchange="updatePrice()">

            <label for="size">Size</label>
            <select id="size" name="size" required onchange="updatePrice()">
                <option value="S">Small</option>
                <option value="M">Medium</option>
                <option value="L">Large</option>
            </select>

            <label for="total-price">Total Price</label>
            <input type="text" id="total-price" name="total-price" readonly value="₹100">

            <label for="payment-method">Payment Method</label>
            <select id="payment-method" name="payment-method" required>
                <option value="COD">Cash on Delivery</option>
            </select>

            <button type="submit">Place Order</button>
        </form>
    </div>

</body>

</html>
