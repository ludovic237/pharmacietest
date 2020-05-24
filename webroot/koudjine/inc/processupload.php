<?php
//define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));
require_once('database.php');
require_once('functions.php');
require_once('../Class/presentation_universite.php');

global $pdo;

$manager = new PresentationUniversiteManager($pdo);
############ Configuration ##############
$width 		            = 200; //Thumbnails will be cropped to 200 pixels in width
$height 		        = 200; //Thumbnails will be cropped to 200 pixels in height
$max_image_size 		= 00; //Maximum image size (height and width)
$thumb_prefix			= "thumb_"; //Normal thumb Prefix
$destination_folder1	= '../assets/uploads/universites/logo/'; //upload directory ends with / (slash)
$destination_folder2	= '../assets/uploads/universites/presentation/'; //upload directory ends with / (slash)
$jpeg_quality 			= 90; //jpeg quality
##########################################

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    //echo $_POST['presentation']."\n";
    if(isset($_POST['editable'])){
        $contenu = $_POST['editable'];
        $id = $_POST['id'];
        if($contenu == '' || $contenu == 'vide'){

        }
        else{
            // mise a jour du contenu de la presentation de l'université
            if($manager->exists($id)){
                $present = $manager->get($id);
                $present->setCONTENU($contenu);
                $manager->update($present);
            }
            else{
                $date = genererID();
                $present = new PresentationUniversite(array(
                    'PRESENTATION_ID' => $date,
                    'UNIVERSITE_ID' => $id,
                    'CONTENU' => $contenu,
                    'IMAGE' => null,
                ));
                $manager->add($present);
            }
        }
    }
    //die();

	// check $_FILES['ImageFile'] not empty

    if(isset($_FILES['logo'])) {
        if (!is_uploaded_file($_FILES['logo']['tmp_name'])) {
            die('Image file is Missing!'); // output error when above checks fail.
        }else{
            if(upload_image($_FILES['logo'],$destination_folder1,$thumb_prefix,$_POST['id'],1000,200,200,$jpeg_quality)){
                echo 'passe';
            }
            /*if(create_thumbnail($_FILES['logo'],$destination_folder1,$_POST['id'],200,200)){
                echo 'passe';
            }*/
        }

    }
    if(isset($_FILES['img_presentation'])) {
        if (!is_uploaded_file($_FILES['img_presentation']['tmp_name'])) {
            die('Image file is Missing!'); // output error when above checks fail.
        }
        else{
            /*if(upload_image($_FILES['img_presentation'],$destination_folder2,$thumb_prefix,$_POST['id'],1000,800,300,$jpeg_quality)){
                echo 'passe';
            }*/
            if(create_thumbnail($_FILES['img_presentation'],$destination_folder2,$_POST['id'],800,300)){
                echo 'passe';
            }
        }
    }




}

