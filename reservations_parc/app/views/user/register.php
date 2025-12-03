<?php ob_start(); ?>

<h1 class="text-2xl mb-4">Inscription</h1>

<form method="POST" class="space-y-4">

    <input name="prenom" placeholder="Prénom" class="w-full p-2 border"/>

    <input name="nom" placeholder="Nom" class="w-full p-2 border"/>

    <input name="email" placeholder="Email" class="w-full p-2 border"/>

    <input type="password" name="motdepasse" placeholder="Mot de passe" class="w-full p-2 border"/>

    <button class="bg-green-600 text-white px-4 py-2">Créer le compte</button>
</form>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
