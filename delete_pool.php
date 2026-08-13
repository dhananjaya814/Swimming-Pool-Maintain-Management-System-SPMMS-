<?php
include "db.php";

$id = $_GET['id'];

$query = "DELETE FROM pool WHERE pool_id='$id'";

if (mysqli_query($conn, $query)) {
    header("Location: view_pools.php");
} else {
    echo "Error deleting!";
}
?>