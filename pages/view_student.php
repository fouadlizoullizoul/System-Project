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

// Handle delete student operation
if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);
    $delete_sql = "DELETE FROM user WHERE id = '$student_id' AND usertype = 'student'";

    if (mysqli_query($connect, $delete_sql)) {
        $_SESSION['message'] = "Student deleted successfully";
    } else {
        $_SESSION['message'] = "Error deleting student: " . mysqli_error($connect);
    }

    // Redirect to refresh the page
    header("Location: view_student.php");
    exit();
}

$sql = "SELECT * FROM user";
$result = mysqli_query($connect, $sql);

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
            <a href="" class="text-xl font-bold">View All Students</a>
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
            <h2 class="text-2xl font-semibold mb-6">Student Data</h2>

            <?php
            // Display message if there is one
            if (isset($_SESSION['message'])) {
                echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4'>";
                echo $_SESSION['message'];
                echo "</div>";
                unset($_SESSION['message']); // Clear the message
            }
            ?>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">User Name</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Email</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Phone</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">User Type</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['usertype'] == 'student') {
                                    echo "<tr class='hover:bg-gray-50'>";
                                    echo "<td class='py-2 px-4 border-b'>" . $row['username'] . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . $row['email'] . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . $row['phone'] . "</td>";
                                    echo "<td class='py-2 px-4 border-b'>" . $row['usertype'] . "</td>";
                                    echo "<td class='py-2 px-4 border-b flex space-x-2'>";
                                    // Update button
                                    echo "<a href='update_student.php?id=" . $row['id'] . "' class='bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm'>";
                                    echo "<i class='fas fa-edit mr-1'></i> Update";
                                    echo "</a>";

                                    // Delete button (existing)
                                    echo "<form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this student?\")'>";
                                    echo "<input type='hidden' name='student_id' value='" . $row['id'] . "'>";
                                    echo "<button type='submit' name='delete_student' class='bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm'>";
                                    echo "<i class='fas fa-trash-alt mr-1'></i> Delete";
                                    echo "</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        } else {
                            echo "<tr><td colspan='5' class='py-4 px-4 text-center text-gray-500'>No students found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>