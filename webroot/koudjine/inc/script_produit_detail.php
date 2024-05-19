<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/produit_detail.php');

global $pdo;


$manager = new Produit_detailManager($pdo);
$managerPr = new ProduitManager($pdo);

$produit_grossiste = $managerPr->getOldListGrossiste();
foreach ($produit_grossiste as $k => $v) :
    //$stock = $stock + ($v->quantiteRestante());

    $nom=$v->nom();
    $reference=$v->reference();
    $stock=$v->stock();
    $stockmin=$v->stockMin();
    $stockmax=$v->stockMax();
    $reduction=$v->reductionMax();
    $prix=0;
    $parrain=$v->grossiste_id();


    if(!$manager->existsNom($nom)){
        //$date = genererID();
        //echo $datec;
        $produit = new Produit_detail(array(
            'grossiste_list' => $parrain,
            'nom' => $nom,
            'reference' => $reference,
            'stock' => $stock,
            'prix' => $prix,
            'stockMin' => $stockmin,
            'stockMax' => $stockmax,
            'reductionMax' => $reduction,
        ));
        $manager->add($produit);
        $prd_det = $manager->getLast();
        //echo $ide;
        if ($parrain != '' || $parrain != null) {
            $grossistes = $parrain;
            $texto = explode('-', $grossistes);

            $i = 0;
            foreach ($texto as $a => $b):
                if(!$managerPr->existsId($b)){
                    $prd = $managerPr->get($b);
                    $prd->setdetail_id($prd_det->id());
                    $managerPr->update($prd);
                }
            endforeach;

        }
        if(!$managerPr->existsId($v->id())){
            $prd1 = $managerPr->get($v->id());
            $prd1->setsupprimer(1);
            $managerPr->update($prd1);
        }


        echo 'ok';
    }
    else{
        $prd1 = $managerPr->getNom($nom);
        $prd1->setsupprimer(1);
        $managerPr->update($prd1);
        echo 'Ce nom de produit existe déjà';

    }

endforeach;





?>