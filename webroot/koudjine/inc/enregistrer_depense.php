<?php
require_once('database.php');
require_once('../Class/depense.php');
require_once('../Class/type_depense.php');

global $pdo;


$manager = new DepenseManager($pdo);
$managerTy = new TypeDepenseManager($pdo);

$type=$_POST['type'];
$objet=$_POST['objet'];
$prix=$_POST['prix'];
$qte=$_POST['qte'];
$dateDel=$_POST['dateDel'];
if($dateDel == ''){
    $dateDel = NULL;
}
$dateDep=$_POST['dateDep'];
$cni=$_POST['cni'];
$lieu=$_POST['lieu'];
$beneficiaire=$_POST['beneficiaire'];
$societe=$_POST['societe'];

if (isset($_POST['id'])){

    $id=$_POST['id'];
    $prod = $manager->get($id);

    $prod->settypeDepense($type);
    $prod->setdesignation($objet);
    $prod->setprixUnitaire($prix);
    $prod->setquantite($qte);
    $prod->setdateDepense($dateDep);
    $prod->setdateDelivrance($dateDel);
    $prod->setbeneficiaire($beneficiaire);
    $prod->setlieuDelivrance($lieu);
    $prod->setnumeroCni($cni);
    $prod->setsociete($societe);
    $manager->update($prod);
    echo 'ok';
}
else{
    $caisse_id=$_POST['caisse_id'];

    $depense = new Depense(array(
        'caisse_id' => $caisse_id,
        'typeDepense' => $type,
        'designation' => $objet,
        'prixUnitaire' => $prix,
        'quantite' => $qte,
        'dateDepense' => $dateDep,
        'dateDelivrance' => $dateDel,
        'numeroCni' => $cni,
        'lieuDelivrance' => $lieu,
        'societe' => $societe,
        'beneficiaire' => $beneficiaire,
    ));
    $manager->add($depense);
    echo 'ok';

}


// D'abord, on se connecte ?ySQL
