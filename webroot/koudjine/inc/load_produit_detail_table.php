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
$nom = $produit->nom();
$nbrVenteMois = 0;
$nbrVenteTotal = 0;
$nbrQteStock = 0;
$nbrReduction = 0;
$datas = [];
if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($vente as $k => $v) :
        $venteid = $v->id();
        //echo $venteid . "-";
        foreach ($enrayon as $k => $e) :
            $enrayonid = $e->id();
            $concerner =  $managerConcerner->getExistsVenteIdAndEn_rayonId($venteid, $enrayonid);

            foreach ($concerner as $k => $c) :
                $venteDate = $managerVente->getDateVente($c->vente_id())->dateVente();
                $datas[] = array(
                    'venteid' => "<p class='venteid'> " . $c->vente_id(). "</p>",
                    'datevente' => "<p class='datevente'> " .  $venteDate. "</p>",
                    'enrayon' => "<p class='enrayon'> " . $c->en_rayon_id() . "</p>",
                    'prixunit' => "<p class='prixunit'> " . $c->prixUnit() . "</p>",
                    'quantite' => "<p class='quantite'> " .$c->quantite() . "</p>",
                    'reduction' => "<p class='reduction'> " . $c->reduction() . "</p>",
                );
                
            endforeach;
        endforeach;
    endforeach;
    if ($datas == null) {
        $donnees = array('data' => []);
        echo json_encode($donnees);
    }
    else{
        $donnees = array('data' => $datas);
        echo json_encode($donnees);
    }

}
