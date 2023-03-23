<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/fournisseur1.php');
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
$managerFournisseur = new FournisseurManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];


$produit = $managerProduit->get($id);
$nom = $produit->nom();
if(strpos($nom, 'D ') === 0 || $produit->grossiste_id() != ""){
    $enrayon = $managerEnRayon->getListDetail($id);
}else{
    $enrayon = $managerEnRayon->getList($id);
}


$datas = [];
$stockTotal = 0;
$stockRestant = 0;

if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($enrayon as $k => $e) :
        $enrayonid = $e->id();
        $stockTotal = $stockTotal + $e->quantite();
        $stockRestant = $stockRestant + $e->quantiteRestante();
        $datas[] = array(
            "DT_RowId" => $e->id(),
            'nom' => $nom,
            'fournisseur' => $managerFournisseur->get($e->fournisseur_id())->nom(),
            'dateLivraison' => $e->dateLivraison(),
            'datePeremption' => $e->datePeremption(),
            'prixAchat' => $e->prixAchat(),
            'prixVente' => $e->prixVente(),
            'reduction' => $e->reduction(),
            'quantite' => $e->quantite(),
            'quantiteRestante' => $e->quantiteRestante(),
            'id' => $e->id(),
        );
        /*$datas[] = array(
            "DT_RowId"  => $e->id(),
            'nom' => "<p class='nom'> " . $nom,
            'fournisseur_id' => "<p class='fournisseur_id'> " . $managerFournisseur->get($e->fournisseur_id())->nom() . "</p>",
            'dateLivraison' => "<p class='dateLivraison'> " . $e->dateLivraison() . "</p>",
            'datePeremption' => "<p class='datePeremption'> " . $e->datePeremption() . "</p>",
            'prixAchat' => "<p class='prixAchat'> " . $e->prixAchat() . "</p>",
            'prixVente' => "<p class='prixVente'> " . $e->prixVente() . "</p>",
            'quantiteRestante' => "<p class='quantiteRestante'> " . $e->quantiteRestante() . "</p>",
            'action' => " <a class=\"btn btn-success btn-rounded btn-sm \"  onclick=\"show_modif_enrayon('" . $e->id() . "')\"><span class=\"\">Modifier</span></a>
                           <a class=\"btn btn-primary btn-rounded btn-sm \"   onclick=\"show_modif_sortie('" . $e->id() . "')\"><span class=\"\">Périmé & Stock détail</span></a>
                           <a class=\"btn btn-primary btn-rounded btn-sm \"   onclick=\"info_row_entree('" . $e->id() . "')\"><span class=\"\">Imprimer etiquette</span></a>",
        );*/
    endforeach;

    if ($datas == null) {
        $donnees = array('data' => []);
        echo json_encode($donnees);
    } else {
        $donnees = array('data' => $datas,'stockTotal' => $stockTotal,'stockRestant' => $stockRestant);
        echo json_encode($donnees);
    }
}

