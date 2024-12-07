<?php
// ----------------------------------------  pour inclure le fichier db.php 
include('db.php');
// ----------------------------------------  pour initialiser les variables d'erreur
$userNameError = $passwordError = $nom_completError = $emailError = $phoneError = $countryError = $confirmPasswordError = $date_naissanceError = '';

if (isset($_POST['submit'])) {
    //suppression des espaces  recuperation des donnees du formulaire   
    $nom_complet = trim($_POST['nom_complet'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $date_naissance = trim($_POST['date_naissance'] ?? '');

    // ----------------------------------------  pour valider les champs
    //+++++++++++++++++nom complet+++++++++++++++++
    if (empty($nom_complet)) {
        $nom_completError = "Le nom complet est requis.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $nom_complet)) {
        $nom_completError = "Le nom complet ne doit contenir que des lettres et des espaces.";
    }

    //+++++++++++++++++nom d'utilisateur+++++++++++++++++
    if (empty($username)) {
        $userNameError = "Le nom d'utilisateur est requis.";
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        $userNameError = "Le nom d'utilisateur ne doit contenir que des lettres et des chiffres.";
    }

    //+++++++++++++++++email+++++++++++++++++
    if (empty($email)) {
        $emailError = "L'adresse e-mail est requise.";
    } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email))  {
        $emailError = "L'adresse e-mail est invalide. (exemple@exemple.com)";
    }

    //+++++++++++++++++numéro de téléphone+++++++++++++++++
    if (empty($phone)) {
        $phoneError = "Le numéro de téléphone est requis.";
    } elseif (!preg_match("/^[[:digit:]]{10}$/", $phone)) {
        $phoneError = "Le numéro de téléphone n'est pas valide.";
    }

    //+++++++++++++++++mot de passe+++++++++++++++++
    if (empty($password)) {
        $passwordError = "Le mot de passe est requis.";
    } elseif (strlen($password) < 8 || 
              !preg_match("/[A-Z]/", $password) || 
              !preg_match("/[a-z]/", $password) || 
              !preg_match("/[0-9]/", $password) || 
              !preg_match("/[\W_]/", $password)) {
        $passwordError = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
    }

    //+++++++++++++++++confirmation du mot de passe+++++++++++++++++
    if (empty($confirm_password)) {
        $confirm_passwordError = "La confirmation du mot de passe est requise.";
    } elseif ($confirm_password !== $password) {
        $confirmPasswordError = "Les mots de passe ne correspondent pas.";
    }

    //+++++++++++++++++pays+++++++++++++++++    
    if (empty($country)) {
        $countryError = "Le pays est requis.";
    }
    //+++++++++++++++++date de naissance+++++++++++++++++   
    if(empty($date_naissance)){
        $date_naissanceError = "La date de naissance est requise.";
    }

    //------------------------------- Si pas d'erreurs, insérer dans la base de données
    if (empty($userNameError) && empty($passwordError) && empty($nom_completError) && empty($emailError) && empty($phoneError) && empty($countryError) && empty($confirmPasswordError) && empty($date_naissanceError)) {

        // ----------------------------------------  pour hacher le mot de passe --> PASSWORD_DEFAULT: Algorithme de hachage par défaut 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // ----------------------------------------  pour utiliser des requetes preparees pour inserer les donnees dans la base de données
        $stmt = $conn->prepare("INSERT INTO utilisateur (nom_complet, username, email, phone, password, country, date_naissance) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nom_complet, $username, $email, $phone, $hashedPassword, $country, $date_naissance);  //s : string    
        // ----------------------------------------  pour executer la requete   
        if ($stmt->execute()) {
            header("Location:connexion.php"); // ----------------------------------------  pour rediriger vers la page de connexion 
            exit();
        } else {
            echo "Erreur SQL : " . $stmt->error; // ----------------------------------------  pour afficher l'erreur SQL si la requete echoue
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../websiteProject/css/inscription.css">
</head>
<body>
    <!-- ----------------------------------------  le contenu de la page -->
    <div class="container">
        <div class="content">
            <!-- ----------------------------------------  le formulaire pour s'inscrire -->    
            <form method="post" action="inscription.php">
                <h2>Inscription</h2>
                <div class="form-grid">
                <!-- ----------------------------------------  nom complet -->
                <div class="input-group">
                    <label>Nom Complet</label>
                    <input type="text" name="nom_complet" placeholder="Entrer votre nom complet"/>
                    <span class="error"><?php echo $nom_completError; ?></span>
                </div>
                <!-- ----------------------------------------  nom d'utilisateur -->
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Entrer votre nom d'utilisateur"/>
                    <span class="error"><?php echo $userNameError; ?></span>
                </div>
                <!-- ----------------------------------------  email -->    
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Entrer votre email"/>
                    <span class="error"><?php echo $emailError; ?></span>
                </div>
                <!-- ----------------------------------------  numéro de téléphone -->  
                <div class="input-group">
                    <label>Téléphone</label>
                    <input type="tel" name="phone" placeholder="Entrer votre numéro"/>
                    <span class="error"><?php echo $phoneError; ?></span>
                </div>
                <!-- ----------------------------------------  mot de passe -->     
                <div class="input-group">
                    <label>Mot de Passe</label>
                    <input type="password" name="password" placeholder="Entrer votre mot de passe"/>
                    <span class="error"><?php echo $passwordError; ?></span>
                </div>
                <!-- ----------------------------------------  confirmation du mot de passe -->     
                <div class="input-group">
                    <label>Confirmer le Mot de Passe</label>
                    <input type="password" name="confirm_password" placeholder="Confirmer votre mot de passe"/>
                    <span class="error"><?php echo $confirmPasswordError; ?></span>
                    </div>
                <!-- ----------------------------------------  pays -->     
                <div class="input-group">
                    <label>Pays</label>
                    <input type="text" name="country" placeholder="Entrer votre pays"/>
                    <span class="error"><?php echo $countryError; ?></span>
                    </div>
                <!-- ----------------------------------------  date de naissance -->     
                <div class="input-group">
                    <label>Date de naissance</label>
                    <input type="date" name="date_naissance" placeholder="Entrer votre date de naissance"/>     
                    <span class="error"><?php echo $date_naissanceError; ?></span>
                </div>
                </div>
                <!-- ----------------------------------------  bouton pour s'inscrire -->
                <button type="submit" name="submit" class="submit">S'inscrire</button>
                <!-- ----------------------------------------  lien pour se connecter -->   
                <p class="link">Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous ici</a></p>
            </form>
        </div>
    </div>
</body>
</html>
