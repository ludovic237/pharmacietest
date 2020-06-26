<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/malade.php');
require_once('../Class/user.php');
require_once('../Class/employe.php');
require_once('../Class/prescripteur.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerMa = new MaladeManager($pdo);
$managerUs = new UserManager($pdo);
$managerEm = new EmployeManager($pdo);
$managerPr = new PrescripteurManager($pdo);

$idc=$_POST['idc'];
$idp=$_POST['idp'];
$nouveau=$_POST['nouveau'];
$commentaire=$_POST['commentaire'];
$prixt=$_POST['prix'];
$prixr=$_POST['prixr'];
$taux=$_POST['taux'];
$etat=$_POST['etat'];



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $ean13=$_POST['ean13'];
    $nom=$_POST['nom'];
    $reference=$_POST['reference'];
    $laborex=$_POST['laborex'];
    $ubipharm=$_POST['ubipharm'];
    $stock=$_POST['stock'];
    $stockmin=$_POST['stockmin'];
    $stockmax=$_POST['stockmax'];
    $reduction=$_POST['reduction'];
    $cat=$_POST['cat'];
    $forme=$_POST['forme'];
    $ray=$_POST['ray'];
    $fab=$_POST['fab'];
    $mag=$_POST['mag'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setcategorie_id($cat);
            $prod->setforme_id($forme);
            $prod->setrayon_id($ray);
            $prod->setfabriquant_id($fab);
            $prod->setmagasin_id($mag);
            $prod->setnom($nom);
            $prod->setean13($ean13);
            $prod->setreference($reference);
            $prod->setcodeLaborex($laborex);
            $prod->setcodeUbipharm($ubipharm);
            $prod->setstock($stock);
            $prod->setstockMin($stockmin);
            $prod->setstockMax($stockmax);
            $prod->setreductionMax($reduction);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setcategorie_id($cat);
        $prod->setforme_id($forme);
        $prod->setrayon_id($ray);
        $prod->setfabriquant_id($fab);
        $prod->setmagasin_id($mag);
        $prod->setnom($nom);
        $prod->setean13($ean13);
        $prod->setreference($reference);
        $prod->setcodeLaborex($laborex);
        $prod->setcodeUbipharm($ubipharm);
        $prod->setstock($stock);
        $prod->setstockMin($stockmin);
        $prod->setstockMax($stockmax);
        $prod->setreductionMax($reduction);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
        $date = genererID();
        //echo $datec;
    if($managerCa->exists()){

        $vent = new Vente(array(
            'id' => $id,
            'user_id' => $idc,
            'employe_id' => $_SESSION['Users']->id,
            'malade_id' => null,
            'prescripteur_id' => $idp,
            'prixTotal' => $prixt,
            'prixPercu' => 0,
            'dateVente' => null,
            'commentaire' => $commentaire,
            'etat' => $etat,
            'reference' => $stock,
            'nouveau_info' => $nouveau,
            'reduction' => $prixr,
            'caisse_id' => $managerCa->get()->id(),
            'supprimer' => 0
        ));
        $manager->add($vent);
        echo 'ok';
    }
    else echo 'Pas de caisse ouverte !!!';



}


// D'abord, on se connecte ?ySQL




?>