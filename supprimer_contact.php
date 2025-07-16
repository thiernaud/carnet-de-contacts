<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        header("Location: afficher_contacts.php");
        exit();

    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    echo "ID du contact manquant.";
}
?>
