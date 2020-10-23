<?php
require_once('database.php');
require_once('../Class/employe.php');

global $pdo;


$manager = new EmployeManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $identifiant=$_POST['identifiant'];
    $password=$_POST['password'];
    $codebarre_id=$_POST['codebarre_id'];
    $type=$_POST['type'];
    $user_id=$_POST['user_id'];
    $etat=$_POST['etat'];
    $faireReductionMax=$_POST['faireReductionMax'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsidentifiant($identifiant)) {
        $prod = $manager->getIdentifiant($identifiant);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setidentifiant($identifiant);
            $prod->setpassword($password);
            $prod->settype($type);
            $prod->setfaireReductionMax($faireReductionMax);
            $prod->setetat($etat);
            $prod->setcodebarre_id($codebarre_id);
            $prod->setuser_id($user_id);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Cet identifiant existe déjà1';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setidentifiant($identifiant);
            $prod->setpassword($password);
            $prod->settype($type);
            $prod->setfaireReductionMax($faireReductionMax);
            $prod->setetat($etat);
            $prod->setcodebarre_id($codebarre_id);
            $prod->setuser_id($user_id);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set password='".$password."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_id = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['password'])&&isset($_POST['etat'])&&isset($_POST['faireReductionMax'])&&isset($_POST['etatmax'])&&isset($_POST['faireReductionMax'])){
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

    $identifiant=$_POST['identifiant'];
    $password=$_POST['password'];
    $codebarre_id=$_POST['codebarre_id'];
    $type=$_POST['type'];
    $user_id=$_POST['user_id'];
    $etat=$_POST['etat'];
    $faireReductionMax=$_POST['faireReductionMax'];



    if(!$manager->existsidentifiant($identifiant)){
        //$date = genererid();
        //echo $datec;
        $employe = new Employe(array(
            'password' => $password,
            'identifiant' => $identifiant,
            'codebarre_id' => $codebarre_id,
            'type' => $type,
            'user_id' => $user_id,
            'etat' => $etat,
            'faireReductionMax' => $faireReductionMax,
        ));
        $manager->add($employe);
        echo 'ok';
    }
    else echo 'Cet identifiant existe déjà2';



}


// D'abord, on se connecte ?ySQL
