<h1>Liste des utilisateurs</h1>
<ul>
<?php foreach($users as $user): ?>
    <li><?= htmlspecialchars($user['name']) ?> (<?= htmlspecialchars($user['email']) ?>)</li>
<?php endforeach; ?>
</ul>
