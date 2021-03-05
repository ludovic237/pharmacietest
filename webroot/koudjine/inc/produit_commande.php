<?php
require_once('database.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');

global $pdo;


$managerPo = new Produit_cmdManager($pdo);
$manager = new CommandeManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerEn = new En_rayonManager($pdo);

$idp = substr($_POST['idp'], 1);
$idc=$_POST['idc'];
$qte=$_POST['qte'];
$ug=$_POST['ug'];
$prixu=$_POST['prixu'];


if (isset($_POST['ide'])){
    $ide=$_POST['ide'];
    $idp=$_POST['idp'];
    $prixPublic=$_POST['prixp'];
    $datep=$_POST['datep'];
    $reduction=$_POST['reduction'];
    if($manager->existsId($idc) && !$managerPo->existsProduit_id($idc, $idp)){
        //echo "passe \n";
        //echo $managerPr->getStock($managerEn->get($ide)->produit_id(),$qte)->stock();

        $conc = new Produit_cmd(array(
            'commande_id' => $idc,
            'produit_id' => $idp,
            'prixPublic' => $prixPublic,
            'puCmd' => $prixu,
            'puRecept' => $prixu,
            'qtiteCmd' => $qte,
            'qtiteRecu' => $qte,
            'uniteGratuite' => $ug,
            'etat' => "Livré"
        ));
        $managerPo->add($conc);
        // Créer une entrée en stock
        $en_rayon = new En_rayon(array(
            'id' => $ide,
            'produit_id' => $idp,
            'fournisseur_id' => $manager->get($idc)->fournisseur_id(),
            'commande_id' => $idc,
            'prixAchat' => $prixu,
            'prixVente' => $prixPublic,
            'quantite' => $qte,
            'reduction' => $reduction,
            'quantiteRestante' => ($qte + $ug),
            'datePeremption' => $datep,
        ));
        $en_rayon->setcommaande_id($idc);
        $managerEn->add($en_rayon);
        // on met à jour la quantité du stock produit
        $prod = $managerPr->get($idp);
        $prod->setstock(($prod->stock() + ($qte + $ug)));
        $managerPr->update($prod);


        $donnees = array('erreur' =>'ok');
        echo json_encode($donnees);
    }
    else{
        $donnees = array('erreur' =>'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
        //echo 'passe pas';
    }


}
else{


    //on verifie qu'il existe deja la vente dans la BD et on verifie aussi si la ligne à enregistrer n'a pas deja été faite
    //echo $manager->existsId($idv);
    //echo $managerCo->existsEn_rayonId($idv, $ide);
    if($manager->existsId($idc) && !$managerPo->existsProduit_id($idc, $idp)){
        //echo "passe \n";
        //echo $managerPr->getStock($managerEn->get($ide)->produit_id(),$qte)->stock();

        $conc = new Produit_cmd(array(
            'commande_id' => $idc,
            'produit_id' => $idp,
            'puCmd' => $prixu,
            'qtiteCmd' => $qte,
            'etat' => "Commandé"
        ));
        $managerPo->add($conc);



        $donnees = array('erreur' =>'ok');
        echo json_encode($donnees);
    }
    else{
        $donnees = array('erreur' =>'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
        //echo 'passe pas';
    }



}


// D'abord, on se connecte ?ySQL




?>