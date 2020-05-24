<?php
//define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));
require_once('database.php');
require_once('functions.php');
require_once('../Class/medias.php');

global $pdo;

if(isset($_FILES['image_file']['name'])){
    if(strpos($_FILES['image_file']['type'], 'image')!== false){
        //print_r($_FILES);
        $dir = '../assets/uploads/medias/'.date('Y-m');
        if(!file_exists($dir)) mkdir($dir,0777);
        create_thumbnail($_FILES['image_file'],$dir.'/',$_FILES['image_file']['name'],200,150);
        move_uploaded_file($_FILES['image_file']['tmp_name'],$dir.'/'.$_FILES['image_file']['name']);

        $manager = new MediaManager($pdo);
        $date = genererID();
        //echo $datec;
        $titre = array();
        if($_POST['titre'] == ''){

            $titre = explode('.',$_FILES['image_file']['name']);
        }
        else{
            $titre[0] = $_POST['titre'];
        }
        $media = new Media(array(
            'MEDIA_ID' => $date,
            'NOM' => $titre[0],
            'FILE' => date('Y-m').'/'.$_FILES['image_file']['name'],
            'TYPE' => 'img',
            'RUBRIQUE' => $_POST['rubrique'],
        ));
        $manager->add($media);
    }

    else{
        echo "le fichier n'est pas une image !";
    }

}