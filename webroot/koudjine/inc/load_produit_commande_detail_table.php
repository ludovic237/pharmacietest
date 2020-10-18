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

$datas = [];
if (isset($_POST['id']) || isset($_GET['id'])) {

    foreach ($commande as $k => $v) :
        $commandeid = $v->id();
        $pdtcmd =  $managerProduitCommande->getExistsCmdIdAndProduitId($commandeid, $id);
        foreach ($pdtcmd as $k => $c) :
            $datas[] = array(
                'produit_id' => "<p class='produit_id'> " . $c->produit_id() . "</p>",
                'commande_id' => "<p class='commande_id'> " . $c->commande_id() . "</p>",
                'prixPublic' => "<p class='prixPublic'> " . $c->prixPublic() . "</p>",
                'qtiteCmd' => "<p class='qtiteCmd'> " . $c->qtiteCmd() . "</p>",
            );
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
    
    //$js_code = json_encode($concerner, JSON_HEX_TAG);

}
