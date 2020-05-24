<?php
require_once('database.php');
require_once('../Class/departement.php');

$univ_id;
global $pdo;

$manager = new DepartementManager($pdo);


    if(isset($_POST['univ_id']))
        $univ_id = $_POST['univ_id'];


        $dep = $manager->getList($univ_id);
        if(empty($dep)){
            $dep = $manager->getDeptUniv($univ_id,'GENERAL');
            if(empty($dep)){
                echo 'non';
            }
            else{
                //$donnees = '<option value="">Tout&hellip;</option>';
                $donnees = '<option value="'.$dep->DEPARTEMENT_ID().'">'.'Par Défaut'.'</option>';
                echo $donnees;
            }
    }else{
            //$donnees = '<option value="">Tout&hellip;</option>';
            $donnees = '';
        foreach($dep as $k => $v){
            $donnees .= '<option value="'.$v->DEPARTEMENT_ID().'">'.$v->NOM().'</option>';
        }
            echo $donnees;
    }





// D'abord, on se connecte ?ySQL




?>