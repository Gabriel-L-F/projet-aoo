<h1>Détail de la réservation</h1>
<p>ID : <?= $reservation['id'] ?></p>
<p>Activité : <?= htmlspecialchars($reservation['activity_name']) ?></p>
<p>Statut : <?= $reservation['status'] ?></p>
<a href="?page=/reservation">Retour à mes réservations</a>
