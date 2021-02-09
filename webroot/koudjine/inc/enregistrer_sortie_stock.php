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
$qte=$_POST['qte'];
$detail_id=$_POST['detail_id'];
$contenu=$_POST['contenu'];
echo $id."\n".$qte."\n".$contenu."\n".$detail_id;


        $conc = new SortieStock(array(
            'en_rayon_id' => $id,
            'quantite' => $qte,
            'detail_id' => $detail_id,
        ));
        $manager->add($conc);

        $ent = $managerEn->get($id);
        $ent->setquantiteRestante(($ent->quantiteRestante()-$qte));
        $managerEn->update($ent);
        $prod = $managerPr->get($ent->produit_id());
        $prod->setstock(($prod->stock()-$qte));
        $managerPr->update($prod);
        if($detail_id !='' && $detail_id != null){
            $ent1 = $managerEn->get($detail_id);
            //$pro = $managerPr->get($ent->produit_id());

            $ent1->setquantiteRestante(($ent1->quantiteRestante()+ ($qte * $contenu)));
            $managerEn->update($ent1);
        }


        $donnees = array('erreur' =>'ok');
        echo json_encode($donnees);







// D'abord, on se connecte ?ySQL




?>