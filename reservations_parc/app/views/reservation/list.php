<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-4">Toutes les réservations</h1>

<table class="w-full border">
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Activité</th>
            <th>Date réservation</th>
            <th>État</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $r): ?>
        <tr class="border-t">
            <td><?= $r['prenom'] . ' ' . $r['nom'] ?></td>
            <td><?= $r['activite_nom'] ?></td>
            <td><?= $r['date_reservation'] ?></td>
            <td><?= $r['etat'] ? 'Confirmée' : 'Annulée' ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
