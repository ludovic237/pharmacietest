<?php

class PresentationFiliere
{
    private $_PRESENTATION_ID,
        $_SLUG,
        $_CONTENU,
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
    public function SLUG()
    {
        return $this->_SLUG;
    }
    public function CONTENU()
    {
        return $this->_CONTENU;
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
    public function setCONTENU($info)
    {

        $this->_CONTENU = $info;

    }
    public function setSLUG($info)
    {

        $this->_SLUG = $info;

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

class PresentationFiliereManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(PresentationFiliere $presentation)
    {
        $q = $this->_db->prepare('INSERT INTO presentation_filiere SET PRESENTATION_ID = :preid, CONTENU = :contenu, SLUG = :slug, DATE_PUBLICATION = NOW(), SUPPRIMER = 0');
        $q->bindValue(':preid', $presentation->PRESENTATION_ID(), PDO::PARAM_INT);
        $q->bindValue(':contenu', $presentation->CONTENU());
        $q->bindValue(':slug', $presentation->SLUG());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM presentation_filiere')->fetchColumn();
    }
    public function delete(PresentationFiliere $presentation)
    {
        $this->_db->exec('DELETE FROM presentation_filiere WHERE id = '.$presentation->CATEGORIE_ID());
    }
    public function exists($info)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM presentation_filiere WHERE SLUG = :slug AND SUPPRIMER = 0');
        $q->execute(array(':slug' => $info));
        return (bool) $q->fetchColumn();

    }
    public function get($info)
    {
        $q = $this->_db->prepare('SELECT * FROM presentation_filiere WHERE SLUG = :slug AND SUPPRIMER = 0');
        $q->execute(array(':slug' => $info));
        return new PresentationFiliere($q->fetch(PDO::FETCH_ASSOC));
    }
    public function getList()
    {
        $Presentations = array();
        $q = $this->_db->prepare('SELECT * FROM presentation_filiere WHERE SUPPRIMER = 0  ORDER BY SLUG');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Presentations[] = new PresentationFiliere($donnees);
        }
        return $Presentations;
    }
    public function update(PresentationFiliere $presentation)
    {
        $q = $this->_db->prepare('UPDATE presentation_filiere SET CONTENU = :contenu, SLUG = :slug, DATE_PUBLICATION = NOW() WHERE PRESENTATION_ID= :id');
        $q->bindValue(':id', $presentation->PRESENTATION_ID(), PDO::PARAM_INT);
        $q->bindValue(':contenu', $presentation->CONTENU());
        $q->bindValue(':slug', $presentation->SLUG());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>