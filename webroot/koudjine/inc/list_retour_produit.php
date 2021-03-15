<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
global $pdo;


$managerRetourProduit = new RetourProduitManager($pdo);
$managerProduitRetour = new ProduitRetourManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerUser = new UserManager($pdo);
$managerEn_rayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);

$data = [];
$datas = [];


if (isset($_POST['id']))
    $id = $_POST['id'];

$retourproduit = $managerRetourProduit->getListCaisseId($managerCa->get()->id());
foreach ($retourproduit as $k => $v) :

    $caisse_userid = $managerCa->getId($v->caisse_id())->user_id();
    $employe_userid = $managerEmploye->get($caisse_userid)->user_id();
    $user_nom = $managerUser->get($employe_userid)->nom();
    $user_prenom = $managerUser->get($employe_userid)->prenom();

    $produitretour = $managerProduitRetour->getListRetourProduitId($v->id());
    $quantite_produitRetour=0;
    $quantite_total_produitRetour=0;
    $List_produitRetour="";
    foreach ($produitretour as $k => $c){
        $quantite_produitRetour = $quantite_produitRetour + $c->quantite();
        $en_rayon_produitId = $managerEn_rayon->get($c->concerner_id())->produit_id();
        $produit_nom = $managerProduit->get($en_rayon_produitId)->nom();
        $List_produitRetour = $List_produitRetour." ".$produit_nom." ".$quantite_produitRetour;
    }
    $quantite_total_produitRetour = $quantite_produitRetour;
    $data[] = array(
        "DT_RowId" => $v->id(),
        "id" => $v->id(),
        "vente_id" => $v->vente_id(),
        "employe_id" => $user_nom . ' ' . $user_prenom,
        "dateRetour" => $v->dateRetour(),
        "caisse_id" => $v->caisse_id(),
        "quantite_total_produitRetour" => $quantite_total_produitRetour,
        "list" => $List_produitRetour,
    );
endforeach;

$donnees = array(
    'data' => $data,
);
echo json_encode($donnees);

?>