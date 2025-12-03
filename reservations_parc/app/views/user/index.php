<?php ob_start(); ?>

<h1 class="text-2xl mb-4">Utilisateurs inscrits</h1>

<table class="w-full bg-white shadow">
    <tr class="bg-gray-200">
        <th class="p-2">Nom</th>
        <th class="p-2">Email</th>
        <th class="p-2">Rôle</th>
    </tr>

<?php foreach ($users as $u): ?>
    <tr>
        <td class="p-2"><?= $u['prenom'] . " " . $u['nom'] ?></td>
        <td class="p-2"><?= $u['email'] ?></td>
        <td class="p-2"><?= $u['role'] ?></td>
    </tr>
<?php endforeach; ?>

</table>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
