<?php

class Forme
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

class FormeManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Forme $forme)
    {
        $q = $this->_db->prepare('INSERT INTO forme SET id = :id, nom = :nom, code = :code');
        $q->bindValue(':id', $forme->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $forme->nom());
        $q->bindValue(':code', $forme->code());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM forme WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Forme $forme)
    {
        $this->_db->exec('DELETE FROM forme WHERE id = '.$forme->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM forme WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM forme WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM forme WHERE supprimer = 0 AND code = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsReference($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM forme WHERE supprimer = 0 AND reference = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM forme WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new forme($donnees);

    }
    public function getList()
    {
        $formes = array();
        $q = $this->_db->prepare('SELECT * FROM forme WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $formes[] = new Forme($donnees);
        }
        return $formes;
    }
    public function update(Forme $forme)
    {

        $q = $this->_db->prepare('UPDATE forme SET nom = :nom, code = :code WHERE id = :id');
        $q->bindValue(':id', $forme->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $forme->nom());
        $q->bindValue(':code', $forme->code());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>