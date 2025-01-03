<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/signIn.php');
    exit();
}
$username = $_SESSION['username'];
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
    </style>
</head>
<body class="bg-[#151515] min-h-screen text-gray-100">
    <?php include '../components/user_navbar.php'; ?>
    
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="relative overflow-hidden rounded-3xl mb-12 bg-gradient-to-br from-violet-900/20 to-indigo-900/20 border border-white/5">
            <div class="absolute inset-0 bg-[url('/assets/grid.svg')] opacity-10"></div>
            <div class="relative p-8 md:p-12">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex-1">
                        <h1 class="text-4xl font-bold mb-4">
                            <span class="bg-gradient-to-r from-violet-400 to-indigo-400 bg-clip-text text-transparent">
                                Bienvenue dans votre univers gaming
                            </span>
                        </h1>
                        <p class="text-gray-400 mb-6 max-w-2xl">
                            Explorez votre collection, suivez vos progrès et découvrez de nouvelles aventures.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <div class="bg-white/5 rounded-2xl p-4 backdrop-blur-sm">
                                <div class="text-2xl font-bold text-violet-400 mb-1">24</div>
                                <div class="text-sm text-gray-400">Jeux</div>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 backdrop-blur-sm">
                                <div class="text-2xl font-bold text-indigo-400 mb-1">3</div>
                                <div class="text-sm text-gray-400">En cours</div>
                            </div>
                            <div class="bg-white/5 rounded-2xl p-4 backdrop-blur-sm">
                                <div class="text-2xl font-bold text-fuchsia-400 mb-1">14</div>
                                <div class="text-sm text-gray-400">Terminés</div>
                            </div>
                        </div>
                    </div>
                    <div class="floating">
                        <img src="https://image.api.playstation.com/vulcan/ap/rnd/202306/1219/60eca3ac155247e21850c7d075d01ebf0f3f5dbf19ccd2a1.jpg" 
                             alt="Spider-Man 2" 
                             class="w-64 h-64 object-contain rounded-xl">
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Bar -->
        <div class="flex flex-col md:flex-row gap-6 items-center mb-12">
            <button class="bg-gradient-to-r from-violet-600 to-indigo-600 px-6 py-3 rounded-2xl
                         hover:from-violet-700 hover:to-indigo-700 transition duration-300 transform hover:scale-105
                         flex items-center space-x-3 shadow-lg shadow-violet-600/20">
                <i class="fas fa-plus"></i>
                <span>Ajouter un jeu</span>
            </button>
            <div class="flex-1 flex flex-wrap gap-4">
                <div class="relative flex-1 min-w-[240px]">
                    <input type="text" 
                           placeholder="Rechercher un jeu..." 
                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-3 pl-12
                                  focus:outline-none focus:border-violet-500/50 transition duration-300">
                    <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
                </div>
                <select class="bg-white/5 border border-white/10 rounded-2xl px-5 py-3 min-w-[180px]
                             focus:outline-none focus:border-violet-500/50 appearance-none cursor-pointer
                             transition duration-300">
                    <option value="">Filtrer par statut</option>
                    <option value="playing">En cours</option>
                    <option value="completed">Terminé</option>
                    <option value="dropped">Abandonné</option>
                </select>
            </div>
        </div>

        <div class="game-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-8 rounded-3xl">
            <?php
            $games = [
                [
                    'id' => 1,
                    'title' => 'The Witcher 3',
                    'image' => 'https://i1.sndcdn.com/artworks-Mnckgkyr334C1360-ZmjZQg-t500x500.jpg',
                    'status' => 'playing',
                    'playtime' => '45h',
                    'rating' => 5
                ],
            ];

            foreach ($games as $game): ?>
            <div class="game-card group relative bg-gradient-to-br from-white/[0.075] to-white/[0.035] 
                        rounded-2xl overflow-hidden border border-white/10 transition-all duration-300
                        hover:border-violet-500/30 hover:shadow-lg hover:shadow-violet-500/10">
                <div class="aspect-[4/3] overflow-hidden">
                    <img src="<?= htmlspecialchars($game['image']) ?>" 
                         alt="<?= htmlspecialchars($game['title']) ?>"
                         class="w-full h-full object-cover transform transition duration-500 
                                group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 right-4 flex space-x-2">
                        <button class="p-2 bg-black/50 rounded-xl backdrop-blur-md 
                                     hover:bg-violet-500/50 transition duration-300 group">
                            <i class="fas fa-star text-yellow-400 group-hover:text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="relative p-6">
                    <h3 class="text-xl font-bold mb-3"><?= htmlspecialchars($game['title']) ?></h3>
                    <div class="flex items-center justify-between text-sm text-gray-400 mb-4">
                        <span class="flex items-center space-x-2">
                            <i class="fas fa-clock"></i>
                            <span><?= htmlspecialchars($game['playtime']) ?></span>
                        </span>
                        <div class="flex items-center">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star text-xs <?= $i <= $game['rating'] ? 'text-yellow-400' : 'text-gray-600' ?>"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="px-4 py-1.5 rounded-xl text-sm font-medium
                            <?= $game['status'] === 'playing' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/20' : 
                                ($game['status'] === 'completed' ? 'bg-green-500/20 text-green-400 border border-green-500/20' : 
                                 'bg-red-500/20 text-red-400 border border-red-500/20') ?>">
                            <?= ucfirst($game['status']) ?>
                        </span>
                        <div class="flex space-x-1">
                            <button class="p-2 hover:text-violet-400 transition-colors duration-300">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 hover:text-red-400 transition-colors duration-300">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.game-card');
        
        cards.forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        });
    });
    </script>
</body>
</html> 