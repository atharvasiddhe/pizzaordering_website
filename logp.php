<?php
session_start();
$username=$_POST["username"];
$password=$_POST["password"];
$_SESSION["username"] = $username;
$con=mysqli_connect("localhost","root","","pizzashop") or die("error while connecting database");
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<script>
            alert('login success');
            window.location.href = 'index.php';
          </script>";
          session_start($username);
}
else
{
    
    echo "<script>
              alert('Incorrect password! or username Please try again.');
                    window.history.back();
          </script>";
}
?>