<?php
include "db.php";

// Count Pools
$pool_query = "SELECT COUNT(*) as total FROM pool";
$pool_result = mysqli_query($conn, $pool_query);
$pool_data = mysqli_fetch_assoc($pool_result);

// Count Maintenance
$main_query = "SELECT COUNT(*) as total FROM maintenance";
$main_result = mysqli_query($conn, $main_query);
$main_data = mysqli_fetch_assoc($main_result);

// Fetch Water Data
$dates = [];
$ph = [];
$chlorine = [];
$temp = [];

$query = "SELECT test_date, ph_level, chlorine_level, temperature FROM water_quality";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = $row['test_date'];
    $ph[] = $row['ph_level'];
    $chlorine[] = $row['chlorine_level'];
    $temp[] = $row['temperature'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .card:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }

        
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

<div class="container mt-4">

    <h2 class="text-center mb-4"><b>Swimming Pool Dashboard</b></h2>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pool System</a>

            <div>
                <a href="add_pool.php" class="btn btn-light btn-sm">Add Pool</a>
                <a href="view_pools.php" class="btn btn-light btn-sm">View Pools</a>
                <a href="add_maintenance.php" class="btn btn-light btn-sm">Maintenance</a>
                <a href="view_maintenance.php" class="btn btn-light btn-sm">View Maintenance</a>
                <a href="add_water.php" class="btn btn-light btn-sm">Add Water</a>
                <a href="view_water.php" class="btn btn-light btn-sm">View Water</a>
            </div>
        </div>
    </nav>

    <!-- SUMMARY CARDS -->
    <div class="row">

        <div class="col-md-6">
            <div class="card bg-success text-white text-center shadow">
                <div class="card-body">
                    <h5>Total Pools</h5>
                    <h2><?php echo $pool_data['total']; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-warning text-dark text-center shadow">
                <div class="card-body">
                    <h5>Total Maintenance</h5>
                    <h2><?php echo $main_data['total']; ?></h2>
                </div>
            </div>
        </div>

    </div>

    <!-- CHART SECTION -->
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h5 class="text-center">Water Quality Analysis</h5>

            <canvas id="chart"></canvas>
        </div>
    </div>

</div>

<!-- CHART SCRIPT -->
<script>
var ctx = document.getElementById('chart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [

        {
            label: 'pH Level',
            data: <?php echo json_encode($ph); ?>,
            borderColor: 'blue',
            borderWidth: 2,
            fill: false,
            tension: 0.4,
            pointRadius: 5
        },

        {
            label: 'Chlorine Level',
            data: <?php echo json_encode($chlorine); ?>,
            borderColor: 'green',
            borderWidth: 2,
            fill: false,
            tension: 0.4,
            pointRadius: 5
        },

        {
            label: 'Temperature',
            data: <?php echo json_encode($temp); ?>,
            borderColor: 'orange',
            borderWidth: 2,
            fill: false,
            tension: 0.4,
            pointRadius: 5
        }

        ]
    }
});
</script>

</body>
</html>