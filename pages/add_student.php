<?php
session_start(); // Start session to access stored messages
if ($_SESSION['usertype'] == "student") {
    header("Location: ../auth/login.php");
    exit();
}
$host = "localhost";
$username = "root";
$password = "";
$dbname = "schoolproject";
$connect = mysqli_connect($host, $username, $password, $dbname);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
// Check if the form is submitted
if (isset($_POST['add_student'])) {
    // Get form data
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $usertype = "student"; // Default user type

    // Check if email already exists
    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($connect, $check_email);
    
    if (mysqli_num_rows($result) > 0) {
        // Email already exists
        $_SESSION['error'] = "This email is already registered. Please use a different email.";
        header("Location: add_student.php");
        exit();
    }
    
    // Insert data into the database
    $sql = "INSERT INTO user (username, email, phone,usertype, password) VALUES ('$username', '$email', '$phone','$usertype', '$password')";

    if (mysqli_query($connect, $sql)) {
        $_SESSION['success'] = "Student added successfully!";
        header("Location: add_student.php");
        exit();
    } else {
        $_SESSION['error'] = "Error adding student: " . mysqli_error($connect);
        header("Location: add_student.php");
        exit();
    }
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

    <!-- Styled Header -->
    <header class="bg-blue-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="" class="text-xl font-bold">Add Students</a>
            <div>
                <a href="../Logout.php"
                    class="hover:bg-blue-700 px-4 py-2 rounded transition duration-300 flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>
    </header>

    <div class="flex flex-grow">
        <!-- Sidebar -->
        <?php include('SideBar.php') ?>
        <!-- Main Content Area -->
        <main class="flex-grow p-6">
            <h2 class="text-2xl font-semibold mb-6">Add New Students</h2>

            <!-- Add Student Form -->
            <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
                <!-- Display success message if set -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-6 rounded relative"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline"> <?php echo $_SESSION['success']; ?></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg onclick="this.parentElement.parentElement.style.display='none'"
                                class="fill-current h-6 w-6 text-green-500 cursor-pointer" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                    <?php
                    // Clear the message after displaying
                    unset($_SESSION['success']);
                endif;
                ?>

                <!-- Display error message if set -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-6 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline"> <?php echo $_SESSION['error']; ?></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg onclick="this.parentElement.parentElement.style.display='none'"
                                class="fill-current h-6 w-6 text-red-500 cursor-pointer" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                    <?php
                    // Clear the message after displaying
                    unset($_SESSION['error']);
                endif;
                ?>

                <form action="#" method="POST" class="space-y-6">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="username" name="username" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="phone" name="phone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <input value="Add Student" name="add_student" type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">

                        </input>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>