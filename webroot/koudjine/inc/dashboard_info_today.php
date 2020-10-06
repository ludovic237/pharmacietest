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
$venteTotal = 0;
$quantiteTotal = 0;
$quantiteTotalEnRayon = 0;
$quantiteTotalSameRayonId = 0;
$nom;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerConcerner = new ConcernerManager($pdo);

$start = $_POST['start'];
$end = $_POST['end'];



$vente = $managerVente->getDateVenteRange($start, $end);


$i = 0;
$concernerTest =  $managerConcerner->getListSameRayonId2();
foreach ($concernerTest as $k => $c) :
    $i = $i + 1;
    //echo '-' . $i . '-' . $c['en_rayon_id'];
    $rayoninfo = $managerEnRayon->get($c['en_rayon_id']);
    $idprod = $rayoninfo->produit_id();
    $produit = $managerProduit->get($idprod);
    $nom = $produit->nom();
    echo $nom . " : ";
    
    $quantiteTotalSameRayonId = 0;
    foreach ($vente as $k => $v) :
        $concernerSameRayonId =  $managerConcerner->getListSameRayonIdAndVenteId($c['en_rayon_id'],$v->id());
        foreach ($concernerSameRayonId as $k => $cd) :
            $quantiteTotalSameRayonId = $quantiteTotalSameRayonId + $cd->quantite();
        endforeach;
    endforeach;    
    
    echo $quantiteTotalSameRayonId.", ";
    
endforeach;
echo '-' . $i . '-';


foreach ($vente as $k => $v) :
    $venteTotal = $venteTotal + $v->prixTotal();
    $concerner =  $managerConcerner->getList($v->id());
    $enrayon = $managerEnRayon->getAll();
    // foreach ($enrayon as $k => $e) :
    //     $concernerIdRay =  $managerConcerner->getList($e->id());
    //     foreach ($concernerIdRay as $k => $c) :
    //         $quantiteTotal = $quantiteTotal + $c->quantite();
    //         //echo $quantiteTotal;
    //     endforeach;
    // endforeach;


    foreach ($concerner as $k => $c) :
        $quantiteTotal = $quantiteTotal + $c->quantite();
    //echo $quantiteTotal;
    endforeach;

// foreach ($enrayon as $k => $e) :
//     $rayoninfo = $managerEnRayon->get($e->id());
//     $idprod = $rayoninfo->produit_id();
//     $produit = $managerProduit->get($idprod);
//     $nom = $produit->nom();
//     echo $nom . " : ";

// $concernerSameRayonId =  $managerConcerner->getListSameRayonId($e->id());
// foreach ($concernerSameRayonId as $k => $c) :
//     echo "-".$c->quantite();

// endforeach;

// $rayoninfo = $managerEnRayon->get($e->id());
// $idprod = $rayoninfo->produit_id();
// $produit = $managerProduit->get($idprod);
// $nom = $produit->nom();
// echo $nom . " : ";
// foreach ($concernerSameRayonId as $k => $c) :
//     $quantiteTotalEnRayon = $quantiteTotalEnRayon + $c->quantite();

// endforeach;
// echo $quantiteTotal . "-";
//endforeach;
endforeach;
echo $venteTotal . " - " . $quantiteTotal;
//$vente = $managerVente->getList();
//$js_code = json_encode($vente, JSON_HEX_TAG);
//echo $js_code;
