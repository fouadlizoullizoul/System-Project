<?php
session_start(); // Fixed the session_start function call
$host="localhost";
$username="root";
$password="";
$dbname="schoolproject";
$connect = mysqli_connect($host, $username, $password, $dbname);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['apply'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    // Prepare data for insertion (with basic sanitization)
    $firstName = mysqli_real_escape_string($connect, $firstName);
    $lastName = mysqli_real_escape_string($connect, $lastName);
    $email = mysqli_real_escape_string($connect, $email);
    $phone = mysqli_real_escape_string($connect, $phone);
    $message = mysqli_real_escape_string($connect, $message);
    
    $sql = "INSERT INTO admission (first_name, last_name, email, phone, message) 
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$message')";
    if(mysqli_query($connect, $sql)){
        $_SESSION['success'] = "Thank you for your application! We have received your information and will contact you soon.";
        header("Location: index.php");
        exit(); // Add exit after redirect to prevent further code execution
    }else{
        $_SESSION['error'] = "There was a problem with your submission: " . mysqli_error($connect);
        header("Location: index.php");
        exit();
    }
}
?>