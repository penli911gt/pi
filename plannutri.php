<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=nutriplan', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");

    $query = $pdo->query("SELECT pn.id_profil, pn.age, pn.poids, pn.objectif, pn.allergies, pn.preferences_alimentaires, 
                                r.nom_recette, r.temps_preparation, r.categorie
                         FROM profil_nutritionnel pn
                         LEFT JOIN recette r ON r.categorie = pn.preferences_alimentaires
                         ORDER BY pn.id_profil DESC");

    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Âge</th>
            <th>Poids (kg)</th>
            <th>Objectif</th>
            <th>Allergies</th>
            <th>Préférences</th>
            <th>Recettes recommandées</th>
          </tr>";

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $allergies = empty($row['allergies']) ? 'Aucune' : htmlspecialchars($row['allergies']);
        $recette = empty($row['nom_recette']) ? 'Non disponible' : htmlspecialchars($row['nom_recette']);
        
        echo "<tr>
                <td>" . htmlspecialchars($row['id_profil']) . "</td>
                <td>" . htmlspecialchars($row['age']) . "</td>
                <td>" . htmlspecialchars($row['poids']) . "</td>
                <td>" . htmlspecialchars($row['objectif']) . "</td>
                <td>" . $allergies . "</td>
                <td>" . htmlspecialchars($row['preferences_alimentaires']) . "</td>
                <td>" . $recette . "</td>
              </tr>";
    }

    echo "</table>";
} catch (PDOException $e) {
    echo "<p style='color:red;text-align:center;'>Erreur de connexion : " . $e->getMessage() . "</p>";
}
?>