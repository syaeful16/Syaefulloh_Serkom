<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "rentalmotor";

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    echo "<script>alert('Database tidak terhubung')</script>";
}

?>
