<?php
// ----------------------------------------  pour demarrer la session et inclure la connexion a la base de donnees
session_start();
include('db.php');
// ----------------------------------------  pour initialiser $Error
$Error = "";
// ----------------------------------------  pour verifier si le formulaire est soumis
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = trim($email);  //supprimer les espaces en debut et en fin de la chaine
    $email = htmlspecialchars($email); //convertir les caracteres speciaux en entites HTML
    if(empty($email)){
        $Error = "L'email est requis";
    }else if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)){
        $Error = "L'email n'est pas valide.il doit être comme ceci: exemple@exemple.com";
    }else{
    // ----------------------------------------  pour verifier si l'email existe dans la base de donnees
    $sql = "SELECT * FROM utilisateur WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // ----------------------------------------  si l'email est trouve, demander a l'utilisateur de saisir un nouveau mot de passe
        $_SESSION['email'] = $email; //stocker l'email dans la session pour l'utiliser dans change_password.php 
        header('Location: change_pass.php');
        exit(); // ----------------------------------------  pour ajouter exit() apres la redirection
    } else {
        $Error= "L'email n'existe pas dans notre base de donnees.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/reset_mdp.css">
    <title>Réinitialiser le mot de passe</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <!-- ----------------------------------------  pour afficher le titre -->
            <h2>Réinitialiser votre mot de passe</h2>
            <!-- ---------------------------------------formulaire --------------------------------------- -->
            <form method="POST" action="reset-mdp.php">
                <div class="email">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="input" placeholder="entrez votre email">
                    <!-- ----------------------------------------  pour utiliser un input de type text au lieu de email car je veut faire la validation de l'email dans la partie php-->
                </div>
                <button type="submit" class="submit" name="submit">Réinitialiser</button>
                <!-- ----------------------------------------  pour afficher le message d'erreur seulement si il y a une erreur-->
                <?php if($Error): ?>
                    <p class="error"><?php echo $Error; ?></p>
                    <!-- ----------------------------------------  pour afficher le message d'erreur -->    
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>

