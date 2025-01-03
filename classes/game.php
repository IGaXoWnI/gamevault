<?php
class Game{
    private $title ;
    private $releaseDate ;
    private $genre ;
    private $description; 



    public function __construct($title, $releaseDate , $genre , $description){
        $this->title = $title ;
        $this->releaseDate = $releaseDate ;
        $this->genre = $genre ;
        $this->description = $description ;
    }



    public function getTitle(){
        return $this->title ;

    }
    public function getReleaseDate(){
        return $this->releaseDate ;
        
    }
    public function getGenre(){
        return $this->genre ;
        
    }

    public function getDescription(){
        return $this->description ;
    }





    public function setTitle($title){
        $this->title = $title;
    }

    public function setReleaseDate($releaseDate){
        $this->releaseDate = $releaseDate;
    }

    public function getGenre($genre){
        $this->genre=$genre ;
    }


    public function setDescription($description){
        $this->description = $description ;
    }




    public function addGame(){

    }
    public function updateGame(){
        
    }
    public function deleteGame(){
        
    }
    
}


?>