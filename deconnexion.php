<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Se déconnecter</title>
    <link rel="stylesheet" href="../websiteProject/css/connexion.css">
    <style>
        /* ----------------------------------style du container */  
        .container {
            width: auto;
            height: auto;
            padding: 70px;
            border: 2px solid  rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            margin: auto;
            text-align: center;
        }
        /* ----------------------------------style de la barre de progression */
        progress {
            width: 100%;
            height: 50px;
            display: block;
            margin-bottom: 20px;
        }
        /* ----------------------------------style du texte */
        .text {
            display: block;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
<?php
include 'db.php';
// ----------------------------------deconnecter l'utilisateur  
session_destroy();
// ----------------------------------rediriger l'utilisateur a la page de connexion   apres 5 secondes 
//synthaxe : http-equiv="refresh" : Pour que le navigateur rafraîchir la page
//5: le nombre de secondes avant de rediriger l'utilisateur a la page de connexion
//URL=connexion.php: la page a laquelle l'utilisateur sera rediriger
echo '<meta http-equiv="refresh" content="5;URL=connexion.php">';
// ----------------------------------afficher le texte et la barre de progression  
echo '<div>';
echo '<span class="text">Déconnexion en cours, veuillez patienter...</span>';
// ----------------------------------afficher la barre de progression   
//max=100: la barre de progression va de 0 a 100    
//<progress> : pour afficher la barre de progression
echo '<progress max=100><strong>Progress:60%done.</strong></progress>';
echo '</div>';
?>
</div>  
</body>
</html>

