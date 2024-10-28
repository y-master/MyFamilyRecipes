<?php
// Connexion à la base de données SQLite
$db = new PDO('sqlite:recipes.db');

// Requête de recherche
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM recipes WHERE title LIKE :search";
$stmt = $db->prepare($query);
$stmt->execute([':search' => '%' . $search . '%']);
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Recettes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Liste des Recettes</h1>
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Recherche de recettes..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Rechercher</button>
    </form>

    <ul>
        <?php foreach ($recipes as $recipe): ?>
            <li>
                <a href="view.php?id=<?php echo $recipe['id']; ?>">
                    <?php echo htmlspecialchars($recipe['title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="add.php">Ajouter une nouvelle recette</a>
</body>
</html>
