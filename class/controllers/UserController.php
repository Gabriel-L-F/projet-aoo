<?php

class UserController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel();

            $user = $model->logUser($_POST['email'], $_POST['motdepasse']);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: /");
                exit;
            }
            $error = "Identifiants incorrects.";
        }

        require "../app/views/user/login.php";
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel();
            $model->createUser($_POST);
            header("Location: /user/login");
            exit;
        }

        require "../app/views/user/register.php";
    }

    public function logout() {
        session_destroy();
        header("Location: /");
    }

    public function index() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Accès interdit.");
        }

        $model = new UserModel();
        $users = $model->getAllUsers();

        require "../app/views/user/index.php";
    }
}
