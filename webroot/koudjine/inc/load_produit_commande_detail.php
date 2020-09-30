<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');

$id;
$vente;
$produit;
$enrayon;
$produit_commande;
$commande;

global $pdo;
global $conndb;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerCommande = new CommandeManager($pdo);
$managerProduitCommande = new Produit_cmdManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];


$produit = $managerProduit->get($id);
$commande = $managerCommande->CommandeActuMois();
$nom = $produit->nom();
$nbrCommandeMois = 0;
$nbrCommandeTotal = 0;
$nbrQteStock = 0;
$nbrReduction = 0;


// echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($commande as $k => $v) :
        $commandeid = $v->id();
        $pdtcmd =  $managerProduitCommande->getExistsCmdIdAndProduitId($commandeid, $id);
        foreach ($pdtcmd as $k => $c) :
            $nbrCommandeMois = $nbrCommandeMois + $c->qtiteCmd();
        endforeach;
    endforeach;

    $pdtcmd =  $managerProduitCommande->getExistsProduitId($id);
    foreach ($pdtcmd as $k => $c) :
        $nbrCommandeTotal = $nbrCommandeTotal + $c->qtiteCmd();
    endforeach;
    //$js_code = json_encode($concerner, JSON_HEX_TAG);
    echo
        "<tr \">
        <td class='prix'>
            " . $nom . "
        </td>
        <td class='prix'>
           " . $nbrCommandeMois . "
        </td>
        <td class='prix'>
           " . $nbrCommandeTotal . "
        </td>
        <td class='prix'>
           " . $nbrQteStock . "
        </td>
    </tr>";
}
