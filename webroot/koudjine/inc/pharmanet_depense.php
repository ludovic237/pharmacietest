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
    $listecaisse = $managercaisse->getIdEmploye($idemploye);

    if ($type == "depense") {
        foreach ($listecaisse as $key => $value) {
            $depense = $managerdepensse->getDateRangeDepenseUserid($startDate, $endDate, $value->id());

            foreach ($depense as $k => $v) :
                echo
                    "<tr id='" . $v->id() . "' data='1000'>
        <td class=''>
            <input class='designation' type=\"text\" value='" . $v->designation() . "'>
        </td>
        <td class=''>
            <input class='qte' type=\"text\" value='" . $v->quantite() . "'>
        </td>
        <td class=''>
            <input class='prix' type=\"text\" value='" . $v->prixUnitaire() . "'>
        </td>
        <td class=''>
            <input class='total' type=\"text\" value='" . ($v->quantite() * $v->prixUnitaire()) . "'>
        </td>
    </tr>";
            endforeach;
        }
    } else {
        if ($type == "caisse") {

            $caisseRange = $managercaisse->getDateRangeCaisseUserid($startDate, $endDate, $idemploye);
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
                                    </td>
                                </tr>";
            endforeach;
        } else {
            if ($type == "vente") {

                $listvente = $managerVente->getListVenteRangeEmploye($startDate, $endDate, $idemploye);
                foreach ($listvente as $key => $v) {

                    echo "<tr id=\"" . $v->id() . "\">
                    <td>
                        <p>" . $v->reference() . "</p>
                    </td>
    
                    <td class='prixTotal'>" . $v->prixTotal() . "</td>
                    <td >" . $v->prixPercu() . "</td>
                    <td >" . $v->employe_id() . "</td>
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
