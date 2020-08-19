<?php
require_once('database.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');
require_once('../Class/produit.php');

global $pdo;


$managerPo = new Produit_cmdManager($pdo);
$manager = new CommandeManager($pdo);
$managerPr = new ProduitManager($pdo);

$idp = substr($_POST['idp'], 1);
$idc=$_POST['idc'];
$qte=$_POST['qte'];
$prixu=$_POST['prixu'];


if (isset($_POST['id'])){



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