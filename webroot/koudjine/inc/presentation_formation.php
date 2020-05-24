<?php
require_once('database.php');
require_once('../Class/presentation_filiere.php');


global $pdo;

$manager = new PresentationFiliereManager($pdo);


if(isset($_POST['slug']))
    $slug = $_POST['slug'];


if(isset($_POST['editable'])){
    $contenu = $_POST['editable'];

    if($manager->exists($slug)){
        $present = $manager->get($slug);
        $present->setCONTENU($contenu);
        $manager->update($present);
    }
    else{
        $date = genererID();
        $present = new PresentationFiliere(array(
            'PRESENTATION_ID' => $date,
            'SLUG' => $slug,
            'CONTENU' => $contenu,
        ));
        $manager->add($present);
    }
}
else{
    if($manager->exists($slug)){
        $pre = $manager->get($slug);
        echo $pre->CONTENU();
    }
    else{
        echo '';

    }
}





// D'abord, on se connecte ?ySQL




?>