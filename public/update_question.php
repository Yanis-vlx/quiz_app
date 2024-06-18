<?php
require_once '../config/db.php';
require_once '../src/Question.php';

$question = new Question($conn);
$question->update($_POST['id'], $_POST['question'], $_POST['category'], $_POST['difficulty']);

header("Location: ../public/admin.php");
?>
