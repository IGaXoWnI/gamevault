<?php
include '../classes/game.php';


$username = $_SESSION['username'] ?? '';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/signIn.php');
    exit();
}





 if(isset($_POST['ajoute'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $genre=$_POST['genre'];
    $releaseDate=$_POST['release_date'];
    $avatar=$_POST['game_image'];
      
    if(!empty($title) &&!empty($description)
    &&!empty($genre)&& !empty($releaseDate)&&!empty($avatar) ){
        $game=new Game();
        $game->addGame($title,$description,$genre,$avatar,$releaseDate);

}}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Ajouter un jeu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen text-gray-100">
    <div class="flex">
        <?php include '../components/sidebar.php'; ?>
        
        <main class="flex-1 ml-64 p-8">
            <div class="max-w-4xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold">Ajouter un jeu</h2>
                        <p class="text-gray-400">Créer une nouvelle fiche de jeu</p>
                    </div>
                </div>

                <form action="add.php" method="POST" class="bg-gray-800 p-6 rounded-lg">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium mb-2">Titre du jeu</label>
                            <input type="text" name="title" required class="w-full bg-gray-700 rounded-lg p-3 text-white">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium mb-2">Description</label>
                            <textarea name="description" rows="4" class="w-full bg-gray-700 rounded-lg p-3 text-white"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Genre</label>
                            <input type="text" name="genre" required class="w-full bg-gray-700 rounded-lg p-3 text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Date de sortie</label>
                            <input type="date" name="release_date" class="w-full bg-gray-700 rounded-lg p-3 text-white">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium mb-2">Image URL</label>
                            <input type="url" name="game_image" class="w-full bg-gray-700 rounded-lg p-3 text-white">
                        </div>

                        <div class="col-span-2">
                            <button type="submit"  name="ajoute"class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                                Ajouter le jeu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html> 