<?php
// ----------------------------------------  pour demarrer la session
session_start();
// ----------------------------------------  pour verifier si l'utilisateur est connecte
if (isset($_SESSION['user_id'])) {
    // ----------------------------------------  si l'utilisateur est connecte, redirigez vers home.php
    header('Location: home.php');
    exit();
} else {
    // ----------------------------------------  si l'utilisateur n'est pas connecte, redirigez vers home_v2.php
    header('Location: home_v2.php');
    exit();
}

?> 