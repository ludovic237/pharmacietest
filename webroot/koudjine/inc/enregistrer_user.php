<?php
require_once('database.php');
require_once('../Class/user.php');

global $pdo;


$manager = new UserManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $fonction=$_POST['fonction'];
    $telephone=$_POST['telephone'];
    $reductionMax=$_POST['reductionMax'];
    $reduction=$_POST['reduction'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsnom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setnom($nom);
            $prod->setprenom($prenom);
            $prod->setfonction($fonction);
            $prod->setReduction($reduction);
            $prod->setreductionMax($reductionMax);
            $prod->setemail($email);
            $prod->settelephone($telephone);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce prenom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setnom($nom);
        $prod->setprenom($prenom);
        $prod->setfonction($fonction);
        $prod->setReduction($reduction);
        $prod->setreductionMax($reductionMax);
        $prod->setemail($email);
        $prod->settelephone($telephone);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set prenom='".$prenom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_id = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['prenom'])&&isset($_POST['reductionMax'])&&isset($_POST['reduction'])&&isset($_POST['reductionMaxmax'])&&isset($_POST['reduction'])){
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
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $fonction=$_POST['fonction'];
    $telephone=$_POST['telephone'];
    $reductionMax=$_POST['reductionMax'];
    $reduction=$_POST['reduction'];



    if(!$manager->existsnom($nom)){
        //$date = genererid();
        //echo $datec;
        $employe = new User(array(
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'codefonction' => $fonction,
            'codetelephone' => $telephone,
            'reductionMax' => $reductionMax,
            'reduction' => $reduction,
        ));
        $manager->add($employe);
        echo 'ok';
    }
    else echo 'Ce prenom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL
