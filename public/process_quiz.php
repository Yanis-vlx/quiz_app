// public/process_quiz.php
<?php
require_once '../config/db.php';
require_once '../src/Quiz.php';

$quiz = new Quiz($conn);
$quiz->create($_POST['title'], $_POST['description']);

header("Location: ../public/admin_quiz.php");
?>
