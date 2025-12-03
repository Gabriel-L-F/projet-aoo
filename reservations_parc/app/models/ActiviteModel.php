<?php

class ActiviteModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllActivities(): array {
        return $this->db->query("
            SELECT a.*, t.nom AS type_nom
            FROM activities a
            JOIN type_activite t ON t.id = a.type_id
        ")->fetchAll();
    }

    public function getActivityById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM activities WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO activities (nom, type_id, places_disponibles, description, datetime_debut, duree)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['nom'],
            $data['type_id'],
            $data['places_disponibles'],
            $data['description'],
            $data['datetime_debut'],
            $data['duree']
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE activities 
            SET nom=?, type_id=?, places_disponibles=?, description=?, datetime_debut=?, duree=?
            WHERE id=?
        ");

        return $stmt->execute([
            $data['nom'],
            $data['type_id'],
            $data['places_disponibles'],
            $data['description'],
            $data['datetime_debut'],
            $data['duree'],
            $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM activities WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function getPlacesLeft(int $id): int {
        $stmt = $this->db->prepare("
            SELECT places_disponibles - (
                SELECT COUNT(*) FROM reservations 
                WHERE activite_id = ? AND etat = TRUE
            ) AS places_restantes
            FROM activities
            WHERE id = ?
        ");

        $stmt->execute([$id, $id]);
        return (int)$stmt->fetch()['places_restantes'];
    }
}
