<aside class="fixed h-screen w-64 bg-gray-900 text-gray-100 p-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold">GameVault</h1>
        <p class="text-gray-400 text-sm">Game Collection Manager</p>
    </div>
    
    <nav class="space-y-2">
        <a href="home.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-gray-800' : 'hover:bg-gray-800'; ?> p-3 rounded-lg transition">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="library.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'library.php' ? 'bg-gray-800' : 'hover:bg-gray-800'; ?> p-3 rounded-lg transition">
            <i class="fas fa-gamepad"></i>
            <span>My Library</span>
        </a>
        <a href="chat.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'chat.php' ? 'bg-gray-800' : 'hover:bg-gray-800'; ?> p-3 rounded-lg transition">
            <i class="fas fa-comments"></i>
            <span>Chat Rooms</span>
        </a>
        <a href="profile.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'bg-gray-800' : 'hover:bg-gray-800'; ?> p-3 rounded-lg transition">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </nav>

    <div class="absolute bottom-0 left-0 w-full p-6">
        <div class="flex items-center space-x-3 mb-6">
            <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?php echo htmlspecialchars($username) ?>" 
                 class="w-10 h-10 rounded-full bg-gray-800">
            <div>
                <p class="font-medium"><?php echo htmlspecialchars($username) ?></p>
                <p class="text-sm text-gray-400">Gamer</p>
            </div>
        </div>
        <a href="auth/signOut.php" class="flex items-center space-x-3 hover:bg-gray-800 p-3 rounded-lg transition">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sign Out</span>
        </a>
    </div>
</aside> 