<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include 'components/sidebar.php'; ?>

        <main class="ml-64 flex-1 p-8">
            <!-- Profile Header -->
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 mb-6 border border-gray-700">
                <div class="flex items-center space-x-6">
                    <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?php echo htmlspecialchars($username) ?>" 
                         class="w-24 h-24 rounded-full">
                    <div>
                        <h2 class="text-2xl font-bold"><?php echo htmlspecialchars($username) ?></h2>
                        <p class="text-gray-400">Member since: January 2024</p>
                        <div class="flex items-center space-x-4 mt-2">
                            <span class="text-sm text-gray-400">
                                <i class="fas fa-gamepad mr-1"></i> 127 Games
                            </span>
                            <span class="text-sm text-gray-400">
                                <i class="fas fa-clock mr-1"></i> 1.2K Hours Played
                            </span>
                            <span class="text-sm text-gray-400">
                                <i class="fas fa-trophy mr-1"></i> 89 Achievements
                            </span>
                        </div>
                    </div>
                    <button class="ml-auto bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Edit Profile
                    </button>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Personal Info -->
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                        <h3 class="text-lg font-bold mb-4">Personal Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-400">Email</label>
                                <p class="font-medium">user@example.com</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-400">Location</label>
                                <p class="font-medium">Paris, France</p>
                            </div>
                            <div>
                                <label class="text-sm text-gray-400">Member Status</label>
                                <p class="font-medium">Premium</p>
                            </div>
                        </div>
                    </div>

                    <!-- Gaming Platforms -->
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                        <h3 class="text-lg font-bold mb-4">Gaming Platforms</h3>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-steam text-gray-400"></i>
                                <span>Steam Connected</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-playstation text-gray-400"></i>
                                <span>PlayStation Connected</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fab fa-xbox text-gray-400"></i>
                                <span>Connect Xbox</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Center Column -->
                <div class="space-y-6 md:col-span-2">
                    <!-- Recent Activity -->
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                        <h3 class="text-lg font-bold mb-4">Recent Activity</h3>
                        <div class="space-y-4">
                            <!-- Activity items -->
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                        <h3 class="text-lg font-bold mb-4">Gaming Statistics</h3>
                        <!-- Add statistics content -->
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html> 