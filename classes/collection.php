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




public function addToLibrary($game_id, $user_id, $play_time, $status) {
    $stmt = $this->pdo->prepare("SELECT * FROM library WHERE game_id = :game_id AND user_id = :user_id");
    $stmt->execute([':game_id' => $game_id, ':user_id' => $user_id]);

    if ($stmt->rowCount() > 0) {
        return false; 
    } else {
        try {
            $games = "INSERT INTO library (game_id, user_id, play_time, status) 
                      VALUES (:game_id, :user_id, :play_time, :status)";
            $addToLibrary = $this->pdo->prepare($games);

            $result = $addToLibrary->execute([
                ':game_id' => $game_id,
                ':user_id' => $user_id,
                ':play_time' => $play_time,
                ':status' => $status
            ]);

            if ($result) {
                require_once 'history.php';
                $history = new History();
                $history->addToHistory($game_id, $user_id, 'added');
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Error in addToLibrary: " . $e->getMessage());
            return false;
        }
    }
}


public function showInlibrary() {
    $userid = $_SESSION['user_id'];
    $game = "SELECT games.game_img, games.game_title, games.genre, 
                    games.game_description, games.release_date, games.added_at, 
                    users.user_id, games.game_id, library.play_time, library.status 
             FROM library 
             JOIN games ON games.game_id = library.game_id  
             JOIN users ON users.user_id = library.user_id 
             WHERE users.user_id = :user_id";
    
    $showgames = $this->pdo->prepare($game);
    $result = $showgames->execute([':user_id' => $userid]);
    
    if ($result) {
        return $showgames->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Erreur d'exécution de la requête SQL.";
        return [];
    }
}
public function removeFromLibrary($gameid){
    try {
        $game = "DELETE FROM library WHERE game_id=:game_id";
        $deletegames = $this->pdo->prepare($game);
        $result = $deletegames->execute(['game_id' => $gameid]);
        
        if ($result) {
            require_once 'history.php';
            $history = new History();
            $history->addToHistory($gameid, $_SESSION['user_id'], 'removed');
        }
        
        return $result;
    }
    catch (Exception $e) {
        error_log("Error : " . $e->getMessage());
        return false;
    }
}
}


 

   
  




























?>