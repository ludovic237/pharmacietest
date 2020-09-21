<?php
require_once('database.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new ProduitManager($pdo);



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
        $prod = $manager->get($id);
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
    $stock=$_POST['stock'];
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
            'stock' => $stock,
            'etagere' => $etagere,
            'contenuDetail' => $contenu,
            'prixDetail' => $prix,
            'etat' => $etat,
            'stockMin' => $stockmin,
            'stockMax' => $stockmax,
            'reductionMax' => $reduction,
        ));
        $manager->add($produit);
        echo 'ok';
    }
    else echo 'Ce nom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL




?>