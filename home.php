<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include 'components/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            <!-- Welcome Section with Search -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold">Welcome back, <?php echo htmlspecialchars($username) ?>!</h2>
                    <p class="text-gray-400">Here's what's happening with your games</p>
                </div>
                <div class="flex space-x-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search games..." 
                               class="w-64 pl-10 pr-4 py-2 border border-gray-700 rounded-lg bg-gray-800 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <!-- Add Game Button -->
                    <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Add New Game</span>
                    </button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <div class="flex items-center space-x-4">
                        <div class="bg-indigo-900 p-3 rounded-lg">
                            <i class="fas fa-book text-indigo-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Collection</p>
                            <h3 class="text-2xl font-bold">127</h3>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-900 p-3 rounded-lg">
                            <i class="fas fa-play text-green-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">In Progress</p>
                            <h3 class="text-2xl font-bold">4</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-900 p-3 rounded-lg">
                            <i class="fas fa-check text-blue-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Completed</p>
                            <h3 class="text-2xl font-bold">89</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-900 p-3 rounded-lg">
                            <i class="fas fa-clock text-purple-400 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Play Time</p>
                            <h3 class="text-2xl font-bold">1.2K hrs</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Game Status Filters -->
            <div class="flex space-x-4 mb-8">
                <button class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">All Games</button>
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-100 hover:bg-gray-700 border border-gray-700">In Progress</button>
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-100 hover:bg-gray-700 border border-gray-700">Completed</button>
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-100 hover:bg-gray-700 border border-gray-700">Abandoned</button>
                <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-100 hover:bg-gray-700 border border-gray-700">Favorites</button>
            </div>

            <!-- Recent & Progress Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Currently Playing -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Currently Playing</h3>
                        <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 p-4 bg-gray-700 rounded-lg">
                            <img src="https://placehold.co/60x60" class="w-15 h-15 rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-semibold">Elden Ring</h4>
                                <div class="flex items-center space-x-2 text-sm text-gray-400">
                                    <span>42 hours played</span>
                                    <span>•</span>
                                    <span>75% complete</span>
                                </div>
                            </div>
                            <div class="w-20 h-20 relative">
                                <svg class="w-20 h-20 transform -rotate-90">
                                    <circle cx="40" cy="40" r="35" stroke="#374151" stroke-width="5" fill="none"/>
                                    <circle cx="40" cy="40" r="35" stroke="#4f46e5" stroke-width="5" fill="none"
                                            stroke-dasharray="220" stroke-dashoffset="55"/>
                                </svg>
                                <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-sm font-bold">
                                    75%
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Add Rating and Status -->
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="far fa-star text-yellow-400"></i>
                        </div>
                        <select class="px-3 py-1 rounded border border-gray-700 bg-gray-700 text-gray-100">
                            <option>In Progress</option>
                            <option>Completed</option>
                            <option>Abandoned</option>
                        </select>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Recent Activity</h3>
                        <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-900 p-2 rounded-lg">
                                <i class="fas fa-trophy text-green-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Completed "The Last of Us Part I"</p>
                                <p class="text-xs text-gray-400">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-900 p-2 rounded-lg">
                                <i class="fas fa-plus text-blue-400"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm">Added "God of War Ragnarök" to collection</p>
                                <p class="text-xs text-gray-400">Yesterday</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Rooms Preview -->
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Active Chat Rooms</h3>
                    <a href="chat.php" class="text-indigo-400 hover:text-indigo-300 text-sm">View All</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 border border-gray-700 rounded-lg hover:bg-gray-700 transition">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold">Elden Ring Discussion</h4>
                            <span class="bg-green-900 text-green-400 text-xs px-2 py-1 rounded">Active</span>
                        </div>
                        <p class="text-sm text-gray-400">32 users online</p>
                    </div>
                </div>
            </div>

            <!-- Popular Games -->
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Popular in Community</h3>
                    <a href="#" class="text-indigo-400 hover:text-indigo-300 text-sm">Browse All</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="group relative">
                        <img src="https://placehold.co/300x400" class="w-full h-48 object-cover rounded-lg">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition">
                            <div class="absolute bottom-0 p-4 text-white">
                                <h4 class="font-semibold">Cyberpunk 2077</h4>
                                <p class="text-sm text-gray-300">Action RPG</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>