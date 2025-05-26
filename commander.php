<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "nutriplan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Sécurisé
$methode = $_POST['methode_de_payment'];

$sql = "INSERT INTO commander (nom, prenom, mot_de_passe, methode_de_payment) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nom, $prenom, $mot_de_passe, $methode);

if ($stmt->execute()) {
    echo "Commande enregistrée avec succès !";
} else {
    echo "Erreur : " . $stmt->error;
}

$conn->close();
?>
