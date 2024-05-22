<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: authe.php");
    exit();
}

include('connexion.php');

$login = $_SESSION['login'];
$sql = "SELECT nom, prenom FROM administrateurs WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->bind_result($nom, $prenom);
$stmt->fetch();
$stmt->close();

$heure = date('H');
if ($heure < 18) {
    $salutation = "Bonjour";
} else {
    $salutation = "Bonsoir";
}

$sql = "SELECT id, nom, prenom, filiere FROM stagiaires";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Privé</title>
</head>
<body>
    <h2><?php echo $salutation . ", " . htmlspecialchars($prenom) . " " . htmlspecialchars($nom); ?>!</h2>
    <a href="insererStagiaire.php">Ajouter</a>
    <a href="deconnecter.php">Se déconnecter</a>
    <h3>Liste des stagiaires</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Filière</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                <td><?php echo htmlspecialchars($row['filiere']); ?></td>
                <td>
                    <a href="ModifierStagiaire.php?id=<?php echo $row['id']; ?>">Modifier</a>
                    <a href="SupprimerStagiaire.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce stagiaire ?');">Supprimer</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>