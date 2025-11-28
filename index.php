<?php
require './vendor/autoload.php';
 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once './class/Bdd.php';
 
$bdd = new Bdd();
$sql = 'SELECT * FROM categorie';
$resultat = $bdd->prepareExecute($sql);
 
$categories = $resultat->fetchAll();
 
foreach ($categories as $une_categorie) {
  echo '<h2>'. $une_categorie['nom'] .'</h2>';
}