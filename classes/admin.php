<?php
include '../classes/user.php';




class Admin extends User {
    public function __construct() {
        parent::__construct();
    }

    public function showusers() {
      
        $showUsers =  $this->db-> getConnection()->prepare("SELECT * FROM users ");

      
        $showUsers->execute();

        
        return $showUsers->fetchAll(PDO::FETCH_ASSOC);
    }
   public function gestionRoles($userid,$role){
   
    $roles="  UPDATE users set role=:role where user_id=:userid ";
    $gestionroles=$this->db-> getConnection()->prepare($roles);
   

    
  
    return $gestionroles->execute(
        [':role'=>$role,
        ':userid'=>$userid]
    );
   }
   public function banutilisateur($status, $userid) {
    
    if ($status === 'banni') {
        $bans = "UPDATE users SET status = :status, ban_date = CURDATE() WHERE user_id = :userid";
    } else {
      
        $bans = "UPDATE users SET status = :status WHERE user_id = :userid";
    }
 
   
    $bansUser = $this->db->getConnection()->prepare($bans);

   
    return $bansUser->execute([
        ':status' => $status,
        ':userid' => $userid
    ]);
}
public function dernierBan(){
    $status="banni";
    $user="SELECT  MAX(ban_date) as ban_date FROM users WHERE status=:status";
    $ban=$this->db->getConnection()->prepare($user);
    $ban->execute([':status'=>   $status]);
    $result= $ban->fetch();
    return $result['ban_date'];

}

   



   

    

   
   
  
   public function countAtifs(){
    
    $statusid='actif';
    $users="SELECT COUNT(user_id) as count
       FROM users
     WHERE status=:actif";
      $actifs=$this->db->getConnection()->prepare( $users);
     $actifs->execute(
        [':actif'=> $statusid]
    
);
   $result=$actifs->fetch();
   return$result['count'];
;
   }
   public function countBan(){
    $statusid='banni';
    $users="SELECT COUNT(user_id) as count
       FROM users
     WHERE status=:banni";
      $actifs=$this->db->getConnection()->prepare( $users);
     $actifs->execute(
        [':banni'=> $statusid]
    
);
   $result=$actifs->fetch();
   return$result['count'];
;
    
   }
   public function countGames(){
  
    $games="SELECT COUNT(game_id) as count_games
       FROM games ";
      $counts=$this->db->getConnection()->prepare( $games);
     $counts->execute(
       
    
);
   $result=$counts->fetch();
   return$result['count_games'];
;
    
   }
   public function dernierGame(){
    $game=" SELECT MAX(added_at) as max FROM games";
    $max=$this->db->getConnection()->prepare($game);
    $max->execute();
    $result=$max->fetch();
    return$result['max'];
   }
   public function dernierinscrep(){
    $statusid='actif ';
    $users=" SELECT MAX(added_at) as dernier FROM users  WHERE  status=:actif";
    $max=$this->db->getConnection()->prepare($users);
    $max->execute([':actif'=> $statusid]);
    $result=$max->fetch();
    return$result['dernier'];
   }
}




  

















?>