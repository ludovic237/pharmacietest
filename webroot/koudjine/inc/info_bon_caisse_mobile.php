<?php
require_once('database.php');
require_once('../Class/bon_caisse.php');

global $pdo;


$manager = new BonCaisseManager($pdo);


$code = $_POST['code'];
if ($code != "") {
    $codeCheck = $manager->checkBonNumber($code);
    $bon = $manager->get($codeCheck->id());
    $data = array(
        'id' =>$bon->id(),
        'caisse_id' =>$bon->caisse_id(),
        'caisse_id_encaisser' =>$bon->caisse_id_encaisser(),
        'nom_client' =>$bon->nom_client(),
        'codebarre_id' =>$bon->codebarre_id(),
        'montant' =>$bon->montant(),
        'dateGenerer' =>$bon->dateGenerer(),
        'dateEncaisser' =>$bon->dateEncaisser(),
        'type' =>$bon->type(),
        'supprimer' =>$bon->type()
    );
    echo json_encode($data);
}

// D'abord, on se connecte ?ySQL
