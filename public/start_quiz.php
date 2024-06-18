<?php
require_once '../config/db.php';
require_once '../src/Quiz.php';
require_once '../src/QuizQuestion.php';

if (!isset($_GET['id'])) {
    die('Quiz ID is missing');
}

$quiz_id = $_GET['id'];

$quiz = new Quiz($conn);
$quizQuestion = new QuizQuestion($conn);

$questions = $quizQuestion->getQuestionsForQuiz($quiz_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Start Quiz</h1>
        <div id="questions">
            <?php foreach ($questions as $question): ?>
                <div class="question" data-question-id="<?= $question['id'] ?>">
                    <h2><?= $question['question'] ?></h2>
                    <?php foreach ($question['options'] as $index => $option): ?>
                        <button class="answer-option" data-answer-id="<?= $index + 1 ?>"><?= $option ?></button>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="feedback" style="display: none;">
            <h2>Quiz Terminé!</h2>
            <p id="score"></p>
        </div>
        <div id="timer"></div>
    </div>
    <script>
    let currentQuestionIndex = 0;
    let score = 0;
    let totalQuestions = <?= count($questions) ?>;
    let timeLeft = 30;
    let timer;

    function showQuestion(index) {
        $('.question').hide();
        $('.question').eq(index).show();
        timeLeft = 30;
        $('#timer').text(timeLeft + ' seconds remaining');
        clearInterval(timer);
        timer = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(timer);
                alert('Time is up!');
                nextQuestion();
            } else {
                $('#timer').text(timeLeft + ' seconds remaining');
            }
            timeLeft -= 1;
        }, 1000);
    }

    function nextQuestion() {
        currentQuestionIndex++;
        if (currentQuestionIndex < totalQuestions) {
            showQuestion(currentQuestionIndex);
        } else {
            clearInterval(timer);
            showFeedback();
        }
    }

    function showFeedback() {
        $('#questions').hide();
        $('#feedback').show();
        $('#score').text('Your score is: ' + score + ' out of ' + totalQuestions);
    }

    $(document).ready(function() {
        showQuestion(currentQuestionIndex);

        $('.answer-option').click(function() {
            let questionId = $(this).closest('.question').data('question-id');
            let answerId = $(this).data('answer-id');
            
            $.ajax({
                url: 'validate_answer.php',
                type: 'POST',
                data: {
                    question_id: questionId,
                    answer_id: answerId
                },
                success: function(response) {
                    if (response.correct) {
                        alert('Correct!');
                        score++;
                    } else {
                        alert('Wrong!');
                    }
                    nextQuestion();
                }
            });
        });
    });
    </script>
</body>
</html>
