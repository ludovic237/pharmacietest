
<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/sortie_sortie.php');

$id;
$vente;
$produit;
$enrayon;
$sortie_stock;

global $pdo;
global $conndb;

$managerSortie = new SortieStockManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre
$datas = [];
if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
foreach ($enrayon as $key => $value) :
    $sortie_stock = $managerSortie->getListId($value->id());
    foreach ($sortie_stock as $key => $e) :
        $datas[] = array(
            'dateSortie' => "<p class='dateSortie'> " . $e->dateSortie() . "</p>",
            'quantite' => "<p class='quantite'> " . $e->quantite() . "</p>",
            'en_rayon_id' => "<p class='en_rayon_id'> " . $e->en_rayon_id() . "</p>",
        );

    endforeach;
endforeach;

$donnees = array('data' => $datas);
echo json_encode($donnees);
