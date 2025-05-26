ki tetbadel el base de donnee twalli mandher e5er
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=nutriplan', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");

    // Add query with proper filtering and ordering
    $query = $pdo->query("SELECT id_recette, nom_recette, instructions, temps_preparation, categorie, image_url, commentaire 
                         FROM recette 
                         ORDER BY nom_recette ASC");
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Recettes - NutriPlan</title>
  <link rel="stylesheet" href="stylev.css" />
  <style>
    .recipes-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      padding: 20px;
    }
    .recipe-box {
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      background-color: #fff;
      text-align: center;
    }
    .recipe-box img {
      max-width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 6px;
      margin-bottom: 10px;
    }
    .recipe-box h3 {
      margin: 10px 0 8px 0;
      font-size: 1.2em;
    }
    .recipe-box p {
      font-size: 0.95em;
      color: #555;
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <ul class="navbar">
        <li><a href="connexion.html">Connexion</a></li>
        <li><a href="essayage.html">Profil Nutritionnel</a></li>
        <li><a href="menu.html">Menu</a></li>
        <li><a href="plan_de_repas.html">Plan de Repas</a></li>
        <li><a href="recettes.php">Recettes</a></li>
        <li><a href="purchase.html">Commande</a></li>
        <li><a href="#" id="helpSupportLink">Aide & Support</a></li>
        <li><a href="https://www.instagram.com/nutriplan_officiel">Instagram</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="recipes-container">
      <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)): ?>
        <article class="recipe-box">
          <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['nom_recette']) ?>" />
          <h3><?= htmlspecialchars($row['nom_recette']) ?></h3>
          <p><strong>Instructions:</strong> <?= nl2br(htmlspecialchars($row['instructions'])) ?></p>
          <p><strong>Temps Préparation:</strong> <?= htmlspecialchars($row['temps_preparation']) ?> min</p>
          <p><strong>Catégorie:</strong> <?= htmlspecialchars($row['categorie']) ?></p>
          <p><strong>Commentaire:</strong> <?= nl2br(htmlspecialchars($row['commentaire'])) ?></p>
        </article>
      <?php endwhile; ?>
    </section>
  </main>
  <div id="modalsContainer"></div>
  <script src="help&support.js"></script>
  <script>
    // Load modals.html content into modalsContainer div
    fetch('modals.html')
      .then(response => response.text())
      .then(html => {
        document.getElementById('modalsContainer').innerHTML = html;

        // Help & Support modal elements
        const helpSupportModal = document.getElementById('helpSupportModal');
        const closeHelpSupportModal = document.getElementById('closeHelpSupportModal');
        const helpSupportLink = document.getElementById('helpSupportLink');

        helpSupportLink.addEventListener('click', function(event) {
          event.preventDefault();
          helpSupportModal.style.display = 'block';
        });

        closeHelpSupportModal.onclick = function() {
          helpSupportModal.style.display = 'none';
        };

        window.onclick = function(event) {
          if (event.target == helpSupportModal) {
            helpSupportModal.style.display = 'none';
          }
        };
      })
      .catch(err => {
        console.error('Failed to load modals.html:', err);
      });
  </script>
</body>
</html>
