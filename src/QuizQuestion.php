<?php
class QuizQuestion {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addQuestionToQuiz($quiz_id, $question_id) {
        $stmt = $this->conn->prepare("INSERT INTO quiz_questions (quiz_id, question_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $quiz_id, $question_id);
        return $stmt->execute();
    }

    public function removeQuestionFromQuiz($quiz_id, $question_id) {
        $stmt = $this->conn->prepare("DELETE FROM quiz_questions WHERE quiz_id = ? AND question_id = ?");
        $stmt->bind_param("ii", $quiz_id, $question_id);
        return $stmt->execute();
    }

    public function getQuestionsForQuiz($quiz_id) {
        $stmt = $this->conn->prepare("SELECT q.id, q.question, q.category, q.difficulty, 
                                      (SELECT GROUP_CONCAT(a.answer SEPARATOR '|') FROM answers a WHERE a.question_id = q.id) as options
                                      FROM questions q JOIN quiz_questions qq ON q.id = qq.question_id WHERE qq.quiz_id = ?");
        $stmt->bind_param("i", $quiz_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($result as &$question) {
            $question['options'] = explode('|', $question['options']);
        }

        return $result;
    }
}
?>
