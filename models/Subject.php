<?php
class Subject {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM subjects ORDER BY name ASC");
        return $stmt->fetchAll();
    }
    
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM subjects WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function create($name, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO subjects (name, description) VALUES (:name, :description)");
        return $stmt->execute([
            'name' => $name,
            'description' => $description
        ]);
    }
    
    public function update($id, $name, $description) {
        $stmt = $this->pdo->prepare("UPDATE subjects SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM subjects WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
