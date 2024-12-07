<?php
// ----------------------------------------  pour inclure le fichier db.php
include_once 'db.php';
// ----------------------------------------  pour inclure le fichier template.php
include 'template.php';
// ---------------------------------------- on a deja verifier si l'utilisateur est connecté
//donc on peut recuperer l'id de l'utilisateur directement
$user_id = $_SESSION['user_id'];
// ----------------------------------------  pour recuperer les données de l'utilisateur


$sql = "SELECT nom_complet FROM utilisateur WHERE ID_Utilisateur = '$user_id'";


$result = mysqli_query($conn,$sql);
// ----------------------------------------  pour verifier si la requete a reussi   
if ($result) {
    if ( mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
    } else {
        // ----------------------------------------  si aucune donnee trouvée pour l'ID de l'utilisateur
        $userData = null;
        echo "Aucune donnee trouvée pour l'ID : " . $user_id;
    }
} else {
    // ----------------------------------------  si la requete a echoue
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
}
$result->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../websiteProject/css/homee.css">
</head>
<body>
    <!-- ----------------------------------------  pour afficher le message de bienvenue -->
    <div class="welcome-container">
        <h1 class="welcome-message">
            Bienvenue sur FocusUp, 
            <span class="user-name-welcome">
                <!-- ----------------------------------------  pour afficher le nom de l'utilisateur si il est connecté   -->


                <?php echo htmlspecialchars(isset($userData['nom_complet']) ? $userData['nom_complet'] : 'Utilisateur'); ?>

                
            </span>
        </h1>
    </div>
    <!-- ----------------------------------------  pour afficher la section vidéo tutorielle -->
    <div class="tutorial-container">
    <h2>Guide Tutoriel FocusUp</h2>
        <div class="video-wrapper">
            <div class="video-placeholder">
                <!-- iframe: base html pour integrer  une video youtube dans la page   -->
                <!-- src: source de la video youtube   // frameborder: pour que la video soit afficher sans bordure  -->
                <!--  allow="..." : Définit les fonctionnalités autorisées dans l'iframe -->
                <!-- allowfullscreen: pour que la video soit afficher en plein ecran -->
            <iframe 
                src="https://www.youtube.com/embed/p5um7s7VHQE"  
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>  
</body>
</html>