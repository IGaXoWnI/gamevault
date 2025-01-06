<?php
include '../classes/game.php';
echo" hello";

$games=new Game();
 echo $games->removegames();
 header('location:../games/manage.php');

?>
