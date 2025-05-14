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
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="" class="flex-shrink-0 flex items-center">
                        <span class="text-white text-2xl font-bold tracking-tight">W-school</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="" class="text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">Home</a>
                            <a href="" class="text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">Contact</a>
                            <a href="" class="text-white hover:bg-blue-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">Admission</a>
                            <a href="" class="bg-white text-blue-700 px-4 py-2 rounded-md text-sm font-medium shadow-sm hover:bg-gray-100 transition duration-150 ease-in-out">Login</a>
                        </div>
                    </div>
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <!-- Heroicon name: menu -->
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu, show/hide based on menu state -->
        <div class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Home</a>
                <a href="" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Contact</a>
                <a href="" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500">Admission</a>
                <a href="" class="bg-white text-blue-700 block px-3 py-2 rounded-md text-base font-medium">Login</a>
            </div>
        </div>
    </nav>
    <!-- Hero section with background image and overlay text -->
    <div class="relative bg-cover bg-center h-[70vh]" style="background-image: url('assets/school.png');">
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white text-center px-4 tracking-wide">
                We Teach Students With Care
            </h1>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div class="flex justify-center">
            <img src="assets/playground.jpg" alt="Playground" class="rounded-lg shadow-lg w-full max-w-md">
            </div>
            <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Welcome To W-School</h1>
            <p class="text-gray-600 leading-relaxed text-lg">
                W-School is dedicated to providing a nurturing and innovative learning environment where students can thrive academically, socially, and emotionally. Our mission is to empower young minds with knowledge, skills, and values that prepare them for a successful future. Join us in shaping the leaders of tomorrow with care and excellence.
            </p>
            </div>
        </div>
    </div>
</body>
</html>