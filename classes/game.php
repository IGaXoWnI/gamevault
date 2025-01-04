<?php
require_once 'database.php';

session_start() ;

class Game {
    private $title;
    private $releaseDate;
    private $genre;
    private $description;
    private $avatar;
    private $pdo;
    public function __construct() {

        $this->pdo = (new Database())->getConnection();
    }

    public function getTitle() {
        return $this->title;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function addGame($title, $description, $genre, $avatar, $releaseDate) {
        $games = "INSERT INTO games (game_title, game_description, genre, release_date, game_img,user_id) 
                  VALUES (:title, :description, :genre, :date_sortie, :avatar,:user_id)";
        
        $games_run = $this->pdo->prepare($games);

        $execute_games = $games_run->execute([
            ':title' => $title,
            ':description' => $description,
            ':genre' => $genre,
            ':date_sortie' => $releaseDate,
            ':avatar' => $avatar,
            ':user_id' => $_SESSION['user_id']
        ]);

       
    }
}
?>
