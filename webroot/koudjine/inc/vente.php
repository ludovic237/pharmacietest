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
$idemp=$_POST['idemp'];
$nouveau=$_POST['nouveau'];
$commentaire=$_POST['commentaire'];
$prixt=$_POST['prixt'];
$prixr=$_POST['prixr'];
$etat=$_POST['etat'];



if (isset($_POST['id'])){


}
else{
        $idGen = genererID();
        $num = $manager->countMois();
        if($etat == "Crédit"){
            $caisse = null;
        }else{
            $caisse = $managerCa->get()->id();
        }
        //echo $idGen;
    if($managerCa->get() != null){

        $vent = new Vente(array(
            'id' => $idGen,
            'user_id' => $idc,
            'employe_id' => $idemp,
            'malade_id' => null,
            'prescripteur_id' => $idp,
            'prixTotal' => $prixt,
            'prixPercu' => 0,
            'commentaire' => $commentaire,
            'etat' => $etat,
            'reference' => genererreference($num),
            'nouveau_info' => $nouveau,
            'reduction' => $prixr,
            'caisse_id' => $caisse,
            'supprimer' => 0
        ));
        $manager->add($vent);
        $donnees = array('erreur' =>'ok', 'id' => $idGen);
        echo json_encode($donnees);
    }
    else{
        $donnees = array('erreur' =>'Pas de caisse ouverte !!!');
        echo json_encode($donnees);
    }



}


// D'abord, on se connecte ?ySQL




?>