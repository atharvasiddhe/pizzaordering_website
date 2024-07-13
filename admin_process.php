<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "pizzashop";

    
    $conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

    
    if (!$conn) {
        die("Connection failed: ");
    }

    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $_SESSION['admin_username']=$username;

    
    $query = "SELECT * FROM admins WHERE username='$username' and passwords='$password'";
    $result = mysqli_query($conn, $query);

    if (!$result)
    {
        echo "<script>alert('Query failed:')</script>";
    }
    else
    {
        echo "<script>
                 alert('login success');
                 window.location.href='admin_dashboard.php';
              </script>";
    }
     

    
    mysqli_close($conn);
}
?>

