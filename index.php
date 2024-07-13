<?php
session_start();
$is_logged_in = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheesy Bytes Pizza - Home</title>
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
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .navigation {
            display: flex;
            justify-content: center;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }
        .navigation a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .navigation a:hover {
            background-color: #555;
        }
        .hero-section {
            background-image: url('back.jpg'); 
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        .feature-section {
            display: flex;
            justify-content: space-around;
            padding: 50px 0;
            flex-wrap: wrap;
            background-color: #f9f9f9;
        }
        .feature-section .feature {
            text-align: center;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            flex: 1 1 300px;
        }
        .feature-section .feature img {
            max-width: 100%;
            border-radius: 5px;
        }
        .feature-section .feature h3 {
            margin-bottom: 10px;
        }
        .feature-section .feature p {
            font-size: 0.9rem;
            color: #666;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: #333;
            color: #fff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .about-section {
            background-image: url('back2.jpg'); 
            background-size: cover;
            background-position: center;
            color: #fff;
            text-align: center;
            padding: 100px 0;
        }
        .contact-section {
            background-image: url('back3.jpg'); 
            background-size: cover;
            background-position: center;
            color: #fff;
            text-align: center;
            padding: 100px 0;
        }
    </style>
</head>

<body>

    <nav class="navigation">
        <a href="index.php">Home</a>
        <a href="menue.html">Menu</a>
        <?php if ($is_logged_in): ?>
            <a href="myorders.php">My Orders</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.html">Login</a>
            <a href="signup.html">Sign Up</a>
        <?php endif; ?>
        <a href="aboutus.html">About Us</a>
        <a href="contact.html">Contact</a>
    </nav>

    <header class="header">
        <div class="container">
            <?php if ($is_logged_in): ?>
                <h3>Welcome, <?php echo $_SESSION['username']; ?>!</h3>
            <?php endif; ?>
            <h1>Welcome to Cheesy Bytes Pizza!</h1>
            <p>Delicious food, Fast Delivery</p>
        </div>
    </header>

    <section class="hero-section">
        <div class="container">
            <h1>Order Delicious Pizzas Online</h1>
            <p>Choose from a wide range of pizzas and customize them to your liking!</p>
        </div>
    </section>

    <section class="feature-section">
        <div class="container">
            <div class="feature">
                <img src="Pizza1.jpeg" alt="Pizza 1"> 
                <h3>Our Menu</h3>
                <p>Explore our delicious range of pizzas, sides, and drinks.</p>
            </div>
            <div class="feature">
                <img src="sandwich1.jpeg" alt="sandwitch"> 
                <h3>Order Online</h3>
                <p>Conveniently order your favorite pizzas from the comfort of your home.</p>
            </div>
            <div class="feature">
                <img src="coldcoffee1.jpeg" alt="Pizza 3"> 
                <h3>Fast Delivery</h3>
                <p>Enjoy quick and reliable delivery of your freshly made pizzas.</p>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <h2>About Us</h2>
            <p>Learn more about our passion for great pizza and commitment to quality.</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Get in touch with us for inquiries, feedback, or support.</p>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Cheesy Bytes Pizza. All rights reserved.</p>
            <p>Made with &#x2764; by Atharva Siddhe &#x2764; </p>
        </div>
    </footer>

</body>

</html>
