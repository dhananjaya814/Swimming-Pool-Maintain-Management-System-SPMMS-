<?php
include "db.php";

session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

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

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 350px;">
        
        <h3 class="text-center mb-3">Login</h3>

        <?php if(isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            
            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html> 