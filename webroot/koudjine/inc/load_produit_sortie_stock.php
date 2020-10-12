
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

if (isset($_POST['id']))
    $id = $_POST['id'];

$enrayon = $managerEnRayon->getList($id);
foreach ($enrayon as $key => $value) :
    $sortie_stock = $managerSortie->getListId($value->id());
    foreach ($sortie_stock as $key => $e) :
        echo
            "<tr >
                       
                        <td class='prix'>
                        " . $e->dateSortie() . "
                        </td>
                        <td class='prix'>
                        " . $e->quantite() . "
                        </td>
                        <td class='prix'>
                        " . $e->en_rayon_id() . "
                        </td>
                    </tr>";
    endforeach;
endforeach;
