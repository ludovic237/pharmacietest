<?php
require_once('database.php');
require_once('../Class/ligne_commande.php');

global $pdo;
global $conndb;
$manager = new LigneCommandeManager($pdo);

$list = $manager->getListType('ListeCommande');
$i = 0;
foreach ($list as $k => $c) :
    if($i == 0){
        $dateDebut = '';
        $lastDate[$i] = $c->dateDerniere();
    }else{
        $lastDate[$i] = $c->dateDerniere();
        $dateDebut = $lastDate[$i-1];
    }

    $data[] = array(
        "id" =>$c->id(),
        "type" =>$c->type(),
        "dateDerniere" =>$c->dateDerniere(),
        "dateDebut" =>$dateDebut
    );
    $i++;
endforeach;
$data[] = array(
    "id" =>'En cours',
    "type" =>'LigneCommande',
    "dateDerniere" =>'',
    "dateDebut" =>$lastDate[$i-1]
);
$datas = array('data' => $data);
echo json_encode($datas);




