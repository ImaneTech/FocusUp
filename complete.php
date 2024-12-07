<?php
include "db.php";
//------------------pour recuperer l'id de la tache a mettre a jour
$id = $_GET["id"]; //recuperer l'id de la tache a mettre a jour a partir de la requete GET  
//------------------pour mettre a jour la tache en terminée
if ($id) { //si l'id est different de null
    $stmt = $conn->prepare("UPDATE todolist SET isdone = 1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close(); 
    //------------------rediriger l'utilisateur a la page de la liste des taches
    header("Location: todo-list-page.php");
    exit();
}