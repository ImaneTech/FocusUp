<?php
//-------------------------------------------inclure le template
include 'template.php';
//-------------------------------------------inclure la base de données une seule fois
include_once 'db.php';
//-------------------------------------------vérifier la connexion
if (!$conn) {
    die("La connexion a échoué : " . mysqli_connect_error());
}

//-------------------------------------------vérifier si la table blog_posts est vide
$sql = "SELECT COUNT(*) as count FROM blog_posts";
$result = mysqli_query($conn, $sql);
$nb_articles = mysqli_num_rows($result);
//-------------------------------------------insérer les articles si la table est vide   seulement une seule fois 
if($nb_articles == 0){
$blog_posts = [
    [   'id' => 1,
        'title' => 'Les 5 meilleures chaînes YouTube pour augmenter la productivité',
        'image' => '../websiteProject/images/ytbimg.jpg',
        'laDate' => '2024-11-22',
        'contenue' => 'Découvrez les YouTubers qui partagent les meilleures astuces de productivité'
    ],
  
    [   'id' => 2,
        'title' => 'Les 5 meilleurs outils pour booster la productivité',
        'image' => '../websiteProject/images/apps.jpg',
        'laDate' => '2024-11-22',
        'contenue' => 'Découvrez les outils essentiels pour booster votre productivité'
    ],
    [   'id' => 3,
        'title' => 'Les études prouvées pour devenir plus productif',
        'image' => '../websiteProject/images/studies.png',
        'laDate' => '2024-11-22',
        'contenue' => 'Les études scientifiques derrière la productivité'
    ],
    [   'id' => 4,
        'title' => 'Les meilleurs livres pour devenir plus productif',
        'image' => '../websiteProject/images/books.jpg',
        'laDate' => '2024-11-22',
        'contenue' => 'Sélection des meilleurs livres sur la productivité'
    ]
];
//-------------------------------------------preparer la requete pour blog_posts
$stmt_posts = $conn->prepare("INSERT INTO blog_posts (id,title, image, laDate, contenue) VALUES (?,?, ?, ?, ?)");
//-------------------------------------------insertion des articles
//on fait une boucle sur le tableau $blog_posts pour inserer les articles dans la table blog_posts 
foreach ($blog_posts as $post) {
    $stmt_posts->bind_param("issss",
        $post['id'],
        $post['title'],
        $post['image'],
        $post['laDate'],
        $post['contenue']
    );
    $stmt_posts->execute();
}
}
//------------------------------------------------------inserer le contenu
$contenue = [
     [  'id' => 1,
        'blog_posts_id' => 1,
        'titre' => 'Ali Abdaal : La science et la pratique de la productivité',
         'parag' => 'Ali Abdaal, un ancien médecin britannique devenu entrepreneur et créateur de contenu, est une référence incontournable en matière de productivité. Sur sa chaîne, il propose des vidéos sur les outils et techniques comme la méthode Pomodoro, l\'organisation avec Notion, et la gestion des priorités. Ce qui distingue Ali, c\'est son approche détendue : il prône une productivité durable et sans pression. Ses vidéos incluent également des revues de livres et des interviews inspirantes avec des leaders d\'opinion.',
         'link' => 'https://www.youtube.com/c/AliAbdaal',
         'num_order' => 1
    ],
        
    [ 'id' => 2,
         'blog_posts_id' => 1,
         'titre' => 'Matt D\'Avella : Minimalisme et efficacité au quotidien - L\'art du minimalisme',
         'parag' => 'Matt D\'Avella est bien connu pour son style cinématographique et ses vidéos minimalistes qui traitent de productivité, de croissance personnelle et de simplicité. Son approche met l\'accent sur le fait de faire moins, mais mieux. Il parle de la discipline, de la création d\'habitudes durables, et de la manière de trouver un équilibre entre ambition et bien-être. Si vous cherchez des contenus inspirants et esthétiques, Matt est un créateur à suivre.',
         'link' => 'https://www.youtube.com/c/MattDAvella',
         'num_order' => 2
    ],
        
    [ 
        'id' => 3,
        'blog_posts_id' => 1,
        'titre' => 'Thomas Frank : L\'expert de l\'organisation',
         'parag' => 'Thomas Frank est un maître de la productivité et de l\'organisation. Il propose des vidéos détaillées sur la planification, la gestion de projets et les outils numériques comme Trello ou Notion. Sa chaîne s\'adresse particulièrement aux étudiants et aux jeunes professionnels qui souhaitent maximiser leur efficacité tout en réduisant le stress. Il aborde aussi des sujets comme l\'apprentissage rapide et la gestion de l\'énergie mentale.',
         'link' => 'https://www.youtube.com/c/Thomasfrank',
        'num_order' => 3
    ],
        
    [
        'id' => 4,
        'blog_posts_id' => 1,
        'titre' => 'David Laroche : La motivation pour passer à l\'action',
         'parag' => 'David Laroche est un conférencier et coach français spécialisé dans la motivation et le développement personnel. Sur sa chaîne, il partage des stratégies pour surmonter les blocages, rester motivé, et atteindre ses objectifs ambitieux. Ses vidéos sont pleines d\'énergie et mettent souvent en avant des exemples concrets pour transformer votre mentalité et vos habitudes.',
         'link' => 'https://www.youtube.com/@david-laroche',
         'num_order' => 4
    ],
        
    [ 
        'id' => 5,
        'blog_posts_id' => 1,
        'titre' => 'Olivier Roland : Entrepreneuriat et liberté',
         'parag' => 'Olivier Roland, auteur et entrepreneur, propose une chaîne centrée sur l\'art de concilier travail et vie personnelle. Ses vidéos s\'adressent principalement aux entrepreneurs et aux freelances. Il aborde des thèmes comme l\'efficacité au travail, la lecture rapide, et la création d\'une entreprise qui vous laisse du temps libre. Sa devise : « Travaillez mieux pour vivre mieux. »',
         'link' => 'https://www.youtube.com/@OlivierRoland',
         'num_order' => 5
    ],

    [
            'id' => 6,
            'blog_posts_id' => 2,
            'titre' => 'Trello : L\'organisation visuelle au bout des doigts',
            'parag' => 'Trello est un outil de gestion de tâches basé sur des tableaux, idéal pour organiser vos projets de manière claire et intuitive. Vous pouvez créer des listes, y ajouter des cartes représentant des tâches, et les déplacer d\'une colonne à l\'autre pour suivre leur progression. Trello est parfait pour les projets personnels comme professionnels, et son interface visuelle le rend accessible à tous. Avantages : Interface intuitive et personnalisable, Idéal pour la gestion de projets collaboratifs, Intégration avec d\'autres outils comme Google Drive et Slack.',
            'link' => 'https://trello.com',
            'num_order' => 1
    ],
        
    [
            'id' => 7,
            'blog_posts_id' => 2,
            'titre' => 'Notion : Le couteau suisse de la productivité',
            'parag' => 'Notion est bien plus qu\'un simple outil de gestion de tâches : c\'est une plateforme tout-en-un qui combine prises de notes, bases de données, planification et organisation. Vous pouvez l\'utiliser pour créer des tableaux Kanban, des calendriers ou même des systèmes personnalisés pour gérer vos objectifs à long terme. Avantages : Grande flexibilité et personnalisation, Idéal pour les individus et les équipes, Prise en charge de nombreux formats (texte, images, bases de données).',
            'link' => 'https://www.notion.so',
            'num_order' => 2
    ],
        
    [
            'id' => 8,
            'blog_posts_id' => 2,
            'titre' => 'Todoist : Une liste de tâches simple et puissante',
            'parag' => 'Todoist est une application légère mais puissante pour gérer vos listes de tâches quotidiennes. Elle permet de classer vos tâches par projets, d\'ajouter des dates d\'échéance et des rappels, et même de définir des priorités. Avec une interface épurée, Todoist convient aussi bien aux professionnels qu\'aux particuliers. Avantages : Facile à utiliser, Fonctionnalités avancées comme les rappels et l\'analyse de productivité, Synchronisation sur tous vos appareils.',
            'link' => 'https://todoist.com',
            'num_order' => 3
    ],
        
    [
            'id' => 9,
            'blog_posts_id' => 2,
            'titre' => 'Clockify : Suivez votre temps avec précision',
            'parag' => 'Clockify est un outil de suivi du temps conçu pour vous aider à mesurer combien de temps vous passez sur chaque tâche ou projet. Il est particulièrement utile pour les freelances et les professionnels qui souhaitent optimiser leur emploi du temps ou suivre leur productivité. Avantages : Gratuit avec des fonctionnalités premium optionnelles, Génère des rapports détaillés sur l\'utilisation du temps, Disponible sur mobile et bureau.',
            'link' => 'https://clockify.me',
            'num_order' => 4
    ],
        
    [
            'id' => 10,
            'blog_posts_id' => 2,
            'titre' => 'Google Calendar : Un calendrier simple mais efficace',
            'parag' => 'Google Calendar reste un classique pour planifier et gérer vos rendez-vous, tâches et événements. Vous pouvez définir des rappels, synchroniser votre emploi du temps sur différents appareils, et même partager des calendriers avec vos collègues ou votre famille. Avantages : Gratuit et accessible partout, Parfait pour organiser des événements collaboratifs, Synchronisation avec Gmail et d\'autres outils Google.',
            'link' => 'https://calendar.google.com',
            'num_order' => 5
    ],
    [
            'id' => 11,
            'blog_posts_id' => 3,
            'titre' => 'La règle des 90 minutes : Le cycle ultradien et la productivité',
             'parag' => 'Kleitman, connu pour ses travaux sur les rythmes biologiques, a découvert que notre cerveau fonctionne par cycles ultradiens d\'environ 90 minutes. Pendant ce temps, nous sommes plus concentrés et productifs. Ensuite, une période de récupération est nécessaire. Résultat clé : Travailler par sessions de 90 minutes suivies de pauses augmente l\'efficacité et réduit la fatigue mentale. Application pratique : Planifiez des tâches complexes pendant ces cycles et accordez-vous des pauses de 15 à 20 minutes.',
             'link' => 'https://evernote.com/fr-fr/blog/les-heures-les-plus-et-les-moins-productives-de-la-journee',
             'num_order' => 1
    ],
        
    [ 
            'id' => 12,
            'blog_posts_id' => 3,
            'titre' => 'L\'effet des interruptions sur la performance',
            'parag' => 'Cette recherche a étudié comment les interruptions (par exemple, des notifications) affectent la productivité. Résultat clé : Chaque interruption nécessite en moyenne 23 minutes pour retrouver pleinement sa concentration initiale. Les interruptions fragmentent la pensée et augmentent le stress. Application pratique : Éliminez les distractions numériques en utilisant des outils de focus ou en mettant votre téléphone en mode avion.',
            'link' => 'https://archipel.uqam.ca/4414/1/M12286.pdf',
            'num_order' => 2
    ],
        
        [
            'id' => 13,
            'blog_posts_id' => 3,
            'titre' => 'La lumière naturelle améliore la performance cognitive',
            'parag' => 'Cette étude a examiné comment l\'exposition à la lumière naturelle dans un environnement de travail influe sur la productivité. Résultat clé : Les employés exposés à la lumière naturelle dorment mieux (+46 minutes par nuit en moyenne) et sont 10 % plus productifs. Application pratique : Placez votre bureau près d\'une fenêtre ou investissez dans une lampe simulant la lumière naturelle.',
            'link' => 'https://www.sageglass.com/sites/default/files/les_benefices_caches_de_la_lumiere_naturelle.pdf',
            'num_order' => 3
    ],
        
    [ 
            'id' => 14,
            'blog_posts_id' => 3,
            'titre' => 'La méthode Pomodoro : la gestion du temps structurée',
             'parag' => 'Le "timeboxing" (comme la méthode Pomodoro) a été étudié dans de nombreux contextes. Résultat clé : Diviser son temps en sessions courtes (par exemple, 25 minutes de travail concentré suivies de 5 minutes de pause) aide à maintenir un haut niveau d\'énergie mentale. Application pratique : Utilisez des minuteurs pour structurer votre journée et évitez l\'épuisement.',
             'link' => 'https://www.unine.ch/blog/home/methodes/pomodoro.html',
             'num_order' => 4
    ],
        
        [ 
            'id' => 15,
            'blog_posts_id' => 3,
            'titre' => 'L\'influence de l\'exercice physique sur la productivité',
             'parag' => 'Cette méta-analyse a exploré le lien entre l\'activité physique et les performances cognitives. Résultat clé : 30 minutes d\'exercice modéré augmentent significativement les fonctions exécutives, notamment la prise de décision, la mémoire de travail et la concentration. Application pratique : Intégrez des séances d\'activité physique dans votre journée, même courtes, pour améliorer votre performance.',
             'link' => 'https://archipel.uqam.ca/12977/1/M15479.pdf',
             'num_order' => 5
    ],
        
 
        // Livres (ID 4)
        [ 
            'id' => 16,
            'blog_posts_id' => 4,
            'titre' => 'Getting Things Done (S\'organiser pour réussir) - David Allen',
         'parag' => 'Ce livre classique propose une méthode claire pour organiser ses tâches, réduire le stress et rester concentré. La méthode GTD (Getting Things Done) repose sur un système en cinq étapes : collecter, clarifier, organiser, réfléchir et engager. Pourquoi il est essentiel : Il offre des outils concrets pour capturer toutes vos idées et projets, les organiser dans des listes spécifiques et avancer efficacement. Idée clé : Libérer votre esprit des tâches à faire en externalisant vos pensées permet de mieux vous concentrer sur l\'action.',
         'link' => 'https://a.co/d/hzesrEe',
         'num_order' => 1],
        
        [ 
            'id' => 17,
            'blog_posts_id' => 4,
            'titre' => 'Atomic Habits (Un rien peut tout changer) - James Clear',
         'parag' => 'James Clear explore la puissance des petites habitudes et leur impact cumulatif sur le long terme. Il explique comment créer des routines positives et se défaire des mauvaises habitudes. Pourquoi il est essentiel : Ce livre démontre que la productivité passe souvent par de petites actions régulières plutôt que des efforts sporadiques. Idée clé : "Ce n\'est pas ce que vous faites une fois qui compte, mais ce que vous faites de manière cohérente."',
         'link' => 'https://amzn.eu/d/eZm64fI',
         'num_order' => 2],
        
        [ 
            'id' => 18,
            'blog_posts_id' => 4,
            'titre' => 'Deep Work (Travailler profondément) - Cal Newport',
         'parag' => 'Cal Newport met en lumière l\'importance du travail concentré dans un monde distrait. Il distingue le "deep work" (travail en profondeur) du "shallow work" (travail superficiel) et explique comment créer des conditions favorables à une concentration intense. Pourquoi il est essentiel : Il propose des stratégies pratiques pour minimiser les distractions et maximiser la productivité intellectuelle. Idée clé : La capacité à se concentrer profondément est une compétence rare et précieuse dans l\'économie moderne.',
         'link' => 'https://a.co/d/7GNTd1r',
         'num_order' => 3],
        
        [ 
            'id' => 19,
            'blog_posts_id' => 4,
            'titre' => 'The 7 Habits of Highly Effective People (Les 7 habitudes des gens efficaces) - Stephen R. Covey',
         'parag' => 'Ce livre intemporel explore les habitudes qui distinguent les personnes efficaces, comme la proactivité, la planification avec une vision claire et la capacité à prioriser l\'important sur l\'urgent. Pourquoi il est essentiel : Covey combine productivité personnelle et relations interpersonnelles pour un succès équilibré. Idée clé : "Commencez avec la fin en tête" pour aligner vos actions avec vos objectifs à long terme.',
         'link' => 'https://amzn.eu/d/ioOhfZf',
         'num_order' => 4],
        
        [ 
            'id' => 20,
            'blog_posts_id' => 4,
            'titre' => 'Make Time - Jake Knapp et John Zeratsky',
         'parag' => 'Ce livre propose une méthode simple pour échapper à la "course contre la montre" et consacrer du temps aux choses qui comptent vraiment. Les auteurs introduisent des concepts comme le "Highlight" (point culminant de la journée) et les micro-ajustements pour rester concentré. Pourquoi il est essentiel : Il s\'adresse à ceux qui cherchent à équilibrer productivité et vie personnelle sans s\'épuiser. Idée clé : Identifiez chaque jour une seule tâche prioritaire (votre "Highlight") et organisez votre temps autour de celle-ci.',
         'link' => 'https://amzn.eu/d/4uA2bI5',
         'num_order' => 5]
     ];


//------------------------------------------------------verification si la table contenue est vide
$sql = "SELECT COUNT(*) as count FROM contenue";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//------------------------------------------------------si la table est vide on inserer les données    c-a-d la premiere fois que on se connecte   
if ($row['count'] == 0) {
    $stmt_contenu = $conn->prepare("INSERT INTO contenue (id, blog_posts_id, titre, parag, link, num_order) VALUES (?, ?, ?, ?, ?, ?)");
    //------------------------------------------------------insertion du contenu
    foreach ($contenue as $section) {
        //utilisation de bind_param permet de lier les parametres de maniere securisee avant l'execution de la requete
        $stmt_contenu->bind_param("iisssi",
            $section['id'],
            $section['blog_posts_id'],
            $section['titre'],
            $section['parag'],
            $section['link'],
            $section['num_order']
        );
        if (!$stmt_contenu->execute()) {
            echo "Erreur lors de l'insertion : " . $stmt_contenu->error;
        }
    }
    $stmt_contenu->close();
}

//------------------------------------------------------selectionner les articles et le contenu
$sql = "SELECT bp.id, bp.title, bp.image, bp.laDate, bp.contenue,
               c.titre as subtitle, c.parag, c.link, c.num_order
        FROM blog_posts bp
        LEFT JOIN contenue c ON bp.id = c.blog_posts_id
        ORDER BY bp.id, c.num_order ASC" ;

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Erreur lors de l'execution de la requete : " . $stmt->error);
}   
$lignes = $result->fetch_all(MYSQLI_ASSOC);
//ici on a utuliser fetch_all pour recuperer toutes les lignes de la table contenuecar c'est une requete qui selectionne plusieurs lignes    
// c'est plus facile de recuperer toutes les lignes en une seule fois  que de faire une boucle while    
//MYSQLI_ASSOC : pour recuperer les resultats sous forme de tableau associatif


//------------------------------------------------------organiser les resultats par article
function organiser_articles($lignes) {
$articles = [];  //creation de tableau pour stocker les articles
foreach ($lignes as $ligne) { //boucle pour parcourir les lignes de la table contenue   
    $articleId = $ligne['id']; //stocker le id de article dans un variable.
    //------------------------------------------------------si c'est la première fois qu'on rencontre cet article
    if (!isset($articles[$articleId])) {
        $articles[$articleId] = [     //on stocke les infos de article dans un tableau  
            'id' => $ligne['id'],
            'title' => $ligne['title'],
            'image' => $ligne['image'],
            'date' => $ligne['laDate'],
            'contenue' => $ligne['contenue'],
            'sections' => []
        ];
    }
    
    //------------------------------------------------------ajouter la section si elle existe
    //dans les articles que je ajouter je ai fait 4 parties mais au futur on peut ajouter des articles avec plus de sections
    if (!empty($ligne['subtitle'])) {
        $articles[$articleId]['sections'][] = [
            'subtitle' => $ligne['subtitle'],
            'parag' => $ligne['parag'],
            'link' => $ligne['link'],
            'num_order' => $ligne['num_order']
        ];
    }
}
return $articles;
}
$articles = organiser_articles($lignes);


//-----------------------------------verifier si des articles existent si non on redirige vers la page blog 
if (empty($articles)) {
    header('Location: blog.php');
    exit();
}
$stmt->close();
//------------------------------------------------------recuperer le ID de article depuis le URL
$article_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

//------------------------------------------------------verifier si l'article existe
if (!$article_id || !isset($articles[$article_id])) {
    //!$article_id : si l'article n'existe pas - id est null
    //!isset($articles[$article_id]) : si l'article n'existe pas dans le tableau $articles
    header('Location: blog.php');
    exit();
}

//------------------------------------------------------recuperer l'article specifique
$article = $articles[$article_id];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- le  nom  de onglet est le titre de l'article   que on va le recuperer de la variable $article['title'] -->
    <title><?php echo htmlspecialchars($article['title']); ?> - FocusUp</title>
    <link rel="stylesheet" href="../websiteProject/css/article.css">
</head>
<body>
    <!-- le conteneur de l'article -->  
    <div class="container">
            <article class="full-article">
                <h1><?php echo htmlspecialchars($article['title']); ?></h1>
                <!-- l'image de l'article -->    
               <img src="<?php echo htmlspecialchars($article['image']); ?>" 
                    alt="<?php echo htmlspecialchars($article['title']); ?>" 
                    class="article-image">
                <!----------------------------------- la date de publication de l'article ------------------->    
                <div class="article-date">
                    <span class="date">
                        <?php echo htmlspecialchars($article['date']); ?>
                    </span>
                </div>
                <!-- -----------------------------le contenu de l'article------------------------------ -->        
                <div class="article-content">
                    <?php foreach ($article['sections'] as $section): ?>
                        <h2><?php echo htmlspecialchars($section['subtitle']); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($section['parag'])); ?></p>
                        <!-- nl2br : pour conserver les retours a la ligne dans le paragraphe   convertion de \n en <br> -->
                        <a href="<?php echo htmlspecialchars($section['link']); ?>" target="_blank">Lien de ressource externe</a>
                        <!-- target="_blank" pour ouvrir le lien dans une nouvelle page -->        
                    <?php endforeach; ?>
                    <!--  foreach / endforeach  : pour parcourir les sections de l'article  et afficher les titres et les paragraphes  -->
                </div>
                </article>
        <!----------------------------------- le lien de retour au page blog   ------------------->
        <div class="link">
            <a href="blog.php">Retour aux articles</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>  
</body>
</html>