<?php
session_start();
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Méthode non autorisée');
    }

    $pdo = new PDO('mysql:host=localhost;dbname=nutriplan', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");

    // Validate and sanitize input
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, array(
        "options" => array("min_range" => 1, "max_range" => 120)
    ));
    $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT, array(
        "options" => array("min_range" => 1, "max_range" => 500)
    ));
    $height = filter_input(INPUT_POST, 'height', FILTER_VALIDATE_FLOAT, array(
        "options" => array("min_range" => 30, "max_range" => 300)
    ));
    $allergies = filter_input(INPUT_POST, 'allergies', FILTER_SANITIZE_STRING);
    $goals = filter_input(INPUT_POST, 'goals', FILTER_SANITIZE_STRING);

    if (!$age || !$weight || !$height || !$goals) {
        throw new Exception('Données invalides');
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO profil_nutritionnel (id_utilisateur, age, poids, taille, objectif, allergies) VALUES (?, ?, ?, ?, ?, ?)");
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // Default to 1 if no session
    $stmt->execute([$userId, $age, $weight, $height, $goals, $allergies]);

    echo json_encode([
        'success' => true,
        'message' => 'Profil créé avec succès'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>