<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');

$id;
$vente;
$produit;
$enrayon;
$concerner;

global $pdo;
global $conndb;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerCommande = new CommandeManager($pdo);
$managerProduitCommande = new Produit_cmdManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];


$produit = $managerProduit->get($id);
$commande = $managerCommande->CommandeActuMois();
$nom = $produit->nom();


echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {

    foreach ($commande as $k => $v) :
        $commandeid = $v->id();
        $pdtcmd =  $managerProduitCommande->getExistsCmdIdAndProduitId($commandeid, $id);
        foreach ($pdtcmd as $k => $c) :
            echo
                    "<tr \">
                        <td class='prix'>
                            " . $c->produit_id(). "
                        </td>
                        <td class='prix'>
                        " . $c->commande_id(). "
                        </td>
                        <td class='prix'>
                        " . $c->prixPublic(). "
                        </td>
                        <td class='prix'>
                        " . $c->qtiteCmd(). "
                        </td>
                    </tr>";
        endforeach;
    endforeach;

    //$js_code = json_encode($concerner, JSON_HEX_TAG);

}
