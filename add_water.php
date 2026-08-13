<?php
include "db.php";

if (isset($_POST['save'])) {

    $pool_id = $_POST['pool_id'];
    $date = $_POST['test_date'];
    $ph = $_POST['ph_level'];
    $chlorine = $_POST['chlorine_level'];
    $temp = $_POST['temperature'];

    $query = "INSERT INTO water_quality 
              (pool_id, test_date, ph_level, chlorine_level, temperature)
              VALUES 
              ('$pool_id', '$date', '$ph', '$chlorine', '$temp')";

    if (mysqli_query($conn, $query)) {
        $success = "Water data saved successfully!";
    } else {
        $error = "Error saving data!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Water Quality</title>

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
            <h4>Add Water Quality</h4>
        </div>

        <div class="card-body">

            <?php if(isset($success)) { ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php } ?>

            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>

            <form method="POST">

                <!-- Pool Dropdown -->
                <div class="mb-3">
                    <label>Pool</label>
                    <select name="pool_id" class="form-control" required>
                        <option value="">Select Pool</option>

                        <?php
                        $query = "SELECT * FROM pool";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['pool_id']; ?>">
                                <?php echo $row['pool_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Date -->
                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="test_date" class="form-control" required>
                </div>

                <!-- pH -->
                <div class="mb-3">
                    <label>pH Level</label>
                    <input type="number" step="0.1" name="ph_level" class="form-control" required>
                </div>

                <!-- Chlorine -->
                <div class="mb-3">
                    <label>Chlorine Level</label>
                    <input type="number" step="0.1" name="chlorine_level" class="form-control" required>
                </div>

                <!-- Temperature -->
                <div class="mb-3">
                    <label>Temperature</label>
                    <input type="number" step="0.1" name="temperature" class="form-control" required>
                </div>

                <button type="submit" name="save" class="btn btn-success">
                    Save Data
                </button>

                <a href="dashboard.php" class="btn btn-secondary">Back</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>