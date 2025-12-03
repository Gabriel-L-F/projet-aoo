<?php ob_start(); ?>

<h1 class="text-2xl mb-4">Réservation : <?= $reservation['activite_nom'] ?></h1>

<p>Date : <?= $reservation['datetime_debut'] ?></p>
<p>État : <?= $reservation['etat'] ? "Confirmée" : "Annulée" ?></p>

<?php if ($reservation['etat']): ?>
    <a href="/reservation/cancel/<?= $reservation['id'] ?>" 
       class="bg-red-600 text-white px-4 py-2 inline-block mt-4">Annuler</a>
<?php endif; ?>

<?php $content = ob_get_clean(); require "../app/views/layout.php"; ?>
