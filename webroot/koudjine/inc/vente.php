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


$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);
$managerFa = new FacturationManager($pdo);



$managerEn = new EmployeManager($pdo);
$managerUser = new UserManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerEnr = new En_rayonManager($pdo);

if (isset($_POST['idCaisse'])) {
    $idCaisse = $_POST['idCaisse'];
    $VenteCaisse = $manager->getListCaisseVente($idCaisse);
    foreach ($VenteCaisse as $key => $v) {
        $employeName = $managerUser->get(($managerEn->get($v->employe_id()))->user_id());
        $produits = $managerCo->getList($v->id());
        $nameProduit = "";
        foreach ($produits as $k => $c) :
            //echo $v->en_rayon_id();
            $nom = $managerPr->get($managerEnr->get($c->en_rayon_id())->produit_id())->nom();
            $nameProduit = $nom.",".$nameProduit;
        endforeach;
        if($managerFa->existsvente_id($v->id())){
            $fact = $managerFa->getVente($v->id());
            $typePaiement = $fact->typePaiement();
        }else{
            $typePaiement = 'Inachevée';
        }

        echo "<tr id=\"" . $v->id() . "\">
                <td>
                    <p>" . $v->reference() . "</p>
                    <strong>" . $nameProduit . "</strong>
                </td>
                <td><strong >" . $v->prixTotal() . "</strong></td>
                <td >" . $v->prixPercu() . "</td>
                <td >" . $employeName->nom() ." ". $employeName->prenom() . "</td>
                <td class=\"datevte\">
                    " . $v->dateVente() . "
                </td>
                <td>
                    " . $v->etat() . " / " . $typePaiement . "
                </td>
                <td>
                    <a class=\"btn btn-success btn-rounded btn-sm \" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Modifier\" onclick=\"reimprime_ticket_caisse(" . $v->id() . ")\">Imprimer ticket</a>
                </td>
            </tr>";
    }
} else {

    $idc = $_POST['idc'];
    $idp = $_POST['idp'];
    $idemp = $_POST['idemp'];
    $nouveau = $_POST['nouveau'];
    $commentaire = $_POST['commentaire'];
    $prixt = $_POST['prixt'];
    $prixr = $_POST['prixr'];
    $etat = $_POST['etat'];

    if (isset($_POST['id'])) {
    } else {

        $idGen = genererID();

        $num = $manager->countMois();
        $ref = genererreference($num);
        if ($etat == "Crédit") {
            $caisse = null;
        } else {
            if ($managerCa->existsetat()) {
                $caisse = $managerCa->get()->id();
            }
        }

        if ($managerCa->exists()) {
            //echo "yo";
            $vent = new Vente(array(
                'id' => $idGen,
                'user_id' => $idc,
                'employe_id' => $idemp,
                'malade_id' => null,
                'prescripteur_id' => $idp,
                'prixTotal' => $prixt,
                'prixPercu' => 0,
                'commentaire' => $commentaire,
                'etat' => $etat,
                'reference' => $ref,
                'nouveau_info' => $nouveau,
                'reduction' => $prixr,
                'caisse_id' => $caisse,
                'supprimer' => 0
            ));
            $manager->add($vent);
            $donnees = array('erreur' => 'ok', 'id' => $idGen, 'ref' => $ref);

            echo json_encode($donnees);
            //echo 'passe';
        } else {
            $donnees = array('erreur' => 'Pas de caisse ouverte !!!');
            echo json_encode($donnees);
            //echo 'depasse';
        }
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
