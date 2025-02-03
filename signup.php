<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['loggedin'])){
    header("Location: welcome.php");
    exit;
}

include("connection.php");


if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
    
    $role = isset($_POST['source']) && ($_POST['source'] === 'student_login.php' || $_POST['source'] === 'student_login') ? 'student' : 'student';

    
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email address";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user == 0 && $count_email == 0){
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(username, email, password, role) VALUES('$username', '$email', '$hash', '$role')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    
                    if ($role == 'student') {
                        header("Location: student_login.php");
                    } else if ($role == 'staff') {
                        header("Location: staff_login.php");
                    }
                    exit;
                }
            } else {
                $error_message = "Passwords do not match";
            }
        } else {
            $error_message = "Username or Email already exists!";
        }
    }
}
?>
<style>body{ background-image: url("images/bg2.jpg");
}</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <?php include "navbar.php"; ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Sign Up Form</h1>
                        
                        <form action="signup.php" method="POST" class="mt-4">
                            <input type="hidden" name="source" value="<?php echo isset($_POST['source']) ? $_POST['source'] : ''; ?>">
                            <div class="mb-3">
                                <label for="user" class="form-label">Enter Username:</label>
                                <input type="text" class="form-control" id="user" name="user" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Enter Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Create Password:</label>
                                <input type="password" class="form-control" id="pass" name="pass" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpass" class="form-label">Retype Password:</label>
                                <input type="password" class="form-control" id="cpass" name="cpass" required>
                            </div>
                            <?php if(isset($error_message)): ?>
                                <div class="alert alert-danger" role="alert"><?= $error_message ?></div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>