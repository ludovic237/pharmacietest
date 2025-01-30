<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');
require_once('../Class/produit_detail.php');

$id;

global $pdo;
global $conndb;
$managerVente = new VenteManager($pdo);
$managerCaisse = new CaisseManager($pdo);
$managerUser = new UserManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerPrDetail = new Produit_detailManager($pdo);

$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);

if (isset($_POST['id']))
    $id=$_POST['id'];

$ventes= $managerVente->getListCaisse($id);
$caisse = $managerCaisse->getId($id);


//echo "passe";
if (isset($_POST['id'])||isset($_GET['id'])){



    foreach ($ventes as $k => $v) :
        $datevente = $v->dateVente();
        if($v->user_id()!= null){
            //$client1 = $managerUser->get($v->user_id());
            $client = $managerUser->get($v->user_id())->nom();
        }else{
            $client = $v->nouveau_info();
        }
        if($v->employe_id() != null){
            $employ = $managerEmploye->get($v->employe_id());
            $employe = $managerUser->get($employ->user_id())->nom();
        }else{
            $employe = null;
        }
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datevente);
        $datev = $date->format('d-m-Y');
        $heurev = $date->format('H:i');

        $produits = $managerCo->getList($v->id());
        $typefacturation = "No exist";
        $montantfactureEspece = 0;
        $montantfactureElectronique = 0;
        $montantfactureTicket = 0;
        $data = [];
        foreach ($produits as $a => $b) :
            if ($b->type() == "detail") {
                $nom = $managerPrDetail->get($b->en_rayon_id())->nom();
            } else {
                $nom = $managerPr->get($managerEn->get($b->en_rayon_id())->produit_id())->nom();
            }

            $data[] = array(
                "nom" => $nom,
            );



        endforeach;
        $nomString = "Le tableau est vide.";
        if($v->etat() == 'Comptant'){
            $bouton = "<button class=\"btn btn-default btn-rounded btn-sm \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"delete_row_caisse('".$v->id()."', event)\"><span class='fa fa-times'></span></button>";
        }else{
            $bouton = "";
        }
        if (!empty($data)) {
            // Concaténation des valeurs de la clé "nom"
            $nomString = implode(", ", array_column($data, "nom"));
            echo $nomString; // Résultat : Jean, Paul, Marie
        } else {
            echo "Le tableau est vide.";
        }
        echo "<tr id=\"".$v->id()."\">
                                            <td ><strong class='prixtotal'>".$v->prixTotal()."</strong></td>
                                            <td class='reduction'>".$v->reduction()."</td>
                                            <td class='reference'>
                                                <p style='font-size: 14px;'>".$v->reference()."</p>
                                             
                                                <p style='font-size: 8px;font-weight: bold;margin-bottom: 0px;'>".$nomString."</p>
                                                
                                            </td>
                                            <td class='client'>
                                                ".$client."
                                            </td>
                                            <td class='vendeur'>
                                                ".$employe."
                                            </td>
                                            <td class='commentaire'>
                                                ".$v->commentaire()."
                                            </td>
                                            <td><span class='date'>
                                                ".$datev."</span> à <span class='heure'>".$heurev."</span>
                                            </td>
                                            <td>
                                                <button class=\"btn btn-default btn-rounded btn-sm \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"charger_vente('".$v->id()."')\"><span class=\"\">Charger</span></button>
                                                ".$bouton."
                                            </td>
                                        </tr>";
    endforeach;



}



?>

