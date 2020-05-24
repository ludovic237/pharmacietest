<?php
require_once('database.php');
require_once('../Class/utilisateur.php');
require_once('../Class/contact.php');

global $pdo;

$managerContact = new ContactManager($pdo);
$managerUtilisateur = new UtilisateurManager($pdo);

if (isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['identifiant'])&&isset($_POST['password'])
    &&isset($_POST['statut'])&&isset($_POST['fonction'])&&isset($_POST['daten'])&&isset($_POST['photo_profil'])
    &&isset($_POST['bp'])&&isset($_POST['email'])&&isset($_POST['site'])&&isset($_POST['telephone_1'])&&isset($_POST['telephone_2'])&&isset($_POST['option'])){
    //echo "passe";
    print_r($_POST);
    extract($_POST);
}

print_r($_FILES);
die();


if ($option == "Ajouter"){
    if(!$managerUtilisateur->existsIdentifiant($identifiant)) {
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

            // Enregistrement de l'utilisateur
            if($_POST['daten'] != null){
                $daten = DateTime::createFromFormat('d-m-Y', $_POST['daten']);
                $daten = $daten->format('Y-m-d');}
            else $daten = null;
            $userid = genererID();
            $user = new Utilisateur(array(
                'PERSONNE_ID' => $userid,
                'CONTACT_ID' => $contactid,
                'NOM' => $nom,
                'PRENOM' => $prenom,
                'IDENTIFIANT' => $identifiant,
                'PASSWORD' => sha1($password),
                'STATUT' => $statut,
                'FONCTION' => $fonction,
                'PHOTO_PROFIL' => (empty($photo_profil)) ? 'no-image.jpg' : $photo_profil,
                'DATE_NAISSANCE' => $daten,
            ));
            $managerUtilisateur->add($user);
            echo "ok";
        } else echo "Cet email existe déjà";
    }

    else echo "Cet identifiant est déjà pris";



    //$sql = "UPDATE departement set NOM='".$nom."',SIGLE='".$sigle."',DESCRIPTION='".$description."' WHERE DEPARTEMENT_ID = '".$id."'";
    //$req = $pdo->exec($sql);
}
else{
    if(isset($_POST['id']))
        $id = $_POST['id'];
    if ($managerUtilisateur->existsIdentifiant($identifiant)) {
        $user = $managerUtilisateur->get($id);
        $contact = $managerContact->get($user->CONTACT_ID());

        if ($user->IDENTIFIANT() == $identifiant) {
            if ($contact->EMAIL() == $email) {
                // Update utilisateur
                $user->setNOM($nom);
                $user->setPRENOM($prenom);
                $user->setIDENTIFIANT($identifiant);
                if($password != null)
                    $user->setPASSWORD(sha1($password));
                if($statut != null)
                $user->setSTATUT($statut);
                $user->setFONCTION($fonction);
                if($photo_profil != null)
                    $user->setPHOTO_PROFIL($photo_profil);
                if($_POST['daten'] != null){
                    $daten = DateTime::createFromFormat('d-m-Y', $_POST['daten']);
                    $daten = $daten->format('Y-m-d');}
                else $daten = null;
                $user->setDATE_NAISSANCE($daten);
                $managerUtilisateur->update($user);
                // Update contact
                $contact->setBP((empty($bp)) ? null : $bp);
                $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
                $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
                $contact->setEMAIL((empty($email)) ? null : $email);
                $contact->setSITE((empty($site)) ? null : $site);
                $managerContact->update($contact);

                echo 'ok';
            }
            elseif(!$managerContact->existsEmail($email)){
                // Update utilisateur
                $user->setNOM($nom);
                $user->setPRENOM($prenom);
                $user->setIDENTIFIANT($identifiant);
                if($password != null)
                    $user->setPASSWORD(sha1($password));
                if($statut != null)
                $user->setSTATUT($statut);
                $user->setFONCTION($fonction);
                if($photo_profil != null)
                    $user->setPHOTO_PROFIL($photo_profil);
                if($_POST['daten'] != null){
                    $daten = DateTime::createFromFormat('d-m-Y', $_POST['daten']);
                    $daten = $daten->format('Y-m-d');}
                else $daten = null;
                $user->setDATE_NAISSANCE($daten);
                $managerUtilisateur->update($user);
                // Update contact
                $contact->setBP((empty($bp)) ? null : $bp);
                $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
                $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
                $contact->setEMAIL((empty($email)) ? null : $email);
                $contact->setSITE((empty($site)) ? null : $site);
                $managerContact->update($contact);

                echo 'ok';
            }
            else {
                echo "Cet email existe déjà";
            }
        }
        elseif(!$managerUtilisateur->existsIdentifiant($identifiant)){
            // Update utilisateur
            $user->setNOM($nom);
            $user->setPRENOM($prenom);
            $user->setIDENTIFIANT($identifiant);
            if($password != null)
                $user->setPASSWORD(sha1($password));
            if($statut != null)
            $user->setSTATUT($statut);
            $user->setFONCTION($fonction);
            if($photo_profil != null)
                $user->setPHOTO_PROFIL($photo_profil);
            if($_POST['daten'] != null){
                $daten = DateTime::createFromFormat('d-m-Y', $_POST['daten']);
                $daten = $daten->format('Y-m-d');}
            else $daten = null;
            $user->setDATE_NAISSANCE($daten);
            $managerUtilisateur->update($user);
            // Update contact
            $contact->setBP((empty($bp)) ? null : $bp);
            $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
            $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
            $contact->setEMAIL((empty($email)) ? null : $email);
            $contact->setSITE((empty($site)) ? null : $site);
            $managerContact->update($contact);


            echo 'ok';
        }
        else {
            echo "Cet identifiant est déjà pris";
        }
    }
    else{
        $user = $managerUtilisateur->get($id);
        $contact = $managerContact->get($user->CONTACT_ID());
        if ($contact->EMAIL() == $email) {
            // Update utilisateur
            $user->setNOM($nom);
            $user->setPRENOM($prenom);
            $user->setIDENTIFIANT($identifiant);
            if($password != null)
                $user->setPASSWORD(sha1($password));
            if($statut != null)
                $user->setSTATUT($statut);
            $user->setFONCTION($fonction);
            if($photo_profil != null)
                $user->setPHOTO_PROFIL($photo_profil);
            if($_POST['daten'] != null){
                $daten = DateTime::createFromFormat('d-m-Y', $_POST['daten']);
                $daten = $daten->format('Y-m-d');}
            else $daten = null;
            $user->setDATE_NAISSANCE($daten);
            $managerUtilisateur->update($user);
            // Update contact
            $contact->setBP((empty($bp)) ? null : $bp);
            $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
            $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
            $contact->setEMAIL((empty($email)) ? null : $email);
            $contact->setSITE((empty($site)) ? null : $site);
            $managerContact->update($contact);

            echo 'ok';
        }
        elseif(!$managerContact->existsEmail($email)){
            // Update utilisateur
            $user->setNOM($nom);
            $user->setPRENOM($prenom);
            $user->setIDENTIFIANT($identifiant);
            if($password != null)
                $user->setPASSWORD(sha1($password));
            if($statut != null)
                $user->setSTATUT($statut);
            $user->setFONCTION($fonction);
            if($photo_profil != null)
                $user->setPHOTO_PROFIL($photo_profil);
            if($_POST['daten'] != null){
                $daten = DateTime::createFromFormat('d-m-Y', $_POST['daten']);
                $daten = $daten->format('Y-m-d');}
            else $daten = null;
            $user->setDATE_NAISSANCE($daten);
            $managerUtilisateur->update($user);
            // Update contact
            $contact->setBP((empty($bp)) ? null : $bp);
            $contact->setTELEPHONE_1((empty($telephone_1)) ? null : $telephone_1);
            $contact->setTELEPHONE_2((empty($telephone_2)) ? null : $telephone_2);
            $contact->setEMAIL((empty($email)) ? null : $email);
            $contact->setSITE((empty($site)) ? null : $site);
            $managerContact->update($contact);

            echo 'ok';
        }
        else {
            echo "Cet email existe déjà";
        }
    }



}

// D'abord, on se connecte ?ySQL




?>