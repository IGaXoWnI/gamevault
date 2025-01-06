<?php
include '../classes/user.php';




class Admin extends User {
    public function __construct() {
        parent::__construct();
    }

    public function showusers() {
      
        $showUsers =  $this->db-> getConnection()->prepare("SELECT * FROM users");

      
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
 public function banutilisateur($status,$userid){
 $bans="UPDATE users set status=:status where user_id=:userid ";
$bansUser=$this->db->getConnection()->prepare($bans);
   

    
  
  return $bansUser->execute(
        [':status'=>$status,
        ':userid'=>$userid]
    );
   }
}




  

















?>