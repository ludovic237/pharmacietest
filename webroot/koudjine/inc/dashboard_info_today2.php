<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/vente.php');
require_once('../Class/en_rayon.php');
require_once('../Class/concerner.php');

global $pdo;
global $conndb;

$start;
$vente;
$concerner;
$enrayon;
$end;
$venteTotalRange = 0;
$quantiteTotalRange = 0;
$quantiteTotalEnRayon = 0;
$quantiteTotalSameRayonId = 0;
$nom;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerConcerner = new ConcernerManager($pdo);

$start = $_POST['start'];
$end = $_POST['end'];

$totalprixEnteeRange=0;
$totalquantiteEnteeRange=0;
$enrayonAllRange =  $managerEnRayon->getAllRange($start, $end);
foreach ($enrayonAllRange as $k => $en) :
    $totalquantiteEnteeRange = $totalquantiteEnteeRange + ($en->quantite());
    $totalprixEnteeRange = $totalprixEnteeRange + ($en->prixAchat()*$en->quantite());
endforeach;

$totalquantiteSortieRange=0;
$totalprixSortieRange=0;
$venteAllRange =  $managerVente->getListRange($start, $end);
foreach ($venteAllRange as $k => $va) :
    $totalprixSortieRange = $totalprixSortieRange + ($va->prixTotal());
endforeach;

$vente = $managerVente->getDateVenteRange($start, $end);

foreach ($vente as $k => $v) :
    $venteTotalRange = $venteTotalRange + $v->prixTotal();
    $concerner =  $managerConcerner->getList($v->id());
    $enrayon = $managerEnRayon->getAll();

    foreach ($concerner as $k => $c) :
        $quantiteTotalRange = $quantiteTotalRange + $c->quantite();
    endforeach;

endforeach;

$donnees = array('totalquantiteEnteeRange' => $totalquantiteEnteeRange,
'totalprixEnteeRange' => $totalprixEnteeRange,'totalquantiteSortieRange' => $quantiteTotalRange,
'totalprixSortieRange' => $totalprixSortieRange ,'quantiteentresortie' => ($totalquantiteEnteeRange-$quantiteTotalRange),
'prixentresortie' => ($totalprixEnteeRange-$totalprixSortieRange));
//$donnees = array('data' => $med);
echo json_encode($donnees);