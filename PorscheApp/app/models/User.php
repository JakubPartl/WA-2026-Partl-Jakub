<?php
class User extends Model {
    public function findByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($data) {
        $stmt = $this->db->prepare('
            INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)
        ');
        return $stmt->execute([
            $data['username'],
            $data['email'],
            $data['password']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare('
            UPDATE users SET username = ?, email = ?, bio = ?, avatar = ?
            WHERE id = ?
        ');
        return $stmt->execute([
            $data['username'],
            $data['email'],
            $data['bio'],
            $data['avatar'],
            $id
        ]);
    }

    public function updatePassword($id, $password) {
        $stmt = $this->db->prepare('
            UPDATE users SET password = ? WHERE id = ?
        ');
        return $stmt->execute([$password, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function getAll() {
        $stmt = $this->db->prepare('SELECT * FROM users ORDER BY created_at DESC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function search($query) {
    $stmt = $this->db->prepare('
        SELECT * FROM users WHERE username LIKE ?
    ');
    $stmt->execute(['%' . $query . '%']);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}