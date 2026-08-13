<?php
include "db.php";

$id = $_GET['id'];

// Fetch data
$query = "SELECT * FROM water_quality WHERE test_id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Update
if (isset($_POST['update'])) {

    $ph = $_POST['ph_level'];
    $chlorine = $_POST['chlorine_level'];
    $temp = $_POST['temperature'];

    $update = "UPDATE water_quality 
               SET ph_level='$ph',
                   chlorine_level='$chlorine',
                   temperature='$temp'
               WHERE test_id='$id'";

    if (mysqli_query($conn, $update)) {
        header("Location: view_water.php");
    } else {
        $error = "Error updating!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Water</title>

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
<h4>Edit Water Data</h4>
</div>

<div class="card-body">

<?php if(isset($error)) { ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label>pH Level</label>
<input type="number" step="0.1" name="ph_level"
value="<?php echo $row['ph_level']; ?>" class="form-control">
</div>

<div class="mb-3">
<label>Chlorine Level</label>
<input type="number" step="0.1" name="chlorine_level"
value="<?php echo $row['chlorine_level']; ?>" class="form-control">
</div>

<div class="mb-3">
<label>Temperature</label>
<input type="number" step="0.1" name="temperature"
value="<?php echo $row['temperature']; ?>" class="form-control">
</div>

<button name="update" class="btn btn-outline-warning">Update</button>
<a href="view_water.php" class="btn btn-outline-light">Back</a>

</form>

</div>
</div>

</div>

</body>
</html>