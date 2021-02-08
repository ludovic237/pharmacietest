<?php
require_once('database.php');
require_once('../Class/presentation_universite.php');

$univ_id;
global $pdo;

$manager = new PresentationUniversiteManager($pdo);


if(isset($_POST['univ_id']))
    $univ_id = $_POST['univ_id'];

if($manager->exists($univ_id)){
    $pre = $manager->get($univ_id);
    echo $pre->CONTENU();
}
else{
    echo '';

}





// D'abord, on se connecte ?ySQL




?>