<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/produitcmd.php');
require_once('../Class/commande.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;
global $conndb;

$manager = new VenteManager($pdo);
$managerPc = new Produit_cmdManager($pdo);
$managerCm = new CommandeManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerEnr = new En_rayonManager($pdo);

//On sélectionne tous les users dont le nom = Pierre
if (isset($_GET["motclef1"])) {
    $motclef = '%' . $_GET["motclef1"] . '%';
    $q = array('motclef' => $motclef . '%');
    $sth = $pdo->prepare("
              SELECT p.nom, p.stock, r.reduction, p.reductionMax, r.prixAchat, r.id as id, r.dateLivraison, p.id as idp 
              FROM produit p, en_rayon r
              WHERE p.nom like :motclef AND p.id = r.produit_id AND p.supprimer = 0 AND r.dateLivraison IN (select max(dateLivraison) from en_rayon e where r.produit_id = e.produit_id )
              
            ");
    $sth->execute($q);
    $count = $sth->rowCount();

    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
            $datelivraison = $result->dateLivraison;
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
            $datel = $date->format('Y-m-d');
            if ($result->reduction > $result->reductionMax) $reduction = $result->reduction;
            else $reduction = $result->reductionMax;
            // calcul de la quantite vendue depuis la derniere commande
            if($managerPc->existsLastCmdId($result->idp)){
                $lastCmd = $managerPc->getLastCmdId($result->idp);
                $cmd = $managerCm->get($lastCmd->commande_id());
                $ventes = $manager->getListRangeNow($cmd->dateLivraison());
                //echo $lastCmd->commande_id();
                $total = 0;
                foreach ($ventes as $k => $c) :
                    //echo $v->en_rayon_id();
                    $concs = $managerCo->getListConverneProduitId($c->id(), $result->idp);
                    //print_r($concs);
                    if( !empty($concs)){
                        foreach ($concs as $p => $q) :
                            //print_r($q);
                            $total = $total + $q['totalqte'];
                            //echo  $q['totalqte'];
                        endforeach;
                    }
                endforeach;
            }
            else{
                $total = 0;
            }

            echo "<tr id=\"" . $result->idp . "\">
                                            <td class='nom'><strong>" . $result->nom . "</strong></td>
                                            <td class='datel'>
                                                " . $datel . "
                                            </td>
                                            <td>
                                                " . $result->stock . "
                                            </td>
                                            <td class='prix'>
                                            <p></p>
                                                <div class='input-group'style='width:100px;' >
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins'
                                                        onclick=\"change_input('moins','inputPrix". $result->idp."')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                                <input type='text' name='quant[1]' class='form-control input-number'
                                                       id=\"inputPrix".$result->idp."\"
                                                       value='".trim($result->prixAchat)."' style='width: 80px;'>
                                                <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus'
                                                        onclick=\"change_input('plus','inputPrix".$result->idp."')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                            
                                            </div>
                                            <p></p>
                                            </td>
                                            <td>
                                            <p></p>
                                            <div class='input-group' style='width:100px;' >
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins'
                                                        onclick=\"change_input('moins', 'inputQte".$result->idp."')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                                <input type='text' name='quant[1]' class='form-control input-number'
                                                       id=\"inputQte". $result->idp."\" value='". $total."' style='width: 40px;'>
<span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus'
                                                        onclick=\"change_input('plus','inputQte".$result->idp."')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
</div>
    <p></p>
                                                
                                            </td>
                                            <td>
                                                <button class=\"btn btn-info btn-rounded btn-sm\" data-toggle=\"tooltip\"
                                                    data-placement=\"top\"
                                                    onclick=\"ajouter_commande(".$result->idp.")\">Ajouter à la
                                                commande
                                            </button>
                                            </td>
                                        </tr>";
            //echo "<li  style=\"background-color: #fff; list-style-type: none; margin: 0; padding: 0;\"><tr><a href=\"update/".$result->id."\" style=\"display:block; height: 25px; color: #000; text-decoration: none;\"><td>$result->nom</td></a><td>$result->stock</td><tr>$result->reductionMax</tr></li>";
        }
    } else {
        echo "Aucun résultat pour le mot : " . $_GET["motclef1"];
    }
}
