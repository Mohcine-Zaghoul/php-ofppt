<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: authe.php");
    exit();
}

include('connexion.php');


$sql = "SELECT id, intitule FROM filieres";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Insérer Stagiaire</title>
</head>
<body>
    <h2>Ajouter un nouveau stagiaire</h2>
    <form action="insererStagiaireAction.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom"><br><br>
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom"><br><br>
        <label for="filiere">Filière:</label>
        <select id="filiere" name="filiere">
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['intitule']); ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br><br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>