<?php
include 'template.php';
include_once 'db.php'; 

// Vérifier si la table existe et la créer si nécessaire
$sql = "SELECT * FROM blog_posts ORDER BY laDate DESC";
$result = mysqli_query($conn, $sql);
//-----------------------------------verifier si la table existe si non on la cree  
if (mysqli_num_rows($result) == 0) {
    $sql = "CREATE TABLE blog_posts ( 
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        image VARCHAR(255),
        laDate DATE NOT NULL,
        content TEXT NOT NULL,
        link VARCHAR(255)
    )";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Erreur lors de la création de la table : " . mysqli_error($conn));
    }
}


$categories = [
    'youtube' => 'Les 5 meilleures chaînes YouTube pour augmenter la productivité',
    'tools' => 'Les 5 meilleurs outils pour booster la productivité',
    'studies' => 'Les études prouvées pour devenir plus productif',
    'books' => 'Les meilleurs livres pour devenir plus productif'
];

$categoryToArticleId = [
    'youtube' => 1,
    'tools' => 2,
    'studies' => 3,
    'books' => 4
];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Blog - FocusUp</title>
    <link rel="stylesheet" href="../websiteProject/css/blogg.css">
</head>
<body>
    <div class="container">
        <h1>Blog FocusUp</h1>
        <div class="posts-container">
            <!-- boucle pour parcourir les categories -->
            <?php foreach ($categories as $cat_key => $cat_name): ?>
                <article class="blog-post">
                    <!-- afficher le titre de poste -->  
                    <h2 class="post-title"><?php echo $cat_name; ?></h2>
                    <div class="post-content">
                        <div class="post-image">
                            <!-- afficher l'image de poste selonla categorie -->  
                            <?php if ($cat_key === 'youtube'): ?>
                            <img src="../websiteProject/images/ytbimg.jpg" alt="<?php echo $cat_name; ?>">
                            <?php elseif ($cat_key === 'tools'): ?>
                                <img src="../websiteProject/images/apps.jpg" alt="<?php echo $cat_name; ?>">
                            <?php elseif ($cat_key === 'studies'): ?>
                                <img src="../websiteProject/images/studies.png" alt="<?php echo $cat_name; ?>">
                            <?php elseif ($cat_key === 'books'): ?>
                                <img src="../websiteProject/images/books.jpg" alt="<?php echo $cat_name; ?>">
                            <?php endif; ?>
                        </div>
                        <div class="post-details">  
                            <!-- afficher la date de publication -->  
                            <p class="post-date">Dernière mise à jour: <?php echo date('d/m/Y'); ?></p>

                            <!-- afficher le lien de l'article -->  
                            <a href="article.php?id=<?php echo $categoryToArticleId[$cat_key]; ?>" class="view-article">Voir l'Article</a>


                            
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>  
</body>
</html>
