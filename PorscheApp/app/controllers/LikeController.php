<?php
class LikeController extends Controller {
    private $likeModel;

    public function __construct() {
        $this->likeModel = $this->model('Like');
    }

    public function toggle($modelId) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $this->likeModel->toggle($_SESSION['user_id'], $modelId);
        header('Location: ' . BASE_URL . '/porsche/show/' . $modelId);
        exit;
    }
}