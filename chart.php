<?php
include "db.php";

// Fetch data
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
    <title>Water Quality Chart</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- DARK THEME -->
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
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-body">
            <h4 class="text-center mb-4">Water Quality Analysis</h4>

            <canvas id="chart"></canvas>
        </div>
    </div>

    <div class="mt-3">
        <a href="dashboard.php" class="btn btn-outline-light">Back</a>
    </div>

</div>

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