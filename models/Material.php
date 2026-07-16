<?php
class Material {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByGroup($group_id) {
        $stmt = $this->pdo->prepare("SELECT m.*, u.name as uploader_name FROM materials m JOIN users u ON m.uploaded_by = u.id WHERE m.group_id = :group_id ORDER BY m.created_at DESC");
        $stmt->execute(['group_id' => $group_id]);
        return $stmt->fetchAll();
    }
    
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM materials WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function create($group_id, $uploaded_by, $title, $description, $file_path, $file_type) {
        $stmt = $this->pdo->prepare("INSERT INTO materials (group_id, uploaded_by, title, description, file_path, file_type) VALUES (:group_id, :uploaded_by, :title, :description, :file_path, :file_type)");
        return $stmt->execute([
            'group_id' => $group_id,
            'uploaded_by' => $uploaded_by,
            'title' => $title,
            'description' => $description,
            'file_path' => $file_path,
            'file_type' => $file_type
        ]);
    }
    
    public function update($id, $title, $description) {
        $stmt = $this->pdo->prepare("UPDATE materials SET title = :title, description = :description WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM materials WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
