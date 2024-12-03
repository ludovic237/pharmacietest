<?php

class Magasin
{
    private $_id,
        $_nom,
        $_code,
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
    public function code()
    {
        return $this->_code;
    }

    // SETTERS
    public function setid($id)
    {

        if ($id > 0)
        {
            $this->_id = $id;
        }
    }
    public function setnom($value)
    {

        $this->_nom = $value;

    }
    public function setcode($value)
    {

        $this->_code = $value;

    }

}

class MagasinManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Magasin $magasin)
    {
        $q = $this->_db->prepare('INSERT INTO magasin SET id = :id, nom = :nom, code = :code');
        $q->bindValue(':id', $magasin->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $magasin->nom());
        $q->bindValue(':code', $magasin->code());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM magasin WHERE supprimer = 0 ')->fetchColumn();
    }
    public function delete(Magasin $magasin)
    {
        $this->_db->exec('DELETE FROM magasin WHERE id = '.$magasin->id());
    }
    public function exists($info)
    {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM magasin WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function getNom($info)
    {
        $q = $this->_db->prepare('SELECT * FROM magasin WHERE supprimer = 0 AND nom = :nom');
        $q->execute(array(':nom' => $info));
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Magasin($donnees);

    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM magasin WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM magasin WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM magasin WHERE supprimer = 0 AND code = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsReference($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM magasin WHERE supprimer = 0 AND reference = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM magasin WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Magasin($donnees);

    }
    public function getList()
    {
        $magasins = array();
        $q = $this->_db->prepare('SELECT * FROM magasin WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $magasins[] = new Magasin($donnees);
        }
        return $magasins;
    }
    public function update(Magasin $magasin)
    {

        $q = $this->_db->prepare('UPDATE magasin SET nom = :nom, code = :code WHERE id = :id');
        $q->bindValue(':id', $magasin->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $magasin->nom());
        $q->bindValue(':code', $magasin->code());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>