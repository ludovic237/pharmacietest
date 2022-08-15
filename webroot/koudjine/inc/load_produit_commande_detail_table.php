<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');
require_once('../Class/fournisseur.php');

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
$managerFournisseur = new FournisseurManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];

if (isset($_POST['start']))
    $start = $_POST['start'];

if (isset($_POST['end']))
    $end = $_POST['end'];

$produit = $managerProduit->get($id);
$commande = $managerCommande->getListRange($start,$end);
$nom = $produit->nom();
$fournisseur;
$commandeid;
$pdtcmd;

$_qteCommandeCmd=0;
$_prixCommandeCmdTotal=0;
$_qteCommandeRecu=0;
$_prixCommandeRecuTotal=0;

$datas = [];
if (isset($_POST['id']) || isset($_GET['id'])) {

    foreach ($commande as $k => $v) :
        $commandeid = $v->id();
        $fournisseur = $managerFournisseur->get($v->fournisseur_id());
        $pdtcmd = $managerProduitCommande->getExistsCmdIdAndProduitId($commandeid, $id);
        foreach ($pdtcmd as $k => $c) :

            $_qteCommandeRecu = $_qteCommandeRecu + $c->qtiteCmd();
            $_prixCommandeRecuTotal = $_prixCommandeRecuTotal + ($c->qtiteCmd()*$c->puCmd());
            $_qteCommandeCmd = $_qteCommandeCmd + $c->qtiteRecu();
            $_prixCommandeCmdTotal = $_prixCommandeCmdTotal + ($c->qtiteRecu()*$c->puCmd());

            $datas[] = array(
                "DT_RowId" => $c->id(),
                'date' => $v->dateCreation(),
                'produit_cmd_id' => $c->id(),
                'produit_id' => $id,
                'commande_id' => $commandeid,
                'fournisseur' => $fournisseur->nom(),
                'prixAchat' => $c->puCmd(),
                'prixVente' => $c->prixPublic(),
                'qtiteCmd' => $c->qtiteCmd(),
                'qtiteRecu' => $c->qtiteRecu(),
                'totalCmd' => ($c->qtiteCmd()*$c->puCmd()),
                'TotalRecu' => ($c->qtiteRecu()*$c->puCmd()),
                'etat' => $v->etat(),
                'action' => $v->id(),
            );
        endforeach;
    endforeach;


    if ($datas == null) {
        $donnees = array('data' => [],'qteCommandeRecuTotal' => 0,'qteCommandeRecu' => 0);
        echo json_encode($donnees);
    } else {
        $donnees = array('data' => $datas,
        'prixCommandeRecuTotal' => $_prixCommandeRecuTotal,'qteCommandeRecu' => $_qteCommandeRecu,
        'prixCommandeCmdTotal' => $_prixCommandeCmdTotal,'qteCommandeCmd' => $_qteCommandeCmd);
        echo json_encode($donnees);
    }

    //$js_code = json_encode($concerner, JSON_HEX_TAG);

}
