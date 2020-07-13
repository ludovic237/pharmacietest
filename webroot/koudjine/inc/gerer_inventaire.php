<?php
require_once('database.php');
require_once('../Class/inventaire.php');

global $pdo;


$manager = new InventaireManager($pdo);

$action = $_POST['action'];
echo 'passe';

if ($action == "lancer"){

    $inventaire = new Inventaire(array(
        'etat' => 'En cours'
    ));
    $manager->add($inventaire);

}
else{
    $inventaire = $manager->get();
    $inventaire->setetat('Clot');
    $manager->update($inventaire);

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