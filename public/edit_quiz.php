<?php
require_once '../config/db.php';
require_once '../src/Quiz.php';

$quizClass = new Quiz($conn);
$quiz = $quizClass->readOne($_GET['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Modifier Quiz</h1>
        <form action="../public/update_quiz.php" method="post">
            <input type="hidden" name="id" value="<?= $quiz['id'] ?>">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $quiz['title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= $quiz['description'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>
</html>
