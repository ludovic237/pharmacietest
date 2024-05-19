<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/produit_detail.php');

global $pdo;


$manager = new Produit_detailManager($pdo);
$managerPr = new ProduitManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $reference=$_POST['reference'];
    $stock=$_POST['stock'];
    $stockmin=$_POST['stockmin'];
    $stockmax=$_POST['stockmax'];
    $reduction=$_POST['reduction'];
    $prix=$_POST['prix'];
    $parrain=$_POST['parrain'];
    //print_r($parrain);
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->getNom($nom);
        /*if($prod->grossiste_id() != null || $prod->grossiste_id() != ""){
            if($prod->reference() != "" && mb_substr($prod->reference(), 0, 1) != "D"){
                $lastprdtdetail = $manager->getLastReferenceDetail();
                $reference1 = substr($lastprdtdetail->reference(), 1);
                $num_reference = (int) $reference1;
                $reference2 = str_pad($num_reference, 3, '0', STR_PAD_LEFT);
                $reference="D".$reference2;
            }elseif ($prod->reference() == "" || $prod->reference() == null){
                $lastprdtdetail = $manager->getLastReferenceDetail();
                $reference1 = substr($lastprdtdetail->reference(), 1);
                $num_reference = (int) $reference1;
                $reference2 = str_pad($num_reference, 3, '0', STR_PAD_LEFT);
                $reference="D".$reference2;
            }
        }*/
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setnom($nom);
            $prod->setreference($reference);
            $prod->setstock($stock);
            $prod->setstockMin($stockmin);
            $prod->setstockMax($stockmax);
            $prod->setreductionMax($reduction);
            $prod->setprix($prix);
            // on verifie que les grossistes ont change avant de mettre a jour
            if ($parrain != $prod->grossiste_list()) {
                $prod->setgrossiste_list($parrain);
                $grossistes = $parrain;
                $listGrossiste = $managerPr->getListGrossiste($id);
                // on reset l'ancienne list to null
                foreach ($listGrossiste as $k => $v) :
                    $v->setdetail_id(null);
                    $managerPr->update($v);
                endforeach;
                // on met a jour nla nouvelle liste
                $texto = explode('-', $grossistes);
                foreach ($texto as $k => $v):
                    $prd = $managerPr->get($v);
                    $prd->setdetail_id($id);
                    $managerPr->update($prd);
                endforeach;

            }
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        /*if($prod->grossiste_id() != null || $prod->grossiste_id() != ""){
            if($prod->reference() != "" && mb_substr($prod->reference(), 0, 1) != "D"){
                $lastprdtdetail = $manager->getLastReferenceDetail();
                $reference1 = substr($lastprdtdetail->reference(), 1);
                $num_reference = (int) $reference1;
                $reference2 = str_pad($num_reference, 3, '0', STR_PAD_LEFT);
                $reference="D".$reference2;
            }elseif ($prod->reference() == "" || $prod->reference() == null){
                $lastprdtdetail = $manager->getLastReferenceDetail();
                $reference1 = substr($lastprdtdetail->reference(), 1);
                $num_reference = (int) $reference1;
                $reference2 = str_pad($num_reference, 3, '0', STR_PAD_LEFT);
                $reference="D".$reference2;
            }
        }*/
        $prod->setnom($nom);
        $prod->setreference($reference);
        $prod->setstock($stock);
        $prod->setstockMin($stockmin);
        $prod->setstockMax($stockmax);
        $prod->setreductionMax($reduction);
        $prod->setprix($prix);
        // on verifie que les grossistes ont change avant de mettre a jour
        if ($parrain != $prod->grossiste_list()) {
            echo 'pass';
            $prod->setgrossiste_list($parrain);
            $grossistes = $parrain;
            $listGrossiste = $managerPr->getListGrossiste($id);
            // on reset l'ancienne list to null
            foreach ($listGrossiste as $k => $v) :
                $v->setdetail_id(null);
                $managerPr->update($v);
            endforeach;
            // on met a jour nla nouvelle liste
            $texto = explode('-', $grossistes);
            foreach ($texto as $k => $v):
                $prd = $managerPr->get($v);
                $prd->setdetail_id($id);
                $managerPr->update($prd);
            endforeach;

        }
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['nom'])&&isset($_POST['stock'])&&isset($_POST['stockmin'])&&isset($_POST['stockmax'])&&isset($_POST['reduction'])){
        $id_univ=$_POST['univid'];
        if($_POST['dated'] != null){
            $dated = DateTime::createFromFormat('d-m-Y', $_POST['dated']);
            $dated = $dated->format('Y-m-d');}
        else $dated = null;
        if($_POST['datef'] != null){
            $datef = DateTime::createFromFormat('d-m-Y', $_POST['datef']);
            $datef = $datef->format('Y-m-d');}
        else $datef = null;
        if($_POST['datec'] != null){
            $datec = DateTime::createFromFormat('d-m-Y', $_POST['datec']);
            $datec = $datec->format('Y-m-d');}
        else $datec = null;
        $description=$_POST['description'];
        $modalite=$_POST['modalite'];
        $composition=$_POST['composition'];
        $composition = trim($composition,';');
        //echo $datec;
    }*/


    $nom=$_POST['nom'];
    $reference=$_POST['reference'];
    $stock=$_POST['stock'];
    $stockmin=$_POST['stockmin'];
    $stockmax=$_POST['stockmax'];
    $reduction=$_POST['reduction'];
    $prix=$_POST['prix'];
    $parrain=$_POST['parrain'];

    /*if($parrain != null || $parrain != ""){
        $lastprdtdetail = $manager->getLastReferenceDetail();
        $reference1 = substr($lastprdtdetail->reference(), 1);
        $num_reference = (int) $reference1;
        $reference2 = str_pad($num_reference, 3, '0', STR_PAD_LEFT);
        $reference="d".$reference2;
    }*/

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
            foreach ($texto as $k => $v):
                $prd = $managerPr->get($v);
                $prd->setdetail_id($prd_det->id());
                $managerPr->update($prd);
            endforeach;

        }

        echo 'ok';
    }
    else echo 'Ce nom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL




?>