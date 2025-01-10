<?php 
require '../classes/game.php';
require '../classes/collection.php';
require '../classes/user.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../auth/signIn.php');
    exit();
}

$username = $_SESSION['username'];
$userid = $_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['favoris'])){
    $gameid=$_POST['game_id'];
   try{
$game= new User();
$game->favorisGame($gameid,$userid);


   }
   catch (Exception $e) {
    error_log("Error  favoris : " . $e->getMessage());
    return false;
}
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault - Ma Bibliothèque</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .game-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(800px circle at var(--mouse-x) var(--mouse-y), 
                rgba(255, 255, 255, 0.06),
                transparent 40%);
            z-index: 3;
        }
     



        .game-grid {
            background: radial-gradient(circle at 50% 50%, 
                rgba(76, 29, 149, 0.1) 0%, 
                rgba(15, 23, 42, 0) 50%);
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }
        #icon {
    color: gold;  
    font-size: 25px;
    cursor: pointer;
    
}
      



    </style>
</head>
<body class="bg-[#151515] min-h-screen text-gray-100">
    <?php include '../components/user_navbar.php'; ?>
    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    

        <div class="game-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-8 rounded-3xl">
            <?php
            $game= new User();

            $games=$game->showFavoris($userid) ;

            foreach ($games as $game): ?>
            <div class="game-card group relative bg-gradient-to-br from-white/[0.075] to-white/[0.035] 
                        rounded-2xl overflow-hidden border border-white/10 transition-all duration-300
                        hover:border-violet-500/30 hover:shadow-lg hover:shadow-violet-500/10">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="<?= htmlspecialchars($game['game_img']) ?>" 
                         alt="<?= htmlspecialchars($game['game_title']) ?>"
                         class="w-full h-full object-cover transform transition duration-500 
                                group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 right-4 flex space-x-2" style="z-index:200;">
                        <form action="" method="POST">
                            <input type="hidden" name="game_id" value="<?= htmlspecialchars($game['game_id']) ?>">
                            <button class="p-2 bg-black/50 rounded-xl backdrop-blur-md hover:bg-violet-500/50 transition duration-300 group" 
                                    name="favoris">
                                <i class="fas fa-star text-yellow-400 group-hover:text-white"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="relative p-6">
                    <h3 class="text-xl font-bold mb-3"><?= htmlspecialchars($game['game_title']) ?></h3>
                    
                    <div class="mb-3">
                        <span class="px-3 py-1 bg-violet-500/20 rounded-full text-violet-300 text-sm">
                            <?= htmlspecialchars($game['genre']) ?>
                        </span>
                    </div>
                    
                    <p class="text-gray-400 text-sm mb-3 line-clamp-2">
                        <?= htmlspecialchars($game['game_description']) ?>
                    </p>
                    
                    <div class="flex items-center text-sm text-gray-400 mb-4">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <?= htmlspecialchars($game['release_date']) ?>
                    </div>
                </div>
            </div>
          
                                        
            
    
            <?php endforeach; ?>
        </div>
    </main>
    
  



   

    <script>




    </script>
</body>
</html> 