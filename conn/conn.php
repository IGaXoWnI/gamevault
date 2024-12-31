<?php
$host = 'localhost';
$dbname = 'gamevault';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>