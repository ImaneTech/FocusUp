<?php
// ------------------Demarrer la session utilisateur
session_start();
// ------------------Inclure le fichier de connexion a la base de donnees
include 'db.php';
// ------------------Verifier la connexion a la base de donnees
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ------------------Initialiser les variables d'erreur
$userNameError = $passwordError = $Error = '';

// ------------------Verifier si les cookies existent 
if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    // ------------------Verifier si l'utilisateur existe toujours dans la base de donnees
    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE Email = ?");
    $stmt->execute([$_COOKIE['username']]);
    
    if($stmt->num_rows > 0) {
        // ------------------L'utilisateur existe, on peut utiliser les cookies
        $username = $_COOKIE['username'];
        $password = $_COOKIE['password'];
    } else {
        // ------------------L'utilisateur n'existe plus, supprimer les cookies
        setcookie('username', '', time() - 3600, '/');
        setcookie('password', '', time() - 3600, '/');
        $username = '';
        $password = '';
    }
} else {
    // ------------------   Si les cookies n'existent pas, initialiser les variables avec des valeurs vides  
    $username = '';
    $password = '';
}

    // ------------------Verifier si le formulaire a ete soumis
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ------------------Validation du nom d'utilisateur et du mot de passe
    if (empty($username)) {
        $userNameError = "<br>Le nom d'utilisateur est requis";
    }

    if (empty($password)) {
        $passwordError = "<br>Le mot de passe est requis";
    }

    // ------------------Si aucun champ n'est vide, effectuer la verification de l'utilisateur
    if (empty($userNameError) && empty($passwordError)) {
        // ------------------Sécuriser la requete SQL avec des requetes preperes
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // ------------------Verifier si l'utilisateur existe
        if ($result->num_rows > 0) {    
            $row = $result->fetch_assoc();

            // Vérifier le mot de passe
            if (password_verify($password, $row['password'])) {
                // ------------------Mot de passe correct, connexion reussie
                // ------------------Demarrer la session utilisateur
                $_SESSION['user_id'] = $row['ID_Utilisateur'];
                // ------------------Definir la variable de session pour savoir si l'utilisateur est connecte 
                $_SESSION['logged_in'] = true;
                if(isset($_POST['remember_me'])){
                    // ------------------ La fonction setcookie() est utilisee pour envoyer un cookie au navigateur de l'utilisateur.
                    // ------------------   Le premier parametre est le nom du cookie, le deuxieme est la valeur a stocker,
                    // ------------------le troisieme est le temps d'expiration ( 1 jour), et le quatrieme est le chemin où le cookie est disponible.
                    setcookie('username', $username, time() + 86400 , "/"); // 86400 = 1 jour 
                    setcookie('password', $password, time() + 86400, "/"); // 86400 = 1 jour  
                }
                //------------------- Rediriger vers la page d'accueil
                header("Location: home.php");
                //------------------- Arrêter l'execution
                exit();
            } else {
                // ------------------Mot de passe incorrect
                $Error = "<br />Mot de passe incorrect";
            }
        } else {
            // ------------------Nom d'utilisateur introuvable
            $Error = "<br />Nom d'utilisateur introuvable";
        }
        // ------------------Fermer la requete
        $stmt->close();
    }

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../websiteProject/css/connexion.css">
</head>
<body>
<div class="container">
    <div class="content">
        <form method="post" action="connexion.php">
            <h2>Se connecter</h2>
            <!-- ------------------ le nom d'utilisateur -->
            <div class="username">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" name="username" placeholder="Entrer votre nom d'utilisateur" class="input"  value="<?php echo $username; ?>"/>
                <!-- ------------------Afficher la valeur du nom d'utilisateur si le utulisateur a deja activer remember me -->
                <!-- ------------------Afficher l'erreur de nom d'utilisateur -->
                <span style="color: red" class="error"><?php echo $userNameError; ?></span>
            </div>
            <!-- ------------------ le mot de passe -->
            <div class="password">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" placeholder="Entrer votre mot de passe" class="input"  value="<?php echo $password; ?>"/>
                <span style="color: red" class="error"><?php echo $passwordError; ?></span>
            </div>
                <!-- ------------------Afficher l'erreur de connexion -->
            <span style="color: red" class="error"><?php echo $Error; ?></span>
            
            <div class="more">
            <!-- ------------------Le lien pour le mot de passe oublié -->
            <p class="forgot-password"><a href="reset-mdp.php">Mot de passe oublié</a></p>
            <!-- ------------------Le bouton pour se souvenir de moi -->
            <span> <input type="checkbox" name="remember_me" id="check">
                    <p>Se souvenir de moi</p>
            </span>
            </div>
            <!-- ------------------Le bouton pour se connecter -->  
                <button class="submit" name="submit">Se connecter</button>
                <!-- ------------------Le lien pour s'inscrire -->
                <p class="dnt-acc">Vous n'avez pas de compte ? <a href="inscription.php" class="signup">Inscrivez-vous ici</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
