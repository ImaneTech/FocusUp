
<?php
// ----------------------------------------  pour inclure le fichier template.php   
include 'template.php';
// ----------------------------------------  pour inclure le fichier db.php
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Pomodoro Timer</title>
    <link rel="stylesheet" href="../websiteProject/css/pomodoroo.css">
</head>
<body>
    <!-- ---------------------------------------- le contenu de la page -->
    <div class="container">
        <h1>Minuteur Pomodoro</h1>
        <hr>
        <!-- ----------------------------------------  pour afficher le minuteur -->        
        <p class="timer" id="timer">25:00</p>
        <!-- ----------------------------------------  pour afficher les boutons -->
        <div class="buttons">
            <!-- ----------------------------------------  pour demarrer le minuteur -->
            <button id="start">Démarrer</button>
            <!-- ----------------------------------------  pour mettre en pause le minuteur -->
            <button id="pause">Pause</button>
            <!-- ----------------------------------------  pour reinitialiser le minuteur -->
            <button id="reset">Réinitialiser</button>
    </div>
    </div>
    <!-- ----------------------------------------  pour inclure le fichier pomodoro.js -->  
    <script src="pomodoro.js"></script>
    <!-- ----------------------------------------  pour inclure le fichier footer.php -->
    <?php include 'footer.php'; ?>  
</body>
</html>