<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);

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
            if($managerCa->existsetat()){
                $caisse = $managerCa->get()->id();
            }
        }


    if($managerCa->exists()){

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
        //echo 'passe';
    }
    else{
        $donnees = array('erreur' =>'Pas de caisse ouverte !!!');
        echo json_encode($donnees);
        //echo 'depasse';
    }



}


// D'abord, on se connecte ?ySQL




?>