<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - My Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include 'components/sidebar.php'; ?>

        <main class="ml-64 flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">My Game Library</h2>
                <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Add Game</span>
                </button>
            </div>

            <!-- Library Filters -->
            <div class="mb-6">
                <div class="flex space-x-4">
                    <select class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-gray-100">
                        <option>All Platforms</option>
                        <option>PC</option>
                        <option>PlayStation</option>
                        <option>Xbox</option>
                        <option>Nintendo Switch</option>
                    </select>
                    <select class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-gray-100">
                        <option>All Genres</option>
                        <option>Action</option>
                        <option>RPG</option>
                        <option>Strategy</option>
                        <option>Sports</option>
                    </select>
                    <select class="px-4 py-2 rounded-lg border border-gray-700 bg-gray-800 text-gray-100">
                        <option>Sort By</option>
                        <option>Recently Added</option>
                        <option>Name A-Z</option>
                        <option>Play Time</option>
                        <option>Rating</option>
                    </select>
                </div>
            </div>

            <!-- Games Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Game Card -->
                <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
                    <img src="https://placehold.co/300x400" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold">Game Title</h3>
                        <p class="text-sm text-gray-400">Action RPG</p>
                        <div class="flex items-center justify-between mt-3">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="text-sm text-gray-400">4.5</span>
                            </div>
                            <span class="text-sm text-gray-400">20 hrs played</span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <span class="px-2 py-1 bg-green-900 text-green-400 rounded text-xs">Completed</span>
                            <button class="text-gray-400 hover:text-gray-200">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Repeat game cards -->
            </div>
        </main>
    </div>
</body>
</html> 