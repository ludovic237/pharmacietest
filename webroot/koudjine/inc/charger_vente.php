<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/produit_detail.php');

require_once('../Class/facturation.php');
require_once('../Class/facture_ticket.php');
require_once('../Class/facture_electronique.php');
require_once('../Class/facture_espece.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerPrDetail = new Produit_detailManager($pdo);

$managerFacturation = new FacturationManager($pdo);
$managerFactureEspece = new FactureEspeceManager($pdo);
$managerFactureElectronique = new FactureElectroniqueManager($pdo);
$managerFactureTicket = new FactureTicketManager($pdo);

$id = $_POST['id'];

//echo $id;
$data = [];

if (isset($_POST['id'])) {
    $produits = $managerCo->getList($id);
    $typefacturation = "No exist";
    $montantfactureEspece = 0;
    $montantfactureElectronique = 0;
    $montantfactureTicket = 0;

    foreach ($produits as $k => $v) :
        if ($v->type() == "detail") {
            $nom = $managerPrDetail->get($v->en_rayon_id())->nom();
        } else {
            $nom = $managerPr->get($managerEn->get($v->en_rayon_id())->produit_id())->nom();
        }

        $data[] = array(
            "DT_RowId" => $v->en_rayon_id(),
            "nom" => $nom,
            "prixUnit" => $v->prixUnit(),
            "quantite" => $v->quantite(),
            "total" => ($v->prixUnit() * $v->quantite()),
            "reduction" => $v->reduction(),
        );



    endforeach;

    if ($managerFacturation->existsvente_id($id)) {
        $facture = $managerFacturation->getVente($id);
        $reste = $facture->reste();
        $typefacturation = $facture->typePaiement();
        if ($managerFactureEspece->existsfacturation_id($facture->id())) {
            $factureEspece = $managerFactureEspece->getFacture($facture->id());
            $montantfactureEspece = $factureEspece[0]->montant();
        }
        if ($managerFactureElectronique->existsfacturation_id($facture->id())) {
            $factureElectronique = $managerFactureElectronique->getFacture($facture->id());
            $montantfactureElectronique = $factureElectronique[0]->montant();
        }
        if ($managerFactureTicket->existsfacturation_id($facture->id())) {
            $factureTicket = $managerFactureTicket->getFacture($facture->id());
            $montantfactureTicket = $factureTicket[0]->montant();
        }
    } else {
        $reste=0;
        $typefacturation = "No exist";
        $montantfactureEspece = 0;
        $montantfactureElectronique = 0;
        $montantfactureTicket = 0;
    }

    $donnees = array(
        'data' => $data,
        "type_paiement" => $typefacturation,
        'montantfactureEspece' => $montantfactureEspece,
        'montantfactureElectronique' => $montantfactureElectronique,
        'montantfactureTicket' => $montantfactureTicket,
    );
    echo json_encode($donnees);
} else {


    //on verifie qu'il existe deja la vente dans la BD et on verifie aussi si la ligne à enregistrer n'a pas deja été faite
    if ($manager->existsId($idv) && !$managerCo->existsEn_rayonId($idv, $ide)) {
        echo "passe \n";
        //echo $managerPr->getStock($managerEn->get($ide)->produit_id(),$qte)->stock();

        $conc = new Concerner(array(
            'vente_id' => $idv,
            'en_rayon_id' => $ide,
            'produit_id' => null,
            'prixUnit' => $prixu,
            'quantite' => $qte,
            'reduction' => $reduction,
            'supprimer' => 0
        ));
        $managerCo->add($conc);


        $donnees = array('erreur' => 'ok');
        echo json_encode($donnees);
    } else {
        $donnees = array('erreur' => 'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
    }


}


// D'abord, on se connecte ?ySQL


?>