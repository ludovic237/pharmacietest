<?php
require_once('database.php');
require_once('../Class/depense.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/vente.php');

global $pdo;


$managerdepensse = new DepenseManager($pdo);
$managercaisse = new CaisseManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerVente = new VenteManager($pdo);

// $id = $_POST['id'];
if (isset($_POST['type'])) {
    $type = $_POST['type'];
}


if (isset($_POST['idemploye'])) {
    $idemploye = $_POST['idemploye'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    if($idemploye != null){
        $listecaisse = $managercaisse->getIdEmploye($idemploye);
    }else{
        $listecaisse = $managercaisse->getList();
    }


    if ($type == "depense") {
        foreach ($listecaisse as $key => $value) {
            $depense = $managerdepensse->getDateRangeDepenseUserid($startDate, $endDate, $value->id());

            foreach ($depense as $k => $v) :
                echo
                    "<tr id='" . $v->id() . "' data='1000'>
        <td class=''>" . $v->designation() . "
        </td>
        <td class=''>" . $v->quantite() . "
        </td>
        <td class=''>" . $v->prixUnitaire() . "
        </td>
        <td class=''>" . ($v->quantite() * $v->prixUnitaire()) . "
        </td>
        <td class=''>" . $v->beneficiaire() . "
        </td>
        <td class=''>" . $v->numeroCni() . "
        </td>
        <td class=''>" . $v->dateDepense() . "
        </td>
        <td class=''>
        " . $v->societe() . "
        </td>
        <td class=''>
                
        <a data-toggle='tooltip' data-placement='top' data-original-title='Modifier' class='btn btn-default btn-rounded btn-sm' onclick='modify_depense_row(" . $v->id() . ");'><span class='fa fa-pencil'></span></a>
        <a data-toggle='tooltip' data-placement='top' data-original-title='Spprimer' class='btn btn-danger btn-rounded btn-sm' onclick='delete_row('trow_1');'><span class='fa fa-times'></span></a>
    
        </td>
    </tr>";
            endforeach;
        }
    } else {
        if ($type == "caisse") {
            if($idemploye != null){
                $caisseRange = $managercaisse->getDateRangeCaisseUserid($startDate, $endDate, $idemploye);
            }else{
                $caisseRange = $managercaisse->getDateRangeCaisse($startDate, $endDate);
            }


            foreach ($caisseRange as $k => $c) :
                $employename = $managerEmploye->get($c->user_id());
                echo
                    "<tr id=\"" . $c->id() . "\">
                                    <td class='prix'>
                                        <strong >
                                        " . $c->id() . "
                                        </strong>
                                    </td>
                                    <td class='prix'>
                                        " . $employename->identifiant() . "
                                    </td>
                                    <td class='prix'>
                                        " . $c->session() . "
                                    </td>
                                    <td class='prix'>
                                        <span class='label label-success'>
                                        " . $c->etat() . "
                                        </span>
                                    </td>
                                    <td class='prixFermeture'>
                                    " . $c->fondCaisseFerme() . "
                                    </td>
                                    <td class='prixOuverture'>
                                    " . $c->fondCaisseOuvert() . "
                                    </td>
                                    <td class='prix'>
                                    " . $c->dateOuvert() . "
                                    </td>
                                    <td class='prix'>
                                    " . $c->dateFerme() . "
                                    </td>
                                    <td>
                                        <a class=\"btn btn-success btn-rounded btn-sm \"  onclick=\"showVenteCaisse('" . $c->id() . "')\"><span class=\"\">Voir vente</span></a>
                                        <a href=\" /pharmacietest/bouwou/comptabilite/caisse_rapport/" . $c->id() . "\" class=\"btn btn-primary btn-rounded btn-sm \" ><span class=\"\">Voir rapport</span></a>
                                    </td>
                                </tr>";
            endforeach;
        } else {
            if ($type == "vente") {
                if($idemploye != null){
                    $listvente = $managerVente->getListVenteRangeEmploye($startDate, $endDate, $idemploye);
                }else{
                    $listvente = $managerVente->getListVenteRange($startDate, $endDate);
                }


                foreach ($listvente as $key => $v) {

                    echo "<tr id=\"" . $v->id() . "\">
                    <td>
                        <p>" . $v->reference() . "</p>
                    </td>
    
                    <td class='prixTotal'>" . $v->prixTotal() . "</td>
                    <td >" . $v->prixPercu() . "</td>
                    <td >" . $managerEmploye->get($v->employe_id())->identifiant() . "</td>
                    <td class=\"datevte\">
                        " . $v->dateVente() . "
                    </td>
                    <td>
                        " . $v->etat() . "
                    </td>
                    <td>
                        <a class=\"btn btn-success btn-rounded btn-sm \" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Modifier\" onclick=\"reimprime_ticket_caisse(" . $v->id() . ")\">Imprimer ticket</a>
                    </td>
                </tr>";
                }
            } else {
                echo "Loading";
            }
        }
    }

    switch ($type) {
        case 'depense':


        case 'caisse':



        case 'vente':
            # code...
            break;

        default:
            # code...
            break;
    }
}