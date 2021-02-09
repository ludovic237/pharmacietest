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
    $id=$_POST['id'];
$action = $_POST['action'];
if($action == 'sortie' || $action == 'sortie1'){
    $enrayon = $managerEnRayon->getListDetail($id);
}else{
    $enrayon = $managerEnRayon->getList($id);
}

$produit = $managerProduit->get($id);


//echo "passe";
if (isset($_POST['id'])&& $action == 'sortie'){



    foreach ($enrayon as $k => $v) :
        $datelivraison = $v->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        if($v->reduction() > $produit->reductionMax()) $reduction = $produit->reductionMax(); else $reduction = $v->reduction();
        echo "<tr id=\"R".$v->id()."\">
                                            <td ><strong class='nom'><a href='/pharmacietest/bouwou/comptabilite/sortie/".$v->id()."'>".$produit->nom()."</a></strong></td>
                                            <td class='prix'>
                                                ".$v->prixVente()."
                                            </td>
                                            <td class=''>
                                                <input class='qte' style=\"width: 50px;\" id=\"qte_vente\" type=\"number\" value='0'>
                                            </td>
                                            <td class='qterest'>
                                                ".$v->quantiteRestante()."
                                            </td>
                                            <td class='reduction'>
                                                ".$reduction."
                                            </td>
                                            <td class='datel'>
                                                ".$datel."
                                            </td>
                                        </tr>";
    endforeach;



}elseif (isset($_POST['id'])&& $action == 'sortie1'){
    foreach ($enrayon as $k => $v) :
        $datelivraison = $v->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        if($v->reduction() > $produit->reductionMax()) $reduction = $produit->reductionMax(); else $reduction = $v->reduction();
        echo "<tr id=\"S".$v->id()."\">
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
                                            <td class='reduction'>
                                                ".$reduction."
                                            </td>
                                            <td class='datel'>
                                                ".$datel."
                                            </td>
                                            <td>
                                               <button class=\"btn btn-primary btn-rounded btn-sm\" onClick=\"valider_stock_detail('".$v->id()."');\">Charger</button>
                                            </td>
                                        </tr>";
    endforeach;
}



?>

