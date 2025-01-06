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

//  function addToLibray($game_id,$user_id){
//    $stmt=$this->pdo->query(" SELECT * FROM library ");
//    $results = $stmt->fetchAll();
// if (count($results) > 0) {
//     echo "Des résultats ont été trouvés.";
// } else {
//     echo "Aucun résultat trouvé."; $games="INSERT INTO library (game_id,user_id) VALUES (:game_id,:user_id)";
//     $addToLibrary=$this->pdo->prepare($games);
//      return $addToLibrary->execute(
// [':game_id'=>$game_id,
// ':user_id'=>$user_id

// ]
//     );

//  }
// }

public function addToLibrary($game_id, $user_id) {
  
   $stmt = $this->pdo->prepare("SELECT * FROM library WHERE game_id = :game_id AND user_id = :user_id");
   $stmt->execute([':game_id' => $game_id, ':user_id' => $user_id]);

  
   if ($stmt->rowCount() > 0) {
      
       return false; 
   } else {
      
       $games = "INSERT INTO library (game_id, user_id) VALUES (:game_id, :user_id)";
       $addToLibrary = $this->pdo->prepare($games);
       return $result = $addToLibrary->execute([
           ':game_id' => $game_id,
           ':user_id' => $user_id
       ]);

      
   }
}

    }


 

   
  




























?>