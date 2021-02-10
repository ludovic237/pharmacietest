<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/sortie_sortie.php');

$id;
$vente;
$produit;
$enrayon;
$concerner;

$quantiteTotal = 0;

global $pdo;
global $conndb;

$managerSortie = new SortieStockManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getListSortie($id);
foreach ($enrayon as $key => $value) :
    $sortie_stock = $managerSortie->getListId($value->id());
    foreach ($sortie_stock as $k => $e) :
        $quantiteTotal = $quantiteTotal + $e->quantite();
    endforeach;
endforeach;
echo $quantiteTotal;
