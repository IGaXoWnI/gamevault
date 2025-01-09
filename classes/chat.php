<?php
class Chat {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=gamevault", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function saveMessage($userId, $gameId, $message) {
        try {
            $stmt = $this->db->prepare("INSERT INTO chat_messages (user_id, game_id, message) VALUES (?, ?, ?)");
            return $stmt->execute([$userId, $gameId, $message]);
        } catch (PDOException $e) {
            error_log("Save message error: " . $e->getMessage());
            return false;
        }
    }

    public function getMessages($gameId, $limit = 50) {
        try {
            // Convert gameId to integer to ensure proper comparison
            $gameId = (int)$gameId;
            
            // Simple query without JOIN first to debug
            $stmt = $this->db->prepare("
                SELECT * FROM chat_messages WHERE game_id = ?
            ");
            
            $stmt->execute([$gameId]);
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // If we have messages, get the usernames
            if (!empty($messages)) {
                $result = [];
                foreach ($messages as $message) {
                    $userStmt = $this->db->prepare("
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