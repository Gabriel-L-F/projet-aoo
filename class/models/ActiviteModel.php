<?php
class ActiviteModel {
    private int $id;

    public function getAllActivities(): array
    {
        $sql = "SELECT nom,description FROM activites";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $activites = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $activites;
    }

    public function getActivityById(int $id): array
    {
        $sql = "SELECT * FROM activites where id = :id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);

        return $activity;
    }

    public function getPlacesLeft(int $activityId): int
{
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