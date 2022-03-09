<?php
require_once('database.php');
require_once('../Class/facturation.php');
require_once('../Class/caisse.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');

global $pdo;


$manager = new CaisseManager($pdo);
$managerFa = new FacturationManager($pdo);
$managerEm = new EmployeManager($pdo);
$managerUs = new UserManager($pdo);

if (isset($_POST['id']))
    $id = $_POST['id'];

if (isset($_POST['id'])){
    $caisse = $manager->getId($id);
    $_caisse = $manager->getIds($id);
    $_employe = $managerEm->get($caisse->user_id());
    //echo $caisse->fondCaisseFerme();
    $especes = $managerFa->getListCaisseType($id, 'Espèce');
    $electroniques = $managerFa->getListCaisseType($id, 'Electronique');
    $total_espece = 0;
    $total_electronique = 0;
    foreach ($especes as $k => $v) :
        $total_espece = $total_espece + $v->montantTtc();
    endforeach;
    foreach ($electroniques as $k => $v) :
        $total_electronique = $total_electronique + $v->montantTtc();
    endforeach;
    $donnees = array('erreur' =>'non', 'espece_caisse' => $caisse->fondCaisseFerme() ,'espece_syst' => $total_espece, 'electronique' => $total_electronique, 'data' => $_caisse, 'employe' => $_employe->identifiant());
    echo json_encode($donnees);

}


// D'abord, on se connecte ?ySQL




?>