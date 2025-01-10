<?php
require_once 'database.php';

class Chat {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->getConnection();
    }

    public function saveMessage($userId, $gameId, $message) {
        try {
            $checkUserStatus = $this->pdo->prepare("SELECT status FROM users WHERE user_id = ?");
            $checkUserStatus->execute([$userId]);
            $userStatus = $checkUserStatus->fetch();
            
            if ($userStatus['status'] === "actif") {
                $stmt = $this->pdo->prepare("INSERT INTO chat_messages (user_id, game_id, message) VALUES (?, ?, ?)");
                return $stmt->execute([$userId, $gameId, $message]);
            } else {
                return "You are banned and do not have access to comment or chat on this page.";
            }
        } catch (PDOException $e) {
            error_log("Save message error: " . $e->getMessage());
            return false;
        }
    }

    public function getMessages($gameId, $limit = 50) {
        try {
            $gameId = (int)$gameId;
            
            $stmt = $this->pdo->prepare("
                SELECT * FROM chat_messages WHERE game_id = ?
            ");
            
            $stmt->execute([$gameId]);
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($messages)) {
                $result = [];
                foreach ($messages as $message) {
                    $userStmt = $this->pdo->prepare("
                        SELECT username FROM users WHERE user_id = ?
                    ");
                    $userStmt->execute([$message['user_id']]);
                    $username = $userStmt->fetchColumn();
                    
                    $result[] = array_merge($message, ['username' => $username]);
                }
                return $result;
            }
            
            return [];
        } catch (PDOException $e) {
            error_log("Get messages error: " . $e->getMessage());
            return [];
        }
    }
} 