<?php
class User {
    private $id;
    private $email;
    private $username;
    private $password;
    private $role;
    private $isBanned;
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getId() { return $this->id; }
    public function getEmail() { return $this->email; }
    public function getUsername() { return $this->username; }
    public function getRole() { return $this->role; }
    public function getIsBanned() { return $this->isBanned; }

    public function setEmail($email) { $this->email = $email; }
    public function setUsername($username) { $this->username = $username; }
    public function setRole($role) { $this->role = $role; }

    public function register($username, $email, $password ,) {
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

    // Update user profile
    public function updateProfile($userId, $data) {
        try {
            $updates = [];
            $params = [];

            // Build dynamic update query based on provided data
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

            // Add user_id to params
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

    // Ban/Unban user
    public function banUser($userId, $ban = true) {
        try {
            // Check if user has admin role
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

    // Load user by ID
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
}
?>
