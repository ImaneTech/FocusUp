<?php
include "db.php";
// ----------------------------------pour recuperer l'id de la tache a supprimer
$id = $_GET["id"];  //on recupere le id en parametre dans l'url
// ----------------------------------pour supprimer la tache
if ($id) { //si l'id est different de null
    $stmt = $conn->prepare("DELETE FROM todolist WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    //rediriger l'utilisateur a la page de la liste des taches
    header("Location: todo-list-page.php");
    exit();
}