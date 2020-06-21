<?php
require_once('database.php');
require_once('../Class/categorie.php');

$id;
$nom;
global $pdo;

$manager = new CategorieManager($pdo);


if (isset($_POST['id']) && isset($_POST['nom'])) {

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $code = $_POST['code'];
    if ($manager->exists($id)) {

        if (!$manager->existsNom($nom)) {
            $dep = $manager->get($id);
            $dep->setnom($nom);
            $manager->update($dep);
            $donnees = array('erreur' => 'non');
            echo json_encode($donnees);
            //echo "Ce departement existe";
        } else {
            $dep = $manager->getNom($nom);
            if ($dep->id() != $id) {
                $donnees = array('erreur' => 'Ce nom existe déja');
                echo json_encode($donnees);
            } else {
                $manager->update($dep);
                $donnees = array('erreur' => 'non');
                echo json_encode($donnees);
            }
        }
    }


    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',code='".$code."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
} else {
    if (isset($_POST['nom'])) {

        $nom = $_POST['nom'];
        $code = $_POST['code'];
        if (!$manager->existsNom($nom)) {
            $rayon = new Categorie(array(
                'nom' => $nom,
                'supprimer' => 0,
            ));
            $manager->add($rayon);
            $donnees = array('erreur' => 'non');
            echo json_encode($donnees);
        } else {
            $donnees = array('erreur' => 'Ce nom existe déja');
            echo json_encode($donnees);
        }
    }
}

// D'abord, on se connecte ?ySQL
