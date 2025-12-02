<h1>Liste des activités</h1>
<ul>
<?php foreach($activities as $activity): ?>
    <li>
        <a href="?page=activity/show/<?= $activity['nom'] ?>">
            <?= htmlspecialchars($activity['nom']) ?>
        </a> - <?= htmlspecialchars($activity['description']) ?>
    </li>
<?php endforeach; ?>
</ul>
<hr>
<a href="index.php?route=reservation">Mes réservations</a><br>
<a href="index.php?route=user/register">S'inscrire</a><br>
<a href="index.php?route=user/login">Se connecter</a>