<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($name, $email, $password, $role = 'student') {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashed,
            'role' => $role
        ]);
    }
    
    // Admin functions
    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT id, name, email, role, is_active, created_at FROM users ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function update($id, $name, $email, $role, $is_active) {
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name, email = :email, role = :role, is_active = :is_active WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'is_active' => $is_active
        ]);
    }
    
    public function updateWithPassword($id, $name, $email, $password, $role, $is_active) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE users SET name = :name, email = :email, password = :password, role = :role, is_active = :is_active WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $hashed,
            'role' => $role,
            'is_active' => $is_active
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
