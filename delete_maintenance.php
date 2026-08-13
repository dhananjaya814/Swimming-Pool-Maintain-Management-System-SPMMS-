<?php
include "db.php";

$id = $_GET['id'];

$query = "DELETE FROM maintenance WHERE maintenance_id='$id'";

if (mysqli_query($conn, $query)) {
    header("Location: view_maintenance.php?msg=deleted");
} else {
    header("Location: view_maintenance.php?msg=error");
}
?>