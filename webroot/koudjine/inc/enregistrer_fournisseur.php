<?php
require_once('database.php');
require_once('../Class/fournisseur1.php');

global $pdo;


$manager = new FournisseurManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    //$code=$_POST['code'];
    $nom=$_POST['nom'];
    $codepostal=$_POST['codepostal'];
    $statut=$_POST['statut'];
    $adresse=$_POST['adresse'];
    $telephone=$_POST['telephone'];
    $email=$_POST['email'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setnom($nom);
            //$prod->setcode($code);
            $prod->setcodepostal($codepostal);
            $prod->setstatut($statut);
            $prod->setadresse($adresse);
            $prod->settelephone($telephone);
            $prod->setemail($email);
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
        //$prod->setcode($code);
        $prod->setcodepostal($codepostal);
        $prod->setstatut($statut);
        $prod->setadresse($adresse);
        $prod->settelephone($telephone);
        $prod->setemail($email);
        $manager->update($prod);
        echo 'ok';
    }
}
else{


    $code=generercodefournisseur($manager->count());
    $nom=$_POST['nom'];
    $codepostal=$_POST['codepostal'];
    $adresse=$_POST['adresse'];
    $telephone=$_POST['telephone'];
    $email=$_POST['email'];
    $statut=$_POST['statut'];


    if(!$manager->existsNom($nom)){
        $fournisseur = new Fournisseur(array(
            'nom' => $nom,
            'code' => $code,
            'CodePostal_id' => $codepostal,
            'statut' => $statut,
            'adresse' => $adresse,
            'telephone' => $telephone,
            'email' => $email,
        ));
        $manager->add($fournisseur);
        echo 'ok';
    }
    else echo 'Ce nom de fournisseur existe déjà';



}

?>