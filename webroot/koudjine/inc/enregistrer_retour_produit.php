<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');
global $pdo;


$manager = new RetourProduitManager($pdo);
$managerCa = new ProduitRetourManager($pdo);

$id = $_POST['id'];
$qte = $_POST['qte'];

$retour = new ProduitRetour(array(
    'retour_produit_id' => $manager->getLastId()->id(),
    'concerner_id' => $id,
    'quantite' => $qte
));
$managerCa->add($retour);
echo "pass";

?>