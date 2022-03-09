<?php
require_once('database.php');
require_once('../Class/client.php');

global $pdo;

$manager = new ClientManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $telephone=$_POST['telephone'];
    $modeReglement=$_POST['modeReglement'];
    $poid=$_POST['poid'];
    $taille=$_POST['taille'];
    $assureur_id=$_POST['assureur_id'];
    $CodePostal_id=$_POST['CodePostal_id'];
    $reduction=$_POST['reduction'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setnom($nom);
            $prod->settelephone($telephone);
            $prod->setmodeReglement($modeReglement);
            $prod->setpoid($poid);
            $prod->settaille($taille);
            // $prod->setassureur_id($assureur_id);
            // $prod->setCodePostal_id($CodePostal_id);
            $prod->setreduction($reduction);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de client existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setnom($nom);
        $prod->settelephone($telephone);
        $prod->setmodeReglement($modeReglement);
        $prod->setpoid($poid);
        $prod->settaille($taille);
        $prod->setreduction($reduction);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['nom'])&&isset($_POST['taille'])&&isset($_POST['assureur_id'])&&isset($_POST['CodePostal_id'])&&isset($_POST['reduction'])){
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
    $telephone=$_POST['telephone'];
    $modeReglement=$_POST['modeReglement'];
    $poid=$_POST['poid'];
    $taille=$_POST['taille'];
    // $assureur_id=$_POST['assureur_id'];
    // $CodePostal_id=$_POST['CodePostal_id'];
    $reduction=$_POST['reduction'];



    if(!$manager->existsNom($nom)){
        //$date = genererID();
        //echo $datec;
        $client = new Client(array(
            'nom' => $nom,
            'telephone' => $telephone,
            'codemodeReglement' => $modeReglement,
            'codepoid' => $poid,
            'taille' => $taille,
            // 'assureur_id' => $assureur_id,
            // 'CodePostal_id' => $CodePostal_id,
            'reduction' => $reduction,
        ));
        $manager->add($client);
        echo 'ok';
    }
    else echo 'Ce nom de client existe déjà';



}


// D'abord, on se connecte ?ySQL




?>