<?php

class ReservationController {

    public function index() {
        if (!isset($_SESSION['user'])) {
            die("Veuillez vous connecter.");
        }

        $model = new ReservationModel();
        $reservations = $model->getReservationsByUserId($_SESSION['user']['id']);

        require "../app/views/reservation/index.php";
    }

    public function create($activityId) {
        if (!isset($_SESSION['user'])) {
            die("Veuillez vous connecter.");
        }

        $userId = $_SESSION['user']['id'];
        $model = new ReservationModel();

        if (!$model->createReservation($userId, $activityId)) {
            die("Impossible de réserver : activité complète.");
        }

        header("Location: /reservation/index");
    }

    public function show($id) {
        if (!isset($_SESSION['user'])) {
            die("Veuillez vous connecter.");
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("
            SELECT r.*, a.nom AS activite_nom, a.datetime_debut
            FROM reservations r
            JOIN activities a ON a.id = r.activite_id
            WHERE r.id = ?
        ");
        $stmt->execute([$id]);
        $reservation = $stmt->fetch();

        if (!$reservation) die("Réservation introuvable.");

        require "../app/views/reservation/show.php";
    }

    public function cancel($id) {
        if (!isset($_SESSION['user'])) {
            die("Veuillez vous connecter.");
        }

        $userId = $_SESSION['user']['id'];

        // Vérifier que la réservation appartient à l’utilisateur
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM reservations WHERE id = ?");
        $stmt->execute([$id]);
        $reservation = $stmt->fetch();

        if ($reservation['user_id'] != $userId) {
            die("Action interdite.");
        }

        $model = new ReservationModel();
        $model->cancelReservation($id);

        header("Location: /reservation/index");
    }

    public function list() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Accès réservé à l’administrateur.");
        }

        $model = new ReservationModel();
        $reservations = $model->getAll();

        require "../app/views/reservation/list.php";
    }
}
