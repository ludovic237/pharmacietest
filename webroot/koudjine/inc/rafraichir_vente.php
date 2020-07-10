<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');

$id;

global $pdo;
global $conndb;
$managerVente = new VenteManager($pdo);
$managerCaisse = new CaisseManager($pdo);

if (isset($_POST['id']))
    $id=$_POST['id'];

$ventes= $managerVente->getList($id);
$caisse = $managerCaisse->getId($id);


//echo "passe";
if (isset($_POST['id'])||isset($_GET['id'])){



    foreach ($enrayon as $k => $v) :
        $datelivraison = $v->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        if($v->reduction() > $produit->reductionMax()) $reduction = $produit->reductionMax(); else $reduction = $v->reduction();
        echo "<tr id=\"R".$v->id()."\">
                                            <td ><strong class='nom'>".$produit->nom()."</strong></td>
                                            <td class='prix'>
                                                ".$v->prixVente()."
                                            </td>
                                            <td class=''>
                                                <input class='qte' style=\"width: 50px;\" id=\"qte_vente\" type=\"number\" value='0'>
                                            </td>
                                            <td class='qterest'>
                                                ".$v->quantiteRestante()."
                                            </td>
                                            <td class='stock'>
                                                ".$produit->stock()."
                                            </td>
                                            <td class='reduction'>
                                                ".$reduction."
                                            </td>
                                            <td class='datel'>
                                                ".$datel."
                                            </td>
                                        </tr>";
    endforeach;



}



?>

