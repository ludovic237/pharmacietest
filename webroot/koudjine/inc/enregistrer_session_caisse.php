<?php
require_once('database.php');
require_once('../Class/caisse.php');

global $pdo;


$manager = new  CaisseManager($pdo);



if (isset($_POST['id'])){ 

    $id=$_POST['id'];
    $user_id=$_POST['user_id'];
    $ouvertureCaisse=$_POST['ouvertureCaisse'];
    $fermetureCaisse=$_POST['fermetureCaisse'];
    $dateOuvert=$_POST['dateOuvert'];
    $dateFerme=$_POST['dateFerme'];
    $session=$_POST['session'];
    $fondCaisse=$_POST['fondCaisse'];
    $etat=$_POST['etat'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsId($id)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setetat($etat);
            $prod->setuser_id($user_id);
            $prod->setouvertureCaisse($ouvertureCaisse);
            $prod->setfermetureCaisse($fermetureCaisse);
            $prod->setdateOuvert($dateOuvert);
            $prod->setdateFerme($dateFerme);
            $prod->setsession($session);
            $prod->setfondCaisse($fondCaisse);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setetat($etat); 
        $prod->setuser_id($user_id);
        $prod->setouvertureCaisse($ouvertureCaisse);
        $prod->setfermetureCaisse($fermetureCaisse);
        $prod->setdateOuvert($dateOuvert);
        $prod->setdateFerme($dateFerme);
        $prod->setsession($session);
        $prod->setfondCaisse($fondCaisse);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['nom'])&&isset($_POST['dateFerme'])&&isset($_POST['session'])&&isset($_POST['dateFermemax'])&&isset($_POST['fondCaisse'])){
        $id_univ=$_POST['univid'];
        if($_POST['dated'] != null){
            $dated = DateTime::createFromFormat('d-m-Y', $_POST['dated']);
            $dated = $dated->format('Y-m-d');}
        else $dated = null;
        if($_POST['datef'] != null){
            $datef = DateTime::createFromFormat('d-m-Y', $_POST['datef']);
            $datef = $datef->format('Y-m-d');}
        else $datef = null;
        if($_POST['datec'] != null){
            $datec = DateTime::createFromFormat('d-m-Y', $_POST['datec']);
            $datec = $datec->format('Y-m-d');}
        else $datec = null;
        $description=$_POST['description'];
        $modalite=$_POST['modalite'];
        $composition=$_POST['composition'];
        $composition = trim($composition,';');
        //echo $datec;
    }*/

    $user_id=$_POST['user_id'];
    $ouvertureCaisse=$_POST['ouvertureCaisse'];
    $fermetureCaisse=$_POST['fermetureCaisse'];
    $dateOuvert=$_POST['dateOuvert'];
    $dateFerme=$_POST['dateFerme'];
    $session=$_POST['session'];
    $fondCaisse=$_POST['fondCaisse'];
    $etat=$_POST['etat'];
    $etatRestante=$_POST['etatRestante'];


    if(!$manager-> existsId($id)){
        //$date = genererID();
        //echo $datec;
        $en_rayon = new  Caisse(array(
            'etategorie_id' => $etat,
            'etatRestante_id' => $etatRestante,
            'user_id' => $user_id,
            'ouvertureCaisse' => $ouvertureCaisse,
            'codefermetureCaisse' => $fermetureCaisse,
            'codedateOuvert' => $dateOuvert,
            'dateFerme' => $dateFerme,
            'session' => $session,
            'dateFermeMax' => $dateFermemax,
            'fondCaisseMax' => $fondCaisse,
        ));
        $manager->add($en_rayon);
        echo 'ok';
    }
    else echo 'Ce nom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL




?>