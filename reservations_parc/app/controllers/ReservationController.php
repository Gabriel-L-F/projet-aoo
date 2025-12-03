<?php

class ReservationController {

    public function index() {
        if (!isset($_SESSION['user'])) {
            die("Accès refusé.");
        }

        $model = new ReservationModel();
        $reservations = $model->getReservationsByUserId($_SESSION['user']['id']);

        require "../app/views/reservation/index.php";
    }

    public function create($activityId) {
        if (!isset($_SESSION['user'])) {
            die("Accès refusé.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ReservationModel();
            $model->createReservation($_SESSION['user']['id'], $activityId);
            header("Location: " . Router::url("reservation/index"));
            exit;
        }
    }

    public function show($id) {
        // Affichage détail si besoin
    }

    public function cancel($id) {
        $model = new ReservationModel();
        $model->cancelReservation($id);
        header("Location: " . Router::url("reservation/index"));
        exit;
    }

    public function list() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Accès refusé.");
        }

        $model = new ReservationModel();
        $reservations = $model->getAllReservations();

        require "../app/views/reservation/list.php";
    }
}
