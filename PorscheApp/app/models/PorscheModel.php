<?php
class PorscheModel extends Model {
    public function getAll($sort = 'created_at', $order = 'DESC', $search = '') {
    $allowed      = ['name', 'price', 'year_from', 'power_hp', 'created_at'];
    $allowedOrder = ['ASC', 'DESC'];
    if (!in_array($sort, $allowed)) $sort = 'created_at';
    if (!in_array($order, $allowedOrder)) $order = 'DESC';

    $where = '';
    $params = [];
    if (!empty($search)) {
        $where = 'WHERE p.name LIKE ? OR p.generation LIKE ? OR p.body_type LIKE ?';
        $params = ["%$search%", "%$search%", "%$search%"];
    }

    $stmt = $this->db->prepare("
        SELECT p.*, c.name as category_name, u.username 
        FROM porsche_models p
        LEFT JOIN categories c ON p.category_id = c.id
        LEFT JOIN users u ON p.user_id = u.id
        $where
        ORDER BY $sort $order
    ");
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
    
    public function getById($id) {
        $stmt = $this->db->prepare('
            SELECT p.*, c.name as category_name, u.username 
            FROM porsche_models p
            LEFT JOIN categories c ON p.category_id = c.id
            LEFT JOIN users u ON p.user_id = u.id
            WHERE p.id = ?
        ');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create($data) {
        $stmt = $this->db->prepare('
            INSERT INTO porsche_models 
            (name, generation, year_from, year_to, engine, power_hp, price, body_type, category_id, description, image, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        return $stmt->execute([
            $data['name'],
            $data['generation'],
            $data['year_from'],
            $data['year_to'],
            $data['engine'],
            $data['power_hp'],
            $data['price'],
            $data['body_type'],
            $data['category_id'],
            $data['description'],
            $data['image'],
            $data['user_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare('
            UPDATE porsche_models SET
            name = ?, generation = ?, year_from = ?, year_to = ?,
            engine = ?, power_hp = ?, price = ?, body_type = ?, category_id = ?,
            description = ?, image = ?
            WHERE id = ?
        ');
        return $stmt->execute([
            $data['name'],
            $data['generation'],
            $data['year_from'],
            $data['year_to'],
            $data['engine'],
            $data['power_hp'],
            $data['price'],
            $data['body_type'],
            $data['category_id'],
            $data['description'],
            $data['image'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM porsche_models WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function getCategories() {
        $stmt = $this->db->prepare('SELECT * FROM categories ORDER BY name');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public static function getBodyTypes() {
    return [
        'Coupe',
        'Cabrio / Roadster',
        'Sedan',
        'SUV',
        'SUV Coupe',
        'Speedster',
        'Targa',
        'Combi (Cross Turismo)',
        'Wagon',
    ];
    }
    public function getByUserId($userId) {
    $stmt = $this->db->prepare('
        SELECT p.*, c.name as category_name
        FROM porsche_models p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.user_id = ?
        ORDER BY p.created_at DESC
    ');
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getStats() {
    $stmt = $this->db->prepare('
        SELECT 
            (SELECT COUNT(*) FROM porsche_models) as total_models,
            (SELECT COUNT(*) FROM users) as total_users,
            (SELECT COUNT(*) FROM comments) as total_comments,
            (SELECT MAX(power_hp) FROM porsche_models) as max_hp
    ');
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
    }
}