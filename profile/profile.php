<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <?php include '../components/user_navbar.php'; ?>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="mb-12 text-center">
            <div class="relative inline-block">
                <img src="https://api.dicebear.com/6.x/initials/svg?seed=JohnDoe" 
                     class="w-32 h-32 rounded-full border-4 border-indigo-500/30 mb-4">
                <span class="absolute bottom-4 right-0 bg-green-500 w-5 h-5 rounded-full border-4 border-gray-900"></span>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-violet-400 to-indigo-400 bg-clip-text text-transparent">
                JohnDoe123
            </h1>
            <p class="text-gray-400 mt-2">Membre depuis Janvier 2024</p>
        </div>

        <div class="grid grid-cols-3 gap-6 mb-12">
            <div class="bg-gray-800/50 backdrop-blur-xl p-6 rounded-xl border border-white/10">
                <div class="text-3xl font-bold text-indigo-400 mb-1">42</div>
                <div class="text-gray-400">Jeux</div>
            </div>
            <div class="bg-gray-800/50 backdrop-blur-xl p-6 rounded-xl border border-white/10">
                <div class="text-3xl font-bold text-indigo-400 mb-1">15</div>
                <div class="text-gray-400">Favoris</div>
            </div>
            <div class="bg-gray-800/50 backdrop-blur-xl p-6 rounded-xl border border-white/10">
                <div class="text-3xl font-bold text-indigo-400 mb-1">120h</div>
                <div class="text-gray-400">Temps de jeu</div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-gray-800/50 backdrop-blur-xl rounded-xl border border-white/10 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold">Informations du compte</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-center justify-between p-4 bg-black/20 rounded-lg">
                            <div>
                                <p class="text-sm text-gray-400">Nom d'utilisateur</p>
                                <p class="text-lg">JohnDoe123</p>
                            </div>
                            <button onclick="toggleEdit('username')" 
                                    class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 px-4 py-2 rounded-lg border border-indigo-500/30 transition-all duration-200">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-black/20 rounded-lg">
                            <div>
                                <p class="text-sm text-gray-400">Email</p>
                                <p class="text-lg">john.doe@example.com</p>
                            </div>
                            <button onclick="toggleEdit('email')" 
                                    class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 px-4 py-2 rounded-lg border border-indigo-500/30 transition-all duration-200">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-black/20 rounded-lg">
                            <div>
                                <p class="text-sm text-gray-400">Mot de passe</p>
                                <p class="text-lg">••••••••</p>
                            </div>
                            <button onclick="toggleEdit('password')" 
                                    class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 px-4 py-2 rounded-lg border border-indigo-500/30 transition-all duration-200">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                        </div>
                    </div>
                </div>

                <div id="username-form" class="hidden border-t border-white/10 p-6 bg-black/20">
                    <form class="space-y-4">
                        <input type="text" value="JohnDoe123"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <input type="password" placeholder="Mot de passe actuel"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Sauvegarder
                        </button>
                    </form>
                </div>

                <div id="email-form" class="hidden border-t border-white/10 p-6 bg-black/20">
                    <form class="space-y-4">
                        <input type="email" value="john.doe@example.com"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <input type="password" placeholder="Mot de passe actuel"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Sauvegarder
                        </button>
                    </form>
                </div>

                <div id="password-form" class="hidden border-t border-white/10 p-6 bg-black/20">
                    <form class="space-y-4">
                        <input type="password" placeholder="Mot de passe actuel"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <input type="password" placeholder="Nouveau mot de passe"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                            Sauvegarder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(field) {
            const forms = ['username-form', 'email-form', 'password-form'];
            forms.forEach(form => {
                document.getElementById(form).classList.add('hidden');
            });
            document.getElementById(`${field}-form`).classList.toggle('hidden');
        }
    </script>
</body>
</html> 