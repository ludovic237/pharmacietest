<?php
require_once('database.php');
require_once('../Class/concerner.php');
require_once('../Class/vente.php');

global $pdo;


$manager = new ConcernerManager($pdo);
$managerVe = new VenteManager($pdo);

$id=$_POST['id'];

//echo $id;
//echo $qte;
$vente = $managerVe->get($id);
$concerner = $manager->getList($id);
print_r($vente);
foreach ($concerner as $k => $v){
    $conc = $manager->get($v->id());
    print_r($conc);
    //$conc->setsupprimer(1);
    $manager->update_delete($conc);
}
//$vente->setsupprimer(1);
$managerVe->update_delete($vente);


// D'abord, on se connecte ?ySQL




?>