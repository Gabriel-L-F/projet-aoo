<?php
// index.php — routeur simple
session_start();

require __DIR__ . '/vendor/autoload.php';

// Inclure les modèles
require __DIR__ . '/models/ActiviteModel.php';
require __DIR__ . '/models/UserModel.php';
require __DIR__ . '/models/ReservationModel.php';

// Inclure les contrôleurs
require __DIR__ . '/controllers/ActivityController.php';
require __DIR__ . '/controllers/UserController.php';
require __DIR__ . '/controllers/ReservationController.php';

// Connexion PDO à la base Laragon
$pdo = new PDO("mysql:host=localhost;dbname=projet aoo", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Instanciation des modèles
$activiteModel = new ActiviteModel($pdo);
$userModel = new UserModel($pdo);
$reservationModel = new ReservationModel($pdo);

// Instanciation des contrôleurs
$activityController = new ActivityController($activiteModel, $reservationModel);
$userController = new UserController($userModel);
$reservationController = new ReservationController($reservationModel, $activiteModel);

// Récupération de la route depuis l’URL
$uri = $_GET['route'] ?? '/';

// Routing
switch (true) {
    // Accueil — liste des activités
    case $uri === '/':
        $activityController->index(); // doit inclure views/activities/index.php
        break;

    // Détail d’une activité — route dynamique avec ID
    case preg_match('#^activity/show/(\d+)$#', $uri, $matches):
        $id = $matches[1];
        $activityController->show($id);
        break;

    // Mes réservations
    case $uri === 'reservation':
        $reservationController->index();
        break;

    // Détail d’une réservation avec ID
    case preg_match('#^reservation/show/(\d+)$#', $uri, $matches):
        $id = $matches[1];
        $reservationController->show($id);
        break;

    // Liste des réservations (admin)
    case $uri === 'reservation/list':
        $reservationController->listAll();
        break;

    // Liste des utilisateurs (admin)
    case $uri === 'user':
        $userController->index();
        break;

    // Formulaire d’inscription
    case $uri === 'user/register':
        $userController->register();
        break;

    // Formulaire de connexion
    case $uri === 'user/login':
        $userController->login();
        break;

    // Déconnexion
    case $uri === 'user/logout':
        $userController->logout();
        break;

    default:
        echo "<h1>404 - Page introuvable</h1>";
}
