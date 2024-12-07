<?php
// ---------------------------------------------------Pour modifier une tache :---------------- -->
// ---------------------------------------------------include la connexion a la base de donnees :---------------- -->   
include "db.php";

// ---------------------------------------------------Si le formulaire est soumis  le utilisateur clique sur le bouton modifier  :---------------- --> 
if (isset($_POST["update"])) {
    $id = $_POST["id"];          // ---------------------------------------------------recuperer l'id de la tache a modifier :---------------- -->
    $taskname = $_POST["taskname"]; // ---------------------------------------------------recuperer le nom de la tache a modifier :---------------- --> 
    // ---------------------------------------------------verifier si le nom de la tache n'est pas vide :---------------- --> 
    if (!empty($taskname)) {
         // --------------------------------mettre a jour le nom de la tache dans la base de donnees :---------------- -->
          $sql = "UPDATE todolist SET nom = '$taskname' WHERE id = $id";
          $result = mysqli_query($conn, $sql);
    }
}
// ---------------------------------------------------rediriger l'utilisateur a la page de la liste des taches :---------------- -->
header("Location: todo-list-page.php");
exit();
?>