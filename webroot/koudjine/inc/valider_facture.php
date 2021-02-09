<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/facturation.php');
require_once('../Class/facture_espece.php');
require_once('../Class/facture_electronique.php');
require_once('../Class/user.php');
require_once('../Class/employe.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerFa = new FacturationManager($pdo);
$managerFes = new FactureEspeceManager($pdo);
$managerFel = new FactureElectroniqueManager($pdo);
$managerEm = new EmployeManager($pdo);
$managerUs = new UserManager($pdo);

$espece;

$caisse_id = $_POST['caisse_id'];
$vente_id=$_POST['vente_id'];
$montant=$_POST['montant'];
$montantPercu=$_POST['montantPercu'];
$reste=$_POST['reste'];
$typePaiement=$_POST['typePaiement'];
$reduction=$_POST['reduction'];
$telephone=$_POST['telephone'];

$idGen = genererID();
$facture = new Facturation(array(
    'id' => $idGen,
    'vente_id' => $vente_id,
    'caisse_id' => $caisse_id,
    'typePaiement' => $typePaiement,
    'MontantPercu' => $montantPercu,
    'montantTtc' => $montant,
    'reste' => $reste
));
$managerFa->add($facture);


if ($typePaiement == "Espèce"){

    $espece = new FactureEspece(array(
        'facturation_id' => $idGen,
        'montant' => $montant
    ));
    $managerFes->add($espece);
    $vente = $manager->get($vente_id);
    $vente->setprixPercu($montant);
    $manager->update($vente);
    if($reduction != 0){
        if($vente->user_id() == null){
            $employe = $managerEm->get($vente->employe_id());
            $employe->setfaireReductionMax($employe->faireReductionMax()-$reduction);
            $managerEm->update($employe);
        }else{
            $user = $managerUs->get($vente->user_id());
            $user->setreductionMax($user->reductionMax()-$reduction);
            $managerUs->update($user);
        }
    }
    echo "ok";

} elseif ($typePaiement == "Electronique"){

    $electronique = new FactureElectronique(array(
        'facturation_id' => $idGen,
        'numeroTelephone' => $telephone,
        'montant' => $montant
    ));
    $managerFel->add($electronique);
    $vente = $manager->get($vente_id);
    $vente->setprixPercu($montant);
    $manager->update($vente);
    if($reduction != 0){
        if($vente->user_id() == null){
            $employe = $managerEm->get($vente->employe_id());
            $employe->setfaireReductionMax($employe->faireReductionMax()-$reduction);
            $managerEm->update($employe);
        }else{
            $user = $managerUs->get($vente->user_id());
            $user->setreductionMax($user->reductionMax()-$reduction);
            $managerUs->update($user);
        }
    }
    echo "ok";

}
else{



    if(true){
        $donnees = array('erreur' =>'ok');
        echo json_encode($donnees);
    }
    else{
        $donnees = array('erreur' =>'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
    }



}


// D'abord, on se connecte ?ySQL




?>