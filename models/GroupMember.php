<?php
class GroupMember {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getMembers($group_id) {
        $stmt = $this->pdo->prepare("SELECT gm.*, u.name as user_name, u.email as user_email FROM group_members gm JOIN users u ON gm.user_id = u.id WHERE gm.group_id = :group_id ORDER BY gm.joined_at ASC");
        $stmt->execute(['group_id' => $group_id]);
        return $stmt->fetchAll();
    }
    
    public function isMember($group_id, $user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM group_members WHERE group_id = :group_id AND user_id = :user_id");
        $stmt->execute(['group_id' => $group_id, 'user_id' => $user_id]);
        return $stmt->fetch();
    }
    
    public function addMember($group_id, $user_id, $role = 'member') {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO group_members (group_id, user_id, role_in_group) VALUES (:group_id, :user_id, :role)");
            return $stmt->execute([
                'group_id' => $group_id,
                'user_id' => $user_id,
                'role' => $role
            ]);
        } catch (PDOException $e) {
            return false; // probably duplicate
        }
    }
    
    public function removeMember($group_id, $user_id) {
        $stmt = $this->pdo->prepare("DELETE FROM group_members WHERE group_id = :group_id AND user_id = :user_id");
        return $stmt->execute(['group_id' => $group_id, 'user_id' => $user_id]);
    }
}
?>
