<?php
require_once('database.php');
require_once('../Class/bon_caisse.php');

global $pdo;


$manager = new BonCaisseManager($pdo);

if (isset($_POST['id']))
    $id = $_POST['id'];

if (isset($_POST['id'])){
    $bon = $manager->getCodebarre_id($id);
    $donnees = array('erreur' =>'non', 'nom' => $bon->nom_client() ,'montant' => $bon->montant(), 'id' => $bon->id(), 'dateE' => $bon->dateEncaisser());
    echo json_encode($donnees);

}
else{
    $new_id = $_POST['new_id'];
    $caisse_id = $_POST['caisse_id'];
    $nom = $_POST['nom'];
    $montant = $_POST['montant'];
    $dateEncaisser = $_POST['dateEncaisser'];

    if($new_id == 0){
        $bon = new BonCaisse(array(
            'nom_client' => $nom,
            'caisse_id' => $caisse_id,
            'montant' => $montant,
            'type' => 'Générer',
            'codebarre_id' => genererCodebarreID(),
        ));
        $manager->add($bon);
    }else{
        $bon = $manager->get($new_id);
        $bon->setcaisse_id_encaisser($caisse_id);
        $bon->setdateEncaisser($dateEncaisser);
        $bon->settype('Encaisser'); 
        $manager->update($bon);
    }



}


// D'abord, on se connecte ?ySQL




?>