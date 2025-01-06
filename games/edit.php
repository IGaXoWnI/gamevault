<?php
session_start();
require_once '../classes/game.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/signIn.php');
    exit();
}

$game = new Game();
$gameId = $_GET['id'] ?? null;
$gameData = null;

if ($gameId) {
    $gameData = $game->getGameById($gameId);
}

if (!$gameData) {
    $_SESSION['error'] = "Game not found";
    header('Location: manage.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $releaseDate = $_POST['release_date'] ?? '';
    
    $avatar = $_POST['game_img'] ?? null;
   
    $result = $game->updateGame($gameId, $title, $description, $genre, $releaseDate, $avatar);
    
    if ($result) {
        $_SESSION['success'] = "Game updated successfully";
        header('Location: manage.php');
        exit();
    } else {
        $_SESSION['error'] = "Failed to update game";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Edit Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include '../components/sidebar.php'; ?>
        
        <main class="flex-1 ml-64 p-8">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold mb-6">Edit Game</h2>
                
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-500 text-white p-3 rounded mb-4">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                
                <form method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Title</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($gameData['game_title']) ?>" 
                               class="w-full bg-gray-700 rounded px-3 py-2 text-gray-100">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Description</label>
                        <textarea name="description" class="w-full bg-gray-700 rounded px-3 py-2 text-gray-100" rows="4"
                        ><?= htmlspecialchars($gameData['game_description']) ?></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Genre</label>
                        <input type="text" name="genre" value="<?= htmlspecialchars($gameData['genre']) ?>" 
                               class="w-full bg-gray-700 rounded px-3 py-2 text-gray-100">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Release Date</label>
                        <input type="date" name="release_date" value="<?= htmlspecialchars($gameData['release_date']) ?>" 
                               class="w-full bg-gray-700 rounded px-3 py-2 text-gray-100">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2">Game Image</label>
                        <input type="text" name="game_img" 
                               class="w-full bg-gray-700 rounded px-3 py-2 text-gray-100">
                        <?php if ($gameData['game_img']): ?>
                            <img src="<?= htmlspecialchars($gameData['game_img']) ?>" 
                                 alt="Current game image" class="mt-2 w-32 h-32 object-cover rounded">
                        <?php endif; ?>
                    </div>
                    
                    <div class="flex justify-end gap-4">
                        <a href="manage.php" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded">Update Game</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html> 