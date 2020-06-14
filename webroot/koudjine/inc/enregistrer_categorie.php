<?php
require_once('database.php');
require_once('../Class/categorie.php');

global $pdo;


$manager = new CategorieManager($pdo);



if (isset($_POST['id'])){

    $id=$_POST['id'];
    $nom=$_POST['nom'];
    //echo $id;
    //$prod = new Departement();
    if ($manager->existsNom($nom)) {
        $prod = $manager->get($id);
        //echo "Ce departement existe";
        if($prod->id() == $id){
            $prod->setnom($nom);
            $manager->update($prod);
            echo 'ok';
        }
        else{

            echo 'Ce nom de produit existe déjà';

        }
    }
    else{
        $prod = $manager->get($id);
        $prod->setnom($nom);
        $manager->update($prod);
        echo 'ok';
    }
}
else{
    
    $nom=$_POST['nom'];



    if(!$manager->existsNom($nom)){
        //$date = genererID();
        //echo $datec;
        $categorie = new Categorie(array(
            'nom' => $nom,
        ));
        $manager->add($categorie);
        echo 'ok';
    }
    else echo 'Ce nom de produit existe déjà';



}


// D'abord, on se connecte ?ySQL




?>