<?php
require_once '../config/db.php';
require_once '../src/Question.php';

$question = new Question($conn);
$question->delete($_GET['id']);

header("Location: ../public/admin.php");
?>
