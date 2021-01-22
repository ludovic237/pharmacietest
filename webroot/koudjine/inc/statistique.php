<?php
require_once('database.php');
require_once('../Class/fournisseur.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/vente.php');

$id;
$nom;
global $pdo;

$managerFo = new FournisseurManager($pdo);
$managerCaisse = new CaisseManager($pdo);
$managerEmploye = new EmployeManager($pdo);
$managerVente = new VenteManager($pdo);

$groupFournisseur = [];
$tab = $_POST['tab'];

$start = $_POST['start'];
$end = $_POST['end'];
$data = [];
$datas = [];
$total = 0;

if ($tab == 'fournisseur') {
    $type = $_POST['type'];
    if ($type == "Tous") {
        $groupFournisseur = $managerFo->getGroupFournisseurRangeAll($start, $end);
        if ($groupFournisseur){
            $datas = array('data' => $groupFournisseur);
            echo json_encode($datas);
        }
        else{
            $datas = array('data' => []);
            echo json_encode($datas);
        }

    } else {
        $groupFournisseur = $managerFo->getGroupFournisseurRange($type, $start, $end);
        if ($groupFournisseur){
            $datas = array('data' => $groupFournisseur);
            echo json_encode($datas);
        }
        else{
            $datas = array('data' => []);
            echo json_encode($datas);
        }
    }
}
else {
    if ($tab == 'caisse') {
        $id = $_POST['type'];

        if ($id == "0") {
            $groupFournisseur = $managerCaisse->getDateRangeCaisse($start, $end);
            if ($groupFournisseur){

                foreach ($groupFournisseur as $k => $e) {
                    $employe = $managerEmploye->get($e->user_id());
                    $ventes = $managerVente->getListCaisseEmployeVente($e->id());
                    $totalEncaisse = 0;
                    foreach ($ventes as $k => $a) {
                        $totalEncaisse = $a->prixTotal() + $totalEncaisse;
                    }

                    $data[] = array(
                        "DT_RowId"  => $e->id(),
                        "id" => $e->id(),
                        "user_id" => $employe->identifiant(),
                        "ouvertureCaisse" => $e->ouvertureCaisse(),
                        "fermetureCaisse" =>$e->fermetureCaisse(),
                        "totalEncaisse" =>$totalEncaisse,
                        "dateOuvert" =>$e->dateOuvert(),
                        "dateFerme" =>$e->dateFerme(),
                        "session" =>$e->session(),
                        "fondCaisseOuvert" =>$e->fondCaisseOuvert(),
                        "fondCaisseFerme" =>$e->fondCaisseFerme(),
                        "etat" =>$e->etat(),
                    );
                    $total = $totalEncaisse + $total;
                }
                $datas = array('data' => $data,'totalEncaisse' => $total);
                echo json_encode($datas);
            }
            else{
                $datas = array('data' => $data,'totalEncaisse' => $total);
                echo json_encode($datas);
            }

        } else {
            $groupFournisseur = $managerCaisse->getDateRangeCaisseUserid($start, $end, $id);
            if ($groupFournisseur){

                foreach ($groupFournisseur as $k => $e) {
                    $employe = $managerEmploye->get($e->user_id());
                    $ventes = $managerVente->getListCaisseEmployeVente($e->id());
                    $totalEncaisse = 0;
                    foreach ($ventes as $k => $a) {
                        $totalEncaisse = $a->prixTotal() + $totalEncaisse;
                    }
                    $data[] = array(
                        "DT_RowId"  => $e->id(),
                        "id" => $e->id(),
                        "user_id" => $employe->identifiant(),
                        "ouvertureCaisse" => $e->ouvertureCaisse(),
                        "fermetureCaisse" =>$e->fermetureCaisse(),
                        "totalEncaisse" =>$totalEncaisse,
                        "dateOuvert" =>$e->dateOuvert(),
                        "dateFerme" =>$e->dateFerme(),
                        "session" =>$e->session(),
                        "fondCaisseOuvert" =>$e->fondCaisseOuvert(),
                        "fondCaisseFerme" =>$e->fondCaisseFerme(),
                        "etat" =>$e->etat(),
                    );
                    $total = $totalEncaisse + $total;
                }
                $datas = array('data' => $data,'totalEncaisse' => $total);
                echo json_encode($datas);
            }
            else{
                $datas = array('data' => $data,'totalEncaisse' => $total);
                echo json_encode($datas);
            }
        }
    }
}




// D'abord, on se connecte ?ySQL
