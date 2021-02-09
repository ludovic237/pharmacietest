<?php
require_once('database.php');
require_once('../Class/caisse.php');

global $pdo;


$manager = new  CaisseManager($pdo);



if (isset($_POST['id'])){

    if(isset($_POST['fondCaisse'])){
        $id=$_POST['id'];
        $fermetureCaisse=$_POST['fermetureCaisse'];
        $fondCaisse=$_POST['fondCaisse'];
        //echo $id;
        //$prod = new Departement();
        if ($manager->existsId($id)) {
            $caisse = $manager->getId($id);

            $caisse->setfermetureCaisse($fermetureCaisse);
            $caisse->setfondCaisseFerme($fondCaisse);
            $caisse->setetat('En cours1');
            if($caisse->dateFerme() == null){
                $manager->updateFermeCaisse($caisse);
            }else{
                $manager->updateFermeCaisse1($caisse);
            }


        }
        else{
            echo 'Pas de session ouverte';
        }
    }elseif (isset($_POST['etat'])){
        $id=$_POST['id'];
        $caisse = $manager->getId($id);
        $etat=$_POST['etat'];
        //echo 'patasse';

        $caisse->setetat($etat);
        $manager->updateFermeCaisse1($caisse);

    }
    else{
        $id=$_POST['id'];

        //echo $id;
        //$prod = new Departement();
        if ($manager->existsId($id)) {
            $caisse = $manager->getId($id);

            $caisse->setetat('En cours');
            if($caisse->dateFerme() == null){
                $manager->updateFermeCaisse($caisse);
            }else{
                $manager->updateFermeCaisse1($caisse);
            }

        }
        else{
            echo 'Pas de session ouverte';
        }
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
            'fondCaisseOuvert' => $fondCaisse,
        ));
        $manager->add($caisse);
        echo 'ok';
    }
    else echo 'Session déja ouverte';



}


// D'abord, on se connecte ?ySQL




?>