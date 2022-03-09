<?php
require_once('database.php');
require_once('../Class/universite.php');
require_once('../Class/contact.php');
require_once('../Class/type_universite.php');
require_once('../Class/departement.php');

global $pdo;

$managerContact = new ContactManager($pdo);
$managerUniversite = new UniversiteManager($pdo);
$managerTU = new TypeUniversiteManager($pdo);
$managerDept = new DepartementManager($pdo);

if (isset($_POST['nom'])&&isset($_POST['nom_complet'])&&isset($_POST['ville'])&&isset($_POST['region'])
&&isset($_POST['statut'])&&isset($_POST['type'])&&isset($_POST['responsable'])
&&isset($_POST['bp'])&&isset($_POST['certif'])&&isset($_POST['email'])&&isset($_POST['site'])&&isset($_POST['telephone_1'])&&isset($_POST['telephone_2'])&&isset($_POST['option'])){
    //echo "passe";
    extract($_POST);
}


if ($option == "Ajouter"){
    if(!$managerUniversite->existsNom($nom)) {
        if (!$managerContact->existsEmail($email)) {
            // Enregistrement de la fiche de contact
            $contactid = genererID();
            $contact = new Contact(array(
                'CONTACT_ID' => $contactid,
                'BP' => $bp,
                'TELEPHONE_1' => $telephone_1,
                'TELEPHONE_2' => $telephone_2,
                'EMAIL' => $email,
                'SITE' => $site,
            ));
            $managerContact->add($contact);

            // Enregistrement de l'universite
            $univid = genererID();
            $univ = new Universite(array(
                'UNIVERSITE_ID' => $univid,
                'PERSONNE_ID' => 1,
                'CONTACT_ID' => $contactid,
                'NOM' => $nom,
                'NOM_COMPLET' => (empty($nom_complet)) ? null : $nom_complet,
                'VILLE' => $ville,
                'REGION' => $region,
                'STATUT' => $statut,
                'RESPONSABLE' => (empty($responsable)) ? null : $responsable,
                'LOGO' => null,
                'PARRAIN_ID' => (empty($parrain)) ? null : $parrain,
                'CERTIFICATION' => $certif,
            ));
            $managerUniversite->add($univ);
            // Création du département par défaut
            $departementid = genererID();
            $departement = new Departement(array(
                'DEPARTEMENT_ID' => $departementid,
                'UNIVERSITE_ID' => $univid,
                'NOM' => 'GENERAL',
                'DESCRIPTION' => 'l\'option général rassemble toutes les filières dont le département constitue directement la filière',
                'SIGLE' => null,
            ));
            $managerDept->add($departement);
            // Enregistrement du type
            foreach ($type as $key => $value) {
                $tu = new TypeUniversite(array(
                    'TYPE_ID' => $value,
                    'UNIVERSITE_ID' => $univid,
                ));
                $managerTU->add($tu);
            }
            $donnees = array( 'erreur' => 'non','id' => $univid);
            echo json_encode($donnees);
        } else{
            $donnees = array('erreur' => 'Cet email existe déjà');
            echo json_encode($donnees);
        }
    }

    else{
        $donnees = array('erreur' => 'Ce nom existe deja');
        echo json_encode($donnees);
    }



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    if(isset($_POST['id']))
        $id = $_POST['id'];
    if ($managerUniversite->existsId($id)) {
        //echo $nom;
        $univ = $managerUniversite->get($id);
        $contact = $managerContact->get($univ->CONTACT_ID());
        $tu = $managerTU->getList($id);
        $nbre_tu = $managerTU->count($id);
        //echo "Ce departement existe";
    }
    if ($univ->NOM() == $nom) {
        if ($contact->EMAIL() == $email) {
            // Update universite
            //echo "pas";
            $univ->setNOM($nom);
            $univ->setNOM_COMPLET((empty($nom_complet)) ? null : $nom_complet);
            $univ->setVILLE($ville);
            $univ->setREGION($region);
            $univ->setRESPONSABLE((empty($responsable)) ? null : $responsable);
            $univ->setSTATUT($statut);
            $univ->setCERTIFICATION($certif);
            $univ->setPARRAIN_ID((empty($parrain)) ? null : $parrain);
            $managerUniversite->update($univ);
            // Update contact
            $contact->setBP((empty($bp)) ? null : $bp);
            $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
            $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
            $contact->setEMAIL((empty($email)) ? null : $email);
            $contact->setSITE((empty($site)) ? null : $site);
            $managerContact->update($contact);

            // Mis à jour du Type d'université
            $i=0;
            $type_bd =array();
            //echo $nbre_tu;
            foreach ($tu as $key => $value)
            {
                $type_bd[$i] = $value->TYPE_ID();
                $i++;
            }
            //echo "\n";
            //print_r($type) ;
            if($type != $type_bd){
                foreach ($tu as $key => $value)
                {
                    $managerTU->delete($value) ;
                }
                foreach ($type as $key => $value) {
                    $tu = new TypeUniversite(array(
                        'TYPE_ID' => $value,
                        'UNIVERSITE_ID' => $id,
                    ));
                    $managerTU->add($tu);
                }
            } //else
            $donnees = array('erreur' => 'non');
            echo json_encode($donnees);
        }
        elseif(!$managerContact->existsEmail($email)){
            // Update universite
            $univ->setNOM($nom);
            $univ->setNOM_COMPLET((empty($nom_complet)) ? null : $nom_complet);
            $univ->setVILLE($ville);
            $univ->setREGION($region);
            $univ->setRESPONSABLE((empty($responsable)) ? null : $responsable);
            $univ->setSTATUT($statut);
            $univ->setCERTIFICATION($certif);
            $univ->setPARRAIN_ID((empty($parrain)) ? null : $parrain);
            $managerUniversite->update($univ);
            // Update contact
            $contact->setBP((empty($bp)) ? null : $bp);
            $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
            $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
            $contact->setEMAIL((empty($email)) ? null : $email);
            $contact->setSITE((empty($site)) ? null : $site);
            $managerContact->update($contact);

            // Mis à jour du Type d'université
            $i=0;
            $type_bd =array();
            //echo $nbre_tu;
            foreach ($tu as $key => $value)
            {
                $type_bd[$i] = $value->TYPE_ID();
                $i++;
            }
            //echo "\n";
            //print_r($type) ;
            if($type != $type_bd){
                foreach ($tu as $key => $value)
                {
                    $managerTU->delete($value) ;
                }
                foreach ($type as $key => $value) {
                    $tu = new TypeUniversite(array(
                        'TYPE_ID' => $value,
                        'UNIVERSITE_ID' => $id,
                    ));
                    $managerTU->add($tu);
                }
            } //else
            $donnees = array('erreur' => 'non');
            echo json_encode($donnees);
        }
        else {
            $donnees = array('erreur' => 'Cet email existe déjà');
            echo json_encode($donnees);
        }
    }
    elseif(!$managerUniversite->existsNom($nom)){
        // Update universite
        $univ->setNOM($nom);
        $univ->setNOM_COMPLET((empty($nom_complet)) ? null : $nom_complet);
        $univ->setVILLE($ville);
        $univ->setREGION($region);
        $univ->setCERTIFICATION($certif);
        $univ->setRESPONSABLE((empty($responsable)) ? null : $responsable);
        $univ->setSTATUT($statut);
        $univ->setPARRAIN_ID((empty($parrain)) ? null : $parrain);
        $managerUniversite->update($univ);
        // Update contact
        $contact->setBP((empty($bp)) ? null : $bp);
        $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
        $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
        $contact->setEMAIL((empty($email)) ? null : $email);
        $contact->setSITE((empty($site)) ? null : $site);
        $managerContact->update($contact);

        // Mis à jour du Type d'université
        $i=0;
        $type_bd =array();
        //echo $nbre_tu;
        foreach ($tu as $key => $value)
        {
            $type_bd[$i] = $value->TYPE_ID();
            $i++;
        }
        //echo "\n";
        //print_r($type) ;
        if($type != $type_bd){
            foreach ($tu as $key => $value)
            {
                $managerTU->delete($value) ;
            }
            foreach ($type as $key => $value) {
                $tu = new TypeUniversite(array(
                    'TYPE_ID' => $value,
                    'UNIVERSITE_ID' => $id,
                ));
                $managerTU->add($tu);
            }
        } //else
        $donnees = array('erreur' => 'non');
        echo json_encode($donnees);
    }
    else {
        $donnees = array('erreur' => 'Ce nom existe déjà');
        echo json_encode($donnees);
    }


}

// D'abord, on se connecte ?ySQL




?>