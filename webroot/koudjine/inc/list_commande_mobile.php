<?php
require_once('database.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new CommandeManager($pdo);
$managerPc = new Produit_cmdManager($pdo);
$managerPr = new ProduitManager($pdo);

//echo $id;
$commande = $manager->getList();
$donnees = [];
$cmd = [];

foreach ($commande as $a => $b) :
    $pdtcmd = [];
    $Produit_cmds = $managerPc->getList($b->id());
    foreach ($Produit_cmds as $k => $v) :
        $nom = $managerPr->get($v->produit_id())->nom();
        $pdtcmd[] = array(
            'id' => $v->id(),
            'commande_id' => $b->id(),
            'produit_id' => $v->produit_id(),
            'produit_name' => $nom,
            'prixPublic' => $v->prixPublic(),
            'qtiteCmd' => $v->qtiteCmd(),
            'qtiteRecu' => $v->qtiteRecu(),
            'puCmd' => $v->puCmd(),
            'puRecept' => $v->puRecept(),
            'total' => $v->qtiteRecu() * $v->puRecept(),
            'dateExp' => '',
            'etat' => $v->etat(),
            'supprimer' => $v->supprimer(),
        );
    endforeach;
    $cmd[] = array(
        'id' => $b->id(),
        'fournisseur_id' => $b->fournisseur_id(),
        'fournisseur_nom' => '',
        'dateCreation' => $b->dateCreation(),
        'dateLivraison' => $b->dateLivraison(),
        'note' => $b->note(),
        'qtiteCmd' => $b->qtiteCmd(),
        'qtiteRecu' => $b->qtiteRecu(),
        'uniteGratuite' => $b->uniteGratuite(),
        'montantCmd' => $b->montantCmd(),
        'montantRecu' => $b->montantRecu(),
        'totalCmd' => ($b->qtiteRecu() * $b->montantRecu()),
        'etat' => $b->etat(),
        'ref' => $b->ref(),
        'productCmd' => $pdtcmd,
        'supprimer' => $b->supprimer());

endforeach;

echo json_encode($cmd);

?>
