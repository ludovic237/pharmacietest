<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/facturation.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/viewproduitcmd.php');

global $pdo;

$data = [];
$datas = [];
$totalEncaisse = 0;
$total = 0;

$managerPrCmdView = new ProduitcmdViewManager($pdo);

$start = $_POST['start'];
$end = $_POST['end'];

$ProduitCmdView = $managerPrCmdView->getAllLast();

$prds = array();
$qte = 0;
foreach ($ProduitCmdView as $key => $v) {
    $data[] = array(
        "nom"=>$v->nom(),
        "ean13"=>$v->ean13(),
        "puCmd"=>$v->puCmd(),
        "ptCmd"=>$v->ptCmd(),
        "qtiteCmd"=>$v->qtiteCmd(),
        "etat"=>$v->etat(),
        "ref"=>$v->ref(),
        "montantCmd"=>$v->montantCmd(),
        "montantRecu"=>$v->montantRecu(),
        "dateCreation"=>$v->dateCreation(),
        "dateLivraison"=>$v->dateLivraison(),
        "fournisseurName"=>$v->fournisseurName(),
    );
}
$datas = array('data' => $data,'totalEncaisse' => $total);
echo json_encode($datas);
