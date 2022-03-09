<?php

class Concours
{
    private $_CONCOURS_ID,
        $_UNIVERSITE_ID,
        $_DATE_DEBUT_CONCOURS,
        $_DATE_FIN_CONCOURS,
        $_DESCRIPTION,
        $_MODALITE_ADMISSION,
        $_COMPOSITION_DOSSIER,
        $_DATE_DOSSIER,
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
    public function CONCOURS_ID()
    {
        return $this->_CONCOURS_ID;
    }
    public function UNIVERSITE_ID()
    {
        return $this->_UNIVERSITE_ID;
    }
    public function DATE_DEBUT_CONCOURS()
    {
        return $this->_DATE_DEBUT_CONCOURS;
    }
    public function DATE_FIN_CONCOURS()
    {
        return $this->_DATE_FIN_CONCOURS;
    }
    public function DESCRIPTION()
    {
        return $this->_DESCRIPTION;
    }
    public function MODALITE_ADMISSION()
    {
        return $this->_MODALITE_ADMISSION;
    }
    public function COMPOSITION_DOSSIER()
    {
        return $this->_COMPOSITION_DOSSIER;
    }
    public function DATE_DOSSIER()
    {
        return $this->_DATE_DOSSIER;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }


    // SETTERS
    public function setCONCOURS_ID($id)
    {

        if ($id > 0)
        {
            $this->_CONCOURS_ID = $id;
        }
    }
    public function setUNIVERSITE_ID($id)
    {

        if ($id > 0)
        {
            $this->_UNIVERSITE_ID = $id;
        }
    }
    public function setDATE_DEBUT_CONCOURS($date)
    {

        $this->_DATE_DEBUT_CONCOURS = $date;

    }
    public function setDATE_FIN_CONCOURS($date)
    {

        $this->_DATE_FIN_CONCOURS = $date;

    }
    public function setDESCRIPTION($description)
    {

        $this->_DESCRIPTION = $description;

    }
    public function setMODALITE_ADMISSION($info)
    {

        $this->_MODALITE_ADMISSION = $info;

    }
    public function setCOMPOSITION_DOSSIER($info)
    {

        $this->_COMPOSITION_DOSSIER = $info;

    }
    public function setDATE_DOSSIER($info)
    {

        $this->_DATE_DOSSIER = $info;

    }
    public function setSUPPRIMER($sup)
    {

        $this->_SUPPRIMER = $sup;

    }

}

class ConcoursManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Concours $Concours)
    {
        $q = $this->_db->prepare('INSERT INTO acces_concours SET CONCOURS_ID = :concoursid, UNIVERSITE_ID = :universiteid, DATE_DEBUT_CONCOURS = :dated,  DATE_FIN_CONCOURS = :datef, DESCRIPTION= :description, MODALITE_ADMISSION= :modalite, COMPOSITION_DOSSIER= :composition, DATE_DOSSIER = :datec, SUPPRIMER=0');
        $q->bindValue(':concoursid', $Concours->CONCOURS_ID(), PDO::PARAM_INT);
        $q->bindValue(':universiteid', $Concours->UNIVERSITE_ID(), PDO::PARAM_INT);
        $q->bindValue(':dated', $Concours->DATE_DEBUT_CONCOURS());
        $q->bindValue(':datef', $Concours->DATE_FIN_CONCOURS());
        $q->bindValue(':modalite', $Concours->MODALITE_ADMISSION());
        $q->bindValue(':composition', $Concours->COMPOSITION_DOSSIER());
        $q->bindValue(':description', $Concours->DESCRIPTION());
        $q->bindValue(':datec', $Concours->DATE_DOSSIER());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM acces_concours')->fetchColumn();
    }
    public function deleteTrue(Concours $Concours)
    {
        $this->_db->exec('DELETE FROM acces_concours WHERE DEPARTEMENT_ID = '.$Concours->DEPARTEMENT_ID());
    }
    public function delete(Concours $Concours)
    {
        $q = $this->_db->prepare('UPDATE acces_concours SET SUPPRIMER = 1 WHERE CONCOURS_ID= :id');
        $q->bindValue(':id', $Concours->CONCOURS_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function exists($id)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM acces_concours WHERE SUPPRIMER=0 AND CONCOURS_ID='.$id);
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function existsUniv($univ_id,$info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM acces_concours WHERE UNIVERSITE_ID='.$univ_id.' AND SUPPRIMER=0 AND DESCRIPTION=:description');
        $q->bindValue(':description', $info);
        $q->execute();
        return (bool) $q->fetchColumn();

    }
    public function getUniv($univ_id,$info)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM acces_concours WHERE UNIVERSITE_ID='.$univ_id.' AND SUPPRIMER=0 AND DESCRIPTION=:description');
        $q->bindValue(':description', $info);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Concours($donnees);

    }
    public function get($id)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM acces_concours WHERE SUPPRIMER=0 AND CONCOURS_ID ='.$id);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new Concours($donnees);

    }
    public function getDeptUniv($univ_id,$info)
    {
        //echo "passe";
        $q = $this->_db->prepare('SELECT * FROM acces_concours WHERE SUPPRIMER=0 AND UNIVERSITE_ID ='.$univ_id.' AND NOM =:nom');
        $q->bindValue(':nom', $info);
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        //print_r($donnees);
        return new acces_concours($donnees);

    }
    public function getList($univ_id)
    {
        $Concourss = array();
        $q = $this->_db->prepare('SELECT * FROM acces_concours WHERE SUPPRIMER = 0 AND UNIVERSITE_ID ='.$univ_id);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Concourss[] = new Concours($donnees);
        }
        return $Concourss;
    }
    public function update(Concours $Concours)
    {
        $q = $this->_db->prepare('UPDATE acces_concours SET UNIVERSITE_ID = :universiteid, DATE_DEBUT_CONCOURS = :dated,  DATE_FIN_CONCOURS = :datef, DESCRIPTION= :description, MODALITE_ADMISSION= :modalite, COMPOSITION_DOSSIER= :composition, DATE_DOSSIER = :datec WHERE CONCOURS_ID= :id');
        $q->bindValue(':universiteid', $Concours->UNIVERSITE_ID(), PDO::PARAM_INT);
        $q->bindValue(':dated', $Concours->DATE_DEBUT_CONCOURS());
        $q->bindValue(':datef', $Concours->DATE_FIN_CONCOURS());
        $q->bindValue(':modalite', $Concours->MODALITE_ADMISSION());
        $q->bindValue(':composition', $Concours->COMPOSITION_DOSSIER());
        $q->bindValue(':description', $Concours->DESCRIPTION());
        $q->bindValue(':datec', $Concours->DATE_DOSSIER());
        $q->bindValue(':id', $Concours->CONCOURS_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>