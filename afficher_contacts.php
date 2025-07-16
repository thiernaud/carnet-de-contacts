<?php
require_once 'config.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $sql = "SELECT * FROM contacts WHERE nom LIKE :search OR email LIKE :search OR telephone LIKE :search ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => "%$search%"]);
} else {
    $sql = "SELECT * FROM contacts ORDER BY id DESC";
    $stmt = $pdo->query($sql);
}

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des contacts</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            background-color: #e0f7ff;
            padding: 20px;
        }
        h1 {
            font-family: Algerian, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: white;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #d3eaff;
        }
        a.btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a.btn:hover {
            background-color: #0056b3;
        }
        .delete {
            color: red;
            text-decoration: none;
            font-weight: bold;
        
        }
         
        .search-form {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
    align-items: center;
}
.search-form label {
    font-size: 20px;
}
          .search-form button {
    padding: 8px 16px;
    background-color: #007BFF;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}


    </style>
</head>
<body>

    <h1>Liste des contacts</h1>
    <a class="btn" href="form.html">Ajouter un contact</a>
     <form method="GET" action="afficher_contacts.php" class="search-form">
    <input type="text" id="search" name="search" placeholder="Rechercher un contact..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Rechercher</button>
</form>



    <table>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Action</th>
        </tr>

        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= htmlspecialchars($contact['nom']) ?></td>
                <td><?= htmlspecialchars($contact['email']) ?></td>
                <td><?= htmlspecialchars($contact['telephone']) ?></td>
                <td><a class="delete" href="supprimer_contact.php?id=<?= $contact['id'] ?>" onclick="return confirm('Supprimer ce contact ?')">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
