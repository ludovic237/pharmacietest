<?php
require_once('database.php');
require_once('../Class/departement.php');

				$id;
				$nom;
				$sigle;
				$description;
				global $pdo;

$manager = new DepartementManager($pdo);


			if (isset($_POST['id'])&&isset($_POST['nom'])&&isset($_POST['sigle'])&&isset($_POST['description'])){

					$id=$_POST['id'];
				$nom=$_POST['nom'];
				$sigle=$_POST['sigle'];
				$description=addslashes($_POST['description']);
                //echo $id;
                //$dep = new Departement();
                if ($manager->exists($id)) {
                    $dep = $manager->get($id);
                    //echo "Ce departement existe";
                    if(!$manager->existsDeptUniv($dep->UNIVERSITE_ID(),$nom)){
                        $dep->setNOM($nom);
                        $dep->setSIGLE($sigle);
                        $dep->setDESCRIPTION($description);
                        $manager->update($dep);
                        echo 'ok';
                    }
                    else{
                        $d = $manager->getDeptUniv($dep->UNIVERSITE_ID(),$nom);
                        if($d->DEPARTEMENT_ID() == $id){
                            $dep->setSIGLE($sigle);
                            $dep->setDESCRIPTION($description);
                            $manager->update($dep);
                            echo 'ok';
                        }
                        else{
                            echo 'Cet université a déjà une faculté portant ce nom';
                        }
                    }
                }



                //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
                //$req = $pdo->exec($sql);
	}
else{
    if(isset($_POST['univ_id'])&&isset($_POST['nom'])&&isset($_POST['sigle'])&&isset($_POST['description'])){
        $univ_id = $_POST['univ_id'];
    $nom=$_POST['nom'];
    $sigle=$_POST['sigle'];
    $description=$_POST['description'];}
    if(isset($_POST['dept_id'])){
        // dans ma fonction javascript je ne passe plus $dept_id
        /*$dept_id = $_POST['dept_id'];
        if($manager->exists($dept_id)){
            $dept = $manager->get($dept_id);
            $manager->delete($dept);
        }
        $date = genererID();
        $departement = new Departement(array(
            'DEPARTEMENT_ID' => $date,
            'UNIVERSITE_ID' => $univ_id,
            'NOM' => $nom,
            'DESCRIPTION' => $description,
            'SIGLE' => $sigle,
        ));
        $manager->add($departement);*/
    }else{
        if(!$manager->existsDeptUniv($univ_id,$nom)){
            $date = genererID();
            $departement = new Departement(array(
                'DEPARTEMENT_ID' => $date,
                'UNIVERSITE_ID' => $univ_id,
                'NOM' => $nom,
                'DESCRIPTION' => $description,
                'SIGLE' => $sigle,
            ));
            $manager->add($departement);
            echo 'ok';
        }
        else echo 'Cet université a déjà une faculté portant ce nom';
    }


}
										
																		// D'abord, on se connecte ?ySQL 
	
	


?>