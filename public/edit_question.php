<!-- public/edit_question.php -->
<?php
require_once '../config/db.php';
require_once '../src/Question.php';

$questionClass = new Question($conn);
$question = $questionClass->readOne($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Modifier Question</h1>
        <form action="../public/update_question.php" method="post">
            <input type="hidden" name="id" value="<?= $question['id'] ?>">
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" value="<?= $question['question'] ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Catégorie</label>
                <input type="text" class="form-control" id="category" name="category" value="<?= $question['category'] ?>">
            </div>
            <div class="form-group">
                <label for="difficulty">Difficulté</label>
                <input type="text" class="form-control" id="difficulty" name="difficulty" value="<?= $question['difficulty'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>
</html>
