<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: authe.php");
    exit();
}

include('connexion.php');

$nom = trim($_POST['nom']);
$prenom = trim($_POST['prenom']);
$filiere = intval($_POST['filiere']);
$image = $_FILES['image'];

$target_dir = "images/";
$target_file = $target_dir . basename($image["name"]);
move_uploaded_file($image["tmp_name"], $target_file);

$sql = "INSERT INTO stagiaires (nom, prenom, filiere, image) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $nom, $prenom, $filiere, $target_file);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: espaceprivee.php");
?>