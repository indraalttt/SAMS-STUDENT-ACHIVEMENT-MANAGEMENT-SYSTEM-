<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit;
}
include('connection.php');

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}
?>
<style>body{ background-image: url("images/bg2.jpg");
}</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h1 class="text-center">Profile of <?= htmlspecialchars($user['username']) ?></h1>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Year of Study:</strong> <?= htmlspecialchars($user['year_of_study']) ?></p>
        <p><strong>Department:</strong> <?= htmlspecialchars($user['department']) ?></p>
        <p><strong>Area of Interest:</strong> <?= htmlspecialchars($user['area_of_interest']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Achievements:</strong> <?= htmlspecialchars($user['achievements']) ?></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
