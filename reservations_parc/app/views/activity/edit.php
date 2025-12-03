<?php ob_start(); ?>

<h1 class="text-2xl mb-4">Modifier l'activité</h1>

<form method="POST" class="space-y-4">

    <input name="nom" placeholder="Nom" value="<?= htmlspecialchars($activity['nom']) ?>" class="w-full p-2 border"/>

    <input name="type_id" placeholder="ID Type activité" value="<?= htmlspecialchars($activity['type_id']) ?>" class="w-full p-2 border"/>

    <input name="places_disponibles" type="number" placeholder="Places" value="<?= htmlspecialchars($activity['places_disponibles']) ?>" class="w-full p-2 border"/>

    <textarea name="description" placeholder="Description" class="w-full p-2 border"><?= htmlspecialchars($activity['description']) ?></textarea>

    <input name="datetime_debut" type="datetime-local" value="<?= date('Y-m-d\TH:i', strtotime($activity['datetime_debut'])) ?>" class="w-full p-2 border"/>

    <input name="duree" type="number" placeholder="Durée (minutes)" value="<?= htmlspecialchars($activity['duree']) ?>" class="w-full p-2 border"/>

    <button class="bg-blue-600 text-white px-4 py-2">Modifier</button>

</form>

<a href="<?= Router::url('activity/delete/' . $activity['id']) ?>" class="bg-red-600 text-white px-4 py-2 mt-4 inline-block" onclick="return confirm('Voulez-vous vraiment supprimer cette activité ?')">Supprimer l'activité</a>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
