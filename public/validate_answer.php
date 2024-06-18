// public/validate_answer.php
<?php
require_once '../config/db.php';
require_once '../src/Answer.php';

$answer = new Answer($conn);
$correct = $answer->isCorrect($_POST['question_id'], $_POST['answer_id']);

echo json_encode(['correct' => $correct]);
?>
