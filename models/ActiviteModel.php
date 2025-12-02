<?php
class ActiviteModel {
    private PDO $db; // propriété pour la connexion PDO

    // Constructeur pour recevoir l'objet PDO
    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getAllActivities(): array
    {
        $sql = "SELECT nom, description FROM activities";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivityById(int $id): array
    {
        $sql = "SELECT * FROM activities WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPlacesLeft(int $activityId): int
    {
        // Attention : tu avais écrit "activities" au lieu de "activites"
        $sqlPlaces = "SELECT places_disponibles FROM activities WHERE id = :id";
        $stmt = $this->db->prepare($sqlPlaces);
        $stmt->execute([':id' => $activityId]);
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$activity) {
            return 0; 
        }

        $totalPlaces = (int)$activity['places_disponibles'];

        $sqlReservations = "SELECT COUNT(*) as nb_reservations 
                            FROM reservations 
                            WHERE activite_id = :id AND etat = 1";
        $stmt = $this->db->prepare($sqlReservations);
        $stmt->execute([':id' => $activityId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $reserved = (int)$result['nb_reservations'];

        $placesLeft = $totalPlaces - $reserved;

        return $placesLeft >= 0 ? $placesLeft : 0;
    }
}
