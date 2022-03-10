<?php

class Rayon
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

class RayonManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Rayon $rayon)
    {
        $q = $this->_db->prepare('INSERT INTO rayon SET id = :id, nom = :nom, code = :code');
        $q->bindValue(':id', $rayon->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $rayon->nom());
        $q->bindValue(':code', $rayon->code());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM rayon WHERE supprimer = 0 ')->fetchColumn();
    }
    public function delete(Rayon $rayon)
    {
        $this->_db->exec('DELETE FROM rayon WHERE id = '.$rayon->id());
    }
    public function exists($info)
    {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM rayon WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function getNom($info)
    {
        $q = $this->_db->prepare('SELECT * FROM rayon WHERE supprimer = 0 AND nom = :nom');
        $q->execute(array(':nom' => $info));
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Rayon($donnees);

    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM rayon WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM rayon WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM rayon WHERE supprimer = 0 AND code = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsReference($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM rayon WHERE supprimer = 0 AND reference = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM rayon WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Rayon($donnees);

    }
    public function getList()
    {
        $rayons = array();
        $q = $this->_db->prepare('SELECT * FROM rayon WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $rayons[] = new Rayon($donnees);
        }
        return $rayons;
    }
    public function update(Rayon $rayon)
    {

        $q = $this->_db->prepare('UPDATE rayon SET nom = :nom, code = :code WHERE id = :id');
        $q->bindValue(':id', $rayon->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $rayon->nom());
        $q->bindValue(':code', $rayon->code());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>