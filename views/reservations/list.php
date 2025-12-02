<h1>Liste de toutes les réservations (Admin)</h1>
<ul>
<?php foreach($reservations as $reservation): ?>
    <li>
        Réservation #<?= $reservation['id'] ?> - <?= $reservation['status'] ?> - Utilisateur: <?= htmlspecialchars($reservation['user_name']) ?>
    </li>
<?php endforeach; ?>
</ul>
