<?php
require_once('database.php');
require_once('../Class/employe.php');

global $pdo;


$manager = new EmployeManager($pdo);



if (isset($_POST['int'])){

    $int=$_POST['int'];
    $identifiant=$_POST['identifiant'];
    $password=$_POST['password'];
    $codebarreid=$_POST['codebarreid'];
    $type=$_POST['type'];
    $userid=$_POST['userid'];
    $etat=$_POST['etat'];
    $reduction=$_POST['reduction'];
    //echo $int;
    //$prod = new Departement();
    if ($manager->existsidentifiant($identifiant)) {
        $prod = $manager->get($int);
        //echo "Ce departement existe";
        if($prod->int() == $int){
            $prod->setidentifiant($identifiant);
            $prod->setpassword($password);
            $prod->settype($type);
            $prod->setfaireReductionMax($reduction);
            $prod->setetat($etat);
            $prod->setcodebarre_id($codebarreid);
            $prod->setuser_id($userid);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce password de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($int);
        $prod->setidentifiant($identifiant);
            $prod->setpassword($password);
            $prod->settype($type);
            $prod->setfaireReductionMax($reduction);
            $prod->setetat($etat);
            $prod->setcodebarre_id($codebarreid);
            $prod->setuser_id($userid);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set password='".$password."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_int = '".$int."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['password'])&&isset($_POST['etat'])&&isset($_POST['reduction'])&&isset($_POST['etatmax'])&&isset($_POST['reduction'])){
        $int_univ=$_POST['univint'];
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
    $codebarreid=$_POST['codebarreid'];
    $type=$_POST['type'];
    $userid=$_POST['userid'];
    $etat=$_POST['etat'];
    $reduction=$_POST['reduction'];



    if(!$manager->existsidentifiant($identifiant)){
        //$date = genererint();
        //echo $datec;
        $employe = new Employe(array(
            'password' => $password,
            'identifiant' => $identifiant,
            'codebarreid' => $codebarreid,
            'codetype' => $type,
            'codeuserid' => $userid,
            'etat' => $etat,
            'reduction' => $reduction,
        ));
        $manager->add($employe);
        echo 'ok';
    }
    else echo 'Ce password de produit existe déjà';



}


// D'abord, on se connecte ?ySQL
