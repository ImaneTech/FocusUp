<?php
session_start();
include('db.php');
//---------------------------------------- Demarrer la session et inclure la connexion a la base de donnees
$errorMsg = $successMsg = '';//initialiser les variables de message d'erreur et de succes   
$email = $_SESSION['email']; //recuperer l'email de l'utilisateur  
// Vérifier si le formulaire est soumis pour changer le mot de passe
if (isset($_POST['submit']) && isset($_SESSION['email'])) {
    $new_password = $_POST['new_password'];
    $new_password = htmlspecialchars(trim($new_password));
    //----------------------------verifier si le mot de passe est vide
    if(empty($new_password)){
        $errorMsg = "Le mot de passe ne peut pas être vide.";
    }
    else if(strlen($new_password) < 8  // au moins 8 caracteres
            || !preg_match('/[A-Z]/', $new_password)  // au moins une majuscule
            || !preg_match('/[a-z]/', $new_password)  // au moins une minuscule
            || !preg_match('/[0-9]/', $new_password)  // au moins un chiffre
            || !preg_match('/[@#$%^&*!]/', $new_password)  // au moins un caractere special
          )
   {
        $errorMsg = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
    }else{
    // -------------Securiser le mot de passe avant de le stocker dans la base de donnees
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    // ------------Mettre a jour le mot de passe dans la base de donnees
    $sql = "UPDATE utilisateur SET password = '$hashed_password' WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    // ------------Verifier si la requete a reussi
    if ($result) {
        $successMsg = "Votre mot de passe a été mis à jour avec succès.";
        $_SESSION['successMsg'] = $successMsg; // Stocker le message dans la session
        header("refresh:4;url=connexion.php"); // Redirection apres 4 secondes 
        //il affichera le message de succes pendant 4 secondes avant de rediriger vers la page de connexion 
    } else {
        $errorMsg = "Une erreur est survenue, veuillez réessayer.";
    }
    }
}

// Verification dans le cas ou le utulisateur arrive directement sur cette page sans passer par reset-mdp.php
if(!isset($_SESSION['email'])){
    header('Location: reset-mdp.php');
    exit();
}   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
    <link rel="stylesheet" href="css/change_pass.css">
</head>
<body>
    <div class="container">
        <div class="content">
    <h2>Entrez votre nouveau mot de passe</h2>
    <!-- ----------------------------formulaire pour changer le mot de passe------------------------- -->
    <form method="POST" action="change_pass.php">
        <div class="new_password">
            <!-- ------------------------------nouveau mot de passe------------------------- -->
            <label for="new_password">Nouveau mot de passe :</label>
            <input type="password" class= "input" name="new_password">
        </div>
        <!-- ------------------------------bouton pour mettre a jour le mot de passe------------------------- -->
        <button type="submit" class = "submit" name="submit">Mettre à jour le mot de passe</button>
    </form>
    <!-- ------------------------------afficher le message de succes------------------------- -->   
    <?php if($successMsg): ?>
        <p class="successMsg"><?php echo $successMsg; ?></p>
    <?php endif; ?>
    <!-- ------------------------------afficher le message d'erreur------------------------- -->   
    <?php if($errorMsg): ?>
        <p class="errorMsg"><?php echo $errorMsg; ?></p>
    <?php endif; ?>
    </div>
    </div>
</body>
</html>
