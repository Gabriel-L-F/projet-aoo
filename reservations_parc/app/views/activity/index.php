<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-4">Toutes les activités</h1>

<?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <a href="<?= Router::url('activity/create') ?>" class="bg-green-600 text-white px-4 py-2 rounded">Ajouter une activité</a>
<?php endif; ?>

<div class="grid grid-cols-3 gap-4 mt-4">
<?php foreach ($activities as $a): ?>
    <div class="p-4 bg-white shadow rounded">
        <h2 class="text-xl font-bold"><?= $a['nom'] ?></h2>
        <p><?= $a['description'] ?></p>
        <a href="<?= Router::url('activity/show/' . $a['id']) ?>" class="text-blue-600">Voir</a>
    </div>
<?php endforeach; ?>
</div>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
