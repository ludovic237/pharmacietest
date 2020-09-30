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


// echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($vente as $k => $v) :
        $venteid = $v->id();
       // echo $venteid . "-";
        foreach ($enrayon as $k => $e) :
            $enrayonid = $e->id();
            $concerner =  $managerConcerner->getExistsVenteIdAndEn_rayonId($venteid,$enrayonid);
            foreach ($concerner as $k => $c) :
               $nbrVenteMois = $nbrVenteMois + $c->quantite();
            endforeach;
        endforeach;
    endforeach;

    foreach ($enrayon as $k => $e) :
        $enrayonid = $e->id();
       // echo $enrayonid . "-";
        $concerner =  $managerConcerner->getExistsEn_rayonId($enrayonid);
        foreach ($concerner as $k => $c) :
            $nbrVenteTotal = $nbrVenteTotal + $c->quantite();
        endforeach;
    endforeach;
    //$js_code = json_encode($concerner, JSON_HEX_TAG);
    echo
        "<tr \">
        <td class='prix'>
            " . $nom . "
        </td>
        <td class='prix'>
           " . $nbrVenteMois . "
        </td>
        <td class='prix'>
           " . $nbrVenteTotal . "
        </td>
        <td class='prix'>
           " . $nbrQteStock . "
        </td>
        <td class='prix'>
        " . $nbrReduction . "
        </td>
    </tr>";
}
