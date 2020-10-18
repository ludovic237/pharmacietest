
<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');

$id;
$vente;
$produit;
$enrayon;
$concerner;

global $pdo;
global $conndb;

$managerProduit = new ProduitManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
$produit = $managerProduit->get($id);
$nom = $produit->nom();

$datas = [];

if (isset($_POST['id']) || isset($_GET['id'])) {



    foreach ($enrayon as $k => $e) :
        $enrayonid = $e->id();

        $datas[] = array(
            "DT_RowId"  => $e->id(),
            'nom' => "<p class='nom'> " . $nom . "</p>",
            'fournisseur_id' => "<p class='fournisseur_id'> " . $e->fournisseur_id() . "</p>",
            'dateLivraison' => "<p class='dateLivraison'> " . $e->dateLivraison() . "</p>",
            'datePeremption' => "<p class='datePeremption'> " . $e->datePeremption() . "</p>",
            'prixAchat' => "<p class='prixAchat'> " . $e->prixAchat() . "</p>",
            'prixVente' => "<p class='prixVente'> " . $e->prixVente() . "</p>",
            'quantiteRestante' => "<p class='quantiteRestante'> " . $e->quantiteRestante() . "</p>",
            'action' => " <a class=\"btn btn-success btn-rounded btn-sm \"  onclick=\"show_modif_enrayon('" . $e->id() . "')\"><span class=\"\">Modifier</span></a>",
        );
    endforeach;

    if ($datas == null) {
        $donnees = array('data' => []);
        echo json_encode($donnees);
    }
    else{
        $donnees = array('data' => $datas);
        echo json_encode($donnees);
    }
}

