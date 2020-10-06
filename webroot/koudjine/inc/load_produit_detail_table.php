<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
echo "start";
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


echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($vente as $k => $v) :
        $venteid = $v->id();
        //echo $venteid . "-";
        foreach ($enrayon as $k => $e) :
            $enrayonid = $e->id();
            $concerner =  $managerConcerner->getExistsVenteIdAndEn_rayonId($venteid, $enrayonid);

            foreach ($concerner as $k => $c) :
                echo
                    "<tr \">
                        <td class='prix'>
                            " . $c->vente_id(). "
                        </td>
                        <td class='prix'>
                            " .
                            $venteDate = $managerVente->getDateVente($c->vente_id())->dateVente()
                             . "
                        </td>
                        <td class='prix'>
                        " . $c->en_rayon_id(). "
                        </td>
                        <td class='prix'>
                        " . $c->prixUnit(). "
                        </td>
                        <td class='prix'>
                        " . $c->quantite(). "
                        </td>
                        <td class='prix'>
                        " . $c->reduction(). "
                        </td>
                    </tr>";
            endforeach;
        endforeach;
    endforeach;

    //$js_code = json_encode($concerner, JSON_HEX_TAG);

}
