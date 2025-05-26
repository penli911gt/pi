<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nutriplan";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupère les données du formulaire
$nom = $_POST['name'];
$prenom = $_POST['prenom'];
$mail = $_POST['Text1'];
$message = $_POST['message'];

// Prépare et exécute la requête
$sql = "INSERT INTO help_support (nom, prenom, mail, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nom, $prenom, $mail, $message);

if ($stmt->execute()) {
    echo "Message envoyé avec succès !";
} else {
    echo "Erreur : " . $stmt->error;
}

$conn->close();
?>
