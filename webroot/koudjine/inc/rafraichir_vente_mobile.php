<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

$id;

global $pdo;
global $conndb;
$managerVente = new VenteManager($pdo);
$managerCaisse = new CaisseManager($pdo);
$managerUser = new UserManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);

if (isset($_POST['id']))
    $id = $_POST['id'];

$ventes = $managerVente->getListCaisse(20);
$caisse = $managerCaisse->getId(20);

$donnees = [];
//echo "passe";
foreach ($ventes as $k => $v) :
    $produits = $managerCo->getList($v->id());
    $concerner = [];
    foreach ($produits as $a => $c) :
        //echo $c->en_rayon_id();
        $nom = $managerPr->get($managerEn->get($c->en_rayon_id())->produit_id())->nom();
        $concerner[] = array(
            'id' => $c->id(),
            'vente_id' => $c->vente_id(),
            'en_rayon_id' => $c->en_rayon_id(),
            'produit_id' => $c->produit_id(),
            'produit_name' => $nom,
            'prixUnit' => $c->prixUnit(),
            'quantite' => $c->quantite(),
            'reduction' => $c->reduction(),
            'supprimer' => $c->supprimer()
        );
    endforeach;

    $datevente = $v->dateVente();
    if ($v->user_id() != null) {
        //$client1 = $managerUser->get($v->user_id());
        $client = $managerUser->get($v->user_id())->nom();
    } else {
        $client = $v->nouveau_info();
    }
    if ($v->employe_id() != null) {
        $employ = $managerEmploye->get($v->employe_id());
        $employe = $managerUser->get($employ->user_id())->nom();
    } else {
        $employe = null;
    }
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $datevente);
    $datev = $date->format('d-m-Y');
    $heurev = $date->format('H:i');
    $donnees[] = array(
        'id' => $v->id(),
        'user_id' => $v->user_id(),
        'employe_id' => $employe,
        'malade_id' => $v->malade_id(),
        'prescripteur_id' => $v->prescripteur_id(),
        'prixTotal' => $v->prixTotal(),
        'prixPercu' => $v->prixPercu(),
        'commentaire' => $v->commentaire(),
        'etat' => $v->etat(),
        'reference' => $v->reference(),
        'nouveau_info' => $v->nouveau_info(),
        'reduction' => $v->reduction(),
        'dateVente' => $datevente,
        'caisse_id' => $v->caisse_id(),
        'concernerList' => $concerner,
        'supprimer' => $v->supprimer(),
    );

endforeach;
echo json_encode($donnees);

?>

