<?php 
class ReservationModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function createReservation(int $userId, int $activityId): bool
    {
        $query = $this->db->prepare("
            INSERT INTO reservations (user_id, activity_id)
            VALUES (:userId, :activityId)
        ");

        return $query->execute([
            ':userId' => $userId,
            ':activityId' => $activityId
        ]);
    }
    public function getReservationsByUserId(int $userId): array
    {
        $query = $this->db->prepare("
            SELECT * FROM reservations
            WHERE user_id = :userId
        ");

        $query->execute([':userId' => $userId]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function cancelReservation(int $reservationId): bool
    {
        $query = $this->db->prepare("
            DELETE FROM reservations
            WHERE id = :reservationId
        ");

        return $query->execute([':reservationId' => $reservationId]);
    }
}
?>
