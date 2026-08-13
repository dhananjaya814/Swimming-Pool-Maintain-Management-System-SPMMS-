<?php
include "db.php";

$id = $_GET['id'];

$query = "SELECT * FROM maintenance WHERE maintenance_id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $date = $_POST['date'];
    $desc = $_POST['description'];

    $update = "UPDATE maintenance 
               SET maintenance_date='$date',
                   description='$desc'
               WHERE maintenance_id='$id'";

    if (mysqli_query($conn, $update)) {
        header("Location: view_maintenance.php");
    } else {
        $error = "Error updating!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Maintenance</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DARK CSS -->
    <style>
        body { background: #121212; color: #e0e0e0; }
        .card { background: #1e1e1e; color: #fff; border: none; }
        .card-header { background: #2c2c2c; color: #fff; }
        .form-control {
            background: #2c2c2c;
            color: #fff;
            border: 1px solid #444;
        }
        .form-control:focus {
            background: #2c2c2c;
            color: #fff;
            border-color: #666;
            box-shadow: none;
        }
    </style>
</head>

<body>

<div class="container mt-5">

<div class="card shadow">
<div class="card-header">
<h4>Edit Maintenance</h4>
</div>

<div class="card-body">

<?php if(isset($error)) { ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label>Date</label>
<input type="date" name="date"
value="<?php echo $row['maintenance_date']; ?>" class="form-control">
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control"><?php echo $row['description']; ?></textarea>
</div>

<button name="update" class="btn btn-outline-warning">Update</button>
<a href="view_maintenance.php" class="btn btn-outline-light">Back</a>

</form>

</div>
</div>

</div>

</body>
</html>