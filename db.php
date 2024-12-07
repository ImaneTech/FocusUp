<?php
// db.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');  // ici mot de pass est root car j'ai utuliser wamp server
define('DB_NAME', 'FocusUp');

// creer la connexion avec la base de donnees
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//verifier la connexion 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>