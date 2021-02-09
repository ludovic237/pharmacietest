<?php
require_once('database.php');
require_once('../Class/assureur.php');

global $pdo;


$manager = new AssureurManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $taux=$_POST['taux'];
    $CodePostal_id=$_POST['CodePostal_id'];
    $telephone=$_POST['telephone'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            
            $prod->setnom($nom);
            $prod->settaux($taux);
             $prod->setCodePostal_id($CodePostal_id);
            $prod->settelephone($telephone);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de assureur existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setnom($nom);
        $prod->settaux($taux);
        $prod->setCodePostal_id($CodePostal_id);
        $prod->settelephone($telephone);
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

    $nom=$_POST['nom'];
    $taux=$_POST['taux'];
    $CodePostal_id=$_POST['CodePostal_id'];
    $telephone=$_POST['telephone'];



    if(!$manager->existsNom($nom)){
        //$date = genererID();
        //echo $datec;
        $assureur = new Assureur(array(
          
            'nom' => $nom,
            'taux' => $taux,
            'CodePostal_id' => $CodePostal_id,
            'telephone' => $telephone,
        ));
        $manager->add($assureur);
        echo 'ok';
    }
    else echo 'Ce nom de assureur existe déjà';



}


// D'abord, on se connecte ?ySQL




?>