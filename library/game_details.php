<?php
require '../classes/game.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/signIn.php');
    exit();
}

$game = new Game();
$gameId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$gameId) {
    header('Location: index.php');
    exit();
}

$gameDetails = $game->getGameById($gameId);
$averageRating = $game->getGameRating($gameId);
$gameReviews = $game->getGameReviews($gameId);

if (!$gameDetails) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['submit_review'])) {
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : null;
    $review = isset($_POST['review']) ? trim($_POST['review']) : null;
    
    if ($rating && $rating >= 1 && $rating <= 5) {
        if ($game->setGameRating($gameId, $_SESSION['user_id'], $rating, $review)) {
            header("Location: game_details.php?id=" . $gameId);
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($gameDetails['game_title']) ?> - GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#151515] min-h-screen text-gray-100">
    <?php include '../components/user_navbar.php'; ?>

    <main class="max-w-6xl mx-auto px-4 py-8">
        <a href="index.php" class="inline-flex items-center text-violet-400 hover:text-violet-300 mb-8">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour
        </a>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="rounded-2xl overflow-hidden max-w-md mx-auto">
                <img src="<?= htmlspecialchars($gameDetails['game_img']) ?>" 
                     alt="<?= htmlspecialchars($gameDetails['game_title']) ?>"
                     class="w-full h-[400px] object-cover">
            </div>

            <div class="space-y-6">
                <div class="space-y-4">
                    <h1 class="text-4xl font-bold">
                        <?= htmlspecialchars($gameDetails['game_title']) ?>
                    </h1>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex items-center bg-white/5 px-4 py-2 rounded-lg">
                            <div class="flex items-center gap-1 text-yellow-400">
                                <i class="fas fa-star"></i>
                                <span class="text-xl font-bold">
                                    <?= number_format($averageRating, 1) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-2 rounded-lg bg-violet-500/20 text-violet-300">
                        <?= htmlspecialchars($gameDetails['genre']) ?>
                    </span>
                    <span class="px-4 py-2 rounded-lg bg-white/5 text-gray-300">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <?= htmlspecialchars($gameDetails['release_date']) ?>
                    </span>
                </div>

                <div class="bg-white/5 rounded-2xl p-6">
                    <p class="text-gray-300 leading-relaxed">
                        <?= nl2br(htmlspecialchars($gameDetails['game_description'])) ?>
                    </p>
                </div>

                <form action="" method="POST" class="mt-6">
                    <input type="hidden" name="game_id" value="<?= htmlspecialchars($gameDetails['game_id']) ?>">
                    <button type="submit" name="add" 
                            class="w-full bg-violet-600 hover:bg-violet-700 text-white py-4 px-6 rounded-xl
                                   transition duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i>
                        Ajouter à ma collection
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-8">Avis et Notes</h2>

            <form action="" method="POST" class="bg-white/5 rounded-2xl p-6 mb-8">
                <div class="space-y-4">
                    <div class="star-rating flex gap-1">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star cursor-pointer text-2xl text-gray-400 hover:text-yellow-400" onclick="rate(<?= $i ?>)"></i>
                        <?php endfor; ?>
                        <input type="hidden" name="rating" id="rating-value">
                    </div>

                    <div>
                        <label for="review" class="block text-sm font-medium mb-2">Votre avis</label>
                        <textarea id="review" name="review" rows="4" 
                                class="w-full bg-white/5 rounded-lg p-3 text-gray-100 focus:ring-2 focus:ring-violet-500 
                                       focus:outline-none resize-none"
                                placeholder="Partagez votre expérience avec ce jeu..."></textarea>
                    </div>

                    <button type="submit" name="submit_review" 
                            class="bg-violet-600 hover:bg-violet-700 text-white py-2 px-4 rounded-lg
                                   transition duration-300">
                        Publier l'avis
                    </button>
                </div>
            </form>

            <div class="space-y-6">
                <?php if (empty($gameReviews)): ?>
                    <p class="text-gray-400 text-center py-4">Aucun avis pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($gameReviews as $review): ?>
                        <div class="bg-white/5 rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <span class="font-medium"><?= htmlspecialchars($review['username']) ?></span>
                                    <span class="text-gray-400 text-sm">
                                        <?= date('d/m/Y', strtotime($review['created_at'])) ?>
                                    </span>
                                </div>
                                <div class="flex text-yellow-400">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?= $i <= $review['rating'] ? 'text-yellow-400' : 'text-gray-400' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <?php if (!empty($review['review'])): ?>
                                <p class="text-gray-300">
                                    <?= nl2br(htmlspecialchars($review['review'])) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script>
    function rate(rating) {
        const stars = document.querySelectorAll('.star-rating .fa-star');
        document.getElementById('rating-value').value = rating;
        
        stars.forEach((star, index) => {
            star.classList.toggle('text-yellow-400', index < rating);
        });
    }
    </script>
</body>
</html> 