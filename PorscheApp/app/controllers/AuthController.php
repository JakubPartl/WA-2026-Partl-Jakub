<?php
class AuthController extends Controller {

    public function register() {
        $this->view('auth/register');
    }

    public function storeUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            if (empty($username) || empty($email) || empty($password)) {
                $_SESSION['flash_error'] = 'Vyplňte prosím všechna povinná pole.';
                header('Location: ' . BASE_URL . '/auth/register');
                exit;
            }

            if ($password !== $passwordConfirm) {
                $_SESSION['flash_error'] = 'Zadaná hesla se neshodují.';
                header('Location: ' . BASE_URL . '/auth/register');
                exit;
            }

            $userModel = $this->model('User');
            $existing  = $userModel->findByEmail($email);

            if ($existing) {
                $_SESSION['flash_error'] = 'Uživatel s tímto e-mailem již existuje.';
                header('Location: ' . BASE_URL . '/auth/register');
                exit;
            }

            $userModel->create([
                'username' => $username,
                'email'    => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

            $_SESSION['flash'] = 'Registrace proběhla úspěšně. Nyní se můžete přihlásit.';
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }

    public function login() {
        $this->view('auth/login');
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user      = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id']  = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['is_admin'] = $user->is_admin;

                $_SESSION['flash'] = 'Vítejte zpět, ' . $user->username . '!';
                header('Location: ' . BASE_URL . '/porsche');
                exit;
            } else {
                $_SESSION['flash_error'] = 'Nesprávný e-mail nebo heslo.';
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }
        }
    }

    public function logout() {
        unset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['is_admin']);
        $_SESSION['flash'] = 'Byli jste úspěšně odhlášeni.';
        header('Location: ' . BASE_URL . '/porsche');
        exit;
    }
}