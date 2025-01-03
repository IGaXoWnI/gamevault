<?php
session_start();
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
                                <th class="px-6 py-4 text-left text-sm font-medium text-gray-300">Status</th>
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
                                <td class="px-6 py-4">1,234</td>
                                <td class="px-6 py-4 text-gray-400">Il y a 5 minutes</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-green-900 text-green-300 rounded-full text-xs">Normal</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-gamepad text-green-400"></i>
                                        <span>Jeux en Base</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">456</td>
                                <td class="px-6 py-4 text-gray-400">Il y a 1 heure</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-green-900 text-green-300 rounded-full text-xs">Normal</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-ban text-red-400"></i>
                                        <span>Utilisateurs Bannis</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">23</td>
                                <td class="px-6 py-4 text-gray-400">Il y a 30 minutes</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-red-900 text-red-300 rounded-full text-xs">Attention</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-flag text-yellow-400"></i>
                                        <span>Signalements en Attente</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">15</td>
                                <td class="px-6 py-4 text-gray-400">Il y a 10 minutes</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-yellow-900 text-yellow-300 rounded-full text-xs">À traiter</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>