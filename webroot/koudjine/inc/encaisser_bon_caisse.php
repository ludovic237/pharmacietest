<?php
require_once('database.php');
require_once('../Class/bon_caisse.php');

global $pdo;


$manager = new BonCaisseManager($pdo);

$type = $_POST['type'];


if ($type == "check") {
    $val = $_POST['val'];
    if ($manager->checkBonNumber($val)){
        echo "OK";
    }
} else {
    if ($type == "encaisser") {
        $code = $_POST['code'];
        $caisse_id = $_POST['caisse_id'];
        $dateEncaisser = $_POST['dateEncaisser'];

        $codeCheck = $manager->checkBonNumber($code);
        $bon = $manager->get($codeCheck->id());
        $bon->setcaisse_id_encaisser($caisse_id);
        $bon->setdateEncaisser($dateEncaisser);
        $bon->settype('Encaisser');
        $manager->update($bon);
        echo "OK";
    } else {
        # code...
    }
}




 
// D'abord, on se connecte ?ySQL
