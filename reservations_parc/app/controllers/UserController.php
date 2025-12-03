<?php

class UserController {

    private $base;

    public function __construct() {
        // chemin de base du projet pour les redirections
        $this->base = "/reservations_parc/public";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new UserModel();

            $user = $model->logUser($_POST['email'], $_POST['motdepasse']);

            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: " . $this->base); // redirection vers la page d'accueil du projet
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
            header("Location: " . $this->base . "/user/login"); // redirection vers la page login
            exit;
        }

        require "../app/views/user/register.php";
    }

    public function logout() {
        session_destroy();
        header("Location: " . $this->base); // redirection vers la page d'accueil après déconnexion
        exit;
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
