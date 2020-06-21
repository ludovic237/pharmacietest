<?php
require_once('database.php');
require_once('../Class/unite.php');

$id;
$nom;
$libelle;
global $pdo;

$manager = new UniteManager($pdo);


if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['libelle'])) {

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $libelle = $_POST['libelle'];
    if ($manager->exists($id)) {

        if (!$manager->existsNom($nom)) {
            $dep = $manager->get($id);
            $dep->setnom($nom);
            $dep->setlibelle($libelle);
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
                $dep->setlibelle($libelle);
                $manager->update($dep);
                $donnees = array('erreur' => 'non');
                echo json_encode($donnees);
            }
        }
    }


    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',libelle='".$libelle."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
} else {
    if (isset($_POST['nom']) && isset($_POST['libelle'])) {

        $nom = $_POST['nom'];
        $libelle = $_POST['libelle'];
        if (!$manager->existsNom($nom)) {
            $rayon = new Unite(array(
                'nom' => $nom,
                'libelle' => $libelle,
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
