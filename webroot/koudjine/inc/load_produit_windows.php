<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');

$id;
$fournisseur;
$produit;
global $pdo;
global $conndb;
$managerProduit = new ProduitManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];
$produit = $managerProduit->get($id);
if ($produit->grossiste_id() != '') {
    $enrayon = $managerEnRayon->getListDetail($id);
} else {
    $enrayon = $managerEnRayon->getList($id);
}


$datas = [];


if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($enrayon as $k => $v) :
        $datelivraison = $v->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        if ($v->reduction() > $produit->reductionMax()) $reduction = $produit->reductionMax();
        else $reduction = $v->reduction();
        if ($v->quantiteRestante() <= $produit->stockMin()) $action = 'style="background: #ff18008a;color: #fff"';
        else $action = '';
        if ($produit->grossiste_id() != '')
            $bouton = "
                                             <button class=\"btn btn-primary \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"gerer_detail('" . $v->id() . "')\"><span class=\"\">Augmenter quantité</span></button>
                                        ";
        else $bouton = "";
        $datas[] = array(
            "DT_RowId" => $v->id(),
            'nom' =>$produit->nom(),
            'prixUnitaire' =>$v->prixVente(),
            'quantite' => $v->quantiteRestante(),
            'stockq' =>$v->quantiteRestante(),
            'stockg' =>$produit->stock(),
            'reduction' => $reduction,
            'date' => $datel ,
            'action' => $bouton
        );
    endforeach;
}

if ($datas == null) {
    $donnees = array('data' => []);
    echo json_encode($donnees);
} else {
    $donnees = array('data' => $datas);
    echo json_encode($donnees);
}
