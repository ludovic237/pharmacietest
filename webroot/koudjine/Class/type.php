<?php

class Type
{
    private $_TYPE_ID,
        $_NOM,
        $_DESCRIPTION,
        $_SLUG,
        $_CERTIFICATION,
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
    public function TYPE_ID()
    {
        return $this->_TYPE_ID;
    }
    public function NOM()
    {
        return $this->_NOM;
    }
    public function DESCRIPTION()
    {
        return $this->_DESCRIPTION;
    }
    public function SLUG()
    {
        return $this->_SLUG;
    }
    public function CERTIFICATION()
    {
        return $this->_CERTIFICATION;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }

    // SETTERS
    public function setTYPE_ID($id)
    {

        if ($id > 0)
        {
            $this->_TYPE_ID = $id;
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
    public function setSLUG($slug)
    {

        $this->_SLUG = $slug;

    }
    public function setCERTIFICATION($certif)
    {

        $this->_CERTIFICATION = $certif;

    }
    public function setSUPPRIMER($del)
    {

        $this->_SUPPRIMER = $del;

    }

}

class TypeManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Type $Type)
    {
        $q = $this->_db->prepare('INSERT INTO type SET TYPE_ID = :Typeid, NOM = :nom, DESCRIPTION = :description, SLUG = :slug, CERTIFICATION = :certif, SUPPRIMER = 0');
        $q->bindValue(':Typeid', $Type->TYPE_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Type->NOM());
        $q->bindValue(':description', $Type->DESCRIPTION());
        $q->bindValue(':slug', $Type->SLUG());
        $q->bindValue(':certif', $Type->CERTIFICATION());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM type')->fetchColumn();
    }
    public function delete(Type $Type)
    {
        $this->_db->exec('DELETE FROM type WHERE id = '.$Type->id());
    }
    public function exists($info)
    {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM type WHERE SUPPRIMER = 0 AND TYPE_ID = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {
            $q = $this->_db->prepare('SELECT COUNT(*) FROM type WHERE SUPPRIMER = 0 AND NOM = :nom');
            $q->execute(array(':nom' => $info));
            return (bool) $q->fetchColumn();

    }
    public function getNom($info)
    {
        $q = $this->_db->prepare('SELECT * FROM type WHERE SUPPRIMER = 0 AND NOM = :nom');
        $q->execute(array(':nom' => $info));
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Type($donnees);

    }
    public function get($info)
    {
            $q = $this->_db->query('SELECT * FROM type WHERE SUPPRIMER = 0 AND TYPE_ID = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new Type($donnees);


    }
    public function getList()
    {
        $Types = array();
        $q = $this->_db->prepare('SELECT * FROM type WHERE SUPPRIMER = 0  ORDER BY Type_ID');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Types[] = new Type($donnees);
        }
        return $Types;
    }
    public function update(Type $Type)
    {
        $q = $this->_db->prepare('UPDATE type SET NOM = :nom, DESCRIPTION = :description, SLUG = :slug, CERTIFICATION = :certif WHERE TYPE_ID= :id');
        $q->bindValue(':id', $Type->TYPE_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Type->NOM());
        $q->bindValue(':description', $Type->DESCRIPTION());
        $q->bindValue(':slug', $Type->SLUG());
        $q->bindValue(':certif', $Type->CERTIFICATION());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>