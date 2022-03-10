<?php
require_once('database.php');
require_once('../Class/en_rayon.php');

global $pdo;


$manager = new  En_rayonManager($pdo);



if (isset($_POST['id'])){ 

    $id=$_POST['id'];
    $produit_id=$_POST['produit_id'];
    $fournisseur_id=$_POST['fournisseur_id'];
    $dateLivraison=$_POST['dateLivraison'];
    $datePeremption=$_POST['datePeremption'];
    $prixAchat=$_POST['prixAchat'];
    $prixVente=$_POST['prixVente'];
    $reduction=$_POST['reduction'];
    $quantite=$_POST['quantite'];
    $quantiteRestante=$_POST['quantiteRestante'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsId($id)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setquantite($quantite);
            $prod->setquantiteRestante($quantiteRestante);
            $prod->setproduit_id($produit_id);
            $prod->setfournisseur_id($fournisseur_id);
            $prod->setdateLivraison($dateLivraison);
            $prod->setdatePeremption($datePeremption);
            $prod->setprixAchat($prixAchat);
            $prod->setprixVente($prixVente);
            $prod->setreduction($reduction);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setquantite($quantite); 
        $prod->setquantiteRestante($quantiteRestante);
        $prod->setproduit_id($produit_id);
        $prod->setfournisseur_id($fournisseur_id);
        $prod->setdateLivraison($dateLivraison);
        $prod->setdatePeremption($datePeremption);
        $prod->setprixAchat($prixAchat);
        $prod->setprixVente($prixVente);
        $prod->setreduction($reduction);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['nom'])&&isset($_POST['prixAchat'])&&isset($_POST['prixVente'])&&isset($_POST['prixAchatmax'])&&isset($_POST['reduction'])){
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

    $produit_id=$_POST['produit_id'];
    $fournisseur_id=$_POST['fournisseur_id'];
    $dateLivraison=$_POST['dateLivraison'];
    $datePeremption=$_POST['datePeremption'];
    $prixAchat=$_POST['prixAchat'];
    $prixVente=$_POST['prixVente'];
    $reduction=$_POST['reduction'];
    $quantite=$_POST['quantite'];
    $quantiteRestante=$_POST['quantiteRestante'];


    if(!$manager-> existsproduit_id($produit_id)){
        //$date = genererID();
        //echo $datec;
        $en_rayon = new  En_rayon(array(
            'quantiteegorie_id' => $quantite,
            'quantiteRestante_id' => $quantiteRestante,
            'produit_id' => $produit_id,
            'fournisseur_id' => $fournisseur_id,
            'codedateLivraison' => $dateLivraison,
            'codedatePeremption' => $datePeremption,
            'prixAchat' => $prixAchat,
            'prixVente' => $prixVente,
            'prixAchatMax' => $prixAchatmax,
            'reductionMax' => $reduction,
        ));
        $manager->add($en_rayon);
        echo 'ok';
    }
    else echo 'Ce nom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL




?>