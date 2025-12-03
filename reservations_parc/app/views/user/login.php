<?php ob_start(); ?>

<h1 class="text-2xl mb-4">Connexion</h1>

<form method="POST" class="space-y-4">

    <input name="email" placeholder="Email" class="w-full p-2 border"/>

    <input type="password" name="motdepasse" placeholder="Mot de passe" class="w-full p-2 border"/>

    <button class="bg-blue-600 text-white px-4 py-2">Se connecter</button>
</form>

<?php if (isset($error)) : ?>
    <p class="text-red-600 mt-4"><?= $error ?></p>
<?php endif; ?>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
