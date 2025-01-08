<?php
require_once 'database.php';
class User {
    private $id;
    private $email;
    private $username;
    private $password;
    private $role;
    private $isBanned;
    protected $db;

    public function __construct() {
        $this->db = new Database();
        // $this->db-> getConnection() ;

    }

    public function getId() { return $this->id; }
    public function getEmail() { return $this->email; }
    public function getUsername() { return $this->username; }
    public function getRole() { return $this->role; }
    public function getIsBanned() { return $this->isBanned; }

    public function setEmail($email) { $this->email = $email; }
    public function setUsername($username) { $this->username = $username; }
    public function setRole($role) { $this->role = $role; }

    public function register($username, $email, $password ,$role) {
        try {
            $existingUser = $this->db->select(
                "SELECT * FROM users WHERE user_email = ?", 
                [$email]
            );

            if (!empty($existingUser)) {
                return ['success' => false, 'message' => 'Email already exists'];
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userId = $this->db->insert(
                "INSERT INTO users (username, user_email, user_password, role, is_banned) 
                VALUES (?, ?, ?, ?, false)",
                [$username, $email, $hashedPassword, $role]
            );

            return [
                'success' => true,
                'message' => 'Registration successful',
                'user_id' => $userId
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }


    public function login($email, $password) {
        try {
            $user = $this->db->select(
                "SELECT * FROM users WHERE user_email = ?", 
                [$email]
            );

            if (empty($user)) {
                return ['success' => false, 'message' => 'User not found'];
            }

            $user = $user[0];

            if ($user['is_banned']) {
                return ['success' => false, 'message' => 'Account is banned'];
            }

            if (password_verify($password, $user['user_password'])) {
                $this->id = $user['user_id'];
                $this->email = $user['user_email'];
                $this->username = $user['username'];
                $this->role = $user['role'];
                $this->isBanned = $user['is_banned'];

                
                $_SESSION['user_id'] = $this->id;
                $_SESSION['username'] = $this->username;
                $_SESSION['role'] = $this->role;

                return [
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => [
                        'id' => $this->id,
                        'username' => $this->username,
                        'email' => $this->email,
                        'role' => $this->role
                    ]
                ];
            }

            return ['success' => false, 'message' => 'Invalid password'];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Login failed'];
        }
    }

    public function updateProfile($userId, $data) {
        try {
            $updates = [];
            $params = [];

            if (isset($data['username'])) {
                $updates[] = "username = ?";
                $params[] = $data['username'];
            }
            if (isset($data['email'])) {
                $updates[] = "email = ?";
                $params[] = $data['email'];
            }
            if (isset($data['password'])) {
                $updates[] = "password = ?";
                $params[] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            if (empty($updates)) {
                return ['success' => false, 'message' => 'No data to update'];
            }

            $params[] = $userId;

            $affected = $this->db->update(
                "UPDATE users SET " . implode(", ", $updates) . " WHERE user_id = ?",
                $params
            );

            return [
                'success' => true,
                'message' => 'Profile updated successfully',
                'rows_affected' => $affected
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Update failed'];
        }
    }

    public function banUser($userId, $ban = true) {
        try {
            if ($_SESSION['role'] !== 'admin') {
                return ['success' => false, 'message' => 'Unauthorized action'];
            }

            $affected = $this->db->update(
                "UPDATE users SET is_banned = ? WHERE user_id = ?",
                [$ban, $userId]
            );

            return [
                'success' => true,
                'message' => $ban ? 'User banned successfully' : 'User unbanned successfully',
                'rows_affected' => $affected
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Action failed'];
        }
    }

    public function loadUser($userId) {
        try {
            $user = $this->db->select(
                "SELECT * FROM users WHERE user_id = ?", 
                [$userId]
            );

            if (empty($user)) {
                return false;
            }

            $user = $user[0];
            $this->id = $user['user_id'];
            $this->email = $user['email'];
            $this->username = $user['username'];
            $this->role = $user['role'];
            $this->isBanned = $user['is_banned'];

            return true;

        } catch (Exception $e) {
            return false;
        }
    }

    public function loadUsers() {
        try {
            $users = $this->db->select("SELECT * FROM users", [], PDO::FETCH_ASSOC);
            
            if ($users === false) {
                error_log("Failed to load users from database");
                return [];
            }
            
            return $users;
        } catch (Exception $e) {
            error_log("Error loading users: " . $e->getMessage());
            return [];
        }
    }


    public function deleteUser($userId) {
        try {
            return $this->db->delete(
                "DELETE FROM users WHERE user_id = ?",
                [$userId]
            );
        } catch (Exception $e) {
            error_log("Error deleting user: " . $e->getMessage());
            return false;
        }
    } 

    
    

// public function favorisGame($gameid,$userid) {
//     $favoris=$this->db->getConnection()->prepare("SELECT * FROM favoris WHERE game_id=:game_id AND user_id=:user_id");
//     $result=$favoris->execute([':game_id '=>$gameid,'user_id'=>$userid]);

//     if($result->rowCount()>0){
//         return false;
//     } else{
//          try {
       
//         $sql = "INSERT INTO favoris( game_id,user_id) VALUES (:game_id,user_id)";

//         $favoris = $this->db-> getConnection()->prepare($sql); 
//  $result=$favoris->execute([':game_id'=>$gameid,'user_id'=>$userid]
//     ); 
//     if ($result) {
//         echo"khdma";
//         return true;
//     } else {
//         echo" non khdma";
       
//         return false;
//     }
     
//     } catch (Exception $e) {
     
//         error_log("Error add favorite game: " . $e->getMessage());
       
//     }
//     }

   
// }
public function favorisGame($gameid, $userid) {
    
    $favoris = $this->db->getConnection()->prepare("SELECT * FROM favoris WHERE game_id = :game_id AND user_id = :user_id");
    $result = $favoris->execute([':game_id' => $gameid, ':user_id' => $userid]);

    if ( $favoris->rowCount() > 0) {
        $sql="DELETE  FROM favoris WHERE user_id=:user_id AND game_id=:game_id";
       $deletefavoris=$this->db->getConnection()->prepare($sql);
       return$deletefavoris->execute([':user_id'=>$userid,':game_id'=>$gameid]);
       
    } else {
        try {
           
            $sql = "INSERT INTO favoris (game_id, user_id) VALUES (:game_id, :user_id)";
            $favoris = $this->db->getConnection()->prepare($sql);
            $execution = $favoris->execute([':game_id' => $gameid, ':user_id' => $userid]);

            if ($execution) {
               
                return true;
            } else {
               
                return false;
            }
        } catch (Exception $e) {
          
            error_log("Error   " . $e->getMessage());
            return false;
        }
    }
}
// afichage des games favoris
public function showFavoris($userid) {


   
    $game = "SELECT games.game_img, games.game_title, games.genre,games.game_description,games.release_date,games.added_at, users.user_id,games.game_id FROM favoris 
JOIN games ON games.game_id = favoris.game_id  
    JOIN users ON users.user_id = favoris.user_id 
    WHERE users.user_id = :user_id";
     $showgames=$this->db->getConnection()->prepare($game);
     
    $result=$showgames->execute([':user_id'=>$userid]);
    if ($result) {
       
        return $showgames->fetchAll(PDO::FETCH_ASSOC);
    } else {
        
        echo "Erreur d'exécution de la requête SQL.";
        return [];
    }

}
public function showuserid($userid){
    try{
     $user="SELECT * FROM users WHERE user_id=:user_id ";
    $showuser=$this->db->getConnection()->prepare($user);
     $showuser->execute([':user_id'=>$userid]);
return  $showuser->fetchAll(PDO::FETCH_ASSOC);

    }
    catch (Exception $e) {
          
        error_log("Error   " . $e->getMessage());
        return false;
    }
    
   

}



}



?>
