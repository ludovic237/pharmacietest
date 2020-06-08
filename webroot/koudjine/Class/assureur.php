<?php

class Assureur
{
    private $_id,
        $_nom,
        $_telephone,
        $_taux,
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
    public function taux()
    {
        return $this->_taux;
    }
    public function telephone()
    {
        return $this->_telephone;
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
    
    public function setnom($value)
    {

        $this->_nom = $value;

    }
    public function settaux($value)
    {

        $this->_taux = $value;

    }
    public function settelephone($value)
    {

        $this->_telephone = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class AssureurManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Assureur $assureur)
    {
        $q = $this->_db->prepare('INSERT INTO assureur SET id = :id, nom = :nom, taux = :taux, telephone = :telephone, supprimer=0');
        $q->bindValue(':id', $assureur->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $assureur->nom());
        $q->bindValue(':taux', $assureur->taux());
        $q->bindValue(':telephone', $assureur->telephone());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM assureur WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Assureur $assureur)
    {
        $this->_db->exec('DELETE FROM assureur WHERE id = '.$assureur->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM assureur WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM assureur WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM assureur WHERE supprimer = 0 AND telephone = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existstaux($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM assureur WHERE supprimer = 0 AND taux = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM assureur WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Assureur($donnees);

    }
    public function getList()
    {
        $assureurs = array();
        $q = $this->_db->prepare('SELECT * FROM assureur WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $assureurs[] = new Assureur($donnees);
        }
        return $assureurs;
    }
    public function update(Assureur $assureur)
    {

        $q = $this->_db->prepare('UPDATE assureur SET nom = :nom, taux = :taux, telephone = :telephone WHERE id = :id');
        $q->bindValue(':id', $assureur->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $assureur->nom());
        $q->bindValue(':taux', $assureur->taux());
        $q->bindValue(':telephone', $assureur->telephone());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>