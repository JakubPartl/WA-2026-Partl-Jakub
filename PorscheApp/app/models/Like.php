<?php
class Like extends Model {
    public function toggle($userId, $modelId) {
        if ($this->hasLiked($userId, $modelId)) {
            $stmt = $this->db->prepare('DELETE FROM likes WHERE user_id = ? AND porsche_model_id = ?');
            $stmt->execute([$userId, $modelId]);
            return false; // odlajkováno
        } else {
            $stmt = $this->db->prepare('INSERT INTO likes (user_id, porsche_model_id) VALUES (?, ?)');
            $stmt->execute([$userId, $modelId]);
            return true; // lajknuto
        }
    }

    public function hasLiked($userId, $modelId) {
        $stmt = $this->db->prepare('SELECT id FROM likes WHERE user_id = ? AND porsche_model_id = ?');
        $stmt->execute([$userId, $modelId]);
        return $stmt->fetch() !== false;
    }

    public function getCount($modelId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM likes WHERE porsche_model_id = ?');
        $stmt->execute([$modelId]);
        return $stmt->fetchColumn();
    }

    public function getByUserId($userId) {
        $stmt = $this->db->prepare('
            SELECT p.*, c.name as category_name, l.created_at as liked_at
            FROM likes l
            JOIN porsche_models p ON l.porsche_model_id = p.id
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE l.user_id = ?
            ORDER BY l.created_at DESC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}