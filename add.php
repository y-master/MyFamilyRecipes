<?php
// Connexion à la base de données
$db = new PDO('sqlite:bdd/recipes.db');


// Gestion de l'envoi du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $link = $_POST['link'];

    // Gestion de l'upload de la photo
    $photo = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $photo);
    }

    // Insertion de la recette dans la base de données
    $query = "INSERT INTO recipes (title, ingredients, link, photo) VALUES (:title, :ingredients, :link, :photo)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':title' => $title,
        ':ingredients' => $ingredients,
        ':link' => $link,
        ':photo' => $photo
    ]);

    // Redirection après l'ajout
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une recette</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Ajouter une nouvelle recette</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" required>

        <label for="ingredients">Ingrédients :</label>
        <textarea name="ingredients" id="ingredients" required></textarea>

        <label for="link">Lien vers la recette :</label>
        <input type="url" name="link" id="link">

        <label for="photo">Photo de la recette :</label>
        <input type="file" name="photo" id="photo">

        <button type="submit">Ajouter la recette</button>
    </form>

    <a href="index.php">Retour à la liste</a>
</body>
</html>
