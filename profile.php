<?php
// ----------------------------------------  pour inclure le fichier template.php
include 'template.php';
// ----------------------------------------  pour inclure le fichier db.php
include_once 'db.php';
// ----------------------------------------  pour verifier si l'utilisateur est connecte    
if (!isset($_SESSION['user_id'])) {
    header("Location:login.php");
    exit();
}
// ----------------------------------------  pour recuperer l'id de l'utilisateur       
$user_id = $_SESSION['user_id'];
// ----------------------------------------  pour recuperer les informations de l'utilisateur   
$sql = "SELECT * FROM utilisateur WHERE ID_Utilisateur = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$utilisateur = $result->fetch_assoc();

// ----------------------------------------  pour recuperer la photo de profil de l'utilisateur
function photo_profil($utilisateur){
    if(isset($utilisateur['photo_url']) && !empty($utilisateur['photo_url'])){
        return $utilisateur['photo_url'];
    }else {
        return '../websiteProject/images/userr.png';
    }
}

// ----------------------------------------  pour recuperer les messages d'erreur ou de succes
$error_message = $_SESSION['error'] ?? null; //null si on n'a pas de message d'erreur
$success_message = $_SESSION['success'] ?? null; //null si on n'a pas de message de succes
unset($_SESSION['error'], $_SESSION['success']);//pour que les messages ne soient pas affiches a chaque chargement de la page
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../websiteProject/css/profile.css">
    <title>Profile</title>
</head>
<body>
<div class="profile-container">
    <div class="profile-grid">
        <!-- ----------------------------------------  photo de profil a droite -->
        <div class="profile-photo">
            <div class="photo-container">
            <img src="<?php echo htmlspecialchars(photo_profil($utilisateur)); ?>" alt="Photo de profil" class="profile-image">
            </div>
            <!-- ----------------------------------------  le formulaire pour uploader la photo de profil -->
            <form action="upload_photo.php" method="POST" enctype="multipart/form-data" class="upload-form">
                <input type="file" name="profile_photo" id="profile_photo" accept="image/*">
                 <!-- accept: permet de limiter le type de fichier que l'utilisateur peut uploader  -->
                <button type="submit"  name="upload_photo" class="upload">Modifier la photo</button>
                    <!-- ----------------------------------------  affichage des messages d'erreur ou de succes -->
                <?php if ($error_message): ?>
                        <div class="msg-error">
                            <?php echo htmlspecialchars($error_message) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($success_message): ?>
                        <div class="msg-success">
                            <?php echo htmlspecialchars($success_message) ?>
                        </div>
                    <?php endif; ?>
            </form>
        </div>
            <!-- ----------------------------------------  informations a gauche -->
        <div class="profile-info">
            <h1>Profil de <?php echo htmlspecialchars($utilisateur['username']); ?></h1>
            <div class="infos">
                <p><strong>Nom complet:</strong> <?php echo htmlspecialchars($utilisateur['nom_complet']); ?></p>
                <p><strong>Nom d'utilisateur:</strong> <?php echo htmlspecialchars($utilisateur['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($utilisateur['email']); ?></p>
                <p><strong>Numéro de téléphone:</strong> <?php echo htmlspecialchars($utilisateur['phone']); ?></p>
                <p><strong>Pays:</strong> <?php echo htmlspecialchars($utilisateur['Country']); ?></p>
                <p><strong>Date de naissance:</strong> <?php echo htmlspecialchars($utilisateur['date_naissance']); ?></p>
                
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>  
</body>
</html>