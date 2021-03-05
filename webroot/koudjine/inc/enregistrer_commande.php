<?php
require_once('database.php');
require_once('../Class/commande.php');

global $pdo;


$manager = new  CommandeManager($pdo);

$idGen = genererID();
$idf=$_POST['idf'];
$qte=$_POST['qte'];
$ug=$_POST['ug'];
$montant=$_POST['montant'];
echo $ug;

$ref = genererreferenceCommande($manager->countMois());


    if(!isset($_POST['datel'])){
        $commande = new Commande(array(
            'id' => $idGen,
            'fournisseur_id' => $idf,
            'dateLivraison' => null,
            'note' => null,
            'qtiteRecu' => null,
            'montantRecu' => null,
            'qtiteCmd' => $qte,
            'uniteGratuite' => $ug,
            'ref' => $ref,
            'montantCmd' => $montant
        ));
        $manager->add($commande);
        $donnees = array('erreur' =>'ok', 'id' => $idGen, 'ref' => $ref);
        echo json_encode($donnees);
    }else{
        $datel=$_POST['datel'];
        $numLivraison=$_POST['numLivraison'];
        $commande = new Commande(array(
            'id' => $idGen,
            'fournisseur_id' => $idf,
            'dateLivraison' => $datel,
            'note' => $numLivraison,
            'qtiteRecu' => $qte,
            'montantRecu' => $montant,
            'qtiteCmd' => $qte,
            'uniteGratuite' => $ug,
            'ref' => $ref,
            'montantCmd' => $montant
        ));
        $manager->add($commande);
        $donnees = array('erreur' =>'ok', 'id' => $idGen, 'ref' => $ref);
        echo json_encode($donnees);
    }





?>