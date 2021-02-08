<?php
require_once('database.php');
require_once('../Class/question_orientation.php');

$id;
$question;
$type;
global $pdo;

$manager = new QuestionOrientationManager($pdo);


if (isset($_POST['id'])&&isset($_POST['question'])&&isset($_POST['type'])){

    $id=$_POST['id'];
    $question=$_POST['question'];
    $type=$_POST['type'];
    //echo $id;
    //$dep = new Departement();
        if(!$manager->exists($question)){
            $dep = $manager->get($question);
            $dep->setQUESTION($question);
            $dep->setTYPE($type);
            $manager->update($dep);
            $donnees = array('erreur' => 'non');
            echo json_encode($donnees);
            //echo "Ce departement existe";
        }
        else{
            $dep = $manager->get($question);
            if($dep->QUESTION_ID() != $id){
                $donnees = array('erreur' => 'Ce question existe déja');
                echo json_encode($donnees);
            }else{
                $dep->setTYPE($type);
                $manager->update($dep);
                $donnees = array( 'erreur' => 'non');
                echo json_encode($donnees);
            }

        }


    //$sql = "UPDATE departement set NOM='".$question."',SIGLE='".$sigle."',DESCRIPTION='".$type."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    if(isset($_POST['question'])&&isset($_POST['type'])) {

        $question = $_POST['question'];
        $type = $_POST['type'];
        if(!$manager->exists($question)) {


            $date = genererID();
            $cat = new QuestionOrientation(array(
                'QUESTION_ID' => $date,
                'QUESTION' => $question,
                'TYPE' => $type,
                'SUPPRIMER' => 0,
            ));
            $manager->add($cat);
            $donnees = array('erreur' => 'non', 'id' => $date);
            echo json_encode($donnees);
        }
        else{
            $donnees = array('erreur' => 'Cette question existe déja');
            echo json_encode($donnees);
        }
    }
}

// D'abord, on se connecte ?ySQL




?>