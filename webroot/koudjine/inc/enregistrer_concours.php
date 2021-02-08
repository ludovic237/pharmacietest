<?php
require_once('database.php');
require_once('../Class/concours.php');

global $pdo;


$manager = new ConcoursManager($pdo);



if (isset($_POST['id'])&&isset($_POST['univid'])&&isset($_POST['dated'])&&isset($_POST['datef'])&&isset($_POST['description'])&&isset($_POST['modalite'])&&isset($_POST['composition'])&&isset($_POST['datec'])){

    $id=$_POST['id'];
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
    //echo $id;
    //$univ = new Departement();
    if ($manager->existsUniv($id_univ,$description)) {
        $univ = $manager->getUniv($id_univ,$description);
        //echo "Ce departement existe";
        if($univ->CONCOURS_ID() == $id){
            $univ->setUNIVERSITE_ID($id_univ);
            $univ->setDESCRIPTION($description);
            $univ->setMODALITE_ADMISSION($modalite);
            $univ->setCOMPOSITION_DOSSIER($composition);
            $univ->setDATE_DEBUT_CONCOURS($dated);
            $univ->setDATE_FIN_CONCOURS($datef);
            $univ->setDATE_DOSSIER($datec);
            $univ->setDESCRIPTION($description);
            $manager->update($univ);
            echo 'ok';
        }
        else{

            echo 'Ce concours existe déjà';

        }
    }
    else{
        $univ = $manager->get($id);
        $univ->setUNIVERSITE_ID($id_univ);
        $univ->setDESCRIPTION($description);
        $univ->setMODALITE_ADMISSION($modalite);
        $univ->setCOMPOSITION_DOSSIER($composition);
        $univ->setDATE_DEBUT_CONCOURS($dated);
        $univ->setDATE_FIN_CONCOURS($datef);
        $univ->setDATE_DOSSIER($datec);
        $univ->setDESCRIPTION($description);
        $manager->update($univ);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    if(isset($_POST['univid'])&&isset($_POST['dated'])&&isset($_POST['datef'])&&isset($_POST['description'])&&isset($_POST['modalite'])&&isset($_POST['composition'])&&isset($_POST['datec'])){
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
    }


    if(!$manager->existsUniv($id_univ,$description)){
        $date = genererID();
        //echo $datec;
        $concours = new Concours(array(
            'CONCOURS_ID' => $date,
            'UNIVERSITE_ID' => $id_univ,
            'DATE_DEBUT_CONCOURS' => $dated,
            'DATE_FIN_CONCOURS' => $datef,
            'DESCRIPTION' => $description,
            'MODALITE_ADMISSION' => $modalite,
            'COMPOSITION_DOSSIER' => $composition,
            'DATE_DOSSIER' => $datec,
        ));
        $manager->add($concours);
        echo 'ok';
    }
    else echo 'Ce concours existe déjà';



}


// D'abord, on se connecte ?ySQL




?>