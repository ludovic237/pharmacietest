<?php
require_once('database.php');
require_once('../Class/ville.php');

global $pdo;


$manager = new VilleManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $code=$_POST['code'];
    $nom=$_POST['nom'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setnom($nom);
            $prod->setcode($code);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de rayon existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setnom($nom);
        $prod->setcode($code);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['nom'])&&isset($_POST['stock'])&&isset($_POST['stockmin'])&&isset($_POST['stockmax'])&&isset($_POST['reduction'])){
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

    $code=$_POST['code'];
    $nom=$_POST['nom'];



    if(!$manager->existsNom($nom)){
        //$date = genererID();
        //echo $datec;
        $rayon = new Ville(array(
            'nom' => $nom,
            'code' => $code,
        ));
        $manager->add($rayon);
        echo 'ok';
    }
    else echo 'Ce nom de rayon existe déjà';



}


// D'abord, on se connecte ?ySQL




?>