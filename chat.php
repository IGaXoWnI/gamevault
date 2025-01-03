<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Chat Rooms</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include 'components/sidebar.php'; ?>

        <main class="ml-64 flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">Chat Rooms</h2>
                <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Create Room</span>
                </button>
            </div>

            <!-- Chat Rooms Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Chat Room Card -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="font-bold">Elden Ring Discussion</h3>
                            <p class="text-sm text-gray-400">General discussion about Elden Ring</p>
                        </div>
                        <span class="bg-green-900 text-green-400 text-xs px-2 py-1 rounded">32 Online</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="flex -space-x-2">
                            <img src="https://api.dicebear.com/6.x/initials/svg?seed=JD" class="w-6 h-6 rounded-full border-2 border-gray-800">
                            <img src="https://api.dicebear.com/6.x/initials/svg?seed=AB" class="w-6 h-6 rounded-full border-2 border-gray-800">
                            <img src="https://api.dicebear.com/6.x/initials/svg?seed=CD" class="w-6 h-6 rounded-full border-2 border-gray-800">
                        </div>
                        <span class="text-sm text-gray-400">+29 more</span>
                    </div>
                    <button class="w-full bg-gray-700 text-gray-100 px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Join Chat
                    </button>
                </div>
                <!-- Repeat chat room cards -->
            </div>

            <!-- Active Conversations -->
            <div class="mt-8">
                <h3 class="text-lg font-bold mb-4">Your Active Conversations</h3>
                <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
                    <div class="divide-y divide-gray-700">
                        <div class="p-4 hover:bg-gray-700 transition">
                            <div class="flex items-center space-x-4">
                                <img src="https://api.dicebear.com/6.x/initials/svg?seed=ER" class="w-12 h-12 rounded-full">
                                <div class="flex-1">
                                    <h4 class="font-semibold">Elden Ring Discussion</h4>
                                    <p class="text-sm text-gray-400">Last message: 5 minutes ago</p>
                                </div>
                                <span class="bg-indigo-900 text-indigo-400 text-xs px-2 py-1 rounded">2 new</span>
                            </div>
                        </div>
                        <!-- Repeat conversation items -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html> 