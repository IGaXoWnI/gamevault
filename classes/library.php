<?php

class Library {
    public function addToLibrary($game_id, $user_id, $play_time, $status) {
        try {
            $db = Database::getInstance();
            
            $stmt = $db->prepare("INSERT INTO library (game_id, user_id, play_time, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$game_id, $user_id, $play_time, $status]);
            
            $stmt = $db->prepare("INSERT INTO history (user_id, game_id, action_type, action_date) VALUES (?, ?, 'added', NOW())");
            $stmt->execute([$user_id, $game_id]);
            
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error adding game to library: " . $e->getMessage());
        }
    }

¡    public function getUserHistory($user_id) {
        try {
            $db = Database::getInstance();
            $stmt = $db->prepare("
                SELECT h.*, g.game_title, g.game_img, g.genre
                FROM history h
                JOIN games g ON h.game_id = g.game_id
                WHERE h.user_id = ?
                ORDER BY h.action_date DESC
            ");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching history: " . $e->getMessage());
        }
    }
} 