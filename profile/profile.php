<?php

require '../classes/game.php';
require '../classes/collection.php';
require '../classes/user.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/signIn.php');
    exit();
}

$username = $_SESSION['username'];
echo" session is".$username;
$userid = $_SESSION['user_id'];
echo $userid;
// echo $_SESSION['username'];


$user1= new User();
$user=$user1->showuserid($userid) ;
//print_r($user);
foreach($user as $test){
    $name=$test['username'];
    $id=$test['user_id'];
    $user_email=$test['user_email'];
    $user_password=$test['user_password'];
   
   
}
if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['name']) && !empty($_POST['updatename'])) {
    echo" hello";
    $usernam=$_POST['updatename'];
    echo $usernam;
    $id=$_POST['userid'];
    $user1= new User();
$user=$user1-> updateName($usernam, $id);
}
if($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['email'])&& !empty($_POST['updatemail'])) {
   try{
    echo" hello";
    $useremail=$_POST['updatemail'];
    $id=$_POST['id_user'];
    $user1= new User();
 echo $user1-> updateemail($useremail, $id);
   }  
    catch (Exception $e) {
          
    error_log("Error   " . $e->getMessage());
    return false;
}



}

 $error="";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submity'])) {
    echo "nice";
    $user2 = new User();
 
    $userid = $_POST['id_us'];  
    $passEnter = $_POST['pass_actuel'];
    echo $passEnter;
 
    if ($user2->verifiecode($userid, $passEnter)) {
       
    $pass=$_POST['new_pass'];
    echo $pass;
    if(!empty($pass)){
        $user= new User();
        $user->updatepass($pass,$userid);
        
    }
    
    } else {
        
        $error="password in correct";
    }
}







?>



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
            <?php echo $name?>
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
                                <p class="text-lg"><?php  echo htmlspecialchars($name)?></p>
                            </div>
                            <button onclick="toggleEdit('username')" 
                                    class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 px-4 py-2 rounded-lg border border-indigo-500/30 transition-all duration-200">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-black/20 rounded-lg">
                            <div>
                                <p class="text-sm text-gray-400">Email</p>
                                <p class="text-lg"><?php echo htmlspecialchars($user_email) ?></p>
                            </div>
                            <button onclick="toggleEdit('email')" 
                                    class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 px-4 py-2 rounded-lg border border-indigo-500/30 transition-all duration-200">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-black/20 rounded-lg">
                            <div>
                                <p class="text-sm text-gray-400">Mot de passe</p>
                                <p class="text-lg">...........</p>
                            </div>
                            <button onclick="toggleEdit('password')" 
                                    class="bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-400 px-4 py-2 rounded-lg border border-indigo-500/30 transition-all duration-200">
                                <i class="fas fa-edit"></i> Modifier
                            </button>
                        </div>
                    </div>
                </div>

                <div id="username-form" class="hidden border-t border-white/10 p-6 bg-black/20">
                    <form class="space-y-4" method="POST">
                        <input type="text" value="<?php echo htmlspecialchars($name) ?>"  name="updatename"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                               <input type="hidden" value="<?php echo htmlspecialchars($id) ?>"  name="userid"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors" name="name" >
                            Sauvegarder
                        </button>
                    </form>
                </div>

                <div id="email-form" class="hidden border-t border-white/10 p-6 bg-black/20">
                    <form class="space-y-4" method="POST">
                        <input type="email" value="<?php echo htmlspecialchars($user_email) ?>" name="updatemail"  
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                       
                               <input type="hidden" value="<?php echo htmlspecialchars($id) ?>"  name="id_user"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors" name="email">
                            Sauvegarder
                        </button>
                    </form>
                </div>

                <div id="password-form" class="hidden border-t border-white/10 p-6 bg-black/20">
                    <form class="space-y-4" method="POST">
                        <input type="password" placeholder="Mot de passe actuel" name="pass_actuel"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                               <div> <?php echo $error?></div>
                        <input type="password" placeholder="Nouveau mot de passe" name="new_pass"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500"> 
                                
                               <input type="hidden" value="<?php echo htmlspecialchars($id) ?>"  name="id_us"
                               class="w-full bg-gray-800/50 border border-white/10 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors" name="submity">
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