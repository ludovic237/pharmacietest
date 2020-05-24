<?php

class PresentationUniversite
{
    private $_PRESENTATION_ID,
        $_UNIVERSITE_ID,
        $_CONTENU,
        $_IMAGE,
        $_DATE_PUBLICATION,
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
        }
    }

    // GETTERS
    public function PRESENTATION_ID()
    {
        return $this->_PRESENTATION_ID;
    }
    public function UNIVERSITE_ID()
    {
        return $this->_UNIVERSITE_ID;
    }
    public function CONTENU()
    {
        return $this->_CONTENU;
    }
    public function IMAGE()
    {
        return $this->_IMAGE;
    }
    public function DATE_PUBLICATION()
    {
        return $this->_DATE_PUBLICATION;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }

    // SETTERS
    public function setPRESENTATION_ID($id)
    {

        if ($id > 0)
        {
            $this->_PRESENTATION_ID = $id;
        }
    }
    public function setUNIVERSITE_ID($id)
    {

        if ($id > 0)
        {
            $this->_UNIVERSITE_ID = $id;
        }
    }
    public function setCONTENU($info)
    {

        $this->_CONTENU = $info;

    }
    public function setIMAGE($info)
    {

        $this->_IMAGE = $info;

    }
    public function setDATE_PUBLICATION($info)
    {

        $this->_DATE_PUBLICATION = $info;

    }
    public function setSUPPRIMER($del)
    {

        $this->_SUPPRIMER = $del;

    }

}

class PresentationUniversiteManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(PresentationUniversite $presentation)
    {
        $q = $this->_db->prepare('INSERT INTO presentation_universite SET PRESENTATION_ID = :preid, UNIVERSITE_ID = :univid, CONTENU = :contenu, IMAGE = :image, DATE_PUBLICATION = NOW(), SUPPRIMER = 0');
        $q->bindValue(':preid', $presentation->PRESENTATION_ID(), PDO::PARAM_INT);
        $q->bindValue(':univid', $presentation->UNIVERSITE_ID(), PDO::PARAM_INT);
        $q->bindValue(':contenu', $presentation->CONTENU());
        $q->bindValue(':image', $presentation->IMAGE());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM presentation_universite')->fetchColumn();
    }
    public function delete(PresentationUniversite $presentation)
    {
        $this->_db->exec('DELETE FROM presentation_universite WHERE id = '.$presentation->CATEGORIE_ID());
    }
    public function exists($info)
    {
        return (bool) $this->_db->query('SELECT COUNT(*) FROM presentation_universite WHERE SUPPRIMER = 0 AND UNIVERSITE_ID = '.$info)->fetchColumn();

    }
    public function get($info)
    {
        $q = $this->_db->query('SELECT * FROM presentation_universite WHERE SUPPRIMER = 0 AND UNIVERSITE_ID = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new PresentationUniversite($donnees);


    }
    public function getList()
    {
        $Presentations = array();
        $q = $this->_db->prepare('SELECT * FROM presentation_universite WHERE SUPPRIMER = 0  ORDER BY UNIVERSITE_ID');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Presentations[] = new PresentationUniversite($donnees);
        }
        return $Presentations;
    }
    public function update(PresentationUniversite $presentation)
    {
        $q = $this->_db->prepare('UPDATE presentation_universite SET CONTENU = :contenu, IMAGE = :image, DATE_PUBLICATION = NOW() WHERE PRESENTATION_ID= :id');
        $q->bindValue(':id', $presentation->PRESENTATION_ID(), PDO::PARAM_INT);
        $q->bindValue(':contenu', $presentation->CONTENU());
        $q->bindValue(':image', $presentation->IMAGE());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>