<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (empty($login) || empty($password)) {
        $error = "Les données d'authentification sont obligatoires.";
        header("Location: authentifier.php?error=" . urlencode($error));
        exit();
    }

   
    include('connexion.php');

  
    $sql = "SELECT * FROM administrateurs WHERE login = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        echo "Bienvenue, administrateur!";
     
    } else {
       
        $error = "Login ou mot de passe incorrect.";
        header("Location: authentifier.php?error=" . urlencode($error));
    }

    $stmt->close();
    $conn->close();
}
?>