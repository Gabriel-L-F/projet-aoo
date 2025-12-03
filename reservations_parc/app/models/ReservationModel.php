<?php

class ReservationModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Crée une réservation
    public function createReservation(int $userId, int $activityId): bool {
        $stmt = $this->db->prepare("
            INSERT INTO reservations (user_id, activite_id, date_reservation, etat)
            VALUES (?, ?, NOW(), TRUE)
        ");
        return $stmt->execute([$userId, $activityId]);
    }

    // Récupère les réservations d'un utilisateur
    public function getReservationsByUserId(int $userId): array {
        $stmt = $this->db->prepare("
            SELECT r.*, a.nom AS activite_nom, a.datetime_debut
            FROM reservations r
            JOIN activities a ON a.id = r.activite_id
            WHERE r.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    // Annule une réservation
    public function cancelReservation(int $id): bool {
        $stmt = $this->db->prepare("UPDATE reservations SET etat = FALSE WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Récupère toutes les réservations (admin)
    public function getAllReservations(): array {
        return $this->db->query("
            SELECT r.*, u.prenom, u.nom, a.nom AS activite_nom, r.etat
            FROM reservations r
            JOIN users u ON u.id = r.user_id
            JOIN activities a ON a.id = r.activite_id
        ")->fetchAll();
    }
}
