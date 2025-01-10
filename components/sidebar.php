<aside class="fixed h-screen w-64 bg-gray-900 text-gray-100 p-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold">GameVault</h1>
        <p class="text-gray-400 text-sm">Administration</p>
    </div>
    
    <nav class="space-y-6">
        <div>
            <a href="../view/home.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'bg-gray-800' : 'hover:bg-gray-800'; ?> p-3 rounded-lg transition">
                <i class="fas fa-home"></i>
                <span>Tableau de bord</span>
            </a>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase mb-2 pl-3">Gestion des Jeux</p>
            <div class="space-y-2">
                <a href="../games/add.php" class="flex items-center space-x-3 hover:bg-gray-800 p-3 rounded-lg transition">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter un jeu</span>
                </a>
                <a href="../games/manage.php" class="flex items-center space-x-3 hover:bg-gray-800 p-3 rounded-lg transition">
                    <i class="fas fa-edit"></i>
                    <span>Gérer les jeux</span>
                </a>
            </div>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase mb-2 pl-3">Gestion Utilisateurs</p>
            <div class="space-y-2">
                <a href="../users/list.php" class="flex items-center space-x-3 hover:bg-gray-800 p-3 rounded-lg transition">
                    <i class="fas fa-users"></i>
                    <span>Liste utilisateurs</span>
                </a>
                <a href="../users/roles.php" class="flex items-center space-x-3 hover:bg-gray-800 p-3 rounded-lg transition">
                    <i class="fas fa-user-shield"></i>
                    <span>Gestion des rôles</span>
                </a>
                <a href="../users/bans.php" class="flex items-center space-x-3 hover:bg-gray-800 p-3 rounded-lg transition">
                    <i class="fas fa-ban"></i>
                    <span>Bannissements</span>
                </a>
            </div>
        </div>

        
    </nav>

    <div class="absolute bottom-0 left-0 w-full p-6">
        <div class="flex items-center space-x-3 mb-6">
            <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?php echo htmlspecialchars($username) ?>" 
                 class="w-10 h-10 rounded-full bg-gray-800">
            <div>
                <p class="font-medium"><?php echo htmlspecialchars($username) ?></p>
                <p class="text-sm text-gray-400">Administrateur</p>
            </div>
        </div>
        <a href="../profile/profile.php" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/10">
                            <i class="fas fa-user mr-2"></i>Mon Profil
                        </a>
        <a href="../auth/signOut.php" class="flex items-center space-x-3 hover:bg-gray-800 p-3 rounded-lg transition">
            <i class="fas fa-sign-out-alt"></i>
            <span>Déconnexion</span>
        </a>
        
        
    </div>
    <!--  -->
   
            
</aside> 