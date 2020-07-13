<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');


global $pdo;


$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);

$caisse_id = $_POST['caisse_id'];
$vente_id = $_POST['vente_id'];

if ($manager->existsId($vente_id)){

    $vente = $manager->get($vente_id);
    $vente->setcaisse_id($caisse_id);
    $manager->update($vente);

}
else{



    if(true){
        $donnees = array('erreur' =>'ok');
        echo json_encode($donnees);
    }
    else{
        $donnees = array('erreur' =>'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
    }



}


// D'abord, on se connecte ?ySQL




?>