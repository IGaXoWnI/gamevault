<?php 
require_once 'database.php';
 class library{
    private $library_id;
    private $status;
    private $game_id;
    private $user_id;
    private $is_favoris;
    private $play_time;
    private  $pdo;
    public function __construct() {
      
        $this->pdo = (new Database())->getConnection();
    }

 function addToLibray($game_id,$user_id){
    $games="INSERT INTO library (game_id,user_id) VALUES (:game_id,:user_id)";
    $addToLibrary=$this->pdo->prepare($games);
     return $addToLibrary->execute(
[':game_id'=>$game_id,
':user_id'=>$user_id

]
    );

 }

    }


 






























?>