<?php
include "db.php";

if (isset($_POST['save'])) {

    $pool_name = $_POST['pool_name'];
    $location = $_POST['location'];

    $query = "INSERT INTO pool (pool_name, location) 
              VALUES ('$pool_name', '$location')";

    if (mysqli_query($conn, $query)) {
        $success = "Pool added successfully!";
    } else {
        $error = "Error adding pool!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Pool</title>

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
        <div class="card-header bg-primary text-white">
            <h4>Add Swimming Pool</h4>
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
                    <input type="text" name="pool_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" required>
                </div>

                <button type="submit" name="save" class="btn btn-success">
                    Save Pool
                </button>

                <a href="dashboard.php" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>