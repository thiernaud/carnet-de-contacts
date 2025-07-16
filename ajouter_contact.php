<?php
require_once 'config.php';

if (isset($_POST['nom'], $_POST['email'], $_POST['telephone'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    try {
        $sql = "INSERT INTO contacts (nom, email, telephone) VALUES (:nom, :email, :telephone)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':telephone' => $telephone
        ]);

        header("Location: afficher_contacts.php");
        exit();

    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du contact : " . $e->getMessage();
    }
} else {
    echo "Tous les champs sont requis.";
}
?>
