<?php
class Schedule {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByGroup($group_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM schedules WHERE group_id = :group_id ORDER BY start_time ASC");
        $stmt->execute(['group_id' => $group_id]);
        return $stmt->fetchAll();
    }
    
    public function getUpcomingByGroups($group_ids, $limit = 5) {
        if (empty($group_ids)) return [];
        
        $placeholders = implode(',', array_fill(0, count($group_ids), '?'));
        
        $sql = "SELECT s.*, sg.name as group_name FROM schedules s JOIN study_groups sg ON s.group_id = sg.id WHERE s.group_id IN ($placeholders) AND s.start_time >= NOW() ORDER BY s.start_time ASC LIMIT $limit";
        
        $stmt = $this->pdo->prepare($sql);
        $params = array_values($group_ids);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM schedules WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function create($group_id, $title, $description, $start_time, $end_time, $location, $meeting_link, $created_by) {
        $stmt = $this->pdo->prepare("INSERT INTO schedules (group_id, title, description, start_time, end_time, location, meeting_link, created_by) VALUES (:group_id, :title, :description, :start_time, :end_time, :location, :meeting_link, :created_by)");
        return $stmt->execute([
            'group_id' => $group_id,
            'title' => $title,
            'description' => $description,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'location' => $location,
            'meeting_link' => $meeting_link,
            'created_by' => $created_by
        ]);
    }
    
    public function update($id, $title, $description, $start_time, $end_time, $location, $meeting_link) {
        $stmt = $this->pdo->prepare("UPDATE schedules SET title = :title, description = :description, start_time = :start_time, end_time = :end_time, location = :location, meeting_link = :meeting_link WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'location' => $location,
            'meeting_link' => $meeting_link
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM schedules WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
