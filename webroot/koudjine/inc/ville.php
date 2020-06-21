<?php
require_once('database.php');
require_once('../Class/ville.php');

$id;
$nom;
$code;
global $pdo;

$manager = new VilleManager($pdo);


if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['code'])) {

    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $code = $_POST['code'];
    if ($manager->exists($id)) {

        if (!$manager->existsNom($nom)) {
            $dep = $manager->get($id);
            $dep->setnom($nom);
            $dep->setcode($code);
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
                $dep->setcode($code);
                $manager->update($dep);
                $donnees = array('erreur' => 'non');
                echo json_encode($donnees);
            }
        }
    }


    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',code='".$code."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
} else {
    if (isset($_POST['nom']) && isset($_POST['code'])) {

        $nom = $_POST['nom'];
        $code = $_POST['code'];
        if (!$manager->existsNom($nom)) {
            $ville = new Ville(array(
                'nom' => $nom,
                'code' => $code,
                'supprimer' => 0,
            ));
            $manager->add($ville);
            $donnees = array('erreur' => 'non');
            echo json_encode($donnees);
        } else {
            $donnees = array('erreur' => 'Ce nom existe déja');
            echo json_encode($donnees);
        }
    }
}

// D'abord, on se connecte ?ySQL
