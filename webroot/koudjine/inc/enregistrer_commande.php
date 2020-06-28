<?php
require_once('database.php');
require_once('../Class/commande.php');

global $pdo;


$manager = new  CommandeManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $note=$_POST['note'];
    $fournisseur_id=$_POST['fournisseur_id'];
    $dateLivraison=$_POST['dateLivraison'];
    $dateCreation=$_POST['dateCreation'];
    $qtiteCmd=$_POST['qtiteCmd'];
    $qtiteRecu=$_POST['qtiteRecu'];
    $montantCmd=$_POST['montantCmd'];
    $montantRecu=$_POST['montantRecu'];
    $etat=$_POST['etat'];
    $ref=$_POST['ref'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsId($id)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setmontantRecu($montantRecu);
            $prod->setetat($etat);
            $prod->setref($ref);
            $prod->setnote($note);
            $prod->setfournisseur_id($fournisseur_id);
            $prod->setdateLivraison($dateLivraison);
            $prod->setdateCreation($dateCreation);
            $prod->setqtiteCmd($qtiteCmd);
            $prod->setqtiteRecu($qtiteRecu);
            $prod->setmontantCmd($montantCmd);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setmontantRecu($montantRecu); 
        $prod->setetat($etat);
        $prod->setref($ref);
        $prod->setnote($note);
        $prod->setfournisseur_id($fournisseur_id);
        $prod->setdateLivraison($dateLivraison);
        $prod->setdateCreation($dateCreation);
        $prod->setqtiteCmd($qtiteCmd);
        $prod->setqtiteRecu($qtiteRecu);
        $prod->setmontantCmd($montantCmd);
        $manager->update($prod);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    /*if(isset($_POST['nom'])&&isset($_POST['qtiteCmd'])&&isset($_POST['qtiteRecu'])&&isset($_POST['qtiteCmdmax'])&&isset($_POST['montantCmd'])){
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

    $note=$_POST['note'];
    $fournisseur_id=$_POST['fournisseur_id'];
    $dateLivraison=$_POST['dateLivraison'];
    $dateCreation=$_POST['dateCreation'];
    $qtiteCmd=$_POST['qtiteCmd'];
    $qtiteRecu=$_POST['qtiteRecu'];
    $montantCmd=$_POST['montantCmd'];
    $montantRecu=$_POST['montantRecu'];
    $etat=$_POST['etat'];
    $ref=$_POST['ref'];


    if(!$manager->existsId($id)){
        //$date = genererID();
        //echo $datec;
        $commande = new  Commande(array(
            'montantRecuegorie_id' => $montantRecu,
            'etat' => $etat,
            'ref' => $ref,
            'note' => $note,
            'fournisseur_id' => $fournisseur_id,
            'codedateLivraison' => $dateLivraison,
            'codedateCreation' => $dateCreation,
            'qtiteCmd' => $qtiteCmd,
            'qtiteRecu' => $qtiteRecu,
            'qtiteCmdMax' => $qtiteCmdmax,
            'montantCmdMax' => $montantCmd,
        ));
        $manager->add($commande);
        echo 'ok';
    }
    else echo 'Ce nom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL




?>