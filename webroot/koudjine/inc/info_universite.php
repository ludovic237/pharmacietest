<?php
require_once('database.php');
require_once('../Class/universite.php');
require_once('../Class/contact.php');
require_once('../Class/type_universite.php');
require_once('../Class/type.php');

				$id;
				global $pdo;
				global $conndb;
$managerContact = new ContactManager($pdo);
$managerUniversite = new UniversiteManager($pdo);
$managerTU = new TypeUniversiteManager($pdo);
$managerType = new TypeManager($pdo);


//echo "passe";
if (isset($_POST['id'])||isset($_GET['id'])){
                if (isset($_POST['id']))
					$id=$_POST['id'];
                if (isset($_GET['id']))
                    $id=$_GET['id'];


                if($managerUniversite->existsId($id)){
                    $univ = $managerUniversite->get($id);
                    $contact = $managerContact->get($univ->CONTACT_ID());
                    $tu = $managerTU->getList($id);
                    if($univ->NOM_COMPLET() != NULL){
                        $nom = $univ->NOM_COMPLET()." (".$univ->NOM().")";
                    }
                    else $nom = $univ->NOM();

                    if($contact->TELEPHONE_2() != NULL)
                        $phone = $contact->TELEPHONE_1()." / ".$contact->TELEPHONE_2();
                    else $phone = $contact->TELEPHONE_1();
                    $type = '';
                    $type_list = $managerTU->getList($id);
                    //print_r($type_list);
                    foreach ($type_list as $k => $v):
                        $typeUniv = $managerType->get($v->TYPE_ID());
                        if($type != '')
                        $type = $type." - ".$typeUniv->NOM();
                    else $type = $typeUniv->NOM();
                    endforeach;
                }

                //echo "passe";


                $donnees = array('nom' => $nom, 'ville' => $univ->VILLE(), 'region' => $univ->REGION(), 'statut' => $univ->STATUT(), 'responsable' => $univ->RESPONSABLE(), 'type' => $type, 'bp' => $contact->BP(), 'email' => $contact->EMAIL(), 'site' => $contact->SITE(), 'phone' => $phone, 'certif' => $univ->CERTIFICATION());
                if (isset($_POST['id']))
                echo json_encode($donnees);

	}

										
																		// D'abord, on se connecte ?ySQL 
	
	function getStatut(){
        //if($statut == "public")
    }


?>