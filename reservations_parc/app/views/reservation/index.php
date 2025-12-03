<?php ob_start(); ?>

<h1 class="text-2xl font-bold mb-4">Mes réservations</h1>

<table class="w-full border">
    <thead>
        <tr>
            <th>Activité</th>
            <th>Date</th>
            <th>État</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $r): ?>
        <tr class="border-t">
            <td><?= $r['activite_nom'] ?></td>
            <td><?= $r['date_reservation'] ?></td>
            <td><?= $r['etat'] ? 'Confirmée' : 'Annulée' ?></td>
            <td>
                <?php if ($r['etat']): ?>
                    <a href="<?= Router::url('reservation/cancel/' . $r['id']) ?>" class="text-red-600">Annuler</a>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
