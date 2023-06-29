<?php
require_once('database.php');
require_once('../Class/ligne_commande.php');
require_once('../Class/viewconcerner.php');

global $pdo;
$data = [];
$datas = [];
$totalEncaisse = 0;
$total = 0;

$managerPrCmdView = new ConcernerViewManager($pdo);

//$start = $_POST['start'];
//$end = $_POST['end'];

$ProduitCmdView = $managerPrCmdView->getAll();

$prds = array();
$qte = 0;
foreach ($ProduitCmdView as $key => $v) {
    $pos = array_search($v->produitId(),$data);
    if($pos!==false){
        $data[$pos]["concernerQuantite"] = $data[$pos]["concernerQuantite"] + $v->concernerQuantite();
    }else{
        $data[] = array(
            "venteId"=>$v->venteId(),
            "concernerId"=>$v->concernerId(),
            "concernerQuantite"=>$v->concernerQuantite(),
            "concernerPrixUnit"=>$v->concernerPrixUnit(),
            "concernerReduction"=>$v->concernerReduction(),
            "venteReference"=>$v->venteReference(),
            "ventePrixPercu"=>$v->ventePrixPercu(),
            "ventePrixTotal"=>$v->ventePrixTotal(),
            "enrayPrixAchat"=>$v->enrayPrixAchat(),
            "enrayPrixVente"=>$v->enrayPrixVente(),
            "enrayDateLivraison"=>$v->enrayDateLivraison(),
            "enrayDatePeremption"=>$v->enrayDatePeremption(),
            "enrayQuantiteRayon"=>$v->enrayQuantiteRayon(),
            "enrayQuantiteRestante"=>$v->enrayQuantiteRestante(),
            "nom"=>$v->nom(),
            "produitId"=>$v->produitId(),
            "venteDateVente"=>$v->venteDateVente(),
        );
    }
}
$datas = array('data' => $data,'totalEncaisse' => $total);
echo json_encode($datas);

