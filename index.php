<?php
    session_start(); // Start the session
    session_destroy(); // Destroy the session
    error_reporting(0); // Suppress error reporting
    if($_SESSION['success']){
        $message = $_SESSION['success'];
        echo "<script>alert('$message');</script>";
    }
?>


<?php 
        include('Header.php');
    ?>
    <!-- Hero section with background image and overlay text -->
    <?php
        include('pages/hero.php');
    ?>
    <!-- Teachers Section -->
    <?php
        include('pages/TechersSection.php');
    ?>
    <!-- Courses Section -->
    <?php
        include('pages/CoursesSection.php');
    ?>
    <!-- Form Section -->
    <?php
        include('pages/Form.php');
    ?>
    <!-- Footer Section -->
    <?php include 'pages/Footer.php'; ?>