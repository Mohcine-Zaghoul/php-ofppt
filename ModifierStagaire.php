<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: authe.php");
    exit();
}

include('connexion.php');

$id = intval($_GET['id']);
$sql = "SELECT * FROM stagiaires WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$stagiaire = $result->fetch_assoc();
$stmt->close();

$sql = "SELECT id, intitule FROM filieres";
$filieres = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Stagiaire</title>
</head>
<body>
    <h2>Modifier les informations du stagiaire</h2>
    <form action="ModifierStagiaireAction.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $stagiaire['id']; ?>">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($stagiaire['nom']); ?>"><br><br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($stagiaire['prenom']); ?>"><br><br>
        <label for="filiere">Filière:</label>
        <select id="filiere" name="filiere">
            <?php while ($row = $filieres->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $stagiaire['filiere']) echo 'selected'; ?>><?php echo htmlspecialchars($row['intitule']); ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">