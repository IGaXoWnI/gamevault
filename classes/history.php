<?php
require_once 'database.php';

class History {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function addToHistory($gameId, $userId, $action) {
        try {
            $sql = "INSERT INTO history (game_id, user_id, action, action_date) 
                    VALUES (:game_id, :user_id, :action, NOW())";
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':game_id' => $gameId,
                ':user_id' => $userId,
                ':action' => $action
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function getUserHistory($userId) {
        try {
            $sql = "SELECT h.*, g.game_title, g.game_img, g.genre 
                    FROM history h 
                    JOIN games g ON h.game_id = g.game_id 
                    WHERE h.user_id = :user_id 
                    ORDER BY h.action_date DESC";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}
?> 