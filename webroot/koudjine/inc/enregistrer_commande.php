<?php
require_once('database.php');
require_once('../Class/commande.php');

global $pdo;


$manager = new  CommandeManager($pdo);

$idGen = genererID();
$idf=$_POST['idf'];
$qte=$_POST['qte'];
$montant=$_POST['montant'];

$ref = genererreferenceCommande($manager->countMois());


    $commande = new Commande(array(
        'id' => $idGen,
        'fournisseur_id' => $idf,
        'dateLivraison' => null,
        'note' => null,
        'qtiteRecu' => null,
        'montantRecu' => null,
        'qtiteCmd' => $qte,
        'ref' => $ref,
        'montantCmd' => $montant
    ));
    $manager->add($commande);
    $donnees = array('erreur' =>'ok', 'id' => $idGen, 'ref' => $ref);
    echo json_encode($donnees);





?>