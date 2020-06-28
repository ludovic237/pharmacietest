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

$idv=$_POST['idv'];
$ide=$_POST['ide'];
$qte=$_POST['qte'];
$reduction=$_POST['reduction'];
$prixu=$_POST['prixu'];



if (isset($_POST['id'])){



}
else{


    //echo $qte;
    if($manager->existsId($idv) && !$managerCo->existsEn_rayonId($idv, $ide)){
        echo "passe \n";
        //echo $managerPr->getStock($managerEn->get($ide)->produit_id(),$qte)->stock();

        if($managerPr->getStock($managerEn->get($ide)->produit_id(),$qte)->stock() >= $qte){
            echo "repasse";
            $produits = array();
            $produits = $managerEn->getList($managerEn->get($ide)->produit_id());
            foreach ($produits as $k => $v) :
                if($qte > $v->quantiteRestante()){
                    $conc = new Concerner(array(
                        'vente_id' => $idv,
                        'en_rayon_id' => $v->id(),
                        'produit_id' => null,
                        'prixUnit' => $prixu,
                        'quantite' => $v->quantiteRestante(),
                        'reduction' => $reduction,
                        'supprimer' => 0
                    ));
                    $managerCo->add($conc);
                    $qte = $qte - $v->quantiteRestante();
                    echo $qte;
                }
                else{
                    $conc = new Concerner(array(
                        'vente_id' => $idv,
                        'en_rayon_id' => $v->id(),
                        'produit_id' => null,
                        'prixUnit' => $prixu,
                        'quantite' => $qte,
                        'reduction' => $reduction,
                        'supprimer' => 0
                    ));
                    $managerCo->add($conc);
                    echo $qte;
                    break;
                }
            endforeach;
        }

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