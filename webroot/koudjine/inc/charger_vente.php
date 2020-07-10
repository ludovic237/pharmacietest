<?php
require_once('database.php');
require_once('../Class/vente.php');
require_once('../Class/concerner.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new VenteManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerCo = new ConcernerManager($pdo);
$managerPr = new ProduitManager($pdo);

$id=$_POST['id'];



if (isset($_POST['id'])){
    $produits = $managerCo->getList($id);

    foreach ($produits as $k => $v) :
        $nom = $managerPr->get($managerEn->get($v->en_rayon_id())->produit_id())->nom();
        echo "<tr id=\"".$v->en_rayon_id()."\">
                                            <td ><strong class='nom'>".$nom."</strong></td>
                                            <td class='prix'>
                                                ".$v->prixUnit()."
                                            </td>
                                            <td class='qte'>
                                                ".$v->quantite()."
                                            </td>
                                            <td class='prixt'>
                                                ".($v->prixUnit()*$v->quantite())."
                                            </td>
                                            <td class='reduction'>
                                                ".$v->reduction()."
                                            </td>
                                        </tr>";
    endforeach;

}
else{


    //on verifie qu'il existe deja la vente dans la BD et on verifie aussi si la ligne à enregistrer n'a pas deja été faite
    if($manager->existsId($idv) && !$managerCo->existsEn_rayonId($idv, $ide)){
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


        $donnees = array('erreur' =>'ok');
        echo json_encode($donnees);
    }
    else{
        $donnees = array('erreur' =>'Veuillez vérifier vos quantités et d\'autres paramètres liés à la vente !!!');
        echo json_encode($donnees);
    }



}


// D'abord, on se connecte ?ySQL




?>