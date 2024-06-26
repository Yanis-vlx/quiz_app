<?php
require_once '../config/db.php';
require_once '../src/Quiz.php';

$quiz = new Quiz($conn);
$quizzes = $quiz->read();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Available Quizzes</h1>
        <ul class="list-group">
            <?php foreach ($quizzes as $quiz): ?>
                <li class="list-group-item">
                    <a href="start_quiz.php?id=<?= $quiz['id'] ?>"><?= $quiz['title'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
