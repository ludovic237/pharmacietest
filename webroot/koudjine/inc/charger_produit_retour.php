<?php
require_once('database.php');
require_once('../Class/retour_produit.php');
require_once('../Class/produit_retour.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/vente.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/concerner.php');
global $pdo;


$managerRetourProduit = new RetourProduitManager($pdo);
$managerProduitRetour = new ProduitRetourManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerUser = new UserManager($pdo);
$managerVente = new VenteManager($pdo);
$managerEn_rayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);

$data = [];
$datas = [];


if (isset($_POST['id']))
    $id = $_POST['id'];

$retourproduit = $managerRetourProduit->get($id);

$employe_id = $managerCa->getId($retourproduit->caisse_id())->user_id();

$userid = $managerEmploye->get($employe_id)->user_id();
$caisse_user_nom = $managerUser->get($userid)->nom();
$caisse_user_prenom = $managerUser->get($userid)->prenom();
$employe_userid = $managerEmploye->get($retourproduit->employe_id())->user_id();
$employe_caisse_user_nom = $managerUser->get($employe_userid)->nom();
$employe_caisse_user_prenom = $managerUser->get($employe_userid)->prenom();

$vente = $managerVente->get($retourproduit->vente_id());

$produitretour = $managerProduitRetour->getListRetourProduitId($id);
$quantite_produitRetour = 0;
$quantite_total_produitRetour = 0;
$total = 0;
$List_produitRetour = "";

foreach ($produitretour as $b => $c) {
    $quantite_produitRetour = $quantite_produitRetour + $c->quantite();
    $concerner_produitId = $managerConcerner->get($c->concerner_id())->en_rayon_id();
    $concerner = $managerConcerner->get((int)$c->concerner_id());
    $en_rayon_produitId = $managerEn_rayon->get($concerner_produitId)->produit_id();
    $produit_nom = $managerProduit->get($en_rayon_produitId)->nom();
    $List_produitRetour = $List_produitRetour . " " . $produit_nom;
    $prixTotal = (($c->quantite()*$concerner->prixUnit()) - ($c->quantite()*$concerner->reduction()/$concerner->quantite()));

    $data[] = array(
        "DT_RowId" => $c->id(),
        "id" => $c->id(),
        "quantite_total_produitRetour" => $c->quantite(),
        "produit" => $List_produitRetour,
        "prix" => $concerner->prixUnit(),
        "total" => $prixTotal,
    );
    $total = $total + $prixTotal;
}

$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $retourproduit->dateRetour());
$date = $dateTime->format('d-m-Y'); // Extrait uniquement la date (format : Année-Mois-Jour)
$time = $dateTime->format('H:i'); // Extrait uniquement l'heure (format : Heures:Minutes:Secondes)

$donnees = array(
    'data' => $data,
    "vente_id" => $retourproduit->vente_id(),
    'date_retour' => $date,
    'caisse_user' => $caisse_user_nom." ".$caisse_user_prenom,
    'employe' => $employe_caisse_user_nom." ".$employe_caisse_user_prenom,
    'montant' => $total,
    'reference' => $vente->reference(),
    'heurevente' => $time,
);
echo json_encode($donnees);

?>