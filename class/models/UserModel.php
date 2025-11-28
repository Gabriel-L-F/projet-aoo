<?php
class UserModel {

    public function setDatabase(PDO $pdo): void {
        $this->db = $pdo;
    }

    public function logUser(string $email, string $motdepasse): array
    {

        $sql = "SELECT * FROM utilisateurs WHERE email = :email LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($motdepasse, $user['motdepasse'])) {
            return [
                'success' => false,
                'message' => 'Email ou mot de passe incorrect.'
            ];
        }

        unset($user['motdepasse']);

        return [
            'user' => $user  
        ];
    }

    public function createUser(array $data): bool
    {
        if (!isset($data['nom'], $data['prenom'], $data['email'], $data['motdepasse'])) {
            return false;
        }        

        $data['motdepasse'] = password_hash($data['motdepasse'], PASSWORD_DEFAULT);


        $sql = "INSERT INTO utilisateurs (nom, prenom, email, motdepasse)
        VALUES (:nom, :prenom, :email, :motdepasse)";

        $stmt = $this->db->prepare($sql);

        $success = $stmt->execute([
            ':nom'        => $data['nom'],
            ':prenom'     => $data['prenom'],
            ':email'      => $data['email'],
            ':motdepasse' => $data['motdepasse']
        ]);

        return $success;
    }
    
    public function getAllUsers(): array
    {
        $sql = "SELECT nom, prenom FROM utilisateurs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }
}