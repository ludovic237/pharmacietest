<?php

class Unite
{
    private $_id,
        $_nom,
        $_libelle,
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
    public function libelle()
    {
        return $this->_libelle;
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
    public function setlibelle($value)
    {

        $this->_libelle = $value;

    }

}

class UniteManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Unite $unite)
    {
        $q = $this->_db->prepare('INSERT INTO unite SET id = :id, nom = :nom, libelle = :libelle');
        $q->bindValue(':id', $unite->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $unite->nom());
        $q->bindValue(':libelle', $unite->libelle());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM unite WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Unite $unite)
    {
        $this->_db->exec('DELETE FROM unite WHERE id = '.$unite->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM unite WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM unite WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM unite WHERE supprimer = 0 AND libelle = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsReference($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM unite WHERE supprimer = 0 AND reference = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM unite WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new unite($donnees);

    }
    public function getList()
    {
        $unites = array();
        $q = $this->_db->prepare('SELECT * FROM unite WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $unites[] = new Unite($donnees);
        }
        return $unites;
    }
    public function update(Unite $unite)
    {

        $q = $this->_db->prepare('UPDATE unite SET nom = :nom, libelle = :libelle WHERE id = :id');
        $q->bindValue(':id', $unite->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $unite->nom());
        $q->bindValue(':libelle', $unite->libelle());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>