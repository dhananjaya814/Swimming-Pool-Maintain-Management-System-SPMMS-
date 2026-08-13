<?php
$conn = mysqli_connect("localhost", "root", "", "swimming_pool_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>