<?php
require_once('database.php');
require_once('../Class/commande.php');
require_once('../Class/en_rayon.php');
require_once('../Class/fournisseur.php');
require_once('../Class/produitcmd.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new CommandeManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerFo = new FournisseurManager($pdo);
$managerPo = new Produit_cmdManager($pdo);
$managerProd = new ProduitManager($pdo);

$idc = $_POST['idc'];
$idp = $_POST['idp'];
$qte = $_POST['qte'];
$prixa = $_POST['prixa'];
$prixv = $_POST['prixv'];
$datep = $_POST['datep'];



    $fournisseur = $managerFo->get($manager->get($idc)->fournisseur_id());
    $Date_Du_Jour = date("Ymd");
    $Date_Du_Jour1 = date("Y-m-d");
    $id = ''.$idp.$fournisseur->code().$Date_Du_Jour;
    echo $idc;

    // on vérifie s'il y'a deja une entrée crée avec l'id
    if($managerEn->existsId($id)){
        $ent = $managerEn->get($id);
        $ent->setcommaande_id($idc);
        $ent->setprixAchat($prixa);
        $ent->setprixVente($prixv);
        $ent->setquantite(($ent->quantite() + ($qte)));
        $ent->setquantiteRestante(($ent->quantiteRestante() + ($qte)));
        $ent->setdatePeremption($datep);
        $managerEn->update($ent);
        // on met à jour la quantité du stock produit
        $prod = $managerProd->get($idp);
        $prod->setstock(($prod->stock() + ($qte)));
        $managerProd->update($prod);
    }else{
        // Créer une entrée en stock
        $en_rayon = new En_rayon(array(
            'id' => $id,
            'produit_id' => $idp,
            'fournisseur_id' => $fournisseur->id(),
            'commande_id' => $idc,
            'prixAchat' => $prixa,
            'prixVente' => $prixv,
            'quantite' => $qte,
            'quantiteRestante' => $qte,
            'datePeremption' => $datep,
        ));
        $en_rayon->setcommaande_id($idc);
        $managerEn->add($en_rayon);
        // on met à jour la quantité du stock produit
        $prod = $managerProd->get($idp);
        $prod->setstock(($prod->stock() + ($qte)));
        $managerProd->update($prod);
    }


    // mettre à jour le produit commandé

    $produit_cmd = $managerPo->get($idp,$idc);
    $produit_cmd->setqtiteRecu($qte);
    $produit_cmd->setpuRecept($prixa);
    $produit_cmd->setprixPublic($prixv);
    $produit_cmd->setetat('Livré');
    $managerPo->update($produit_cmd);

    // mettre à jour la commande

    $etat = $_POST['etat'];
    $commentaire = $_POST['commentaire'];
    $total = $_POST['total'];
    $nbreProduit = $_POST['nbreProduit'];
    //echo $nbreProduit;

    $commande = $manager->get($idc);
    $commande->setqtiteRecu($nbreProduit);
    $commande->setnote($commentaire);
    $commande->setetat($etat);
    $commande->setmontantRecu($total);
    $commande->setdateLivraison($Date_Du_Jour1);
    $manager->update($commande);






?>