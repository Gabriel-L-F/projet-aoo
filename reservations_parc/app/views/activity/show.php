<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-4"><?= htmlspecialchars($activity['nom']) ?></h1>

<p><strong>Type :</strong> <?= htmlspecialchars($activity['type_id']) ?></p>
<p><strong>Description :</strong> <?= htmlspecialchars($activity['description']) ?></p>
<p><strong>Places disponibles :</strong> <?= htmlspecialchars($activity['places_disponibles']) ?></p>
<p><strong>Date et heure :</strong> <?= htmlspecialchars($activity['datetime_debut']) ?></p>
<p><strong>Durée :</strong> <?= htmlspecialchars($activity['duree']) ?> minutes</p>

<?php if (isset($_SESSION['user'])): ?>
    <form method="POST" action="<?= Router::url('reservation/create/' . $activity['id']) ?>">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 mt-2">Réserver</button>
    </form>
<?php endif; ?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <a href="<?= Router::url('activity/edit/' . $activity['id']) ?>" class="bg-yellow-500 text-white px-4 py-2 mt-2 inline-block">Modifier l'activité</a>
    <a href="<?= Router::url('activity/delete/' . $activity['id']) ?>" class="bg-red-600 text-white px-4 py-2 mt-2 inline-block" onclick="return confirm('Voulez-vous vraiment supprimer cette activité ?');">Supprimer l'activité</a>
<?php endif; ?>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
