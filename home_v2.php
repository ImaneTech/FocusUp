<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
        <title>Accueil</title>
        <link rel="stylesheet" href="../websiteProject/css/footerr.css">
    <style>
        /* ----------------------------------style de la page */    
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Indie Flower", cursive;
        }
        
        body {
            background: rgb(191,174,238);
            background: linear-gradient(90deg, rgba(191,174,238,1) 0%, rgba(148,187,233,1) 100%);
            padding: 20px;
        }

        html, body{
            width: 100%;
            height: 100vh;
        }
        /* ----------------------------------style de logo*/ 
        .header {
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .logo-website {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-website .icon {
            height: 50px;
            width: auto;
        }

        .logo-website .logo {
            height: 80px;
            width: auto;
        }
        /* ----------------------------------style de la partie principale de la page */
        .main-content {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            border-radius: 15px;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
            margin-left: 100px;
            margin-right: 100px;
            margin-top: 35px;
        }

        .new-user-container {
            padding: 20px;
        }

        .intro-text {
            margin: 20px 0;
            line-height: 1.6;
            color: #333;
        }
        /* ----------------------------------style des boutons */
        .buttons-container {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .button{
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .signup{
            background-color: #007bff;
            color: white;
        }

        .login{
            background-color: #6c757d;
            color: white;
        }
        /* ----------------------------------style du hover */
        .button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        /* ----------------------------------style de la section vidéo tutorielle */
        .tutorial-container {
            padding: 20px;
        }
        /* ----------------------------------style de la video */
        .video-wrapper {
            width: 100%;
        }
        /* ----------------------------------style du titre de la video */  
        .video-wrapper h2 {
            margin-bottom: 20px;
        }
        /* ----------------------------------style de la video */   
        .video-placeholder {
            width: 100%;
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            background-color: #f8f9fa;
            border-radius: 8px;
            overflow: hidden; 
        }
        .video-placeholder iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover; /*pour que la video soit couvrir la video-placeholder*/  
        }

    </style>
</head>
<body>
    <!-- ---------------------------------------- logo-->
    <header class="header">
        <div class="logo-website">
            <img src="../websiteProject/images/checkmark.png" alt="Icon" class="icon">
            <img src="../websiteProject/images/logo.png" alt="Logo" class="logo">
        </div>
    </header>
    <!-- ---------------------------------------- la partie principale de la page -->    
    <div class="main-content">
         <!-- Section pour nouveau utilisateur -->
         <div class="new-user-container">
            <h1>Bienvenue sur FocusUp</h1>
            <!-- ----------------------------------------  texte -->
            <p class="intro-text">
                Découvrez une nouvelle façon de gérer votre temps et augmenter votre productivité.
                Rejoignez-nous dès maintenant!
            </p>
            <!-- ----------------------------------------  boutons -->
            <div class="buttons-container">
                <a href="inscription.php" class="button signup">S'inscrire</a>
                <a href="connexion.php" class="button login">Se connecter</a>
            </div>
        </div>
        
         <!-- ----------------------------------------  vidéo tutorielle -->
         <div class="tutorial-container">
            <div class="video-wrapper">
                <h2>Guide Tutoriel FocusUp</h2>
                <div class="video-placeholder">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/p5um7s7VHQE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>      
        </div>
    </div>
</body>
</html>
