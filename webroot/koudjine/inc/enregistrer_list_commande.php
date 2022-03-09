<?php
require_once('database.php');
require_once('../Class/ligne_commande.php');

global $pdo;


$manager = new LigneCommandeManager($pdo);
$type=$_POST['type'];
$dateDerniere=$_POST['date'];

$liste = new LigneCommande(array(
    'dateDerniere' => $dateDerniere,
    'type' => $type,
));
$manager->add($liste);

echo ' pour '.$dateDerniere;

?>