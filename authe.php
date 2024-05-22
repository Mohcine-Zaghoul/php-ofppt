<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    
    <title>Authentification</title>
</head>
<body>
    <h2>Authentification de l'administrateur</h2>
    <?php
    if (isset($_GET['error'])) {
        echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
    <form action="verifier_authentification.php" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login"><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>