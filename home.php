<?php

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
<body class="bg-gray-50 min-h-screen">
    <!-- Sidebar Navigation -->
    <div class="flex">
        <aside class="fixed h-screen w-64 bg-indigo-800 text-white p-6">
            <div class="mb-8">
                <h1 class="text-2xl font-bold">GameVault</h1>
                <p class="text-indigo-200 text-sm">Game Collection Manager</p>
            </div>
            
            <nav class="space-y-2">
                <a href="dashboard.php" class="flex items-center space-x-3 bg-indigo-900 p-3 rounded-lg">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="library.php" class="flex items-center space-x-3 hover:bg-indigo-700 p-3 rounded-lg transition">
                    <i class="fas fa-gamepad"></i>
                    <span>My Library</span>
                </a>
                <a href="chat.php" class="flex items-center space-x-3 hover:bg-indigo-700 p-3 rounded-lg transition">
                    <i class="fas fa-comments"></i>
                    <span>Chat Rooms</span>
                </a>
                <a href="profile.php" class="flex items-center space-x-3 hover:bg-indigo-700 p-3 rounded-lg transition">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 w-full p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?php echo htmlspecialchars($username) ?>" 
                         class="w-10 h-10 rounded-full bg-indigo-600">
                    <div>
                        <p class="font-medium"><?php echo htmlspecialchars($username) ?></p>
                        <p class="text-sm text-indigo-200">Gamer</p>
                    </div>
                </div>
                <a href="auth/signOut.php" class="flex items-center space-x-3 hover:bg-indigo-700 p-3 rounded-lg transition">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sign Out</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            <!-- Welcome Section -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Welcome back, <?php echo htmlspecialchars($username) ?>!</h2>
                    <p class="text-gray-600">Here's what's happening with your games</p>
                </div>
                <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Add New Game</span>
                </button>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="bg-indigo-100 p-3 rounded-lg">
                            <i class="fas fa-book text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Collection</p>
                            <h3 class="text-2xl font-bold text-gray-800">127</h3>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i class="fas fa-play text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">In Progress</p>
                            <h3 class="text-2xl font-bold text-gray-800">4</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-check text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Completed</p>
                            <h3 class="text-2xl font-bold text-gray-800">89</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i class="fas fa-clock text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Play Time</p>
                            <h3 class="text-2xl font-bold text-gray-800">1.2K hrs</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent & Progress Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Currently Playing -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Currently Playing</h3>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                            <img src="https://placehold.co/60x60" class="w-15 h-15 rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800">Elden Ring</h4>
                                <div class="flex items-center space-x-2 text-sm text-gray-600">
                                    <span>42 hours played</span>
                                    <span>•</span>
                                    <span>75% complete</span>
                                </div>
                            </div>
                            <div class="w-20 h-20 relative">
                                <svg class="w-20 h-20 transform -rotate-90">
                                    <circle cx="40" cy="40" r="35" stroke="#e5e7eb" stroke-width="5" fill="none"/>
                                    <circle cx="40" cy="40" r="35" stroke="#4f46e5" stroke-width="5" fill="none"
                                            stroke-dasharray="220" stroke-dashoffset="55"/>
                                </svg>
                                <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-sm font-bold">
                                    75%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm">View All</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-2 rounded-lg">
                                <i class="fas fa-trophy text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">Completed "The Last of Us Part I"</p>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <i class="fas fa-plus text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">Added "God of War Ragnarök" to collection</p>
                                <p class="text-xs text-gray-500">Yesterday</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Games -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Popular in Community</h3>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm">Browse All</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="group relative">
                        <img src="https://placehold.co/300x400" class="w-full h-48 object-cover rounded-lg">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition">
                            <div class="absolute bottom-0 p-4 text-white">
                                <h4 class="font-semibold">Cyberpunk 2077</h4>
                                <p class="text-sm">Action RPG</p>
                            </div>
                        </div>
                    </div>
                    <!-- Add more game cards here -->
                </div>
            </div>
        </main>
    </div>

    <script>
        // Add any JavaScript functionality here
    </script>
</body>
</html>