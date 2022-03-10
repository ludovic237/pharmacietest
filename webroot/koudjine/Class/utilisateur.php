<?php

class Utilisateur
{
    private $_PERSONNE_ID,
        $_CONTACT_ID,
        $_NOM,
        $_PRENOM,
        $_IDENTIFIANT,
        $_PASSWORD,
        $_DATE_NAISSANCE,
        $_PHOTO_PROFIL,
        $_DATE_CREATION,
        $_STATUT,
        $_FONCTION,
        $_SUPPRIMER;

    // CONSRUCTEUR
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
            else echo "N existe pas";
        }
    }

    // GETTERS
    public function PERSONNE_ID()
    {
        return $this->_PERSONNE_ID;
    }
    public function CONTACT_ID()
    {
        return $this->_CONTACT_ID;
    }
    public function NOM()
    {
        return $this->_NOM;
    }
    public function PRENOM()
    {
        return $this->_PRENOM;
    }
    public function IDENTIFIANT()
    {
        return $this->_IDENTIFIANT;
    }
    public function PASSWORD()
    {
        return $this->_PASSWORD;
    }
    public function DATE_NAISSANCE()
    {
        return $this->_DATE_NAISSANCE;
    }
    public function PHOTO_PROFIL()
    {
        return $this->_PHOTO_PROFIL;
    }
    public function DATE_CREATION()
    {
        return $this->_DATE_CREATION;
    }
    public function STATUT()
    {
        return $this->_STATUT;
    }
    public function FONCTION()
    {
        return $this->_FONCTION;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }


    // SETTERS
    public function setPERSONNE_ID($id)
    {

        if ($id > 0)
        {
            $this->_PERSONNE_ID = $id;
        }
    }
    public function setCONTACT_ID($id)
    {

        if ($id > 0)
        {
            $this->_CONTACT_ID = $id;
        }
    }
    public function setNOM($info)
    {

        $this->_NOM = $info;

    }
    public function setPRENOM($info)
    {

        $this->_PRENOM = $info;

    }
    public function setIDENTIFIANT($info)
    {

        $this->_IDENTIFIANT = $info;

    }
    public function setPASSWORD($info)
    {

        $this->_PASSWORD = $info;

    }
    public function setDATE_NAISSANCE($info)
    {

        $this->_DATE_NAISSANCE = $info;

    }
    public function setPHOTO_PROFIL($info)
    {

        $this->_PHOTO_PROFIL = $info;

    }
    public function setDATE_CREATION($info)
    {

        $this->_DATE_CREATION = $info;

    }
    public function setSTATUT($info)
    {

        $this->_STATUT = $info;

    }
    public function setFONCTION($info)
    {

        $this->_FONCTION = $info;

    }
    public function setSUPPRIMER($sup)
    {

        $this->_SUPPRIMER = $sup;

    }

}

class UtilisateurManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Utilisateur $Utilisateur)
    {
        $q = $this->_db->prepare('INSERT INTO personne SET PERSONNE_ID = :personneid, CONTACT_ID = :contactid, NOM = :nom,  PRENOM = :prenom, IDENTIFIANT= :identifiant, PASSWORD= :password, DATE_NAISSANCE= :daten, PHOTO_PROFIL= :photo, DATE_CREATION = NOW(), STATUT= :statut, FONCTION= :fonction, SUPPRIMER=0');
        $q->bindValue(':personneid', $Utilisateur->PERSONNE_ID(), PDO::PARAM_INT);
        $q->bindValue(':contactid', $Utilisateur->CONTACT_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Utilisateur->NOM());
        $q->bindValue(':prenom', $Utilisateur->PRENOM());
        $q->bindValue(':identifiant', $Utilisateur->IDENTIFIANT());
        $q->bindValue(':password', $Utilisateur->PASSWORD());
        $q->bindValue(':daten', $Utilisateur->DATE_NAISSANCE());
        $q->bindValue(':photo', $Utilisateur->PHOTO_PROFIL());
        $q->bindValue(':statut', $Utilisateur->STATUT());
        $q->bindValue(':fonction', $Utilisateur->FONCTION());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM personne')->fetchColumn();
    }
    public function deleteTrue(Utilisateur $Utilisateur)
    {
        $this->_db->exec('DELETE FROM personne WHERE PERSONNE_ID = '.$Utilisateur->PERSONNE_ID());
    }
    public function exists($id)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM personne WHERE SUPPRIMER=0 AND PERSONNE_ID='.$id);
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function existsIdentifiant($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM personne WHERE SUPPRIMER=0 AND IDENTIFIANT=:identifiant');
        $q->bindValue(':identifiant', $info);
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function getIdentifiant($info)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM personne WHERE SUPPRIMER=0 AND IDENTIFIANT=:identifiant');
        $q->bindValue(':identifiant', $info);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Utilisateur($donnees);

    }
    public function get($id)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM personne WHERE SUPPRIMER=0 AND PERSONNE_ID ='.$id);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Utilisateur($donnees);

    }
    public function update(Utilisateur $Utilisateur)
    {
        $q = $this->_db->prepare('UPDATE personne SET CONTACT_ID = :contactid, NOM = :nom,  PRENOM = :prenom, IDENTIFIANT= :identifiant, PASSWORD= :password, DATE_NAISSANCE= :daten, PHOTO_PROFIL= :photo, DATE_CREATION = NOW(), STATUT= :statut, FONCTION= :fonction WHERE PERSONNE_ID= :id');
        $q->bindValue(':contactid', $Utilisateur->CONTACT_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Utilisateur->NOM());
        $q->bindValue(':prenom', $Utilisateur->PRENOM());
        $q->bindValue(':identifiant', $Utilisateur->IDENTIFIANT());
        $q->bindValue(':password', $Utilisateur->PASSWORD());
        $q->bindValue(':daten', $Utilisateur->DATE_NAISSANCE());
        $q->bindValue(':photo', $Utilisateur->PHOTO_PROFIL());
        $q->bindValue(':statut', $Utilisateur->STATUT());
        $q->bindValue(':fonction', $Utilisateur->FONCTION());
        $q->bindValue(':id', $Utilisateur->PERSONNE_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>