<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/vente.php');
require_once('../Class/en_rayon.php');
require_once('../Class/concerner.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');

global $pdo;
global $conndb;

$vente;
$concerner;
$enrayon;
$caisse;
$venteTotalRange = 0;
$quantiteTotalRange = 0;
$quantiteTotalEnRayon = 0;
$quantiteTotalSameRayonId = 0;
$nom;

$managerProduit = new ProduitManager($pdo);
$managerVente = new VenteManager($pdo);
$managerCaisse = new CaisseManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerConcerner = new ConcernerManager($pdo);

// $start = $_POST['start'];
// $end = $_POST['end'];
$start = $_POST['start'];
$end = $_POST['end'];
$idemploye = $_POST['idemploye'];

if ($idemploye==0) {
    $idemploye = null;
}
if ($start != 0 && $end != 0 && $idemploye == null) {
    $caisse = $managerCaisse->getDateRangeCaisse($start, $end);
    //echo "passe 0";
} else if ($start != 0 && $end != 0 && $idemploye != null){
    //echo "passe 1";
    $caisse = $managerCaisse->getDateRangeCaisseUserid($start, $end, $idemploye);
} else if ($start == 0 && $end == 0 && $idemploye != null){
    //echo "passe 2";
    $caisse = $managerCaisse->getIdEmploye($idemploye);
}else {
    //echo "passe 3";
    $caisse = $managerCaisse->getList();
}



/*{
    if ($idemploye == $_POST['idemploye'] && $start == 0 && $end == 0) {

        $caisse = $managerCaisse->getIdEmploye($idemploye);

    } else {
        if ($start == $_POST['start'] && $end == $_POST['end'] && $idemploye == $_POST['idemploye']) {
            
            if ($idemploye != null) {

            } else {
                $caisse = $managerCaisse->getDateRangeCaisse($start, $end);
            }

        } else {
            if ($idemploye == null && $start == 0 && $end == 0) {

                $caisse = $managerCaisse->getList();

            }
        }
    }
}*/
foreach ($caisse as $k => $c) :
    $employe = $managerEmploye->get($c->user_id());
    echo
        "<tr \">
                        <td class='prix'>
                            " . $c->id() . "
                        </td>
                        <td class='prix'>
                            " . $employe->identifiant() . "
                        </td>
                        <td class='prix'>
                            " . $c->session() . "
                        </td>
                        <td class='prix'>
                        " . $c->etat() . "
                        </td>
                        <td class='prix'>
                        " . $c->fondCaisseFerme() . "
                        </td>
                        <td class='prix'>
                        " . $c->fondCaisseOuvert() . "
                        </td>
                    </tr>";
endforeach;
