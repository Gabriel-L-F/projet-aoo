<?php 
// Chemin de base du projet (nécessaire pour éviter les erreurs 404)
$base = "/reservations_parc/public";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parc Activités</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<nav class="bg-blue-600 text-white p-4 flex justify-between">

    <!-- Logo -->
    <a href="<?= $base ?>" class="font-bold">Parc d'Activités</a>

    <!-- Menu -->
    <div class="flex gap-4">

        <a href="<?= Router::url('activity/index') ?>" class="px-3">Activités</a>

        <?php if (isset($_SESSION['user'])): ?>

            <a href="<?= Router::url('reservation/index') ?>" class="px-3">Mes réservations</a>

            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <a href="<?= Router::url('reservation/list') ?>" class="px-3">Admin Réservations</a>
                <a href="<?= Router::url('user/index') ?>" class="px-3">Admin Utilisateurs</a>
            <?php endif; ?>

            <a href="<?= Router::url('user/logout') ?>" class="px-3 text-red-300">Déconnexion</a>

        <?php else: ?>

            <a href="<?= Router::url('user/login') ?>" class="px-3">Connexion</a>
            <a href="<?= Router::url('user/register') ?>" class="px-3">Inscription</a>

        <?php endif; ?>

    </div>
</nav>

<!-- Contenu -->
<div class="p-6">
    <?= $content ?>
</div>

</body>
</html>
