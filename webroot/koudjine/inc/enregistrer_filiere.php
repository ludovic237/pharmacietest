<?php
require_once('database.php');
require_once('../Class/filiere.php');

global $pdo;


$manager = new FiliereManager($pdo);



if (isset($_POST['id'])&&isset($_POST['nom'])&&isset($_POST['sigle'])&&isset($_POST['description'])&&isset($_POST['niveau'])&&isset($_POST['id_fac'])&&isset($_POST['id_cat'])){

    $id=$_POST['id'];
    $id_fac=$_POST['id_fac'];
    $id_cat=$_POST['id_cat'];
    $nom=$_POST['nom'];
    $sigle=$_POST['sigle'];
    $niveau=$_POST['niveau'];
    $description=$_POST['description'];
    //echo $id;
    //$fil = new Departement();
    if ($manager->existsNom($id_fac,$nom)) {
        $fil = $manager->getFiliere($id_fac,$nom);
        //echo "Ce departement existe";
        if($fil->FILIERE_ID() == $id){
            $fil->setNOM($nom);
            $fil->setCATEGORIE_ID($id_cat);
            $fil->setDEPARTEMENT_ID($id_fac);
            $slug = genererSlug($nom);
            $fil->setSLUG($slug);
            $niveau = trim($niveau,';');
            $fil->setNIVEAU_FORMATION($niveau);
            $fil->setSIGLE($sigle);
            $fil->setDESCRIPTION($description);
            $manager->update($fil);
            echo 'ok';
        }
        else{

                echo 'Cette faculté a déjà une filière portant ce nom';

        }
    }
    else{
        $fil = $manager->get($id);
        $fil->setNOM($nom);
        $fil->setCATEGORIE_ID($id_cat);
        $fil->setDEPARTEMENT_ID($id_fac);
        $slug = genererSlug($nom);
        $fil->setSLUG($slug);
        $niveau = trim($niveau,';');
        $fil->setNIVEAU_FORMATION($niveau);
        $fil->setSIGLE($sigle);
        $fil->setDESCRIPTION($description);
        $manager->update($fil);
        echo 'ok';
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    if(isset($_POST['nom'])&&isset($_POST['sigle'])&&isset($_POST['description'])&&isset($_POST['niveau'])&&isset($_POST['id_fac'])&&isset($_POST['id_cat'])){
        $id_fac=$_POST['id_fac'];
        $id_cat=$_POST['id_cat'];
        $nom=$_POST['nom'];
        $sigle=$_POST['sigle'];
        $niveau=$_POST['niveau'];
        $description=$_POST['description'];
        $niveau = trim($niveau,';');
    }


        if(!$manager->existsNom($id_fac,$nom)){
            $date = genererID();
            $filiere = new Filiere(array(
                'FILIERE_ID' => $date,
                'DEPARTEMENT_ID' => $id_fac,
                'CATEGORIE_ID' => $id_cat,
                'NOM' => $nom,
                'DESCRIPTION' => $description,
                'SLUG' => genererSlug($nom),
                //'TYPE_FORMATION' => null,
                'NIVEAU_FORMATION' => $niveau,
                'SIGLE' => $sigle,
            ));
            $manager->add($filiere);
            echo 'ok';
        }
        else echo 'Cette faculté a déjà une filière portant ce nom';



}
    

// D'abord, on se connecte ?ySQL




?>