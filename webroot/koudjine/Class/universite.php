<?php

class Universite
{
    private $_UNIVERSITE_ID,
        $_PERSONNE_ID,
        $_CONTACT_ID,
        $_NOM,
        $_NOM_COMPLET,
        $_VILLE,
        $_REGION,
        $_STATUT,
        $_RESPONSABLE,
        $_LOGO,
        $_PARRAIN_ID,
        $_CERTIFICATION;

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
        }
    }

    // GETTERS
    public function UNIVERSITE_ID()
    {
        return $this->_UNIVERSITE_ID;
    }
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
    public function NOM_COMPLET()
    {
        return $this->_NOM_COMPLET;
    }
    public function VILLE()
    {
        return $this->_VILLE;
    }
    public function REGION()
    {
        return $this->_REGION;
    }
    public function STATUT()
    {
        return $this->_STATUT;
    }
    public function RESPONSABLE()
    {
        return $this->_RESPONSABLE;
    }
    public function LOGO()
    {
        return $this->_LOGO;
    }
    public function PARRAIN_ID()
    {
        return $this->_PARRAIN_ID;
    }
    public function CERTIFICATION()
    {
        return $this->_CERTIFICATION;
    }

    // SETTERS
    public function setUNIVERSITE_ID($id)
    {

        if ($id > 0)
        {
            $this->_UNIVERSITE_ID = $id;
        }
    }
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
    public function setNOM($nom)
    {

            $this->_NOM = $nom;

    }
    public function setNOM_COMPLET($nom_complet)
    {

            $this->_NOM_COMPLET = $nom_complet;

    }
    public function setVILLE($ville)
    {

            $this->_VILLE = $ville;

    }
    public function setREGION($region)
    {

            $this->_REGION = $region;

    }
    public function setSTATUT($statut)
    {

            $this->_STATUT = $statut;

    }
    public function setRESPONSABLE($responsable)
    {

            $this->_RESPONSABLE = $responsable;

    }
    public function setLOGO($logo)
    {

            $this->_LOGO = $logo;

    }
    public function setPARRAIN_ID($id)
    {

        if ($id > 0)
        {
            $this->_PARRAIN_ID = $id;
        }
    }
    public function setCERTIFICATION($certification)
    {

            $this->_CERTIFICATION = $certification;

    }

}

class UniversiteManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Universite $universite)
    {
        $q = $this->_db->prepare('INSERT INTO universite SET UNIVERSITE_ID = :universiteid, PERSONNE_ID = :personneid, CONTACT_ID = :contactid, NOM = :nom, NOM_COMPLET = :nomcomplet, VILLE = :ville, REGION = :region, STATUT = :statut, RESPONSABLE = :responsable, LOGO = :logo, PARRAIN_ID = :parrainid, CERTIFICATION = :certification');
        $q->bindValue(':universiteid', $universite->UNIVERSITE_ID(), PDO::PARAM_INT);
        $q->bindValue(':personneid', $universite->PERSONNE_ID(), PDO::PARAM_INT);
        $q->bindValue(':contactid', $universite->CONTACT_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $universite->NOM());
        $q->bindValue(':nomcomplet', $universite->NOM_COMPLET());
        $q->bindValue(':ville', $universite->VILLE());
        $q->bindValue(':region', $universite->REGION());
        $q->bindValue(':statut', $universite->STATUT());
        $q->bindValue(':responsable', $universite->RESPONSABLE());
        $q->bindValue(':logo', $universite->LOGO());
        $q->bindValue(':parrainid', $universite->PARRAIN_ID(), PDO::PARAM_INT);
        $q->bindValue(':certification', $universite->CERTIFICATION());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM universite WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Universite $universite)
    {
        $this->_db->exec('DELETE FROM Universites WHERE id = '.$universite->id());
    }
    public function existsId($info)
    {

            return (bool) $this->_db->query('SELECT COUNT(*) FROM universite WHERE SUPPRIMER = 0 AND UNIVERSITE_ID = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

            $q = $this->_db->prepare('SELECT COUNT(*) FROM universite WHERE SUPPRIMER = 0 AND NOM = :nom');
            $q->execute(array(':nom' => $info));
            return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

            $q = $this->_db->query('SELECT * FROM universite WHERE SUPPRIMER = 0 AND UNIVERSITE_ID = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new Universite($donnees);

    }
    public function getList()
    {
        $universites = array();
        $q = $this->_db->prepare('SELECT * FROM universite WHERE SUPPRIMER = 0 ORDER BY NOM');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $universites[] = new Universite($donnees);
        }
        return $universites;
    }
    public function update(Universite $universite)
    {
        $q = $this->_db->prepare('UPDATE universite SET NOM = :nom, NOM_COMPLET = :nomcomplet, VILLE = :ville, REGION = :region, STATUT = :statut, RESPONSABLE = :responsable, LOGO = :logo, PARRAIN_ID = :parrainid, CERTIFICATION = :certification WHERE UNIVERSITE_ID = :id');
        $q->bindValue(':nom', $universite->NOM());
        $q->bindValue(':nomcomplet', $universite->NOM_COMPLET());
        $q->bindValue(':ville', $universite->VILLE());
        $q->bindValue(':region', $universite->REGION());
        $q->bindValue(':statut', $universite->STATUT());
        $q->bindValue(':responsable', $universite->RESPONSABLE());
        $q->bindValue(':logo', $universite->LOGO());
        $q->bindValue(':parrainid', $universite->PARRAIN_ID(), PDO::PARAM_INT);
        $q->bindValue(':certification', $universite->CERTIFICATION());
        $q->bindValue(':id', $universite->UNIVERSITE_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>