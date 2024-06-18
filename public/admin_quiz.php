<!-- public/admin_quiz.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Gestion des Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Gestion des Quiz</h1>
        <form action="../public/process_quiz.php" method="post">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <h2>Liste des Quiz</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../config/db.php';
                require_once '../src/Quiz.php';
                $quizClass = new Quiz($conn);
                $quizzes = $quizClass->read();
                foreach ($quizzes as $quiz): ?>
                    <tr>
                        <td><?= $quiz['title'] ?></td>
                        <td><?= $quiz['description'] ?></td>
                        <td>
                            <a href="../public/edit_quiz.php?id=<?= $quiz['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="../public/delete_quiz.php?id=<?= $quiz['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
