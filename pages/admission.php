<?php
session_start(); // Start session to access stored messages
    if($_SESSION['usertype'] == "student") {
        header("Location: ../auth/login.php");
        exit();
    }
    $host="localhost";
    $username="root";
    $password="";
    $dbname="schoolproject";
    $connect = mysqli_connect($host, $username, $password, $dbname);
    $sql = "SELECT * FROM admission";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }

    // Reset the result pointer
    mysqli_data_seek($result, 0);
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
            <a href="" class="text-xl font-bold">Admission</a>
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
            <h2 class="text-2xl font-semibold mb-6">Applied For Admission</h2>
            
            <!-- Admission Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                First Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Last Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Phone
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Message
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php 
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) { 
                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="max-w-xs truncate"><?php echo htmlspecialchars($row['first_name']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="max-w-xs truncate"><?php echo htmlspecialchars($row['last_name']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="max-w-xs truncate"><?php echo htmlspecialchars($row['email']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="max-w-xs truncate"><?php echo htmlspecialchars($row['phone']); ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs truncate"><?php echo htmlspecialchars($row['message']); ?></div>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">No admission applications found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>