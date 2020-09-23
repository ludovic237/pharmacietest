<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);

$id=$_POST['id'];
//echo $id;



if (isset($_POST['id'])){
    $ventes = $manager->getListCaisseComplete($id);
    $count = 0;

    foreach ($ventes as $k => $v) :
        //echo $v->en_rayon_id();
        if($count == 5) break;
        $produits = $managerCo->getList($v->id());
        $nom = "";
        foreach ($produits as $p => $q) :
            $produit = $managerPr->get($managerEn->get($q->en_rayon_id())->produit_id())->nom();
            if($nom == ""){
                $nom = $nom.$produit;
            }else{
                $nom = $nom."\n".$produit;
            }
        endforeach;

        echo "<tr id=\"".$v->id()."\">
                                            <td class='prix'>
                                                ".$v->prixTotal()."
                                            </td>
                                            <td class='qte'>
                                                ".$v->prixPercu()."
                                            </td>
                                            <td class='reduction'>
                                                ".$v->dateVente()."
                                            </td>
                                            <td class='reduction'>
                                                ".$v->etat()."
                                            </td>
                                            <td class='reduction'>
                                                <p style=\"font-size: 14px;\">" . $v->reference() . "</p>
                                                <p style=\"font-size: 8px;font-weight: bold;margin-bottom: 0px;\">" . $nom . "</p>
                                            </td>
                                        </tr>";
        $count++;
    endforeach;

}


// D'abord, on se connecte ?ySQL




?>