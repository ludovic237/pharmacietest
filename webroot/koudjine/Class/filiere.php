<?php

class Filiere
{
    private $_FILIERE_ID,
        $_DEPARTEMENT_ID,
        $_CATEGORIE_ID,
        $_NOM,
        $_SLUG,
        $_NIVEAU_FORMATION,
        $_DESCRIPTION,
        $_SIGLE,
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
            else echo "N existe pas ".$key;
        }
    }

    // GETTERS
    public function FILIERE_ID()
    {
        return $this->_FILIERE_ID;
    }
    public function DEPARTEMENT_ID()
    {
        return $this->_DEPARTEMENT_ID;
    }
    public function CATEGORIE_ID()
    {
        return $this->_CATEGORIE_ID;
    }
    public function NOM()
    {
        return $this->_NOM;
    }
    public function SLUG()
    {
        return $this->_SLUG;
    }
    public function NIVEAU_FORMATION()
    {
        return $this->_NIVEAU_FORMATION;
    }
    public function DESCRIPTION()
    {
        return $this->_DESCRIPTION;
    }
    public function SIGLE()
    {
        return $this->_SIGLE;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }


    // SETTERS
    public function setFILIERE_ID($id)
    {

        if ($id > 0)
        {
            $this->_FILIERE_ID = $id;
        }
    }
    public function setDEPARTEMENT_ID($id)
    {

        if ($id > 0)
        {
            $this->_DEPARTEMENT_ID = $id;
        }
    }
    public function setCATEGORIE_ID($id)
    {

        if ($id > 0)
        {
            $this->_CATEGORIE_ID = $id;
        }
    }
    public function setNOM($nom)
    {

        $this->_NOM = $nom;

    }
    public function setSLUG($nom)
    {

        $this->_SLUG = $nom;

    }
    public function setNIVEAU_FORMATION($nom)
    {

        $this->_NIVEAU_FORMATION = $nom;

    }
    public function setDESCRIPTION($description)
    {

        $this->_DESCRIPTION = $description;

    }
    public function setSIGLE($sigle)
    {

        $this->_SIGLE = $sigle;

    }
    public function setSUPPRIMER($sup)
    {

        $this->_SUPPRIMER = $sup;

    }

}

class FiliereManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Filiere $Filiere)
    {
        $q = $this->_db->prepare('INSERT INTO filiere SET FILIERE_ID = :filiereid, DEPARTEMENT_ID = :departementid, CATEGORIE_ID = :categorieid, NOM = :nom, SLUG = :slug, NIVEAU_FORMATION = :niveau, DESCRIPTION= :description, SIGLE = :sigle, SUPPRIMER=0');
        $q->bindValue(':filiereid', $Filiere->FILIERE_ID(), PDO::PARAM_INT);
        $q->bindValue(':departementid', $Filiere->DEPARTEMENT_ID(), PDO::PARAM_INT);
        $q->bindValue(':categorieid', $Filiere->CATEGORIE_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Filiere->NOM());
        $q->bindValue(':slug', $Filiere->SLUG());
        $q->bindValue(':niveau', $Filiere->NIVEAU_FORMATION());
        $q->bindValue(':description', $Filiere->DESCRIPTION());
        $q->bindValue(':sigle', $Filiere->SIGLE());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM filiere')->fetchColumn();
    }
    public function deleteTrue(Filiere $Filiere)
    {
        $this->_db->exec('DELETE FROM filiere WHERE FILIERE_ID = '.$Filiere->FILIERE_ID());
    }
    public function delete(Filiere $Filiere)
    {
        $q = $this->_db->prepare('UPDATE filiere SET SUPPRIMER = 1 WHERE FILIERE_ID= :id');
        $q->bindValue(':id', $Filiere->FILIERE_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function exists($fil_id,$dep_id)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM filiere WHERE SUPPRIMER=0 AND FILIERE_ID='.$fil_id.' AND DEPARTEMENT_ID ='.$dep_id);
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function existsNom($dep_id,$info)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT COUNT(*) FROM filiere WHERE SUPPRIMER=0 AND DEPARTEMENT_ID ='.$dep_id.' AND NOM =:nom');
        $q->bindValue(':nom', $info);
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function getDeptDefault($univ_id)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM filiere WHERE UNIVERSITE_ID='.$univ_id.' AND SUPPRIMER=0 AND NOM='.'"\"GENERAL\""');
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Filiere($donnees);

    }
    public function get($fil_id)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM filiere WHERE SUPPRIMER=0 AND FILIERE_ID ='.$fil_id);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Filiere($donnees);

    }
    public function getFiliere($dep_id,$info)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM filiere WHERE SUPPRIMER=0 AND DEPARTEMENT_ID ='.$dep_id.' AND NOM =:nom');
        $q->bindValue(':nom', $info);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Filiere($donnees);

    }
    public function getList($univ_id)
    {
        $Filieres = array();
        $q = $this->_db->prepare('SELECT * FROM filiere WHERE SUPPRIMER = 0 AND UNIVERSITE_ID ='.$univ_id.' AND NOM <> :nom   ORDER BY FILIERE_ID');
        $q->bindValue(':nom', 'GENERAL');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Filieres[] = new Filiere($donnees);
        }
        return $Filieres;
    }
    public function update(Filiere $Filiere)
    {
        $q = $this->_db->prepare('UPDATE filiere SET DEPARTEMENT_ID = :departementid, CATEGORIE_ID = :categorieid, NOM = :nom, SLUG = :slug, NIVEAU_FORMATION = :niveau, DESCRIPTION= :description, SIGLE = :sigle WHERE FILIERE_ID= :id');
        $q->bindValue(':id', $Filiere->FILIERE_ID(), PDO::PARAM_INT);
        $q->bindValue(':departementid', $Filiere->DEPARTEMENT_ID(), PDO::PARAM_INT);
        $q->bindValue(':categorieid', $Filiere->CATEGORIE_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Filiere->NOM());
        $q->bindValue(':slug', $Filiere->SLUG());
        $q->bindValue(':niveau', $Filiere->NIVEAU_FORMATION());
        $q->bindValue(':description', $Filiere->DESCRIPTION());
        $q->bindValue(':sigle', $Filiere->SIGLE());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>