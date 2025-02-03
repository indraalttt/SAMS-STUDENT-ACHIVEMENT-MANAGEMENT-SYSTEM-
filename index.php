<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Achievement Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url("images/bg2.jpg");
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #kctlogo {
            margin-bottom: 30px;
        }
        #kctlogo img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto; 
        }
        h1 {
            text-align: center;
            font-size: 28px;
            color: black;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container">
        <div id="kctlogo">
            <img src="images/kctlogo.jpeg" alt="KCT Logo">
        </div>
        <h1>Welcome to the Student Achievement Management System</h1>
        <div class="row justify-content-center mt-3">
            <p>"Our Student Achievement Management System empowers students to showcase their accomplishments by updating their profiles with achievements and uploading certificates. Staff members have access to student profiles, enabling them to verify the authenticity of certificates. Furthermore, our system features a dynamic dashboard where students earn credits based on their achievement levels. Additionally, staff members can post upcoming events on the notice board, providing students with easy access to relevant information and opportunities for participation."</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>