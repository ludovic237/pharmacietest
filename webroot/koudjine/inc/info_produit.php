<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/fournisseur1.php');
require_once('../Class/en_rayon.php');

$id;
$produit;
$categorie;
$forme;
$magasin;
$rayon;
$fabriquant;

global $pdo;
global $conndb;

$managerProduit = new ProduitManager($pdo);
$managerCategorie = new CategorieManager($pdo);
$managerFabriquant = new FabriquantManager($pdo);
$managerForme = new FormeManager($pdo);
$managerMagasin = new MagasinManager($pdo);
$managerRayon = new RayonManager($pdo);


if (isset($_POST['id']))
    $id=$_POST['id'];


$produit = $managerProduit->get($id);
$categorie = $managerCategorie->get($id);
$forme = $managerForme->get($id);
$magasin = $managerMagasin->get($id);
$rayon = $managerRayon->get($id);
$fabriquant = $managerFabriquant->get($id);

//echo "passe";
if (isset($_POST['id'])||isset($_GET['id'])){




    //echo "passe";
    $code_barre = $id;
    //$code = cb($code_barre);




    $donnees = array('ean13A' => $produit->ean13(), 'nomA' => $produit->nom(), 'referenceA' => $produit->reference(), 'codelaborexA' => $produit->codeLaborex(), 'codeubipharmA' => $produit->codeUbipharm(), 'stockA' => $produit->stock(), 'stockmaxA' => $produit->stockMax(), 'stockminA' => $produit->stockmin(), 'contenudetailA' => $produit->contenuDetail(), 'etatA' => $produit->etat(), 'etagereA' => $produit->etagere(), 'reductionmaxA' => $produit->reductionMax(), 'prixdetailA' => $produit->prixDetail(), 'rayonA' => $rayon->nom(), 'magasinA' => $magasin->nom(), 'fabriquantA' => $fabriquant->nom(), 'formeA' => $forme->nom(), 'categorieA' => $categorie->nom());
    if (isset($_POST['id']))
        echo json_encode($donnees);



}



?>

