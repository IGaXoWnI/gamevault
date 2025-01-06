<?php
include '../classes/admin.php';
session_start();
$username = $_SESSION['username'] ?? '';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/signIn.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Liste des utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include '../components/sidebar.php'; ?>
        
        <main class="flex-1 ml-64 p-8">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold">Liste des utilisateurs</h2>
                        <p class="text-gray-400">Gestion des comptes utilisateurs</p>
                    </div>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un utilisateur..." 
                                   class="bg-gray-800 rounded-lg px-4 py-2 pl-10 w-64">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left">Utilisateur</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Rôle</th>
                               
                                <th class="px-6 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php
                            $user=new admin();
                            $users=$user-> showusers();

                            foreach ($users as $user): ?>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?= htmlspecialchars($user['username']) ?>" 
                                         class="w-8 h-8 rounded-full">
                                    <span><?= htmlspecialchars($user['username']) ?></span>
                                </td>
                                <td class="px-6 py-4"><?= htmlspecialchars($user['user_email']) ?></td>
                                <td class="px-6 py-4">
          <span class="px-2 py-1 rounded-full text-xs <?= $user['role'] === 'Admin' ? 'bg-blue-500' : 'bg-gray-600'  ?>">
                       <?= htmlspecialchars($user['role']) ?>
                          </span>
                   </td>

                               
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <button class="text-blue-400 hover:text-blue-300">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-yellow-400 hover:text-yellow-300">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-red-400 hover:text-red-300">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body> 