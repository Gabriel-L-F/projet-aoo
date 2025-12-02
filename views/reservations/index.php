<h1>Mes réservations</h1>
<ul>
<?php foreach($reservations as $reservation): ?>
    <li>
        <a href="?page=reservation/show/<?= $reservation['id'] ?>">
            Réservation #<?= $reservation['id'] ?> - <?= $reservation['status'] ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
