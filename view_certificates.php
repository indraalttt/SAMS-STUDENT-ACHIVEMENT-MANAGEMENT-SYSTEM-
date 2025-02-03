<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit;
}
include('connection.php');

$student_id = $_SESSION['id']; // Assuming the student's ID is stored in the session

$sql = "SELECT certificate_name, file_path FROM certificates WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $sql);
?>
<style>body{ background-image: url("images/bg2.jpg");
}</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Certificates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h1 class="text-center">My Certificates</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Certificate Name</th>
                    <th>View Certificate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['certificate_name']) . "</td>";
                        echo "<td><a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>View</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No certificates found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
