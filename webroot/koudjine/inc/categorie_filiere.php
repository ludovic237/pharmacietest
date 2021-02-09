<?php
require_once('database.php');
require_once('../Class/categorie_filiere.php');

$id;
$nom;
$description;
global $pdo;

$manager = new CategorieFiliereManager($pdo);


if (isset($_POST['id'])&&isset($_POST['nom'])&&isset($_POST['description'])){

    $id=$_POST['id'];
    $nom=$_POST['nom'];
    $description=$_POST['description'];
    //echo $id;
    //$dep = new Departement();
    if ($manager->exists($id)) {
        if(!$manager->existsNom($nom)){
            $dep = $manager->get($id);
            $dep->setNOM($nom);
            $dep->setDESCRIPTION($description);
            $dep->setSLUG(genererSlug($nom));
            $manager->update($dep);
            $donnees = array('slug' => genererSlug($nom), 'erreur' => 'non');
            echo json_encode($donnees);
            //echo "Ce departement existe";
        }
        else{
            $dep = $manager->getNom($nom);
            if($dep->CATEGORIE_ID() != $id){
                $donnees = array('erreur' => 'Ce nom existe déja');
                echo json_encode($donnees);
            }else{
                $dep->setDESCRIPTION($description);
                $manager->update($dep);
                $donnees = array('slug' => genererSlug($nom), 'erreur' => 'non');
                echo json_encode($donnees);
            }

        }
    }


    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    if(isset($_POST['nom'])&&isset($_POST['description'])) {

        $nom = $_POST['nom'];
        $description = addslashes($_POST['description']);
        $slug = genererSlug($nom);
        if(!$manager->existsNom($nom)) {


            $date = genererID();
            $cat = new CategorieFiliere(array(
                'CATEGORIE_ID' => $date,
                'NOM' => $nom,
                'DESCRIPTION' => $description,
                'SLUG' => $slug,
                'SUPPRIMER' => 0,
            ));
            $manager->add($cat);
            $donnees = array('slug' => $slug, 'erreur' => 'non', 'id' => $date);
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