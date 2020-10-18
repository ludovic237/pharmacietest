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

if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
$produit = $managerProduit->get($id);

$datas;
//echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {



    foreach ($enrayon as $k => $v) :
        $datelivraison = $v->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        if ($v->reduction() > $produit->reductionMax()) $reduction = $produit->reductionMax();
        else $reduction = $v->reduction();

        $datas[] = array(
            "DT_RowId"  => $v->id(),
            'nom' => "<strong class='nom'><a href='/pharmacietest/bouwou/comptabilite/sortie/" . $v->id() . "'>" . $produit->nom() . "</a></strong>",
            'prixVente' => "<p class='prixVente'> " . $v->prixVente() . "</p>",
            'quantiteRestante' => "<p class='quantiteRestante'> " . $v->quantiteRestante() . "</p>",
            'reduction' => "<p class='reduction'> " . $reduction . "</p>",
            'datel' => "<p class='datel'> " . $datel . "</p>",
        );

    endforeach;

    $donnees = array('data' => $datas);
    echo json_encode($donnees);
}
