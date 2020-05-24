<?php

class Media
{
    private $_MEDIA_ID,
        $_NOM,
        $_FILE,
        $_TYPE,
        $_RUBRIQUE,
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
    public function MEDIA_ID()
    {
        return $this->_MEDIA_ID;
    }
    public function NOM()
    {
        return $this->_NOM;
    }
    public function FILE()
    {
        return $this->_FILE;
    }
    public function TYPE()
    {
        return $this->_TYPE;
    }
    public function RUBRIQUE()
    {
        return $this->_RUBRIQUE;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }

    // SETTERS
    public function setMEDIA_ID($id)
    {

        if ($id > 0)
        {
            $this->_MEDIA_ID = $id;
        }
    }
    public function setNOM($nom)
    {

        $this->_NOM = $nom;

    }
    public function setFILE($info)
    {

        $this->_FILE = $info;

    }
    public function setTYPE($info)
    {

        $this->_TYPE = $info;

    }
    public function setRUBRIQUE($info)
    {

        $this->_RUBRIQUE = $info;

    }
    public function setSUPPRIMER($del)
    {

        $this->_SUPPRIMER = $del;

    }

}

class MediaManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Media $MEDIA)
    {
        $q = $this->_db->prepare('INSERT INTO medias SET MEDIA_ID = :mediaid, NOM = :nom, FILE = :file, TYPE = :type, RUBRIQUE = :rubrique, SUPPRIMER = 0');
        $q->bindValue(':mediaid', $MEDIA->MEDIA_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $MEDIA->NOM());
        $q->bindValue(':file', $MEDIA->FILE());
        $q->bindValue(':type', $MEDIA->TYPE());
        $q->bindValue(':rubrique', $MEDIA->RUBRIQUE());
        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>