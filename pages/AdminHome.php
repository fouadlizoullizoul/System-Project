<?php
session_start(); // Start session to access stored messages
    if($_SESSION['usertype'] == "student") {
        header("Location: ../auth/login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - W-school</title>
    <!-- Add Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styles/style.css">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Display success message if set -->
    <?php if(isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 mx-4 mt-4 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline"> <?php echo $_SESSION['success']; ?></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg onclick="this.parentElement.parentElement.style.display='none'" class="fill-current h-6 w-6 text-green-500 cursor-pointer" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
            </svg>
        </span>
    </div>
    <?php 
    // Clear the message after displaying
    unset($_SESSION['success']); 
    endif; 
    ?>

    <!-- Styled Header -->
    <header class="bg-blue-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="" class="text-xl font-bold">Admin Dashboard</a>
            <div>
                <a href="../Logout.php" class="hover:bg-blue-700 px-4 py-2 rounded transition duration-300 flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </header>

    <div class="flex flex-grow">
        <!-- Sidebar -->
        <?php include('SideBar.php')?>
        <!-- Main Content Area -->
        <main class="flex-grow p-6">
            <h2 class="text-2xl font-semibold mb-6">Welcome to Admin Panel</h2>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p>You can manage students, teachers, and courses from the sidebar menu.</p>
            </div>
        </main>
    </div>
</body>
</html>