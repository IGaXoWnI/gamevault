<nav class="bg-black/30 backdrop-blur-md border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="../library/index.php" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold bg-gradient-to-r from-violet-400 to-indigo-400 bg-clip-text text-transparent">
                        GameVault
                    </span>
                </a>
            </div>

        
            <div class="hidden md:flex items-center space-x-8">
            <a href="../library/index.php" class="text-gray-300 hover:text-white transition">
             <i class="fas fa-home mr-2"></i>home
              </a>
                <a href="../library/collection.php" class="text-gray-300 hover:text-white transition">
                    <i class="fas fa-gamepad mr-2"></i>Bibliothèque
                </a>

                <a href="../library/favorises.php" class="text-gray-300 hover:text-white transition">
                    <i class="fas fa-star mr-2"></i>Favoris
                </a>
                <a href="../library/historique.php" class="text-gray-300 hover:text-white transition">
                    <i class="fas fa-history mr-2"></i>Historique
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <div class="relative group">
                    <button class="flex items-center space-x-3 p-2 rounded-full bg-white/10 hover:bg-white/20 transition">
                        <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?= htmlspecialchars($username) ?>" 
                             class="w-8 h-8 rounded-full">
                        <span class="text-sm font-medium text-gray-300"><?= htmlspecialchars($username) ?></span>
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 py-2 bg-gray-900 rounded-xl shadow-xl border border-white/10 backdrop-blur-xl
                                opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="../profile/profile.php" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/10">
                            <i class="fas fa-user mr-2"></i>Mon Profil
                        </a>
                        <a href="../auth/signOut.php" class="block px-4 py-2 text-sm text-red-400 hover:bg-white/10">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </a>
                    </div>
                </div>
            </div>

            <!-- Menu mobile -->
            <div class="md:hidden">
                <button class="text-gray-300 hover:text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav> 