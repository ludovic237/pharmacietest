<?php
require_once('database.php');
require_once('../Class/ligne_commande.php');
require_once('../Class/viewconcerner.php');


global $pdo;
global $conndb;
$data = [];
$line = [];
$datas = [];
$lastDate = [];
$totalEncaisse = 0;
$total = 0;

$managerPrCmdView = new ConcernerViewManager($pdo);
$manager = new LigneCommandeManager($pdo);

$list = $manager->getListType('ListeCommande');
$i = 0;
$start = $_POST['start'];
$end = $_POST['end'];

if ($start == '' && $end == '') {
    $ProduitCmdView = $managerPrCmdView->getAll();

    $prds = array();
    $qte = 0;
    foreach ($ProduitCmdView as $key => $v) {
        //$pos = array_search($v->nom(),$data);
        $index = array_search($v->produitId(), array_column($data, 'produitId'));
        if ($index !== false) {
            $data[$index]["concernerQuantite"] = $data[$index]["concernerQuantite"] + $v->concernerQuantite();
        } else {
            $data[] = array(
                "venteId" => $v->venteId(),
                "concernerId" => $v->concernerId(),
                "concernerQuantite" => $v->concernerQuantite(),
                "concernerPrixUnit" => $v->concernerPrixUnit(),
                "concernerReduction" => $v->concernerReduction(),
                "venteReference" => $v->venteReference(),
                "ventePrixPercu" => $v->ventePrixPercu(),
                "ventePrixTotal" => $v->ventePrixTotal(),
                "enrayPrixAchat" => $v->enrayPrixAchat(),
                "enrayPrixVente" => $v->enrayPrixVente(),
                "enrayDateLivraison" => $v->enrayDateLivraison(),
                "enrayDatePeremption" => $v->enrayDatePeremption(),
                "enrayQuantiteRayon" => $v->enrayQuantiteRayon(),
                "enrayQuantiteRestante" => $v->enrayQuantiteRestante(),
                "nom" => $v->nom(),
                "produitId" => $v->produitId(),
                "venteDateVente" => $v->venteDateVente(),
            );
        }
    }

    if (!empty($list)) {
        foreach ($list as $k => $c) {
            if ($i == 0) {
                $dateDebut = '';
                $lastDate[$i] = $c->dateDerniere();
            } else {
                $lastDate[$i] = $c->dateDerniere();
                $dateDebut = $lastDate[$i - 1];
            }

            $line[] = array(
                "id" => $c->id(),
                "type" => $c->type(),
                "dateDerniere" => $c->dateDerniere(),
                "dateDebut" => $dateDebut
            );
            $i++;
        }
        $line[] = array(
            "id" => 'En cours',
            "type" => 'LigneCommande',
            "dateDerniere" => '',
            "dateDebut" => $lastDate[$i - 1]
        );
    }


    $datas = array('data' => $data, 'totalEncaisse' => $total, 'ligne' => $line,);
    echo json_encode($datas);
} else {

    $ProduitCmdView = $managerPrCmdView->getAllByDate($start, $end);


    $prds = array();
    $qte = 0;
    foreach ($ProduitCmdView as $key => $v) {
        //$pos = array_search($v->nom(),$data);
        $index = array_search($v->produitId(), array_column($data, 'produitId'));
        if ($index !== false) {
            $data[$index]["concernerQuantite"] = $data[$index]["concernerQuantite"] + $v->concernerQuantite();
        } else {
            $data[] = array(
                "venteId" => $v->venteId(),
                "concernerId" => $v->concernerId(),
                "concernerQuantite" => $v->concernerQuantite(),
                "concernerPrixUnit" => $v->concernerPrixUnit(),
                "concernerReduction" => $v->concernerReduction(),
                "venteReference" => $v->venteReference(),
                "ventePrixPercu" => $v->ventePrixPercu(),
                "ventePrixTotal" => $v->ventePrixTotal(),
                "enrayPrixAchat" => $v->enrayPrixAchat(),
                "enrayPrixVente" => $v->enrayPrixVente(),
                "enrayDateLivraison" => $v->enrayDateLivraison(),
                "enrayDatePeremption" => $v->enrayDatePeremption(),
                "enrayQuantiteRayon" => $v->enrayQuantiteRayon(),
                "enrayQuantiteRestante" => $v->enrayQuantiteRestante(),
                "nom" => $v->nom(),
                "produitId" => $v->produitId(),
                "venteDateVente" => $v->venteDateVente(),
            );
        }
    }

    if (!empty($list)) {
        foreach ($list as $k => $c) {
            if ($i == 0) {
                $dateDebut = '';
                $lastDate[$i] = $c->dateDerniere();
            } else {
                $lastDate[$i] = $c->dateDerniere();
                $dateDebut = $lastDate[$i - 1];
            }

            $line[] = array(
                "id" => $c->id(),
                "type" => $c->type(),
                "dateDerniere" => $c->dateDerniere(),
                "dateDebut" => $dateDebut
            );
            $i++;
        }
        $line[] = array(
            "id" => 'En cours',
            "type" => 'LigneCommande',
            "dateDerniere" => '',
            "dateDebut" => $lastDate[$i - 1]
        );
    }


    $datas = array('data' => $data, 'totalEncaisse' => $total, 'ligne' => $line,);
    echo json_encode($datas);
}



