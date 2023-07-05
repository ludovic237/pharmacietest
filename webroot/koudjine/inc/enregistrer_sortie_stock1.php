<?php
require_once('database.php');
require_once('../Class/sortie_sortie.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new SortieStockManager($pdo);
$managerEn = new En_rayonManager($pdo);
$managerPr = new ProduitManager($pdo);

//$ide = substr($_POST['ide'], 1);
$id=$_POST['id'];
$detail_id=$_POST['detail_id'];

if($detail_id !='' && $detail_id != null){
    if($managerEn->existsId($id) ){
        $ent = $managerEn->get($id);
        $ent1 = $managerEn->get($detail_id);
        $prod = $managerPr->get($ent->produit_id());
        $prod_det = $managerPr->get($ent1->produit_id());
        $string_id = strval($ent->produit_id());
        if(strpos($prod_det->grossiste_id(), $string_id) !== false && $ent->quantiteRestante() > 0){
            $conc = new SortieStock(array(
                'en_rayon_id' => $id,
                'quantite' => 1,
                'detail_id' => $detail_id,
                'type_sortie_id' => 1,
            ));
            $manager->add($conc);

            $ent->setquantiteRestante(($ent->quantiteRestante()-1));
            $managerEn->update($ent);
            $prod->setstock(($prod->stock()-1));
            $managerPr->update($prod);

            $contenu = $prod->contenuDetail();
            $ent1->setquantiteRestante(($ent1->quantiteRestante()+ ($contenu)));
            $managerEn->update($ent1);
            $prod1 = $managerPr->get($ent1->produit_id());
            $prod1->setstock(($prod1->stock()+($contenu)));
            $managerPr->update($prod1);

            $donnees = array('erreur' =>'ok', 'qte' => $contenu);
            echo json_encode($donnees);
        }
        else{
            if($ent->quantiteRestante() <= 0){
                $donnees = array('erreur' =>" la quantite en stock est nulle");
                echo json_encode($donnees);
            }else{
                $donnees = array('erreur' =>"Ce produit n'est pas defini comme grossiste de l'autre");
                echo json_encode($donnees);
            }

        }
    }else{
        $donnees = array('erreur' =>'Veuillez verifier le code parent!!!');
        echo json_encode($donnees);
    }
}















// D'abord, on se connecte ?ySQL




?>