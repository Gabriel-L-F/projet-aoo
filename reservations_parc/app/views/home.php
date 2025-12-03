<?php ob_start(); ?>

<h1 class="text-3xl font-bold">Bienvenue sur le parc d'activités</h1>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
