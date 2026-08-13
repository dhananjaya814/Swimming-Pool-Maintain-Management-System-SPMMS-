<?php
include "db.php";

// SEARCH
$search = "";

if(isset($_GET['search'])) {

    $search = $_GET['search'];

    $query = "SELECT maintenance.*, pool.pool_name
              FROM maintenance
              JOIN pool ON maintenance.pool_id = pool.pool_id
              WHERE pool.pool_name LIKE '%$search%'
              OR maintenance_date LIKE '%$search%'
              OR description LIKE '%$search%'";

} else {

    $query = "SELECT maintenance.*, pool.pool_name
              FROM maintenance
              JOIN pool ON maintenance.pool_id = pool.pool_id";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Records</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DARK UI -->
    <style>

        body {
            background: #121212;
            color: #e0e0e0;
        }

        .card {
            background: #1e1e1e;
            border: none;
            color: white;
        }

        .table {
            color: white;
        }

        .table thead {
            background: #333;
        }

        .form-control {
            background: #2c2c2c;
            color: white;
            border: 1px solid #444;
        }

        .form-control:focus {
            background: #2c2c2c;
            color: white;
            box-shadow: none;
            border-color: #666;
        }

    </style>

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark">
<h4>Maintenance Records</h4>
</div>

<div class="card-body">

<!-- SUCCESS MESSAGE -->
<?php if(isset($_GET['msg'])) { ?>

    <?php if($_GET['msg'] == 'deleted') { ?>
        <div class="alert alert-success">
            Record deleted successfully!
        </div>
    <?php } ?>

<?php } ?>

<!-- ADD BUTTON -->
<a href="add_maintenance.php" class="btn btn-outline-success mb-3">
Add Maintenance
</a>

<!-- SEARCH FORM -->
<form method="GET" class="mb-4 d-flex">

    <input type="text"
           name="search"
           class="form-control me-2"
           placeholder="Search by pool, date or description"
           value="<?php echo $search; ?>">

    <button class="btn btn-outline-light">
        Search
    </button>

</form>

<!-- TABLE -->
<table class="table table-bordered table-striped">

<thead>

<tr>
    <th>ID</th>
    <th>Pool</th>
    <th>User ID</th>
    <th>Date</th>
    <th>Description</th>
    <th>Actions</th>
</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['maintenance_id']; ?></td>

<td><?php echo $row['pool_name']; ?></td>

<td><?php echo $row['user_id']; ?></td>

<td><?php echo $row['maintenance_date']; ?></td>

<td><?php echo $row['description']; ?></td>

<td>

<a href="edit_maintenance.php?id=<?php echo $row['maintenance_id']; ?>"
class="btn btn-outline-warning btn-sm">
Edit
</a>

<a href="delete_maintenance.php?id=<?php echo $row['maintenance_id']; ?>"
class="btn btn-outline-danger btn-sm"
onclick="return confirm('Delete this record?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-outline-light">
Back
</a>

</div>
</div>
</div>

</body>
</html>