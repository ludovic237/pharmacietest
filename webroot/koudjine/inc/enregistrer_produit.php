<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');

global $pdo;


$manager = new ProduitManager($pdo);
$managerEn = new En_rayonManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $ean13=$_POST['ean13'];
    $nom=$_POST['nom'];
    $reference=$_POST['reference'];
    $laborex=$_POST['laborex'];
    $ubipharm=$_POST['ubipharm'];
    $stock=$_POST['stock'];
    $etagere=$_POST['etagere'];
    $stockmin=$_POST['stockmin'];
    $stockmax=$_POST['stockmax'];
    $reduction=$_POST['reduction'];
    $etat=$_POST['etat'];
    $etagere=$_POST['etagere'];
    $contenu=$_POST['contenu'];
    $prix=$_POST['prix'];
    $cat=$_POST['cat'];
    $forme=$_POST['forme'];
    $ray=$_POST['ray'];
    $fab=$_POST['fab'];
    $parrain=$_POST['parrain'];
    $mag=$_POST['mag'];
    //print_r($parrain);
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->getNom($nom);
        if($prod->grossiste_id() != null || $prod->grossiste_id() != ""){
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
        }
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setcategorie_id($cat);
            $prod->setforme_id($forme);
            $prod->setrayon_id($ray);
            $prod->setfabriquant_id($fab);
            $prod->setmagasin_id($mag);
            $prod->setnom($nom);
            $prod->setean13($ean13);
            $prod->setreference($reference);
            $prod->setcodeLaborex($laborex);
            $prod->setcodeUbipharm($ubipharm);
            $prod->setstock($stock);
            $prod->setetagere($etagere);
            $prod->setstockMin($stockmin);
            $prod->setstockMax($stockmax);
            $prod->setreductionMax($reduction);
            $prod->setetat($etat);
            $prod->setetagere($etagere);
            $prod->setcontenuDetail($contenu);
            $prod->setprixDetail($prix);
            $prod->setgrossiste_id($parrain);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        if($prod->grossiste_id() != null || $prod->grossiste_id() != ""){
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
        }
        $prod->setcategorie_id($cat); 
        $prod->setforme_id($forme);
        $prod->setrayon_id($ray);
        $prod->setfabriquant_id($fab);
        $prod->setmagasin_id($mag);
        $prod->setnom($nom);
        $prod->setean13($ean13);
        $prod->setreference($reference);
        $prod->setcodeLaborex($laborex);
        $prod->setcodeUbipharm($ubipharm);
        $prod->setstock($stock);
        $prod->setetagere($etagere);
        $prod->setstockMin($stockmin);
        $prod->setstockMax($stockmax);
        $prod->setreductionMax($reduction);
        $prod->setetat($etat);
        $prod->setetagere($etagere);
        $prod->setcontenuDetail($contenu);
        $prod->setprixDetail($prix);
        $prod->setgrossiste_id($parrain);
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

    $ean13=$_POST['ean13'];
    $nom=$_POST['nom'];
    $reference=$_POST['reference'];
    $laborex=$_POST['laborex'];
    $ubipharm=$_POST['ubipharm'];
    //$stock=$_POST['stock'];
    $etagere=$_POST['etagere'];
    $stockmin=$_POST['stockmin'];
    $stockmax=$_POST['stockmax'];
    $reduction=$_POST['reduction'];
    $cat=$_POST['cat'];
    $forme=$_POST['forme'];
    $ray=$_POST['ray'];
    $fab=$_POST['fab'];
    $mag=$_POST['mag'];
    $etat=$_POST['etat'];
    $etagere=$_POST['etagere'];
    $contenu=$_POST['contenu'];
    $prix=$_POST['prix'];
    $parrain=$_POST['parrain'];

    if($parrain != null || $parrain != ""){
            $lastprdtdetail = $manager->getLastReferenceDetail();
            $reference1 = substr($lastprdtdetail->reference(), 1);
            $num_reference = (int) $reference1;
            $reference2 = str_pad($num_reference, 3, '0', STR_PAD_LEFT);
            $reference="D".$reference2;
    }

    if(!$manager->existsNom($nom)){
        //$date = genererID();
        //echo $datec;
        $produit = new Produit(array(
            'categorie_id' => $cat,
            'forme_id' => $forme,
            'rayon_id' => $ray,
            'fabriquant_id' => $fab,
            'magasin_id' => $mag,
            'grossiste_id' => $parrain,
            'nom' => $nom,
            'ean13' => $ean13,
            'reference' => $reference,
            'codeLaborex' => $laborex,
            'codeUbipharm' => $ubipharm,
            'stock' => 0,
            'etagere' => $etagere,
            'contenuDetail' => $contenu,
            'prixDetail' => $prix,
            'etat' => $etat,
            'stockMin' => $stockmin,
            'stockMax' => $stockmax,
            'reductionMax' => $reduction,
        ));
        $manager->add($produit);
        $prd = $manager->getLast();
        $Date_Du_Jour = date("Ymd");
        $ide = $prd->id().'00'.$Date_Du_Jour;
        //echo $ide;
        $en_rayon = new En_rayon(array(
            'id' => $ide,
            'produit_id' => $prd->id(),
            'fournisseur_id' => null,
            'commande_id' => null,
            'prixAchat' => 0,
            'prixVente' => 0,
            'quantite' => 0,
            'quantiteRestante' => 0,
            'datePeremption' => null,
        ));
        $managerEn->add($en_rayon);
        echo 'ok';
    }
    else echo 'Ce nom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL




?>