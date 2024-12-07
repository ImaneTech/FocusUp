<?php
// ---------------------------------------------------Pour uploader une photo de profil :---------------- -->   
session_start();
// ---------------------------------------------------include la connexion a la base de donnees :---------------- -->   
include_once 'db.php';

// ---------------------------------------------------verifier si l'utilisateur est connecte :---------------- --> 
if (!isset($_SESSION['user_id'])) {
    // ---------------------------------------------------rediriger l'utilisateur a la page de connexion :---------------- -->  
    header("Location: connexion.php");
    exit();
}

// ---------------------------------------------------Si le formulaire est soumis et si le fichier de photo est envoye :---------------- --> 
if (isset($_POST['upload_photo']) && isset($_FILES['profile_photo'])) {
    // ---------------------------------------------------recuperer l'id de l'utilisateur connecte :---------------- -->    
    $user_id = $_SESSION['user_id'];
    // ---------------------------------------------------recuperer le fichier de photo envoye par l'utilisateur :---------------- --> 
    $file = $_FILES['profile_photo'];
    
    // ---------------------------------------------------verifier le type du fichier :---------------- --> 
    $autorise_type= ['jpg', 'jpeg', 'png', 'gif'];
    // ---------------------------------------------------recuperer le nom du fichier de photo envoye par l'utilisateur :---------------- -->   
    $filename = $file['name'];
    //pathinfo() : fonction php qui retourne des informations sur un fichier
    //PATHINFO_EXTENSION : constante php qui retourne l'extension du fichier
    $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if (!in_array($filetype, $autorise_type)) {
        //in_array() : fonction php qui verifie si une valeur existe dans un tableau
        // ---------------------------------------------------afficher un message d'erreur si le fichier n'est pas une image :---------------- --> 
        $_SESSION['error'] = "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        // ---------------------------------------------------rediriger l'utilisateur a la page de profil :---------------- --> 
        header("Location: profile.php");
        exit();
    }
    
    // ---------------------------------------------------creer un nom de fichier unique :---------------- --> 
    //uniqid() :  fonction php genere un identifiant unique
    $new_filename = uniqid() . '.' . $filetype;
    // ---------------------------------------------------creer le chemin de la photo de profil :---------------- -->   
    $upload_path = 'uploads/' . $new_filename;
    // ---------------------------------------------------verifier si le dossier uploads existe, sinon le creer :---------------- --> 
    //Utilise file_exists('uploads') pour verifier si le dossier 'uploads' existe deja dans le repertoire courant
    //mkdir() : fonction php qui cree un dossier
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
        //synthaxe de la fonction mkdir() : mkdir(nom_du_dossier, permissions, true)
        //0777 : permissions octales pour le dossier
        //true : permet de creer le dossier et tous les dossiers parents necessaires si ce n'est pas deja fait
    }

    //move_uploaded_file() : fonction php qui deplace un fichier telecharge vers un nouveau chemin
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        // ---------------------------------------------------mettre a jour la base de donnees :---------------- --> 
        $sql = "UPDATE utilisateur SET photo_url = ? WHERE ID_Utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $upload_path, $user_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Photo de profil mise à jour avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour de la base de données.";
        }
    } else {
        $_SESSION['error'] = "Erreur lors du téléchargement du fichier.";
    }
}
// ---------------------------------------------------rediriger l'utilisateur a la page de profil :---------------- -->     
header("Location: profile.php");
exit();
?> 