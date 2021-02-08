<?php
require_once('database.php');
require_once('../Class/question_categorie.php');

$id;
$nom;
$description;
global $pdo;

$manager = new QuestionCategorieManager($pdo);


if (isset($_POST['id'])&&isset($_POST['id_cats'])&&isset($_POST['taux'])){

    $id =$_POST['id'];
    $id_cats =$_POST['id_cats'];
    $taux =$_POST['taux'];
    //echo $id;
    //$dep = new Departement();

        if($manager->exists($id)){

            $manager->delete($id);
            $id_cats = trim($id_cats,';');
            $taux = trim($taux,';');
            $tau = explode(';',$taux);
            $id_cat = explode(';',$id_cats);

            foreach($id_cat as $k => $v){
                $question = new QuestionCategorie(array(
                    'QUESTION_ID' => $id,
                    'CATEGORIE_ID' => $v,
                    'TAUX' => $tau[$k],
                ));
                $manager->add($question);
            }
            echo "ok";
        }
        else{

            $id_cats = trim($id_cats,';');
            $taux = trim($taux,';');
            $tau = explode(';',$taux);
            $id_cat = explode(';',$id_cats);

            foreach($id_cat as $k => $v){
                $question = new QuestionCategorie(array(
                    'QUESTION_ID' => $id,
                    'CATEGORIE_ID' => $v,
                    'TAUX' => $tau[$k],
                ));
                $manager->add($question);
            }
            echo "ok";

        }


    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}

// D'abord, on se connecte ?ySQL




?>