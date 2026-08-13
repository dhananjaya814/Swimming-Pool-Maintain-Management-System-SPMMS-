<?php
include "db.php";

$id = $_GET['id'];

// Fetch existing data
$query = "SELECT * FROM pool WHERE pool_id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Update logic
if (isset($_POST['update'])) {

    $pool_name = $_POST['pool_name'];
    $location = $_POST['location'];

    $update = "UPDATE pool 
               SET pool_name='$pool_name', location='$location' 
               WHERE pool_id='$id'";

    if (mysqli_query($conn, $update)) {
        $success = "Pool updated successfully!";
    } else {
        $error = "Error updating!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pool</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #121212;
        color: #e0e0e0;
    }

    .card {
        background-color: #1e1e1e;
        color: #ffffff;
        border: none;
    }

    .card-header {
        background-color: #2c2c2c !important;
        color: #ffffff !important;
    }

    .table {
        color: #ffffff;
    }

    .table thead {
        background-color: #333333;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #1a1a1a;
    }

    .form-control, .form-select {
        background-color: #2c2c2c;
        color: #ffffff;
        border: 1px solid #444;
    }

    .form-control:focus {
        background-color: #2c2c2c;
        color: #fff;
        border-color: #666;
        box-shadow: none;
    }

    .btn {
        border-radius: 5px;
    }

    a {
        color: #90caf9;
    }

    a:hover {
        color: #64b5f6;
    }
</style>
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4>Edit Pool</h4>
        </div>

        <div class="card-body">

            <?php if(isset($success)) { ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php } ?>

            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Pool Name</label>
                    <input type="text" name="pool_name" 
                        value="<?php echo $row['pool_name']; ?>" 
                        class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Location</label>
                    <input type="text" name="location" 
                        value="<?php echo $row['location']; ?>" 
                        class="form-control" required>
                </div>

                <button type="submit" name="update" class="btn btn-warning">
                    Update Pool
                </button>

                <a href="view_pools.php" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>