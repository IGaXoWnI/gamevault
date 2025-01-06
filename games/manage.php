<?php
include '../classes/game.php';

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
    <title>GameVault - Gérer les jeux</title>
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
                        <h2 class="text-2xl font-bold">Gérer les jeux</h2>
                        <p class="text-gray-400">Liste et modification des jeux</p>
                    </div>
                    <a href="add.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>Ajouter un jeu
                    </a>
                </div>

                <div class="bg-gray-800 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left">Image</th>
                                <th class="px-6 py-3 text-left">Titre</th>
                                <th class="px-6 py-3 text-left">Genre</th>
                                <th class="px-6 py-3 text-left">description</th>
                                <th class="px-6 py-3 text-left">date de sortie </th>
                                <th class="px-6 py-3 text-left">added at  </th>
                                <th class="px-6 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php
                          $game=new Game();
                          $games=$game->showgames();
                      
                            foreach ($games as $game): ?>
                            <?php   $game_id=$_SESSION['game_id']=$game['game_id'];
                            ?>
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4">
                                        <img src="placeholder.jpg" alt="<?= htmlspecialchars($game['game_img']) ?>" class="w-16 h-16 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($game['game_title']) ?></td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($game['genre']) ?></td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($game['game_description'])?></td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($game['release_date'] )?></td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($game['added_at'] )?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                        <button class="text-blue-400 hover:text-blue-300">
                                        <a href="../games/update.php?update=<?php echo $game_id ?>"><i class="fas fa-edit"></i></a>
 

</button>

                                            <button class="text-red-400 hover:text-red-300">
                                               <a href="../games/delette.php?deleted=<?php echo $game_id ?>"><i class="fas fa-trash"></i></a>  
                                            </button>
                                          
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                     
                       
                        
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body> 