<?php
session_start(); // Start session to access stored messages
if ($_SESSION['usertype'] == "student") {
    header("Location: ../auth/login.php");
    exit();
}
;
$host = "localhost";
$username = "root";
$password = "";
$dbname = "schoolproject";
$connect = mysqli_connect($host, $username, $password, $dbname);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = "No student ID provided for update";
    header("Location: view_student.php");
    exit();
}

$student_id = mysqli_real_escape_string($connect, $_GET['id']);

// Fetch student data
$sql = "SELECT * FROM user WHERE id = '$student_id' AND usertype = 'student'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['message'] = "Student not found";
    header("Location: view_student.php");
    exit();
}

$student = mysqli_fetch_assoc($result);

// Process update form submission
if (isset($_POST['update_student'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);

    $update_sql = "UPDATE user SET 
                 username = '$username',
                 email = '$email',
                 phone = '$phone'
                 WHERE id = '$student_id' AND usertype = 'student'";

    if (mysqli_query($connect, $update_sql)) {
        $_SESSION['message'] = "Student updated successfully";
        header("Location: view_student.php");
        exit();
    } else {
        $error = "Error updating student: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student - W-school</title>
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
            <a href="" class="text-xl font-bold">Update Student</a>
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
            <h2 class="text-2xl font-semibold mb-6">Update Student Information</h2>

            <?php if (isset($error)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <form method="POST" action="">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $student['username']; ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $student['phone']; ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" name="update_student"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                        <a href="view_student.php" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Students
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>