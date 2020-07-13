<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');

$id;

global $pdo;
global $conndb;
$managerVente = new VenteManager($pdo);
$managerCaisse = new CaisseManager($pdo);
$managerUser = new UserManager($pdo);
$managerEmploye = new EmployeManager($pdo);

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
        echo "<tr id=\"".$v->id()."\">
                                            <td ><strong class='prixtotal'>".$v->prixTotal()."</strong></td>
                                            <td class='reduction'>".$v->reduction()."</td>
                                            <td class='reference'>
                                                ".$v->reference()."
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
                                            <td class='date'>
                                                ".$datev."
                                            </td>
                                            <td>
                                                <button class=\"btn btn-default btn-rounded btn-sm \" data-toggle=\"tooltip\" data-placement=\"top\" onclick=\"charger_vente('".$v->id()."')\"><span class=\"\">Charger</span></button>
                                            </td>
                                        </tr>";
    endforeach;



}



?>

