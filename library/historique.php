<?php
require '../classes/game.php';
require '../classes/history.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../auth/signIn.php');
    exit();
}

$username = $_SESSION['username'];
$userid = $_SESSION['user_id'];

$history = new History();
$userHistory = $history->getUserHistory($userid);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Historique</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#151515] min-h-screen text-gray-100">
    <?php include '../components/user_navbar.php'; ?>
    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-violet-400 to-indigo-400 bg-clip-text text-transparent">
                Historique
            </h1>
        </div>

        <div class="space-y-4">
            <?php foreach ($userHistory as $item): ?>
                <div class="bg-white/5 rounded-xl p-4 border border-white/10 hover:border-violet-500/30 transition duration-300">
                    <div class="flex items-center space-x-4">
                        <img src="<?= htmlspecialchars($item['game_img']) ?>" 
                             alt="<?= htmlspecialchars($item['game_title']) ?>"
                             class="w-16 h-16 rounded-lg object-cover">
                        
                        <div class="flex-1">
                            <h3 class="font-semibold"><?= htmlspecialchars($item['game_title']) ?></h3>
                            <div class="flex items-center space-x-2 text-sm text-gray-400">
                                <span class="px-2 py-1 rounded-full text-xs
                                    <?= $item['action'] === 'added' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' ?>">
                                    <?= $item['action'] === 'added' ? 'Ajouté à la collection' : 'Retiré de la collection' ?>
                                </span>
                                <span class="text-gray-500">•</span>
                                <span><?= date('d/m/Y H:i', strtotime($item['action_date'])) ?></span>
                            </div>
                        </div>
                        
                       
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html> 