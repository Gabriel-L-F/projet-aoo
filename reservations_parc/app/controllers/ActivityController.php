<?php

class ActivityController {

    public function index() {
        $model = new ActiviteModel();
        $activities = $model->getAllActivities();
        require "../app/views/activity/index.php";
    }

    public function show($id) {
        $model = new ActiviteModel();
        $activity = $model->getActivityById($id);

        if (!$activity) {
            die("Activité introuvable.");
        }

        require "../app/views/activity/show.php";
    }

    public function create() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Accès refusé.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new ActiviteModel();
            $model->create($_POST);
            header("Location: " . Router::url("activity/index"));
            exit;
        }

        require "../app/views/activity/create.php";
    }

    public function edit($id) {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Accès refusé.");
        }

        $model = new ActiviteModel();
        $activity = $model->getActivityById($id);

        if (!$activity) {
            die("Activité introuvable.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->update($id, $_POST);
            header("Location: " . Router::url("activity/show/$id"));
            exit;
        }

        require "../app/views/activity/edit.php";
    }

    public function delete($id) {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die("Accès refusé.");
        }

        $model = new ActiviteModel();
        $model->delete($id);

        $resModel = new ReservationModel();
        Database::getConnection()
            ->prepare("DELETE FROM reservations WHERE activite_id = ?")
            ->execute([$id]);

        header("Location: " . Router::url("activity/index"));
        exit;
    }
}
