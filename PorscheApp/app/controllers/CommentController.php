<?php
class CommentController extends Controller {
    private $commentModel;

    public function __construct() {
        $this->commentModel = $this->model('Comment');
    }

    public function store($modelId) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $data = [
            'porsche_model_id' => $modelId,
            'user_id'          => $_SESSION['user_id'],
            'content'          => trim($_POST['content'])
        ];

        $this->commentModel->create($data);
        header('Location: ' . BASE_URL . '/porsche/show/' . $modelId);
        exit;
    }

    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $comment = $this->commentModel->getById($id);
        if (!$comment) {
            header('Location: ' . BASE_URL . '/porsche');
            exit;
        }

        if ($comment->user_id != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche/show/' . $comment->porsche_model_id);
            exit;
        }

        $this->view('comments/edit', ['comment' => $comment]);
    }

    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $comment = $this->commentModel->getById($id);
        if ($comment->user_id != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche/show/' . $comment->porsche_model_id);
            exit;
        }

        $this->commentModel->update($id, trim($_POST['content']));
        header('Location: ' . BASE_URL . '/porsche/show/' . $comment->porsche_model_id);
        exit;
    }

    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $comment = $this->commentModel->getById($id);
        if ($comment->user_id != $_SESSION['user_id'] && !$_SESSION['is_admin']) {
            header('Location: ' . BASE_URL . '/porsche/show/' . $comment->porsche_model_id);
            exit;
        }

        $modelId = $comment->porsche_model_id;
        $this->commentModel->delete($id);
        header('Location: ' . BASE_URL . '/porsche/show/' . $modelId);
        exit;
    }
}