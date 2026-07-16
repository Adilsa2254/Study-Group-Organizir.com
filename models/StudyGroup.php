<?php
class StudyGroup {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll($subject_id = null, $keyword = null) {
        $sql = "SELECT sg.*, s.name as subject_name, u.name as creator_name, 
                (SELECT COUNT(*) FROM group_members WHERE group_id = sg.id) as member_count 
                FROM study_groups sg 
                JOIN subjects s ON sg.subject_id = s.id 
                JOIN users u ON sg.created_by = u.id WHERE 1=1";
        
        $params = [];
        if ($subject_id) {
            $sql .= " AND sg.subject_id = :subject_id";
            $params['subject_id'] = $subject_id;
        }
        if ($keyword) {
            $sql .= " AND (sg.name LIKE :keyword OR sg.description LIKE :keyword)";
            $params['keyword'] = '%' . $keyword . '%';
        }
        $sql .= " ORDER BY sg.created_at DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function getJoinedGroups($user_id) {
        $sql = "SELECT sg.*, s.name as subject_name, 
                (SELECT COUNT(*) FROM group_members WHERE group_id = sg.id) as member_count
                FROM study_groups sg 
                JOIN subjects s ON sg.subject_id = s.id 
                JOIN group_members gm ON sg.id = gm.group_id 
                WHERE gm.user_id = :user_id 
                ORDER BY sg.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT sg.*, s.name as subject_name, u.name as creator_name, (SELECT COUNT(*) FROM group_members WHERE group_id = sg.id) as member_count FROM study_groups sg JOIN subjects s ON sg.subject_id = s.id JOIN users u ON sg.created_by = u.id WHERE sg.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($subject_id, $name, $description, $max_members, $created_by) {
        $stmt = $this->pdo->prepare("INSERT INTO study_groups (subject_id, name, description, max_members, created_by) VALUES (:subject_id, :name, :description, :max_members, :created_by)");
        $stmt->execute([
            'subject_id' => $subject_id,
            'name' => $name,
            'description' => $description,
            'max_members' => $max_members,
            'created_by' => $created_by
        ]);
        return $this->pdo->lastInsertId();
    }
    
    public function update($id, $subject_id, $name, $description, $max_members) {
        $stmt = $this->pdo->prepare("UPDATE study_groups SET subject_id = :subject_id, name = :name, description = :description, max_members = :max_members WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'subject_id' => $subject_id,
            'name' => $name,
            'description' => $description,
            'max_members' => $max_members
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM study_groups WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
