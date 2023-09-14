<?php
session_start();

// Check if the login form is submitted
if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database (replace with your database credentials)
    $conn = mysqli_connect('localhost', 'root', '', 'me');

    // Check for a connection error
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize user input
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // User found, set session variable
        $_SESSION['username'] = $username;
        header('location: certificate_generator.php');
    } else {
        // Authentication failed
        // Output the error message and video code
        echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/ecertificate/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/ecertificate/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/ecertificate/favicon-16x16.png">
<link rel="manifest" href="/ecertificate/site.webmanifest">
<link rel="mask-icon" href="/ecertificate/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <title>Error</title>
    <style>
        /* Make the video cover the entire viewport */
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        /* Center the video and make it non-clickable */
        #video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        /* Style the error message */
        #error-message {
            position: absolute;
            top: 90%;
            left: 60%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: rgb(11, 13, 56);
            font-size: 45px;
        }
    </style>
</head>
<body>
    <!-- Video container -->
    <div id="video-container">
        <video autoplay loop muted>
            <source src="/ecertificate/error.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Error message -->
    <div id="error-message">
        Invalid username or password
    </div>
</body>
</html>
HTML;
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
