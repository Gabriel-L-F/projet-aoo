<?php ob_start(); ?>

<h1 class="text-2xl mb-4">Créer une activité</h1>

<?php if (!empty($error)): ?>
    <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
        <?= $error ?>
    </div>
<?php endif; ?>

<form method="POST" action="<?= Router::url('activity/create') ?>" class="space-y-4">

    <input name="nom" placeholder="Nom" class="w-full p-2 border" value="<?= $_POST['nom'] ?? '' ?>"/>

    <input name="type_id" placeholder="ID Type activité" class="w-full p-2 border" value="<?= $_POST['type_id'] ?? '' ?>"/>

    <input name="places_disponibles" type="number" placeholder="Places" class="w-full p-2 border" value="<?= $_POST['places_disponibles'] ?? '' ?>"/>

    <textarea name="description" placeholder="Description" class="w-full p-2 border"><?= $_POST['description'] ?? '' ?></textarea>

    <input name="datetime_debut" type="datetime-local" class="w-full p-2 border" value="<?= $_POST['datetime_debut'] ?? '' ?>"/>

    <input name="duree" type="number" placeholder="Durée (minutes)" class="w-full p-2 border" value="<?= $_POST['duree'] ?? '' ?>"/>

    <button class="bg-green-600 text-white px-4 py-2">Créer</button>

</form>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
