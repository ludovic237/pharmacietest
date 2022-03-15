<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/facturation.php');
require_once('../Class/facture_espece.php');
require_once('../Class/facture_electronique.php');
require_once('../Class/facture_ticket.php');
require_once('../Class/user.php');
require_once('../Class/employe.php');
require_once('../Class/bon_caisse.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerFa = new FacturationManager($pdo);
$managerFes = new FactureEspeceManager($pdo);
$managerFel = new FactureElectroniqueManager($pdo);
$managerFtk = new FactureTicketManager($pdo);
$managerEm = new EmployeManager($pdo);
$managerUs = new UserManager($pdo);
$managerBo = new BonCaisseManager($pdo);

$caisse_id = $_POST['caisse_id'];
$vente_id=$_POST['vente_id'];
$montant=$_POST['montant'];
$montantPercu=$_POST['montantPercu'];
$reste=$_POST['reste'];
$typePaiement=$_POST['typePaiement'];
$reduction=$_POST['reduction'];
$telephone=$_POST['telephone'];
$dateEncaisser=$_POST['dateEncaisser'];

$idGen = genererID();
$tab_type = explode(" ", $typePaiement);
if($typePaiement == "Espèce" || $typePaiement == "Electronique" || $typePaiement == "Ticketcaisse" || in_array("Mixtes", $tab_type)){
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
}



if ($typePaiement == "Espèce" || $typePaiement == "Mixte Espèce"){

    $espece = new FactureEspece(array(
        'facturation_id' => $idGen,
        'montant' => $montant
    ));
    $managerFes->add($espece);
    if($typePaiement != "Mixte Espèce"){
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
    }
    echo "ok";

} elseif ($typePaiement == "Electronique" || $typePaiement == "Mixte Electronique"){

    $electronique = new FactureElectronique(array(
        'facturation_id' => $idGen,
        'numeroTelephone' => $telephone,
        'montant' => $montant
    ));
    $managerFel->add($electronique);
    if($typePaiement != "Mixte Electronique"){
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
    }
    echo "ok";

}elseif ($typePaiement == "Ticketcaisse" || $typePaiement == "Mixte Ticketcaisse"){

    // Enregistrement facture ticket
    $ticket_id=$_POST['ticket_id'];
    $bon = $managerBo->getCodebarre_id($ticket_id);
    $ticket = new FactureTicket(array(
        'facturation_id' => $idGen,
        'ticket_caisse_id' => $bon->id(),
        'montant' => $montant
    ));
    $managerFtk->add($ticket);
    // Encaissement bon ticket

    $bon->setcaisse_id_encaisser($caisse_id);
    $bon->setdateEncaisser($dateEncaisser);
    $bon->settype('Encaisser');
    $managerBo->update($bon);
    if($typePaiement != "Mixte Ticketcaisse"){
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
    }
    echo "ok";

}else{
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
}



// D'abord, on se connecte ?ySQL




?>