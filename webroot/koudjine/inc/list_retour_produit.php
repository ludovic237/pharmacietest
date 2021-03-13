<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');
require_once('../Class/caisse.php');
global $pdo;


$managerRetourProduit = new RetourProduitManager($pdo);
$managerProduitRetour = new ProduitRetourManager($pdo);
$managerCa = new CaisseManager($pdo);

$data = [];
$datas = [];

if (isset($_POST['id']))
    $id = $_POST['id'];

$retourproduit = $managerRetourProduit->getListCaisseId($managerCa->get()->id());
foreach ($retourproduit as $k => $v) :

    $data[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "vente_id" => $v->vente_id(),
        "employe_id" => $v->employe_id(),
        "dateRetour" => $v->dateRetour(),
        "caisse_id" => $v->caisse_id(),
    );
endforeach;

$donnees = array(
    'data' => $data,
);
echo json_encode($donnees);

?>