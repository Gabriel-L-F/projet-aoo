<?php

class UserModel {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function logUser(string $email, string $motdepasse): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($motdepasse, $user['motdepasse'])) {
            return $user;
        }
        return null;
    }

    public function createUser(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO users (prenom, nom, email, motdepasse, role)
            VALUES (?, ?, ?, ?, 'user')
        ");

        return $stmt->execute([
            $data['prenom'],
            $data['nom'],
            $data['email'],
            password_hash($data['motdepasse'], PASSWORD_DEFAULT)
        ]);
    }

    public function getAllUsers(): array {
        return $this->db->query("SELECT * FROM users")->fetchAll();
    }
}
