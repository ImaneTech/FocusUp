<?php
include 'template.php';
include_once 'db.php';
// 1. Creation de la table contact si elle n'existe pas 
$sql="CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL
)";
if ($conn->query($sql) === false) {
    echo "Erreur lors de la création de la table: " . $conn->error;
}
$errorMsg='';
$successMsg='';
// 2. Insertion des donnees dans la table contact   
if (isset($_POST["submit"])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        // ----------------------------------Afficher l'erreur de message   
        $errorMsg = "Veuillez remplir tous les champs.";
    }else{
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $_POST['message']);
    if ($stmt->execute()) {
        // ----------------------------------Afficher le message de succes  
        $successMsg = "Message envoyé avec succès!";
    } else {
        // ----------------------------------Afficher l'erreur de message     
        $errorMsg = "Erreur lors de l'envoi du message.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="../websiteProject/css/contact.css">
</head>
<body>
    <div class="container">
        <h1>Contact</h1>
        <div class="content">
            <div class="contact-form">
                <form action="contact.php" method="POST">
                    <div class="form-group">
                        <!-- -------------------------------------le nom -->
                        <label for="name">Nom:</label>
                        <input type="text" name="name" id="name" placeholder="Votre nom" required>
                    </div>   
                    <div class="form-group">
                        <!-- -----------------------------------------le email -->
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Votre email" required>
                    </div>
                    <div class="form-group">
                        <!-- -------------------------------------le message -->
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" placeholder="Votre message" required></textarea>
                    </div>  
                    <div class="button-group">
                        <!-- --------------------------------le bouton pour annuler -->
                        <button type="reset" class="reset-button">Annuler</button>
                        <!-- -------------------------------le bouton pour envoyer -->
                        <button type="submit" name="submit" class="submit-button">Envoyer</button>
                    </div>
                </form>
                <!-- ----------------------------------Afficher l'erreur de message -->
                <?php if (!empty($errorMsg)) { ?>   
                    <div class="errorMsg"><?php echo $errorMsg; ?></div>
                <?php } ?>
                <!-- ----------------------------------Afficher le message de succes -->
                <?php if (!empty($successMsg)) { ?>
                    <div class="successMsg"><?php echo $successMsg; ?></div>
                <?php } ?>
            </div>
            <!-- ----------------------------------Afficher la photo de contact --> 
            <div class="photo">
                <img src="../websiteProject/images/contacter-nous.png" alt="contact-us">
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>  
</body>
</html>
