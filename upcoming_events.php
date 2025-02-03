<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit;
}
include('connection.php');


$sql = "SELECT * FROM events ORDER BY date ASC";
$result = mysqli_query($conn, $sql);


if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}
?>
<style>body{ background-image: url("images/bg2.jpg");
}</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h1 class="text-center">Upcoming Events</h1>
        <?php while ($event = mysqli_fetch_assoc($result)): ?>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($event['description']) ?></p>
                    <p class="card-text"><small class="text-muted">Date: <?= htmlspecialchars($event['date']) ?></small></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
