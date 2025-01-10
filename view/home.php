<?php
session_start();
include '../classes/admin.php';
$admin=new admin();


$actif=$admin->countAtifs();
$ban=$admin->countBan();
$games=$admin->countGames();
$max=$admin->dernierGame();
$last_signup=$admin->dernierinscrep();
$last_date_ban=$admin-> dernierBan();







$username = $_SESSION['username'];
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
    <title>GameVault - Administration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include '../components/sidebar.php'; ?>

        <main class="ml-64 flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold">Panneau d'Administration</h2>
                    <p class="text-gray-400">Vue d'ensemble des données</p>
                </div>
            </div>

            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <h3 class="text-lg font-bold">Statistiques Globales</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-900">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Catégorie</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Total</th>
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Dernière mise à jour</th>
                               
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-users text-blue-400"></i>
                                        <span>Utilisateurs Actifs</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4"><?php echo ($actif) ?></td>
                                <td class="px-6 py-4 text-gray-400"><?php  echo $last_signup;?></td>
                               
                            </tr>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-gamepad text-green-400"></i>
                                        <span>Jeux en Base</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4"> <?php echo $games?></td>
                                <td class="px-6 py-4 text-gray-400"><?php echo $max;?></td>
                                
                            </tr>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-ban text-red-400"></i>
                                        <span>Utilisateurs Bannis</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4"><?php echo $ban?></td>
                                <td class="px-6 py-4 text-gray-400"><?php echo $last_date_ban;?></td>
                                >
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>