<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'student') {
    header("Location: index.php");
    exit;
}
include('connection.php');


error_reporting(E_ALL);
ini_set('display_errors', 1);


$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

if (isset($_POST['submit'])) {
    $student_id = $_SESSION['id']; 
    if (!isset($student_id)) {
        echo "Session ID not set.";
        exit;
    }

    $certificate_name = mysqli_real_escape_string($conn, $_POST['certificate_name']);
    $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    
    if ($_FILES["certificate"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    
    $allowed_types = ["pdf", "jpg", "jpeg", "png"];
    if (!in_array($fileType, $allowed_types)) {
        echo "Sorry, only PDF, JPG, JPEG, and PNG files are allowed.";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO certificates (student_id, certificate_name, file_path) VALUES ('$student_id', '$certificate_name', '$target_file')";
            if (mysqli_query($conn, $sql)) {
                echo "The file " . htmlspecialchars(basename($_FILES["certificate"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error saving your file information to the database: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error moving your file. Error: " . $_FILES['certificate']['error'];
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
    <title>Upload Certificate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h1 class="text-center">Upload Certificate</h1>
        <form action="upload_certificate.php" method="POST" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3">
                <label for="certificate_name" class="form-label">Certificate Name</label>
                <input type="text" class="form-control" id="certificate_name" name="certificate_name" required>
            </div>
            <div class="mb-3">
                <label for="certificate" class="form-label">Select Certificate</label>
                <input type="file" class="form-control" id="certificate" name="certificate" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
