<!-- public/admin.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Gestion des Questions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Questions</h1>
        <form action="../public/process_question.php" method="post">
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>
            <div class="form-group">
                <label for="category">Catégorie</label>
                <input type="text" class="form-control" id="category" name="category">
            </div>
            <div class="form-group">
                <label for="difficulty">Difficulté</label>
                <input type="text" class="form-control" id="difficulty" name="difficulty">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <h2>Liste des Questions</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Catégorie</th>
                    <th>Difficulté</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../config/db.php';
                require_once '../src/Question.php';
                $questionClass = new Question($conn);
                $questions = $questionClass->read();
                foreach ($questions as $question): ?>
                    <tr>
                        <td><?= $question['question'] ?></td>
                        <td><?= $question['category'] ?></td>
                        <td><?= $question['difficulty'] ?></td>
                        <td>
                            <a href="edit_question.php?id=<?= $question['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="delete_question.php?id=<?= $question['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
