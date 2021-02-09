<?php

class Departement
{
    private $_DEPARTEMENT_ID,
        $_UNIVERSITE_ID,
        $_NOM,
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
            else echo "N existe pas";
        }
    }

    // GETTERS
    public function DEPARTEMENT_ID()
    {
        return $this->_DEPARTEMENT_ID;
    }
    public function UNIVERSITE_ID()
    {
        return $this->_UNIVERSITE_ID;
    }
    public function NOM()
    {
        return $this->_NOM;
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
    public function setDEPARTEMENT_ID($id)
    {

        if ($id > 0)
        {
            $this->_DEPARTEMENT_ID = $id;
        }
    }
    public function setUNIVERSITE_ID($id)
    {

        if ($id > 0)
        {
            $this->_UNIVERSITE_ID = $id;
        }
    }
    public function setNOM($nom)
    {

            $this->_NOM = $nom;

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

class DepartementManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Departement $Departement)
    {
        $q = $this->_db->prepare('INSERT INTO departement SET DEPARTEMENT_ID = :departementid, UNIVERSITE_ID = :universiteid, NOM = :nom, DESCRIPTION= :description, SIGLE = :sigle, SUPPRIMER=0');
        $q->bindValue(':departementid', $Departement->DEPARTEMENT_ID(), PDO::PARAM_INT);
        $q->bindValue(':universiteid', $Departement->UNIVERSITE_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Departement->NOM());
        $q->bindValue(':description', $Departement->DESCRIPTION());
        $q->bindValue(':sigle', $Departement->SIGLE());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM departement')->fetchColumn();
    }
    public function deleteTrue(Departement $Departement)
    {
        $this->_db->exec('DELETE FROM departement WHERE DEPARTEMENT_ID = '.$Departement->DEPARTEMENT_ID());
    }
    public function delete(Departement $Departement)
    {
        $q = $this->_db->prepare('UPDATE departement SET SUPPRIMER = 1 WHERE DEPARTEMENT_ID= :id');
        $q->bindValue(':id', $Departement->DEPARTEMENT_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function exists($dep_id)
    {

            $q = $this->_db->prepare('SELECT COUNT(*) FROM departement WHERE SUPPRIMER=0 AND DEPARTEMENT_ID='.$dep_id);
            $q->execute();
            return (bool) $q->fetchColumn();

    }
    public function existsDeptDefault($univ_id)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM departement WHERE UNIVERSITE_ID='.$univ_id.' AND SUPPRIMER=0 AND NOM='.'"\"GENERAL\""');
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function existsDeptUniv($univ_id,$info)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT COUNT(*) FROM departement WHERE SUPPRIMER=0 AND UNIVERSITE_ID ='.$univ_id.' AND NOM =:nom');
        $q->bindValue(':nom', $info);
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function getDeptDefault($univ_id)
    {
            //echo "passe";
            $q = $this->_db->prepare('SELECT * FROM departement WHERE UNIVERSITE_ID='.$univ_id.' AND SUPPRIMER=0 AND NOM='.'"\"GENERAL\""');
            $q->execute();
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
            return new Departement($donnees);

    }
    public function get($dep_id)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM departement WHERE SUPPRIMER=0 AND DEPARTEMENT_ID ='.$dep_id);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Departement($donnees);

    }
    public function getDeptUniv($univ_id,$info)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM departement WHERE SUPPRIMER=0 AND UNIVERSITE_ID ='.$univ_id.' AND NOM =:nom');
        $q->bindValue(':nom', $info);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Departement($donnees);

    }
    public function getList($univ_id)
    {
        $Departements = array();
        $q = $this->_db->prepare('SELECT * FROM departement WHERE SUPPRIMER = 0 AND UNIVERSITE_ID ='.$univ_id.' AND NOM <> :nom   ORDER BY DEPARTEMENT_ID');
        $q->bindValue(':nom', 'GENERAL');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Departements[] = new Departement($donnees);
        }
        return $Departements;
    }
    public function update(Departement $Departement)
    {
        $q = $this->_db->prepare('UPDATE departement SET NOM = :nom, DESCRIPTION= :description, SIGLE = :sigle WHERE DEPARTEMENT_ID= :id');
        $q->bindValue(':nom', $Departement->NOM());
        $q->bindValue(':description', $Departement->DESCRIPTION());
        $q->bindValue(':sigle', $Departement->SIGLE());
        $q->bindValue(':id', $Departement->DEPARTEMENT_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>