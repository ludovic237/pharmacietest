<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');
require_once('../Class/facturation.php');
require_once('../Class/employe.php');
require_once('../Class/user.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;

$data = [];
$datas = [];
$totalEncaisse = 0;
$total = 0;

$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerFa = new FacturationManager($pdo);


$managerEn = new EmployeManager($pdo);
$managerUser = new UserManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerEnr = new En_rayonManager($pdo);

$username = $_POST['username'];
$password = $_POST['password'];
$codebarre = $_POST['codebarre'];

if ($username != "" && $password != "") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $val = $managerEn->getInfoConnect($username, $password);
    $caisse = $managerCa->get();
    if ($val) {
        $data = array(
            'id' =>$val->id(),
            'identifiant' =>$val->identifiant(),
            'password' =>$val->password(),
            'type' =>$val->type(),
            'faireReductionMax' =>$val->faireReductionMax(),
            'etat' =>$val->etat(),
            'codebarre_id' =>$val->codebarre_id(),
            'user_id' =>$val->user_id(),
            'caisse_id' =>$caisse->id(),
            'supprimer' =>$val->supprimer()
        );
        echo json_encode($data);
    } else {
        echo "".$val;
    }
} else {
    $user = $managerEn->existscodebarre_id($codebarre);
    if ($user) {
        echo "".$user;
    } else {
        echo "".$user;
    }
}





// D'abord, on se connecte ?ySQL

// <?php
// require_once('database.php');
// require_once('../Class/vente.php');
// require_once('../Class/caisse.php');

// global $pdo;


// $manager = new VenteManager($pdo);
// $managerCa = new CaisseManager($pdo);

// $idc=$_POST['idc'];
// $idp=$_POST['idp'];
// $idemp=$_POST['idemp'];
// $nouveau=$_POST['nouveau'];
// $commentaire=$_POST['commentaire'];
// $prixt=$_POST['prixt'];
// $prixr=$_POST['prixr'];
// $etat=$_POST['etat'];


// if (isset($_POST['id'])){


// }
// else{

//     ///echo (''+$managerCa->get());
//     //print_r($managerCa->existsetat());
//     //echo $managerCa->existsetat();


//     $idGen = genererID();

//         $num = $manager->countMois();
//     $ref = genererreference($num);
//         if($etat == "Crédit"){
//             $caisse = null;
//         }else{
//             if($managerCa->existsetat()){
//                 $caisse = $managerCa->get()->id();
//             }
//         }

//     if($managerCa->exists()){
//         //echo "yo";
//         $vent = new Vente(array(
//             'id' => $idGen,
//             'user_id' => $idc,
//             'employe_id' => $idemp,
//             'malade_id' => null,
//             'prescripteur_id' => $idp,
//             'prixTotal' => $prixt,
//             'prixPercu' => 0,
//             'commentaire' => $commentaire,
//             'etat' => $etat,
//             'reference' => $ref,
//             'nouveau_info' => $nouveau,
//             'reduction' => $prixr,
//             'caisse_id' => $caisse,
//             'supprimer' => 0
//         ));
//         $manager->add($vent);
//         $donnees = array('erreur' =>'ok', 'id' => $idGen, 'ref' => $ref);

//         echo json_encode($donnees);
//         //echo 'passe';
//     }
//     else{
//         $donnees = array('erreur' =>'Pas de caisse ouverte !!!');
//         echo json_encode($donnees);
//         //echo 'depasse';
//     }


// }


// // D'abord, on se connecte ?ySQL


//
