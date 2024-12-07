<?php
// ----------------------------------------  pour inclure le fichier db.php
include_once 'db.php';  //Permet d'utiliser la connexion $conn
// ----------------------------------------  pour demarrer la session   
session_start();
// ----------------------------------------  pour une session c'est comme une carte d'identite temporaire qui :
// Est unique pour chaque visiteur
// Stocke des informations pendant sa visite
// Permet de savoir si le visiteur est connecte ou non

// ----------------------------------------  pour verifier si l'utilisateur est connecte
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // ----------------------------------------  ici on verifie deux choses : Si la "carte d'identite" n'a pas de tampon "logged_in"  OU   si le tampon n'indique pas "true" (connecte)
    header("Location: connexion.php");
    exit(); // ----------------------------------------  pour arreter l'execution du reste du code si l'utilisateur n'est pas connecte
}
// ----------------------------------------  si l'utilisateur est connecte
// ----------------------------------------  pour recuperer l'id de l'utilisateur stocke dans la session afin de le reutiliser pour identifier l'utilisateur connecte 
$user_id = $_SESSION['user_id'];

// ----------------------------------------  pour recuperer les informations de l'utilisateur de la base de donnees 
$sql = "SELECT nom_complet, email FROM utilisateur WHERE ID_Utilisateur = '$user_id'";
$result = mysqli_query($conn,$sql);
if ($result) {
    if ( mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
    } else {
        $userData = null;
        echo "Aucune donnée trouvée pour l'ID : " . $user_id;
    }
} else {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
}
// Tableau associatif (cles : author, quote) des citations du jour
$quotes = [
    [
        "author" => "Albert Einstein",
        "quote" => "L'imagination est plus importante que le savoir."
    ],
    [
        "author" => "Elon Musk",
        "quote" => "Quand quelque chose est suffisamment important, vous le faites, même si les chances ne sont pas en votre faveur."
    ],
    [
        "author" => "Marie Curie",
        "quote" => "Rien dans la vie ne doit être craint, il doit seulement être compris."
    ],
    [
        "author" => "Steve Jobs",
        "quote" => "Votre travail va occuper une grande partie de votre vie, et la seule façon d'être vraiment satisfait est de faire ce que vous croyez être un excellent travail."
    ],
    [
        "author" => "Isaac Newton",
        "quote" => "Si j'ai vu plus loin, c'est en montant sur les épaules de géants."
    ],
    [
        "author" => "Nikola Tesla",
        "quote" => "Le présent leur appartient; l'avenir, pour lequel j'ai vraiment travaillé, est le mien."
    ],
    [
        "author" => "Thomas Edison",
        "quote" => "Le génie est un pour cent d'inspiration et quatre-vingt-dix-neuf pour cent de transpiration."
    ],
    [
        "author" => "Leonardo da Vinci",
        "quote" => "La simplicité est la sophistication ultime."
    ],
    [
        "author" => "Galilée",
        "quote" => "Vous ne pouvez rien enseigner à un homme; vous pouvez seulement l'aider à le découvrir en lui-même."
    ],
    [
        "author" => "Bill Gates",
        "quote" => "C'est bien de célébrer le succès, mais il est plus important de tirer les leçons de l'échec."
    ],
    [
        "author" => "Stephen Hawking",
        "quote" => "L'intelligence est la capacité de s'adapter au changement."
    ],
    [
        "author" => "Jeff Bezos",
        "quote" => "Votre marque est ce que les autres disent de vous lorsque vous n'êtes pas dans la pièce."
    ],
    [
        "author" => "Richard Feynman",
        "quote" => "Je préfère avoir des questions sans réponse que des réponses qui ne peuvent pas être remises en question."
    ],
    [
        "author" => "Oprah Winfrey",
        "quote" => "La plus grande aventure que vous pouvez entreprendre est de vivre la vie de vos rêves."
    ],
    [
        "author" => "Charles Darwin",
        "quote" => "Ce ne sont pas les espèces les plus fortes qui survivent, ni les plus intelligentes, mais celles qui s'adaptent le mieux au changement."
    ],
    [
        "author" => "Walt Disney",
        "quote" => "Le moyen de commencer est d'arrêter de parler et de commencer à faire."
    ],
    [
        "author" => "Sundar Pichai",
        "quote" => "Portez votre échec comme un insigne d'honneur !"
    ],
    [
        "author" => "Ada Lovelace",
        "quote" => "Ce cerveau à moi est quelque chose de plus qu'un simple mortel; comme le temps le montrera."
    ],
    [
        "author" => "Sheryl Sandberg",
        "quote" => "Si on vous offre une place dans une fusée, ne demandez pas quelle place ! Montez simplement à bord."
    ],
    [
        "author" => "Tim Berners-Lee",
        "quote" => "Le Web ne connecte pas seulement des machines, il connecte des gens."
    ],
    [
        "author" => "Mark Zuckerberg",
        "quote" => "Le plus grand risque est de ne prendre aucun risque."
    ],
    [
        "author" => "Nelson Mandela",
        "quote" => "Cela semble toujours impossible jusqu'à ce que ce soit fait."
    ],
    [
        "author" => "Margaret Mead",
        "quote" => "Ne doutez jamais qu'un petit groupe de citoyens réfléchis et engagés puisse changer le monde; en fait, c'est la seule chose qui l'ait jamais fait."
    ],
    [
        "author" => "Carl Sagan",
        "quote" => "Quelque part, quelque chose d'incroyable attend d'être connu."
    ],
    [
        "author" => "Jane Goodall",
        "quote" => "Ce que vous faites fait une différence, et vous devez décider quelle sorte de différence vous voulez faire."
    ],
    [
        "author" => "Elon Musk",
        "quote" => "La persistance est très importante. Vous ne devez pas abandonner à moins d'y être obligé."
    ],
    [
        "author" => "Grace Hopper",
        "quote" => "La phrase la plus dangereuse dans la langue est : 'Nous avons toujours fait comme ça.'"
    ],
    [
        "author" => "Ruth Bader Ginsburg",
        "quote" => "Battez-vous pour les choses auxquelles vous tenez, mais faites-le d'une manière qui incite les autres à vous rejoindre."
    ],
    [
        "author" => "Eleanor Roosevelt",
        "quote" => "L'avenir appartient à ceux qui croient en la beauté de leurs rêves."
    ],
    [
        "author" => "Alan Turing",
        "quote" => "Nous ne pouvons voir qu'une courte distance devant nous, mais nous pouvons voir beaucoup de choses qui doivent être faites."
    ]
];
// ----------------------------------------  pour creer la table si elle n'existe pas (une seule fois )
function creerTableCitations($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS quotes ( id INT AUTO_INCREMENT PRIMARY KEY, author VARCHAR(255) NOT NULL, quote TEXT NOT NULL)";
     $result=mysqli_query($conn,$sql);
     if(!$result){
        echo "Erreur lors de la création de la table : " . mysqli_error($conn);
     }
}

// ----------------------------------------  pour verifier si la table est vide
function verifierVide($conn) {
    $sql="SELECT COUNT(*) as cpt FROM quotes";  
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    return $row['cpt'] == 0;
}
// ----------------------------------------  pour inserer les citations si la table est vide
function insererCitations($conn, $quotes) {
    if (verifierVide($conn)) {
        //prepare : Prépare une requête SQL pour l'exécution future
        //INSERT INTO quotes (author, quote) VALUES (?, ?) : Insertion des auteurs et citations dans la table quotes
        $stmt = $conn->prepare("INSERT INTO quotes (author, quote) VALUES (?, ?)");
        //bind_param : Lie les variables à la requête SQL
        //ss : string, string
        //boucle foreach : Parcourt chaque élément du tableau $quotes 
        foreach ($quotes as $citation) {
            $stmt->bind_param("ss", $citation['author'], $citation['quote']);
            $stmt->execute();
            if(!$stmt->execute()){
                echo "Erreur lors de l'insertion des citations : " . $stmt->error;
            }   
        }
        $stmt->close();
    }
}
// ----------------------------------------  pour obtenir une citation aleatoire a partir des citations stockees dans la base de donnees
function obtenirCitationAleatoire($conn) {
    //Sélectionne une citation aléatoire dans la table quotes
    $sql="SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
    $result=mysqli_query($conn,$sql);
    return mysqli_fetch_assoc($result);
}
// ----------------------------------------  pour creer la table
creerTableCitations($conn); //creation de la table quotes   
// ----------------------------------------  pour inserer les citations dans la table
insererCitations($conn, $quotes); //insertion des citations dans la table quotes
$citation_aleatoire = obtenirCitationAleatoire($conn); //selection d'une citation a leatoire dans la table quotes
$result->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../websiteProject/css/template.css">
</head>
<body>
    <!-- ----------------------------------------  pour afficher la citation du jour--------------------------------- -->
    <div class="quote-container">
        <div class="quote-box">
            <h2 class="quote-title">Citation du Jour</h2>
        <div class="quote">
            <blockquote>
                <!-- ----------------------------------------  pour afficher la citation du jour stockee dans la variable (tableau associatif) $citation_aleatoire-->
                <span class="quote-text"><?php echo $citation_aleatoire['quote']; ?></span>
                <!-- ----------------------------------------  pour afficher l'auteur de la citation du jour stockee dans la variable (tableau associatif) $citation_aleatoire-->
                <div class="quote-author"><?php echo $citation_aleatoire['author']; ?></div>
            </blockquote>
        </div>
        </div>
    </div>
    <!--side-nav-->
        <div class="side-nav">
            <div class="logo">
                <!--Affiche l'icone de la logo stockée dans le dossier images-->
                <img src="../websiteProject/images/checkmark.png" alt="logo-icon" class="logo-icon">
                <!--Affiche la logo stockée dans le dossier images-->
                <img src="../websiteProject/images/logo.png" alt="logo" class="logo-img">
            </div>
            <ul class="nav-links">
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page home.php-->
                <li><img src="../websiteProject/images/home.png" alt="home"><a href="home.php"><p>Accueil</p></a></li>
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page todo-list-page.php-->
                <li><img src="../websiteProject/images/list.png" alt="list"><a href="todo-list-page.php"><p>TO-DO List</p></a></li>
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page pomodoro.php-->
                <li><img src="../websiteProject/images/pomodoro.png" alt="pomodoro"><a href="pomodoro.php"><p>Minuteur Pomodoro</p></a></li>
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page blog.php-->
                <li><img src="../websiteProject/images/blog.png" alt="blog"><a href="blog.php"><p>Blog</p></a></li>
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page add_article.php-->
                <li><img src="../websiteProject/images/add.png" alt="add"><a href="add_article.php"><p>Ajouter un article</p></a></li>
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page contact.php -->
                <li><img src="../websiteProject/images/contact-us.png" alt="contact"><a href="contact.php"><p>Contact</p></a></li>
            </ul>
            <ul class="nav-bottom">
                <div class="user-info">
                <!--htmlspecialchars : Convertit les caractères spéciaux en entités HTML pour éviter les attaques XSS (Cross-Site Scripting)
                ? : Opérateur de fusion null - retourne 'Utilisateur inconnu' si $userData['nom_complet'] n'existe pas -->
                    <!--Affiche le nom de l'utilisateur stocké dans la variable (tableau associatif) $userData-->
                    <h2 class="user-name"><?php echo htmlspecialchars(isset($userData['nom_complet']) ? $userData['nom_complet'] : 'Utilisateur inconnu'); ?></h2>
                    <!--Affiche l'email de l'utilisateur stocké dans la variable (tableau associatif) $userData-->
                    <p class="user-email"><?php echo htmlspecialchars(isset($userData['email']) ? $userData['email']: 'Email non disponible'); ?></p>
                </div>
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page profile.php-->
                <li><img src="../websiteProject/images/user.png" alt="user"><a href="profile.php"><p>Profile</p></a></li>
                <!--Affiche la logo stockée dans le dossier images avec un lien vers la page deconnexion.php-->
                <li><img src="../websiteProject/images/logout.png" alt="logout"><a href="deconnexion.php"><p>Logout</p></a></li>
            </ul>
        </div>
</body>
</html>