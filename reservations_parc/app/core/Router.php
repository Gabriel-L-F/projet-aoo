<?php

class Router {

    // Lance le routeur et appelle le bon contrôleur/méthode
    public static function run() {
        $url = $_GET['url'] ?? "";
        $url = trim($url, "/");

        $segments = explode("/", $url);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . "Controller" : "ActivityController";
        $method = $segments[1] ?? "index";
        $param = $segments[2] ?? null;

        $path = __DIR__ . "/../controllers/$controllerName.php";

        if (!file_exists($path)) {
            http_response_code(404);
            die("404 - Page introuvable");
        }

        require_once $path;

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            die("404 - Méthode introuvable");
        }

        ($param !== null) ? $controller->$method($param) : $controller->$method();
    }

    // Génère une URL complète pour les liens dans les vues
    public static function url($path) {
        $base = "/reservations_parc/public"; // adapte selon le dossier de ton projet
        return $base . "/" . ltrim($path, "/");
    }

    // Routes prédéfinies pour ton application (optionnel si tu veux centraliser)
    public static function routes() {
        return [
            // Activités
            ['GET',  '/activity/index', [ActivityController::class, 'index']],
            ['GET',  '/activity/show/(\d+)', [ActivityController::class, 'show']],
            ['GET',  '/activity/create', [ActivityController::class, 'create']],
            ['POST', '/activity/create', [ActivityController::class, 'create']],
            ['GET',  '/activity/edit/(\d+)', [ActivityController::class, 'edit']],
            ['POST', '/activity/edit/(\d+)', [ActivityController::class, 'edit']],
            ['GET',  '/activity/delete/(\d+)', [ActivityController::class, 'delete']],

            // Utilisateurs
            ['GET',  '/user/index', [UserController::class, 'index']],
            ['GET',  '/user/login', [UserController::class, 'login']],
            ['POST', '/user/login', [UserController::class, 'login']],
            ['GET',  '/user/register', [UserController::class, 'register']],
            ['POST', '/user/register', [UserController::class, 'register']],
            ['GET',  '/user/logout', [UserController::class, 'logout']],

            // Réservations
            ['GET',  '/reservation/index', [ReservationController::class, 'index']],
            ['POST', '/reservation/create/(\d+)', [ReservationController::class, 'create']],
            ['GET',  '/reservation/show/(\d+)', [ReservationController::class, 'show']],
            ['POST', '/reservation/cancel/(\d+)', [ReservationController::class, 'cancel']],
            ['GET',  '/reservation/list', [ReservationController::class, 'list']],
        ];
    }
}
