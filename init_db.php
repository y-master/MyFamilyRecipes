<?php
try {
    // Crée la base de données SQLite
    $db = new PDO('sqlite:bdd/recipes.db');

    // Crée la table des recettes
    $db->exec("CREATE TABLE IF NOT EXISTS recipes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT,
        ingredients TEXT,
        link TEXT,
        photo TEXT
    )");
    
    echo "Base de données et table créées avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
