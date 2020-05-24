<?php

class TypeUniversite
{
    private $_TYPE_ID,
        $_UNIVERSITE_ID;

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
    public function TYPE_ID()
    {
        return $this->_TYPE_ID;
    }
    public function UNIVERSITE_ID()
    {
        return $this->_UNIVERSITE_ID;
    }

    // SETTERS
    public function setTYPE_ID($id)
    {

        if ($id > 0)
        {
            $this->_TYPE_ID = $id;
        }
    }
    public function setUNIVERSITE_ID($id)
    {

        if ($id > 0)
        {
            $this->_UNIVERSITE_ID = $id;
        }
    }

}

class TypeUniversiteManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(TypeUniversite $TypeUniversite)
    {
        $q = $this->_db->prepare('INSERT INTO type_universite SET TYPE_ID = :TypeUniversiteid, UNIVERSITE_ID = :univid');
        $q->bindValue(':TypeUniversiteid', $TypeUniversite->TYPE_ID(), PDO::PARAM_INT);
        $q->bindValue(':univid', $TypeUniversite->UNIVERSITE_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function count($info)
    {
        return $this->_db->query('SELECT COUNT(*) FROM type_universite WHERE UNIVERSITE_ID = '.$info)->fetchColumn();
    }
    public function delete(TypeUniversite $TypeUniversite)
    {
        $this->_db->exec('DELETE FROM type_universite WHERE UNIVERSITE_ID = '.$TypeUniversite->UNIVERSITE_ID());
    }
    public function exists($info)
    {
        return (bool) $this->_db->query('SELECT COUNT(*) FROM type_universite WHERE UNIVERSITE_ID = '.$info)->fetchColumn();

    }
    public function getList($univid)
    {
        $TypeUniversites = array();
        $q = $this->_db->prepare('SELECT * FROM type_universite WHERE UNIVERSITE_ID = :id ORDER BY TYPE_ID');
        $q->execute(array(':id' => $univid));
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $TypeUniversites[] = new TypeUniversite($donnees);
        }
        return $TypeUniversites;
    }
    public function update(TypeUniversite $TypeUniversite)
    {
        $q = $this->_db->prepare('UPDATE type_universite SET NOM = :nom, DESCRIPTION = :description WHERE TypeUniversite_ID= :id');
        $q->bindValue(':id', $TypeUniversite->TypeUniversite_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $TypeUniversite->NOM());
        $q->bindValue(':description', $TypeUniversite->DESCRIPTION());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>