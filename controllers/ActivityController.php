<?php
class ActivityController {
    private $activityModel;
    private $reservationModel;

    public function __construct($activityModel, $reservationModel) {
        $this->activityModel = $activityModel;
        $this->reservationModel = $reservationModel;
    }

    // Affiche toutes les activités
    public function index() {
        $activities = $this->activityModel->getAllActivities();
        $isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

        include 'views/activities/index.php';
    }

    // Affiche une activité et formulaire réservation
    public function show(int $id) {
        $activity = $this->activityModel->getActivityById($id);
        $placesLeft = $this->activityModel->getPlacesLeft($id);
        $isAdmin = isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';

        include 'views/activities/show.php';
    }

    // Mise à jour activité (ADMIN)
    public function update(int $id, array $data) {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /forbidden');
            exit;
        }

        $this->activityModel->updateActivity($id, $data);
        header('Location: /activities/' . $id);
        exit;
    }

    // Suppression activité (ADMIN)
    public function delete(int $id) {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /forbidden');
            exit;
        }

        // Suppression des réservations liées
        $this->reservationModel->deleteReservationsByActivity($id);

        // Suppression de l'activité
        $this->activityModel->deleteActivity($id);

        header('Location: /activities');
        exit;
    }
}
