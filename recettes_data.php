<?php
header('Content-Type: application/json');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=nutriplan', 'utilisateur', 'motdepasse');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id_recette, nom_recette, instructions, temps_preparation, categorie, image_url, commentaire FROM recette");
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($recipes);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur de connexion: ' . $e->getMessage()]);
}
?>
