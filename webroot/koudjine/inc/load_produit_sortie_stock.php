
<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/vente.php');
require_once('../Class/sortie_sortie.php');
require_once('../Class/forme.php');

$id;
$vente;
$produit;
$enrayon;
$sortie_stock;

global $pdo;
global $conndb;

$managerSortie = new SortieStockManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);
$managerForme = new FormeManager($pdo);

//On sélectionne tous les users dont le nom = Pierre
$datas = [];
if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
foreach ($enrayon as $key => $value) :
    $nom = $managerProduit->get($value->produit_id())->nom();
    $forme = $managerForme->get( $managerProduit->get($value->produit_id())->forme_id())->nom();
    $dateLivraison = $value->dateLivraison();
    $dateLivraison = $value->dateLivraison();
    $sortie_stock = $managerSortie->getListId($value->id());
    foreach ($sortie_stock as $key => $e) :
        if ($e->detail_id() != '' && $e->detail_id() !=null ) {
            $opration = 'Détail';
        } else {
            $opration = 'Périmé';
        }
        
        $datas[] = array(
            'nom' => "<strong class='nom'><a href='/pharmacietest/bouwou/comptabilite/entre/". $value->produit_id()."'>" . $nom . " - [". $dateLivraison ."]</a> </strong>",
            'quantite' => "<p class='quantite'> " . $e->quantite() . "</p>",
            'nomproduitdetail' => "<p class='nomproduitdetail'> 2</p>",
            'forme' => "<p class='forme'> " . $forme . "</p>",
            'dateSortie' => "<p class='dateSortie'> " . $e->dateSortie() . "</p>",
            'operation' => "<p class='operation'> " . $opration . " </p>",
        );

    endforeach;
endforeach;

$donnees = array('data' => $datas);
echo json_encode($donnees);
