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

$totalEntee=0;
$enrayonAll =  $managerEnRayon->getAll();
foreach ($enrayonAll as $k => $en) :
    $totalEntee = $totalEntee + ($en->prixAchat()*$en->quantite());
endforeach;

$totalSortie=0;
$venteAll =  $managerVente->getList();
foreach ($venteAll as $k => $va) :
    $totalSortie = $totalSortie + ($va->prixTotal());
endforeach;

$totalSortie=0;
$venteAll =  $managerVente->getList();
foreach ($venteAll as $k => $va) :
    $totalSortie = $totalSortie + ($va->prixTotal());
endforeach;

$assurance =  $managerVente->VenteCountEtat('assurance');
$comptant =  $managerVente->VenteCountEtat('comptant');
$credit =  $managerVente->VenteCountEtat('credit');

$vente = $managerVente->getDateVenteRange($start, $end);

$med = [];
$i = 0;
$concernerTest =  $managerConcerner->getListSameRayonId2();
foreach ($concernerTest as $k => $c) :
    $rayoninfo = $managerEnRayon->get($c->en_rayon_id());
    $idprod = $rayoninfo->produit_id();
    $produit = $managerProduit->get($idprod);
    $nom = $produit->nom();

    $quantiteTotalSameRayonId = 0;
    foreach ($vente as $g => $v) :
        $concernerSameRayonId =  $managerConcerner->getListSameRayonIdAndVenteId($c->en_rayon_id(), $v->id());
        foreach ($concernerSameRayonId as $k => $cd) :
            $quantiteTotalSameRayonId = $quantiteTotalSameRayonId + $cd->quantite();
        endforeach;
    endforeach;

    $med[] = array('nom' => $nom, 'quantiteTotalSameRayonId' => $quantiteTotalSameRayonId);
endforeach;

foreach ($vente as $k => $v) :
    $venteTotalRange = $venteTotalRange + $v->prixTotal();
    $concerner =  $managerConcerner->getList($v->id());
    $enrayon = $managerEnRayon->getAll();

    foreach ($concerner as $k => $c) :
        $quantiteTotalRange = $quantiteTotalRange + $c->quantite();
    endforeach;

endforeach;
 
//$donnees = array('credit' => $credit,'comptant' => $comptant,'assurance' => $assurance,'beneficeTotal' => ($totalEntee-$totalSortie),'venteTotal' => $venteTotalRange, 'quantiteTotal' => $quantiteTotalRange, 'med' => $med);
$donnees = array('data' => $med);
echo json_encode($donnees);