<?php

class TypeSortie
{
    private $_id,
        $_nom,
        $_description,
        $_supprimer;

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
    public function id()
    {
        return $this->_id;
    }
    public function nom()
    {
        return $this->_nom;
    }
    public function description()
    {
        return $this->_description;
    }
    public function supprimer()
    {
        return $this->_supprimer;
    }

    // SETTERS
    public function setid($id)
    {

        if ($id > 0)
        {
            $this->_id = $id;
        }
    }
    public function setnom($nom)
    {

        $this->_nom = $nom;

    }
    public function setdescription($description)
    {

        $this->_description = $description;

    }
    public function setsupprimer($del)
    {

        $this->_supprimer = $del;

    }

}

class TypeSortieManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(TypeSortie $Type)
    {
        $q = $this->_db->prepare('INSERT INTO type_sortie SET id = :id, nom = :nom, description = :description, supprimer = 0');
        $q->bindValue(':id', $Type->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Type->nom());
        $q->bindValue(':description', $Type->description());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM type_sortie')->fetchColumn();
    }
    public function delete(TypeSortie $Type)
    {
        $this->_db->exec('DELETE FROM type_sortie WHERE id = '.$Type->id());
    }
    public function exists($info)
    {
        return (bool) $this->_db->query('SELECT COUNT(*) FROM type_sortie WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM type_sortie WHERE supprimer = 0 AND nom = :nom');
        $q->execute(array(':nom' => $info));
        return (bool) $q->fetchColumn();

    }
    public function getNom($info)
    {
        $q = $this->_db->prepare('SELECT * FROM type_sortie WHERE supprimer = 0 AND nom = :nom');
        $q->execute(array(':nom' => $info));
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new TypeSortie($donnees);

    }
    public function get($info)
    {
        $q = $this->_db->query('SELECT * FROM type_sortie WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new TypeSortie($donnees);


    }
    public function getList()
    {
        $Types = array();
        $q = $this->_db->prepare('SELECT * FROM type_sortie WHERE supprimer = 0  ORDER BY id');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Types[] = new TypeSortie($donnees);
        }
        return $Types;
    }
    public function update(TypeSortie $Type)
    {
        $q = $this->_db->prepare('UPDATE type_sortie SET nom = :nom, description = :description WHERE id= :id');
        $q->bindValue(':id', $Type->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $Type->nom());
        $q->bindValue(':description', $Type->description());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>