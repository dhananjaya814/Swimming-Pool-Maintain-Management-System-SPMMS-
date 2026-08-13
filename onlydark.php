<?php
include "db.php";

// TOTAL POOLS
$pool_query = "SELECT COUNT(*) as total FROM pool";
$pool_result = mysqli_query($conn, $pool_query);
$pool_data = mysqli_fetch_assoc($pool_result);

// TOTAL MAINTENANCE
$main_query = "SELECT COUNT(*) as total FROM maintenance";
$main_result = mysqli_query($conn, $main_query);
$main_data = mysqli_fetch_assoc($main_result);

// WATER QUALITY DATA
$dates = [];
$ph = [];
$chlorine = [];
$temp = [];

$query = "SELECT test_date, ph_level, chlorine_level, temperature 
          FROM water_quality";

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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        body {
            margin: 0;
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1e1e1e;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: #cccccc;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #333333;
            color: white;
        }

        .sidebar i {
            margin-right: 10px;
        }

        /* MAIN CONTENT */

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* CARDS */

        .card {
            background: #1e1e1e;
            border: none;
            color: white;
            border-radius: 10px;
        }

        .card:hover {
            transform: scale(1.03);
            transition: 0.3s;
        }

        /* CHART */

        canvas {
            background: #1e1e1e;
            border-radius: 10px;
            padding: 10px;
        }

        /* RESPONSIVE */

        @media screen and (max-width: 768px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }

    </style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <h3>🏊 Pool System</h3>

    <a href="dashboard.php">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="add_pool.php">
        <i class="bi bi-plus-circle"></i> Add Pool
    </a>

    <a href="view_pools.php">
        <i class="bi bi-table"></i> View Pools
    </a>

    <a href="add_maintenance.php">
        <i class="bi bi-tools"></i> Add Maintenance
    </a>

    <a href="view_maintenance.php">
        <i class="bi bi-list-check"></i> View Maintenance
    </a>

    <a href="add_water.php">
        <i class="bi bi-droplet"></i> Add Water Data
    </a>

    <a href="view_water.php">
        <i class="bi bi-clipboard-data"></i> View Water Data
    </a>

    <a href="chart.php">
        <i class="bi bi-bar-chart"></i> Charts
    </a>

    <a href="login.php">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

</div>

<!-- MAIN CONTENT -->

<div class="main-content">

    <h2 class="mb-4">Dashboard</h2>

    <!-- SUMMARY CARDS -->

    <div class="row">

        <div class="col-md-6 mb-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Total Pools</h5>

                    <h1><?php echo $pool_data['total']; ?></h1>

                </div>

            </div>

        </div>

        <div class="col-md-6 mb-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Total Maintenance</h5>

                    <h1><?php echo $main_data['total']; ?></h1>

                </div>

            </div>

        </div>

    </div>

    <!-- CHART SECTION -->

    <div class="card shadow">

        <div class="card-body">

            <h4 class="mb-4">Water Quality Analysis</h4>

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
            tension: 0.4
        },

        {
            label: 'Chlorine Level',
            data: <?php echo json_encode($chlorine); ?>,
            borderColor: 'green',
            borderWidth: 2,
            fill: false,
            tension: 0.4
        },

        {
            label: 'Temperature',
            data: <?php echo json_encode($temp); ?>,
            borderColor: 'orange',
            borderWidth: 2,
            fill: false,
            tension: 0.4
        }

        ]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                labels: {
                    color: 'white'
                }

            }

        },

        scales: {

            x: {

                ticks: {
                    color: 'white'
                }

            },

            y: {

                ticks: {
                    color: 'white'
                }

            }

        }

    }

});

</script>

</body>
</html>