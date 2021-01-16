<?php
require_once('database.php');
require_once('../Class/categorie.php');
require_once('../Class/produit.php');
require_once('../Class/prescripteur.php');
require_once('../Class/assureur.php');
require_once('../Class/client.php');
require_once('../Class/fabriquant.php');
require_once('../Class/fournisseur.php');
require_once('../Class/en_rayon.php');
require_once('../Class/magasin.php');
require_once('../Class/forme.php');
require_once('../Class/unite.php');
require_once('../Class/ville.php');


$id;
$nom;
global $pdo;

$managerCategorie = new CategorieManager($pdo);
$managerProduit = new ProduitManager($pdo);
$managerprescripteur = new PrescripteurManager($pdo);
$managerassureur = new AssureurManager($pdo);
$managerclient = new ClientManager($pdo);
$managerFabriquant = new FabriquantManager($pdo);
$managerFournisseur = new FournisseurManager($pdo);
$managerEn_rayon = new En_rayonManager($pdo);
$managerMagasin = new MagasinManager($pdo);
$managerForme = new FormeManager($pdo);
$managerUnite = new UniteManager($pdo);
$managerVille = new VilleManager($pdo);

$id = $_POST['id'];
$type = $_POST['type'];
$data = "";

switch ($type) {
    case "produit":
        $Produit = $managerProduit->delete($id);
        if ($Produit == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "magasin":
        $Magasin = $managerMagasin->delete($id);
        if ($Magasin == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "forme":
        $Forme = $managerForme->delete($id);
        if ($Forme == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "unite":
        $Unite = $managerUnite->delete($id);
        if ($Unite == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "ville":
        $Ville = $managerVille->delete($id);
        if ($Ville == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "categorie":
        $Categorie = $managerCategorie->delete($id);
        if ($Categorie == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "prescripteur":
        $Prescripteur = $managerPrescripteur->delete($id);
        if ($Prescripteur == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "assureur":
        $Assureur = $managerAssureur->delete($id);
        if ($Assureur == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "client":
        $Client = $managerClient->delete($id);
        if ($Client == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "fabriquant":
        $Fabriquant = $managerFabriquant->delete($id);
        if ($Fabriquant == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "fournisseur":
        $Fournisseur = $managerFournisseur->delete($id);
        if ($Fournisseur == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
    case "en_rayon":
        $En_rayon = $managerEn_rayon->delete($id);
        if ($En_rayon == 1) {
            $data = "Ok";
        } else {
            $data = "No";
        }
        break;
}

echo $data;

// D'abord, on se connecte ?ySQL
