<?php
require_once('database.php');
require_once('../Class/commande.php');
require_once('../Class/produitcmd.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');
require_once('../Class/fournisseur.php');

global $pdo;


$manager = new CommandeManager($pdo);
$managerPc = new Produit_cmdManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerPrayon = new En_rayonManager($pdo);
$managerFourn = new FournisseurManager($pdo);

$id = $_POST['id'];
//echo $id;
if (isset($_POST['ticket']) && isset($_POST['id'])) {
    $en_rayon_List = $managerPrayon->getListByCommande($id);
    $med = [];
    foreach ($en_rayon_List as $k => $v) :
        //echo $v->en_rayon_id();
        $nom = $managerPr->get($v->produit_id())->nom();
        //echo $nom;
        $med[] = array('nom' => $nom,
            'id' => $v->id(),
            'produit_id' => $v->produit_id(),
            'fournisseur_code' => $managerFourn->get($v->fournisseur_id())->code(),
            'commande_id' => $v->commande_id(),
            'dateLivraison' => $v->dateLivraison(),
            'datePeremption' => $v->datePeremption(),
            'prixAchat' => $v->prixAchat(),
            'prixVente' => $v->prixVente(),
            'quantite' => $v->quantite(),
            'quantiteRestante' => $v->quantiteRestante(),
            'reduction' => $v->reduction(),
        );
    endforeach;
    $donnees = array('data' => $med);
    echo json_encode($donnees);
} elseif (isset($_POST['id'])) {
    $Produit_cmds = $managerPc->getList($id);

    foreach ($Produit_cmds as $k => $v) :
        //echo $v->en_rayon_id();
        $nom = $managerPr->get($v->produit_id())->nom();
        //echo $nom;

        echo "<tr id=\"" . $v->produit_id() . "\">
                                            <td ><strong class='nom' id='nom" . $v->produit_id() . "'>" . $nom . "</strong></td>
                                            <td class='qteCmd'>
                                            <p></p>
                                                <div class='input-group' style='width: 100px;' >
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins'
                                                        onclick=\"change_input('moins','inputQte" . $v->produit_id() . "')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                        <input type='text' name='quant[1]' class='form-control input-number'
                                               id=\"inputQte" . $v->produit_id() . "\"
                                               value='" . $v->qtiteCmd() . "' style='width: 40px;'>
                                        <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus'
                                                        onclick=\"change_input('plus','inputQte" . $v->produit_id() . "')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                    </div>
                                    <p></p>
                                            </td>
                                            <td class='qteRecu'>
                                            <p></p>
                                                <div class='input-group' style='width: 100px;' >
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins'
                                                        onclick=\"change_input('moins','inputQteRecu" . $v->produit_id() . "')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                        <input type='text' name='quant[1]' class='form-control input-number'
                                               id=\"inputQteRecu" . $v->produit_id() . "\" value='" . $v->qtiteRecu() . "' style='width: 40px;'>
                                        <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus'
                                                        onclick=\"change_input('plus','inputQteRecu" . $v->produit_id() . "')\"
                                                        style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                    </div>
                                    <p></p>
                                            </td>
                                            <td>
                                            <input type='text' name='' class='form-control input-number'
                                               id=\"prixCmd" . $v->produit_id() . "\" value='" . $v->puCmd() . "' style='width: 80px;'>
                                            </td>
                                            <td>
                                                <input type='text' name='' class='form-control input-number'
                                               id=\"prixVente" . $v->produit_id() . "\" value='" . $v->prixPublic() . "' style='width: 80px;'>
                                            </td>
                                            <td>
                                                <input id=\"datePeremption" . $v->produit_id() . "\" name=\"\" type=\"date\" value=\"\" size=\"3\" maxlength=\"3\" class=\"number\" />
                                            </td>
                                        </tr>";
    endforeach;

} else {


    //on verifie qu'il existe deja la vente dans la BD et on verifie aussi si la ligne à enregistrer n'a pas deja été faite
    if ($manager->existsId($idv) && !$managerCo->existsEn_rayonId($idv, $ide)) {
        echo "passe \n";
        //echo $managerPr->getStock($managerEn->get($ide)->produit_id(),$qte)->stock();

        $conc = new Concerner(array(
            'vente_id' => $idv,
            'en_rayon_id' => $ide,
            'produit_id' => null,
            'prixUnit' => $prixu,
            'quantite' => $qte,
            'reduction' => $reduction,
            'supprimer' => 0
        ));
        $managerCo->add($conc);


        $donnees = array('erreur' => 'ok');
        echo json_encode($donnees);
    } else {
        $donnees = array('erreur' => 'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
    }


}


// D'abord, on se connecte ?ySQL


?>