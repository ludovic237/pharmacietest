<?php
require_once('database.php');
require_once('../Class/caisse.php');

global $pdo;


$manager = new  CaisseManager($pdo);



if (isset($_POST['id'])){ 

    $id=$_POST['id'];
    $fermetureCaisse=$_POST['fermetureCaisse'];
    $fondCaisse=$_POST['fondCaisse'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsId($id)) {
        $caisse = $manager->getId($id);

        $caisse->setfermetureCaisse($fermetureCaisse);
        $caisse->setfondCaisse($fondCaisse);
        $manager->updateFermeCaisse($caisse);
            echo 'ok';

    }
    else{
        echo 'Pas de session ouverte';
    }

}
else{

    $user_id=$_POST['user_id'];
    $ouvertureCaisse=$_POST['ouvertureCaisse'];
    $session=$_POST['session'];
    $fondCaisse=$_POST['fondCaisse'];
    $etat=$_POST['etat'];


    if(!$manager-> exists()){
        //$date = genererID();
        //echo $datec;
        $caisse = new  Caisse(array(
            'user_id' => $user_id,
            'ouvertureCaisse' => $ouvertureCaisse,
            'session' => $session,
            'etat' => $etat,
            'fondCaisse' => $fondCaisse,
        ));
        $manager->add($caisse);
        echo 'ok';
    }
    else echo 'Session déja ouverte';



}


// D'abord, on se connecte ?ySQL




?>