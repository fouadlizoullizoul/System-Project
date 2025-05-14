<?php
session_start(); // Start session to store messages

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "schoolproject";
$connect = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connect) {
    $_SESSION['error'] = "Database connection failed: " . mysqli_connect_error();
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate that fields are not empty
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Username and password are required";
        header("Location: ../auth/login.php");
        exit();
    }

    // Get and sanitize input
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Query the database
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($connect, $sql);

    // Check if user exists
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = "User not found. Please check your username.";
        header("Location: ../auth/login.php");
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    // Check password and user type
    if ($row["password"] != $password) {
        $_SESSION['error'] = "Incorrect password. Please try again.";
        header("Location: ../auth/login.php");
        exit();
    }

    // Successful login - set session variables
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['usertype'] = $row['usertype'];

    // Redirect based on user type
    if ($row["usertype"] == "student") {
        $_SESSION['success'] = "Welcome back, " . $row['username'] . "!";
        $_SESSION['usertype'] = "student";
        header("Location: ../pages/StudentHome.php");
        exit();
    } else if ($row["usertype"] == "admin") {
        $_SESSION['success'] = "Welcome back, Administrator " . $row['username'] . "!";
        $_SESSION['usertype'] = "admin";
        header("Location: ../pages/AdminHome.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid user type. Please contact administrator.";
        header("Location: ../auth/login.php");
        exit();
    }
}
?>