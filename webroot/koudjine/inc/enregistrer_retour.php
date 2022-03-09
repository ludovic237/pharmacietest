<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/caisse.php');
global $pdo;


$manager = new RetourProduitManager($pdo);
$managerCa = new CaisseManager($pdo);

$idEmp = $_POST['idEmp'];
$idVente = $_POST['idVente'];
$caisse = $managerCa->get();

$retour = new RetourProduit(array(
    'vente_id' => $idVente,
    'employe_id' => $idEmp,
    'caisse_id' => $caisse->id()
));
$manager->add($retour);

?>