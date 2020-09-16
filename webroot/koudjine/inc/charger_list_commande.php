<?php
require_once('database.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new CommandeManager($pdo);
$managerPc = new Produit_cmdManager($pdo);
$managerPr = new ProduitManager($pdo);

$id=$_POST['id'];
//echo $id;



if (isset($_POST['id'])){
    $Produit_cmds = $managerPc->getList($id);
    $i = 1;
    $nbre = 0;
    $total = 0;

    foreach ($Produit_cmds as $k => $v) :
        //echo $v->en_rayon_id();
        $nom = $managerPr->get($v->produit_id())->nom();
        //echo $nom;
    $nbre = $nbre + $v->qtiteCmd();
    $total = $total + ($v->qtiteCmd()*$v->puCmd());

        echo "<tr id=\"".$v->produit_id()."\">
                                            <td>".$i."</td>
                                            <td style='background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;' ><strong class='nom' id='nom".$v->produit_id()."'>".$nom."</strong></td>
                                            <td style='background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;' class='qteCmd'>".$v->qtiteCmd()."</td>
                                            <td style='background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;' class='prixCmd'>".$v->puCmd()."</td>
                                            <td style='background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;' class='total'>".($v->qtiteCmd()*$v->puCmd())."</td>
                                        </tr>";
        $i++;
    endforeach;
    echo "<tr id=\"".$v->produit_id()."\">
                                            <td style='background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;' colspan=\"4\" >Total</td>
                                            <td style='background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;' ><strong class='total_com' id='total_com' data='".$nbre."' data1='".($i-1)."'>".$total."</strong></td>
                                           
                                        </tr>";

}





?>