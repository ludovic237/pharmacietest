<?php

class Inventaire
{
    private $_id,
        $_dateDebut,
        $_dateFin,
        $_etat,
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
    public function dateDebut()
    {
        return $this->_dateDebut;
    }
    public function dateFin()
    {
        return $this->_dateFin;
    }
    public function etat()
    {
        return $this->_etat;
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
    public function setdateDebut($id)
    {
            $this->_dateDebut = $id;
    }
    public function setdateFin($id)
    {
            $this->_dateFin = $id;
    }
    public function setetat($id)
    {
            $this->_etat = $id;
    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class InventaireManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Inventaire $inventaire)
    {
        $q = $this->_db->prepare('INSERT INTO inventaire SET id = :id, dateDebut = now(), dateFin = :dateFin, etat = :etat, supprimer=0');
        $q->bindValue(':id', $inventaire->id(), PDO::PARAM_INT);
        $q->bindValue(':dateFin', $inventaire->dateFin());
        $q->bindValue(':etat', $inventaire->etat());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM inventaire WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Inventaire $inventaire)
    {
        $this->_db->exec('DELETE FROM inventaire WHERE id = '.$inventaire->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM inventaire WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }

    public function existsdateDebut($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM inventaire WHERE supprimer = 0 AND dateDebut = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsQuantite($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM inventaire WHERE supprimer = 0 AND quantite = :info AND id = '.$id);
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get()
    {

        $q = $this->_db->query('SELECT * FROM inventaire WHERE supprimer = 0 AND etat = "En cours" ');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Inventaire($donnees);

    }
    public function getList($info)
    {
        $inventaires = array();
        $q = $this->_db->prepare('SELECT * FROM inventaire WHERE supprimer = 0 AND quantiteRestante > 0 AND dateDebut = '.$info.' ORDER BY etat ASC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $inventaires[] = new Inventaire($donnees);
        }
        return $inventaires;
    }
    public function update(Inventaire $inventaire)
    {

        $q = $this->_db->prepare('UPDATE inventaire SET dateFin = now(), etat = :etat WHERE id = :id');
        $q->bindValue(':id', $inventaire->id(), PDO::PARAM_INT);
        $q->bindValue(':etat', $inventaire->etat());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
