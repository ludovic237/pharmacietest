<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');

$id;
$vente;
$produit;
$enrayon;
$concerner;

global $pdo;
global $conndb;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
$produit = $managerProduit->get($id);
$vente = $managerVente->VenteActuMois();
$venteTotal = $managerVente->getList();
$nom = $produit->nom();

$nbrVenteMois = 0;
$prixVenteMois = 0;
$nbrReductionVenteMois = 0;

$nbrVenteTotal = 0;
$prixVenteTotal = 0;
$nbrReductionVenteTotal = 0;

$nbrVenteTotal = 0;
$nbrQteStock = 0;
$nbrReduction = 0;

$datas;
// echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($vente as $k => $v) :
        $venteid = $v->id();


        // echo $venteid . "-";
        foreach ($enrayon as $k => $e) :
            $enrayonid = $e->id();
            $concerner =  $managerConcerner->getExistsVenteIdAndEn_rayonId($venteid, $enrayonid);
            foreach ($concerner as $k => $c) :
                $nbrVenteMois = $nbrVenteMois + $c->quantite();
                $prixVenteMois = $prixVenteMois + $c->prixUnit();
                $nbrReductionVenteMois = $nbrReductionVenteMois + $c->reduction();
            endforeach;
        endforeach;
    endforeach;

    foreach ($venteTotal as $k => $v) :
        $venteid = $v->id();

        // echo $venteid . "-";
        foreach ($enrayon as $k => $e) :
            $enrayonid = $e->id();
            $concerner =  $managerConcerner->getExistsVenteIdAndEn_rayonId($venteid, $enrayonid);
            foreach ($concerner as $k => $c) :
                $nbrVenteTotal = $nbrVenteTotal + $c->quantite();
                $prixVenteTotal = $prixVenteTotal + ($c->quantite() * $c->prixUnit());
                $nbrReductionVenteTotal = $nbrReductionVenteTotal + $c->reduction();
            endforeach;
        endforeach;
    endforeach;


    $datas[] = array(
        'nomProduit' =>  $nom,
        'qteVenteMois' =>  $nbrVenteMois,
        'redVenteMois' =>  $nbrReductionVenteMois,
        'prixVenteMois' =>  $prixVenteMois,
        'qteVenteTotal' =>  $nbrVenteTotal,
        'redVenteTotal' =>  $nbrReductionVenteTotal,
        'prixVenteTotal' =>  $prixVenteTotal,
    );
    $donnees = array('data' => $datas);
    echo json_encode($donnees);
}
