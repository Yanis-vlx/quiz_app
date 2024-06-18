<?php
class Quiz {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($title, $description) {
        $stmt = $this->conn->prepare("INSERT INTO quizzes (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);
        return $stmt->execute();
    }

    public function read() {
        $result = $this->conn->query("SELECT * FROM quizzes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readOne($id) {
        $stmt = $this->conn->prepare("SELECT * FROM quizzes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $title, $description) {
        $stmt = $this->conn->prepare("UPDATE quizzes SET title = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title, $description, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM quizzes WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
