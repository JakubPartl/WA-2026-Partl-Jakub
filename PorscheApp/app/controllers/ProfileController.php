<?php
class ProfileController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function index() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
    $user = $this->userModel->findById($_SESSION['user_id']);
    $porscheModel = $this->model('PorscheModel');
    $models = $porscheModel->getByUserId($_SESSION['user_id']);
    $likeModel = $this->model('Like');
    $likedModels = $likeModel->getByUserId($_SESSION['user_id']);
    $this->view('profile/index', [
        'user'        => $user,
        'models'      => $models,
        'likedModels' => $likedModels
    ]);
}

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $user = $this->userModel->findById($_SESSION['user_id']);
        $this->view('profile/edit', ['user' => $user]);
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $avatar = $this->userModel->findById($_SESSION['user_id'])->avatar;
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $uploadDir = '../public/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['avatar']['name']);
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $filename);
            $avatar = $filename;
        }

        $data = [
            'username' => trim($_POST['username']),
            'email'    => trim($_POST['email']),
            'bio'      => trim($_POST['bio']),
            'avatar'   => $avatar
        ];

        $this->userModel->update($_SESSION['user_id'], $data);
        $_SESSION['username'] = $data['username'];
        header('Location: ' . BASE_URL . '/profile');
        exit;
    }

    public function updatePassword() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $user = $this->userModel->findById($_SESSION['user_id']);
        if (!password_verify($_POST['current_password'], $user->password)) {
            $_SESSION['flash'] = 'Současné heslo je nesprávné.';
            header('Location: ' . BASE_URL . '/profile/edit');
            exit;
        }

        $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $this->userModel->updatePassword($_SESSION['user_id'], $newPassword);
        $_SESSION['flash'] = 'Heslo bylo úspěšně změněno.';
        header('Location: ' . BASE_URL . '/profile');
        exit;
    }

    public function delete($id) {
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche');
            exit;
        }
        $this->userModel->delete($id);
        header('Location: ' . BASE_URL . '/profile/users');
        exit;
    }

    public function users() {
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche');
            exit;
        }
        $users = $this->userModel->getAll();
        $this->view('profile/users', ['users' => $users]);
    }
    public function search() {
    $query = trim($_GET['q'] ?? '');
    $users = [];
    if (!empty($query)) {
        $users = $this->userModel->search($query);
    }
    $this->view('profile/search', ['users' => $users, 'query' => $query]);
}
public function view_user($id) {
    $user = $this->userModel->findById($id);
    if (!$user) {
        header('Location: ' . BASE_URL . '/porsche');
        exit;
    }
    $porscheModel = $this->model('PorscheModel');
    $models = $porscheModel->getByUserId($id);
    $this->view('profile/view_user', ['user' => $user, 'models' => $models]);
}
}