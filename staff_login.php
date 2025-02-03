<style>body{ background-image: url("images/bg2.jpg");
}</style>
<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: welcome.php");
    exit;
}

include('connection.php');

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    $sql = "SELECT * FROM users WHERE BINARY username = '$username' AND role = 'staff'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if($count && password_verify($password, $row["password"])){
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['loggedin'] = true;
        header("Location: welcome.php");
        exit;
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Staff Login</h1>
                        <form action="staff_login.php" method="POST" class="mt-4">
                            <div class="mb-3">
                                <label for="user" class="form-label">Enter Username:</label>
                                <input type="text" class="form-control" id="user" name="user" required>
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="pass" name="pass" required>
                            </div>
                            <input type="hidden" name="source" value="staff_login">
                            <?php if(isset($error_message)): ?>
                                <div class="alert alert-danger" role="alert"><?= $error_message ?></div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary" name="submit">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="signup.php" class="btn btn-link">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>