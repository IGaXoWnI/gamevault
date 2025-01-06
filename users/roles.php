<?php
include '../classes/admin.php';
session_start();
$username = $_SESSION['username'] ?? '';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/signIn.php');
    exit();
}
if(isset($_POST['modifier'])){
     $admin=new admin();
     echo $admin->gestionRoles($_POST['user_id'],$_POST['role']);
    
   
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Gestion des rôles</title>
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
                        <h2 class="text-2xl font-bold">Gestion des rôles</h2>
                        <p class="text-gray-400">Attribution et modification des rôles</p>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left">Utilisateur</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Rôle actuel</th>
                                <th class="px-6 py-3 text-left">Modifier rôle</th>
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
                                    <span class="px-2 py-1 rounded-full text-xs <?= $user['role'] === 'admin' ? 'bg-blue-500' : 'bg-gray-600' ?>">
                                        <?= htmlspecialchars($user['role']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="../users/roles.php" method="POST" class="flex items-center space-x-2">
                             
                                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                                        <select name="role" class="bg-gray-700 rounded px-3 py-1 text-sm">
                                            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                        <button type="submit" name="modifier" class="bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded text-sm">
                                            Modifier
                                        </button>
                                    </form>
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