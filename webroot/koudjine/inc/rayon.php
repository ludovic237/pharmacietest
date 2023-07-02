<?php
require_once('database.php');
require_once('../Class/rayon.php');
require_once('../Class/produit.php');
require_once('../Class/categorie.php');
require_once('../Class/forme.php');
require_once('../Class/fabriquant.php');
require_once('../Class/magasin.php');
require_once('../Class/fournisseur1.php');
require_once('../Class/en_rayon.php');

$id;
$nom;
$code;
global $pdo;

$manager = new RayonManager($pdo);
$managerProduit = new ProduitManager($pdo);
$managerCategorie = new CategorieManager($pdo);
$managerFabriquant = new FabriquantManager($pdo);
$managerForme = new FormeManager($pdo);
$managerMagasin = new MagasinManager($pdo);
$managerEn = new En_rayonManager($pdo);

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
} elseif (isset($_POST['id']) && isset($_POST['code'])) {

    $id = $_POST['id'];
    $code = $_POST['code'];
    if ($managerEn->existsproduit_id($id)) {
        echo 'Ce produit est deja en rayon';
    }
    else{

        $en_rayon = new En_rayon(array(
            'id' => $code,
            'produit_id' => $id,
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

} else {
    if (isset($_POST['nom']) && isset($_POST['code'])) {

        $nom = $_POST['nom'];
        $code = $_POST['code'];
        if (!$manager->existsNom($nom)) {
            $rayon = new Rayon(array(
                'nom' => $nom,
                'code' => $code,
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
