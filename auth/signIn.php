<?php
require_once "../conn/conn.php" ;   

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST["email"] ?? "" ;
    $password = $_POST["password"] ?? "" ;



    if(empty($email)||empty($password)){
        echo "all fields required !!" ;
    }


    try{
        $sql = "SELECT * FROM users WHERE user_email = :email" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute([
            ":email" => $email 
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC) ;


        if($user && password_verify($password , $user["user_password"])){
            session_start();
            $_SESSION["username"] = $user["name"] ;
            $_SESSION["email"] = $user["email"] ;
            header("Location:../home.php");
            exit ;
        }

    }catch(PDOException $e){
        die("the error is " . $e->getMessage()) ;
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- Add Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Sign In</h2>
        
        <form class="space-y-4"  action = "signIn.php"  method = "POST">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" 
                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" 
                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Forgot password?</a>
            </div>

            <button type="submit" 
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Sign In
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an account? 
            <a href="signUp.php" class="font-medium text-blue-600 hover:text-blue-500">Sign up</a>
        </p>
    </div>
</body>
</html>