<?php
class Comment extends Model {
    public function getByModelId($modelId) {
        $stmt = $this->db->prepare('
            SELECT c.*, u.username 
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.porsche_model_id = ?
            ORDER BY c.created_at DESC
        ');
        $stmt->execute([$modelId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM comments WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($data) {
        $stmt = $this->db->prepare('
            INSERT INTO comments (porsche_model_id, user_id, content)
            VALUES (?, ?, ?)
        ');
        return $stmt->execute([
            $data['porsche_model_id'],
            $data['user_id'],
            $data['content']
        ]);
    }

    public function update($id, $content) {
        $stmt = $this->db->prepare('
            UPDATE comments SET content = ? WHERE id = ?
        ');
        return $stmt->execute([$content, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM comments WHERE id = ?');
        return $stmt->execute([$id]);
    }
}