<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');

$id;
$vente;
$produit;
$enrayon;
$concerner;

global $pdo;
global $conndb;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerUser = new UserManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];

if (isset($_POST['start']))
    $start = $_POST['start'];

if (isset($_POST['end']))
    $end = $_POST['end'];

$enrayon = $managerEnRayon->getList($id);
$produit = $managerProduit->get($id);
$vente = $managerVente->getListRange($start, $end);
$nom = $produit->nom();
$nbrVenteMois = 0;
$nbrVenteTotal = 0;

$nbrQteStock = 0;
$reductionTotal = 0;
$qteTotal = 0;
$venteTotal = 0;

$_prixVenteTotal=0;
$_qteVenteTotal=0;
$_reductionVenteTotal=0;

$datas = [];
if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($vente as $k => $v) :
        $venteid = $v->id();
        $employe =  $managerEmploye->get($v->employe_id());

        if (($v->user_id())!=null){
            $user =  $managerUser->get($v->user_id());
            $client = $user->nom()+' '+$user->prenom();
        }
        else{
            $client = 'Client pas enregistré';
        }

        //echo $venteid . "-";
        foreach ($enrayon as $k => $e) :
            $enrayonid = $e->id();
            $concerner = $managerConcerner->getExistsVenteIdAndEn_rayonId($venteid, $enrayonid);

            foreach ($concerner as $k => $c) :
                $venteDate = $managerVente->getDateVente($c->vente_id())->dateVente();

                $prixTotal = $c->quantite() * $c->prixUnit();
                $venteTotal = $c->quantite() + $venteTotal;

                $reduction = $prixTotal * $c->reduction();
                $reductionTotal = $c->reduction() + $reductionTotal;

                $prixVente = $prixTotal - $reduction;
                $venteTotal = $prixVente + $venteTotal;

                $_reductionVenteTotal = $_reductionVenteTotal + $reductionTotal;
                $_prixVenteTotal = $_prixVenteTotal + $prixTotal;
                $_qteVenteTotal = $_qteVenteTotal + $c->quantite();

                $datas[] = array(
                    'venteid' => $c->vente_id(),
                    'datevente' => $venteDate,
                    'enrayon' => $c->en_rayon_id(),
                    'vendeur' => $employe->identifiant(),
                    'client' => $client,
                    'prixunit' => $c->prixUnit(),
                    'quantite' => $c->quantite(),
                    'prixTotal' => $prixTotal,
                    'reduction' => $reduction,
                    'prixVente' => $prixVente,
                );

            endforeach;
        endforeach;
    endforeach;
    if ($datas == null) {
        $donnees = array('data' => []);
        echo json_encode($donnees);
    } else {
        $donnees = array('data' => $datas,'reductionVenteTotal' => $_reductionVenteTotal,'prixVenteTotal' => $_prixVenteTotal,'qteVenteTotal' => $_qteVenteTotal);
        echo json_encode($donnees);
    }

}
