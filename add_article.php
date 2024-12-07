<?php
//-------------------------------------------inclure le template   
include 'template.php';
//----------------------------------------inclure la base de données
include_once 'db.php';
//-----------------------------------initialiser les messages de erreur et de succes    
$errorMsg='';
$successMsg='';
//-------------------------------------------verifier si le bouton d'ajout d'article a ete clique
if (isset($_POST["addArticle"])) {
    //-------------------------------------------verifier si les champs de titre et de contenu sont vides
    if (empty($_POST['title']) || empty($_POST['contenue'])) {
        $errorMsg = "Veuillez remplir les champs de titre et de contenu.";
    }else{
    //--------------------------------------------inserer les donnees dans la base de donnees
    $stmt = $conn->prepare("INSERT INTO blog_posts (title,image,laDate ,contenue,link) VALUES (?, ?,NOW(), ?, ?)");
    $stmt->bind_param("ssss", $_POST['title'], $_POST['image'], $_POST['contenue'], $_POST['link']);
    if ($stmt->execute()) {
        //--------------------------------------------afficher un message de succes
            $successMsg = "Article ajouté avec succès!";
    } else {
        //--------------------------------------------afficher un message d'erreur
        $errorMsg = "Erreur lors de l'ajout de l'article.";
    }
}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../websiteProject/css/add_articlee.css" />
    <title>Ajouter un article</title>
</head>
<body>
<div class="new-article">
                <h3>Ajouter un nouvel article</h3>
                <!----------------------------------------------------------formualire de l'ajout d'article-->
                <form method="POST" action="add_article.php" class="form">
                    <input type="text" name="title" placeholder="Titre de l'article" >
                    <textarea name="contenue" placeholder="Contenu de l'article" ></textarea>
                    <input type="text" name="image" placeholder="URL de l'image">
                    <input type="text" name="link" placeholder="Lien externe">
                    <button type="submit" name="addArticle">Ajouter l'article</button>  
                </form>
                <!------------------------------------------------------------afficher les messages d'erreur ou de succes-->
                <?php if (!empty($errorMsg)) { ?>   
                    <div class="errorMsg"><?php  echo $errorMsg; ?></div>
                <?php } ?>
                <?php if (!empty($successMsg)) { ?>
                    <div class="successMsg"><?php  echo $successMsg; ?></div>
                <?php } ?>
 </div>
<!----------------------------------------------------------inclure le footer-->    
 <?php include 'footer.php'; ?>  
</body>
</html>


