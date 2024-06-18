// public/delete_quiz.php
<?php
require_once '../config/db.php';
require_once '../src/Quiz.php';

$quiz = new Quiz($conn);
$quiz->delete($_GET['id']);

header("Location: ../public/admin_quiz.php");
?>
