<?php

class ActivityController
{
    private ActiviteModel $activityModel;
    private AuthService $auth;

    public function __construct(ActiviteModel $activityModel, AuthService $auth)
    {
        $this->activityModel = $activityModel;
        $this->auth = $auth;
    }

    /**
     * Liste des activités
     */
    public function index(): void
    {
        $activities = $this->activityModel->getAllActivities();
        $isAdmin = $this->auth->isAdmin();

        require __DIR__ . '/../views/activity/index.php';
    }

    /**
     * Affiche une activité + places restantes
     */
    public function show(int $id): void
    {
        $activity = $this->activityModel->getActivityById($id);

        if (!$activity) {
            echo "Activité introuvable";
            return;
        }

        // récupération des places restantes (méthode existante)
        $placesLeft = $this->activityModel->getPlacesLeft($id);

        $isAdmin = $this->auth->isAdmin();

        require __DIR__ . '/../views/activity/show.php';
    }

    /**
     * UPDATE — Impossible car le modèle n'a pas updateActivity()
     */
    public function update(int $id, array $data): void
    {
        http_response_code(501);
        echo "Fonction updateActivity() inexistante dans ActiviteModel.";
    }

    /**
     * DELETE — Impossible car le modèle n'a pas deleteActivity()
     */
    public function delete(int $id): void
    {
        http_response_code(501);
        echo "Fonction deleteActivity() inexistante dans ActiviteModel.";
    }
}

