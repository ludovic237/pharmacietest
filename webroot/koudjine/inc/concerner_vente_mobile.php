<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);

//$ide = substr($_POST['ide'], 1);
$ide = $_POST['ide'];
$idv = $_POST['idv'];
$qte = $_POST['qte'];
$reduction = $_POST['reduction'];
$prixu = $_POST['prixu'];

if ($manager->existsId($idv) && !$managerCo->existsEn_rayonId($idv, $ide)) {

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

    $data = array(
        'id' =>null,
        'vente_id' => $idv,
        'en_rayon_id' => $ide,
        'produit_id' => null,
        'produit_name' => null,
        'prixUnit' => $prixu,
        'quantite' => $qte,
        'reduction' => $reduction,
        'supprimer' => 0
    );
    echo json_encode($data);
} else {
    $donnees = array('erreur' => 'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
    echo json_encode($donnees);
    //echo 'passe pas';
}


// D'abord, on se connecte ?ySQL


?>
