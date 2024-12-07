<?php
include 'template.php';
include_once 'db.php';

// ----------------------------------------  pour ajouter une tache
//lorsque le formulaire est soumis c-a-d lorsque l'utilisateur clique sur le bouton "Ajouter"  
if (isset($_POST["addtask"])) {
    $taskname = $_POST["taskname"];
    if (!empty($taskname)) {
        $sql = "INSERT INTO todolist (nom) VALUES('$taskname')";
        $result = mysqli_query($conn, $sql);
        // ----------------------------------------  pour rediriger apres l'insertion    
        //pour resoudre le probleme que le meme nom de tache soit ajouté plusieurs fois,chaque fois que l'utilisateur clique sur le bouton ajouter  
        //on redirige l'utilisateur a la meme page pour que la page soit rafraichie et la tache soit affichée   
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
// ----------------------------------------  pour par defaut isdone est 0 donc les taches sont ouvertes dans la base de donnees

// ----------------------------------------  pour afficher les taches ouvertes
$opentask = mysqli_query($conn,"SELECT * FROM todolist where isdone = 0");

// ----------------------------------------  pour afficher les taches terminees
$closedtask = mysqli_query($conn,"SELECT * FROM todolist where isdone = 1");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste de tâches</title>
    <link rel="stylesheet" href="../websiteProject/css/todo_list.css">
</head>
<body>

    <div class="container">
        <!-- formulaire pour ajouter une tache -->
        <form method="POST">
            <div class="form-container">
            <input type="text" name="taskname" placeholder="Nom de la tâche..." class="form-control">
                <button name="addtask" type="submit" class="addtask">Ajouter</button>
            </div>
        </form>
        <!-- ----------------------------------------  pour modifier une tache -->
        <?php 
    if (isset($_GET['id'])) {
        // ----------------------------------------  pour recuperer l'id de la tache a modifier a travers l'url
        $edit_id = $_GET['id'];
        $sql = "SELECT * FROM todolist WHERE id = $edit_id";
        $result = mysqli_query($conn, $sql);
        if ($result && $row = mysqli_fetch_assoc($result)) {
    ?>
        <!-- ----------------------------------------  pour creer le formulaire -->
        <form method="POST" action="update.php">
            <div class="form-container">
                <!-- value pour que le nom  de la tache soit affiche dans le champ de saisie -->
                <input value="<?= $row['nom'] ?? '' ?>" type="text" name="taskname" placeholder="Modifier la tâche..." class="form-control">
                <input type="hidden" name="id" value="<?= $edit_id ?>">
                <button name="update" type="submit" class="addtask">Mettre à jour</button>
            </div>
            </form>
        <?php }  }?>   
        <div class="tasklist">
                    <!-- ----------------------------------------  pour afficher les taches ouvertes -->
            <div class="part1">
                <h2 class="tasktitle">Liste des tâches ouvertes :</h2>
                <table class="table">
                <tr>
                <th>Nom de la tâche</th>
                <th>Actions</th>
                </tr>
                <!-- extraire liste de taches ouvertes   -->    
                <?php if (mysqli_num_rows($opentask) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($opentask)): ?>
                    <tr>
                    <td>- <?= $row["nom"] ?></td>
                    <td>
                        <!-- ----------------------------------------  pour creer les boutons -->
                    <div class="actions-container">
                        <a href="complete.php?id=<?= $row["id"] ?>" class="boutton terminer">Terminé</a>
                        <a href="delete.php?id=<?= $row["id"] ?>" class="boutton supprimer">Supprimer</a>
                        <a href="?id=<?= $row["id"] ?>" class="boutton modifier">Modifier</a>
                        <!-- ----------------------------------------  pour recuperer l'id de la tache a modifier -->
                    </div>
                    </td>
                    </tr>
                    <?php endwhile; ?>
                    <!-- ---------------------------------------------------Aucune tache ouverte trouvee :---------------- -->  
                <?php else: ?>
                <tr>
                <td>-Aucune tâche trouvée !!<td>
                </tr>
                <?php endif; ?>
                </table>
                </div>
                <!-- ----------------------------------------  pour afficher les taches terminees -->
        <div class="part2"  >
        <h2 class="tasktitle">Tâches terminées :</h2>
                <table class="table">
                <tr>
                <th>Nom de la tâche</th>   <!-- ---------------------------------------------------Nom de la tache :---------------- -->
                <th>Actions</th>                    <!-- ---------------------------------------------------Actions :---------------- -->   
                </tr>

                <!-- extraire liste de taches terminees   -->
                <?php if ($closedtask->num_rows > 0): ?>
                    <?php while ($row = $closedtask->fetch_assoc()): ?>
                    <tr>
                    <td><s><?= $row["nom"] ?></s></td>
                    <td>
                        <!-- ---------------------------------------------------Supprimer :---------------- --> 
                    <div class="actions-container">
                        <a href="delete.php?id=<?= $row["id"] ?>" class="boutton supprimer">Supprimer</a>
                    </div>
                    </td>
                    </tr>
                    <?php endwhile; ?>
                    <!-- ---------------------------------------------------Aucune tâche terminée trouvée :---------------- --> 
                <?php else: ?>
                        <tr>
                        <td>
                        -Aucune tâche terminée trouvée !!
                        <td>
                        <tr>
                <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
        <!-- ----------------------------------------  pour inclure le fichier footer.php -->
    <?php include 'footer.php'; ?>  
</body>
</html>