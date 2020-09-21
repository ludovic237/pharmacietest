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

//On sélectionne tous les users dont le nom = Pierre

if (isset($_POST['id']))
    $id=$_POST['id'];

$enrayon = $managerEnRayon->getList($id);
$produit = $managerProduit->get($id);


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
<<<<<<< HEAD
                                                <input class='qte' style=\"width: 50px;\" id=\"qte_vente\" type=\"number\" value='0'>
                                            </td>
=======
                                                <p></p>
                                                <div class='input-group'>
                                                    <span class='input-group-btn'>
                                                        <button type='button' class='btn btn-default btn-number moins'
                                                                onclick=\"change_input('moins','inputQte". $v->id()."')\"
                                                                style='padding: 4px;'>
                                                            <span class='glyphicon glyphicon-minus'></span>
                                                        </button>
                                                    </span>
                                                    <input type='text' name='quant[1]' class='form-control input-number qte'
                                                    id=\"inputQte".$v->id()."\"
                                                    value='0' style='width: 80px;'>
                                                    <span class='input-group-btn'>
                                                        <button type='button' class='btn btn-default btn-number plus'
                                                                onclick=\"change_input('plus','inputQte".$v->id()."')\"
                                                                style='padding: 4px;'>
                                                            <span class='glyphicon glyphicon-plus'></span>
                                                        </button>
                                                    </span>
                                                </div>
                                                <p></p>

                                    </td>
>>>>>>> 750c3bfcf42a35b9012340f832e6186a27f65563
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

