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
$managerVente = new VenteManager($pdo);
$managerConcerner = new ConcernerManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
$quantiteRestante = 0;


// echo "passe";
if (isset($_POST['id']) || isset($_GET['id'])) {


    foreach ($enrayon as $k => $e) :
        $enrayonid = $e->id();
        $quantiteRestante = $quantiteRestante + $e->quantiteRestante();
    endforeach;
    echo $quantiteRestante;
  
}
