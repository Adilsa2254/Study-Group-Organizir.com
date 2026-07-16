<?php
class Comment {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByMaterial($material_id) {
        $stmt = $this->pdo->prepare("SELECT c.*, u.name as user_name FROM comments c JOIN users u ON c.user_id = u.id WHERE c.material_id = :material_id ORDER BY c.created_at ASC");
        $stmt->execute(['material_id' => $material_id]);
        return $stmt->fetchAll();
    }
    
    public function create($material_id, $user_id, $comment_text) {
        $stmt = $this->pdo->prepare("INSERT INTO comments (material_id, user_id, comment_text) VALUES (:material_id, :user_id, :comment_text)");
        return $stmt->execute([
            'material_id' => $material_id,
            'user_id' => $user_id,
            'comment_text' => $comment_text
        ]);
    }
    
    public function update($id, $comment_text) {
        $stmt = $this->pdo->prepare("UPDATE comments SET comment_text = :comment_text WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'comment_text' => $comment_text
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM comments WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
?>
