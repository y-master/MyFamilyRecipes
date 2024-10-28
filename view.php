<?php
// Connexion à la base de données
$db = new PDO('sqlite:recipes.db');

// Récupère l'ID de la recette depuis l'URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Requête pour récupérer la recette
$query = "SELECT * FROM recipes WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($recipe['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
    <p><strong>Ingrédients :</strong> <?php echo htmlspecialchars($recipe['ingredients']); ?></p>
    <p><a href="<?php echo htmlspecialchars($recipe['link']); ?>" target="_blank">Voir la recette en ligne</a></p>
    <?php if ($recipe['photo']): ?>
        <img src="uploads/<?php echo htmlspecialchars($recipe['photo']); ?>" alt="Photo de la recette">
    <?php endif; ?>
    <a href="index.php">Retour à la liste</a>
</body>
</html>
