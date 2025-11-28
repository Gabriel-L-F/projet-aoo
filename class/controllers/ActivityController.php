<?php 
class ActivityController
{
    private ActivityModel $activityModel;
    private ReservationModel $reservationModel;
    private AuthService $auth;

    public function __construct(ActivityModel $activityModel, ReservationModel $reservationModel, AuthService $auth)
    {
        $this->activityModel = $activityModel;
        $this->reservationModel = $reservationModel;
        $this->auth = $auth;
    }
    public function index(): void
    {
        $activities = $this->activityModel->getAllActivities();
        $isAdmin = $this->auth->isAdmin();

        require __DIR__ . '/../views/activity/index.php';
    }

    public function show(int $id): void
    {
        $activity = $this->activityModel->getActivityById($id);
        if (!$activity) {
            echo "Activité introuvable";
            return;
        }

        $isAdmin = $this->auth->isAdmin();
        require __DIR__ . '/../views/activity/show.php';
    }

    public function update(int $id, array $data): void
    {
        if (!$this->auth->isAdmin()) {
            http_response_code(403);
            echo "Accès refusé";
            return;
        }

        $this->activityModel->updateActivity($id, $data);
        header("Location: /activity/show/$id");
    }
    public function delete(int $id): void
    {
        if (!$this->auth->isAdmin()) {
            http_response_code(403);
            echo "Accès refusé";
            return;
        }

        // Supprimer les réservations liées
        $this->reservationModel->deleteReservationsByActivityId($id);

        // Supprimer l'activité
        $this->activityModel->deleteActivity($id);

        header("Location: /activity/index");
    }
}

?>
