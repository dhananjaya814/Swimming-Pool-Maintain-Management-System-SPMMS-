<?php
include "db.php";

$id = $_GET['id'];

$query = "DELETE FROM water_quality WHERE test_id='$id'";

if (mysqli_query($conn, $query)) {
    header("Location: view_water.php?msg=deleted");
} else {
    header("Location: view_water.php?msg=error");
}
?>