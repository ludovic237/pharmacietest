<?php
require_once('database.php');
require_once('../Class/bon_caisse.php');

global $pdo;


$manager = new BonCaisseManager($pdo);

/*if (isset($_POST['id']))
    $id = $_POST['id'];*/

/*if (isset($_POST['id'])){*/
$dataBoncaisseGenerer = [];
$generer = $manager->getList();
foreach ($generer as $k => $v) {
    $dataBoncaisseGenerer[] = array(
        "caisse_id" => $v->caisse_id(),
        "caisse_id_encaisser" => $v->caisse_id_encaisser(),
        "codebarre_id" => $v->codebarre_id(),
        "dateEncaisser" => $v->dateEncaisser(),
        "dateGenerer" => $v->dateGenerer(),
        "id" => $v->id(),
        "montant" => $v->montant(),
        "nom_client" => $v->nom_client(),
        "supprimer" => $v->supprimer(),
        "type" => $v->type()
    );
}

echo json_encode($dataBoncaisseGenerer);

/*}*/

?>
