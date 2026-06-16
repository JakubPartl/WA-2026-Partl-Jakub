<?php
class PorscheController extends Controller {
    private $porscheModel;
    private $categoryModel;

    public function __construct() {
        $this->porscheModel = $this->model('PorscheModel');
        $this->categoryModel = $this->model('PorscheModel');
    }

    public function index() {
    $sort   = $_GET['sort'] ?? 'created_at';
    $order  = $_GET['order'] ?? 'DESC';
    $search = trim($_GET['search'] ?? '');
    $models = $this->porscheModel->getAll($sort, $order, $search);
    $stats  = $this->porscheModel->getStats();
    $this->view('porsche/index', [
        'models' => $models,
        'sort'   => $sort,
        'order'  => $order,
        'search' => $search,
        'stats'  => $stats
    ]);
}

    public function show($id) {
    $model = $this->porscheModel->getById($id);
    if (!$model) {
        header('Location: ' . BASE_URL . '/porsche');
        exit;
    }
    $commentModel = $this->model('Comment');
    $comments = $commentModel->getByModelId($id);
    $likeModel = $this->model('Like');
    $likeCount = $likeModel->getCount($id);
    $hasLiked = isset($_SESSION['user_id']) ? $likeModel->hasLiked($_SESSION['user_id'], $id) : false;
    $this->view('porsche/show', [
        'model'     => $model,
        'comments'  => $comments,
        'likeCount' => $likeCount,
        'hasLiked'  => $hasLiked
    ]);
}

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $categories = $this->porscheModel->getCategories();
        $this->view('porsche/create', ['categories' => $categories]);
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $uploadDir = '../public/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
            $image = $filename;
        }

        $data = [
            'name'        => trim($_POST['name']),
            'generation'  => trim($_POST['generation']),
            'year_from'   => $_POST['year_from'],
            'year_to'     => $_POST['year_to'],
            'engine'      => trim($_POST['engine']),
            'power_hp'    => $_POST['power_hp'],
            'price'       => !empty($_POST['price']) ? $_POST['price'] : null,
            'body_type'   => trim($_POST['body_type']),
            'category_id' => !empty($_POST['category_id']) ? $_POST['category_id'] : null,
            'description' => trim($_POST['description']),
            'image'       => $image,
            'user_id'     => $_SESSION['user_id']
        ];

        $this->porscheModel->create($data);
        header('Location: ' . BASE_URL . '/porsche');
        exit;
    }

    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $model = $this->porscheModel->getById($id);
        if (!$model) {
            header('Location: ' . BASE_URL . '/porsche');
            exit;
        }
        if ($model->user_id != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche');
            exit;
        }
        $categories = $this->porscheModel->getCategories();
        $this->view('porsche/edit', ['model' => $model, 'categories' => $categories]);
    }

    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $model = $this->porscheModel->getById($id);
        if ($model->user_id != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche');
            exit;
        }

        $image = $model->image;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $uploadDir = '../public/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename);
            $image = $filename;
        }

        $data = [
            'name'        => trim($_POST['name']),
            'generation'  => trim($_POST['generation']),
            'year_from'   => $_POST['year_from'],
            'year_to'     => $_POST['year_to'],
            'engine'      => trim($_POST['engine']),
            'power_hp'    => $_POST['power_hp'],
            'price'       => !empty($_POST['price']) ? $_POST['price'] : null,
            'body_type'   => trim($_POST['body_type']),
            'category_id' => !empty($_POST['category_id']) ? $_POST['category_id'] : null,
            'description' => trim($_POST['description']),
            'image'       => $image
        ];

        $this->porscheModel->update($id, $data);
        header('Location: ' . BASE_URL . '/porsche/show/' . $id);
        exit;
    }

    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $model = $this->porscheModel->getById($id);
        if ($model->user_id != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche');
            exit;
        }
        $this->porscheModel->delete($id);
        header('Location: ' . BASE_URL . '/porsche');
        exit;
    }
}