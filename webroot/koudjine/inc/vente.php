<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/caisse.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerCa = new CaisseManager($pdo);

$idCaisse = $_POST['idCaisse'];


if ($idCaisse == $_POST['idCaisse']) {
    $VenteCaisse = $manager->getListCaisseVente($idCaisse);
    foreach ($VenteCaisse as $key => $v) {
        echo "<tr id=\"" . $v->id() . "\">
                <td>
                    <p>" . $v->reference() . "</p>
                </td>

                <td><strong >" . $v->prixTotal() . "</strong></td>
                <td >" . $v->prixPercu() . "</td>
                <td >" . $v->employe_id() . "</td>
                <td class=\"datevte\">
                    " . $v->dateVente() . "
                </td>
                <td>
                    " . $v->etat() . "
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
