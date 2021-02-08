<?php
require_once('database.php');
require_once('../Class/type.php');

$id;
$nom;
$description;
global $pdo;

$manager = new TypeManager($pdo);


if (isset($_POST['id'])&&isset($_POST['nom'])&&isset($_POST['description'])&&isset($_POST['certif'])){

    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $certif=$_POST['certif'];
    $description=$_POST['description'];
    if($certif == null) $certif = 'En attente';
    //echo $id;
    //$dep = new Departement();
    if ($manager->exists($id)) {
        if(!$manager->existsNom($nom)){
        $dep = $manager->get($id);
        $dep->setNOM($nom);
        $dep->setDESCRIPTION($description);
        $dep->setSLUG(genererSlug($nom));
        $dep->setCERTIFICATION($certif);
        $manager->update($dep);
        $donnees = array('slug' => genererSlug($nom), 'certif' => $certif, 'erreur' => 'non');
        echo json_encode($donnees);
        //echo "Ce departement existe";
        }
        else{
            $dep = $manager->getNom($nom);
            if($dep->TYPE_ID() != $id){
                $donnees = array('erreur' => 'Ce nom existe déja');
                echo json_encode($donnees);
            }else{
                $dep->setDESCRIPTION($description);
                $dep->setSLUG(genererSlug($nom));
                $dep->setCERTIFICATION($certif);
                $manager->update($dep);
                $donnees = array('slug' => genererSlug($nom), 'certif' => $certif, 'erreur' => 'non');
                echo json_encode($donnees);
            }

        }
    }


    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    if(isset($_POST['nom'])&&isset($_POST['description'])&&isset($_POST['certif'])) {

        $nom = $_POST['nom'];
        $certif = $_POST['certif'];
        $description = addslashes($_POST['description']);
        $slug = genererSlug($nom);
        if(!$manager->existsNom($nom)) {

            if ($certif == null) $certif = 'En attente';

            $date = genererID();
            $type = new Type(array(
                'TYPE_ID' => $date,
                'NOM' => $nom,
                'DESCRIPTION' => $description,
                'SLUG' => $slug,
                'CERTIFICATION' => $certif,
                'SUPPRIMER' => 0,
            ));
            $manager->add($type);
            $donnees = array('slug' => $slug, 'certif' => $certif, 'erreur' => 'non', 'id' => $date);
            echo json_encode($donnees);
        }
        else{
            $donnees = array('erreur' => 'Ce nom existe déja');
            echo json_encode($donnees);
        }
    }
}

// D'abord, on se connecte ?ySQL




?>