<?php
require_once "conn/conn.php";

session_start() ;

$username = $_SESSION["username"] ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>welcome back <?php echo $username ?></h1>
    <a href="auth/signOut.php">sign out</a>
</body>
</html>