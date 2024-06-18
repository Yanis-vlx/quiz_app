// src/Question.php
<?php
class Question {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($question, $category, $difficulty) {
        $stmt = $this->conn->prepare("INSERT INTO questions (question, category, difficulty) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $question, $category, $difficulty);
        return $stmt->execute();
    }

    public function read() {
        $result = $this->conn->query("SELECT * FROM questions");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readOne($id) {
        $stmt = $this->conn->prepare("SELECT * FROM questions WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $question, $category, $difficulty) {
        $stmt = $this->conn->prepare("UPDATE questions SET question = ?, category = ?, difficulty = ? WHERE id = ?");
        $stmt->bind_param("sssi", $question, $category, $difficulty, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
