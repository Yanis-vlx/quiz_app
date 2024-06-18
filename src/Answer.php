<?php
class Answer {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($question_id, $answer, $is_correct) {
        $stmt = $this->conn->prepare("INSERT INTO answers (question_id, answer, is_correct) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $question_id, $answer, $is_correct);
        return $stmt->execute();
    }

    public function read($question_id) {
        $stmt = $this->conn->prepare("SELECT * FROM answers WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $answer, $is_correct) {
        $stmt = $this->conn->prepare("UPDATE answers SET answer = ?, is_correct = ? WHERE id = ?");
        $stmt->bind_param("sii", $answer, $is_correct, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM answers WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function isCorrect($question_id, $answer_id) {
        $stmt = $this->conn->prepare("SELECT is_correct FROM answers WHERE question_id = ? AND id = ?");
        $stmt->bind_param("ii", $question_id, $answer_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['is_correct'];
    }
}
?>
