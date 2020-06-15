<?php
require_once('database.php');
require_once('../Class/fournisseur.php');

global $pdo;


$manager = new FournisseurManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $code=$_POST['code'];
    $nom=$_POST['nom'];
    $CodePostal_id=$_POST['CodePostal_id'];
    $statut=$_POST['statut'];
    $adresse=$_POST['adresse'];
    $telephone=$_POST['telephone'];
    $email=$_POST['email'];
    $supprimer=$_POST['supprimer'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setnom($nom);
            $prod->setcode($code);
            $prod->setCodePostal_id($CodePostal_id);
            $prod->setstatut($statut);
            $prod->setadresse($adresse);
            $prod->settelephone($telephone);
            $prod->setemail($email);
            $prod->setsupprimer($supprimer);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de fournisseur existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setnom($nom);
        $prod->setcode($code);
        $prod->setCodePostal_id($CodePostal_id);
        $prod->setstatut($statut);
        $prod->setadresse($adresse);
        $prod->settelephone($telephone);
        $prod->setemail($email);
        $prod->setsupprimer($supprimer);
        $manager->update($prod);
        echo 'ok';
    }
}
else{

    $code=$_POST['code'];
    $nom=$_POST['nom'];
    $CodePostal_id=$_POST['CodePostal_id'];
    $statut=$_POST['statut'];
    $adresse=$_POST['adresse'];
    $telephone=$_POST['telephone'];
    $email=$_POST['email'];
    $supprimer=$_POST['supprimer'];



    if(!$manager->existsNom($nom)){
        $fournisseur = new Fournisseur(array(
            'nom' => $nom,
            'code' => $code,
            'CodePostal_id' => $CodePostal_id,
            'statut' => $statut,
            'adresse' => $adresse,
            'telephone' => $telephone,
            'email' => $email,
            'supprimer' => $supprimer,
        ));
        $manager->add($fournisseur);
        echo 'ok';
    }
    else echo 'Ce nom de fournisseur existe déjà';



}

?>