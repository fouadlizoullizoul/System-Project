<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles/style.css">
    <title>Student Management System</title>
</head>
<body class="font-sans bg-gray-50">
    <!-- Navbar Section -->
    <?php
        include('pages/navbar.php');
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
</body>
</html>