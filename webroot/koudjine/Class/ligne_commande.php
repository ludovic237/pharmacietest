<?php

class LigneCommande
{
    private $_id,
        $_type,
        $_dateDerniere,
        $_supprimer;

    // CONSRUCTEUR
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS
    public function id()
    {
        return $this->_id;
    }
    public function dateDerniere()
    {
        return $this->_dateDerniere;
    }
    public function type()
    {
        return $this->_type;
    }
    public function supprimer()
    {
        return $this->_supprimer;
    }

    // SETTERS
    public function setid($id)
    {

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setdateDerniere($value)
    {

        $this->_dateDerniere = $value;
    }
    public function settype($value)
    {

        $this->_type = $value;
    }

    public function setsupprimer($value)
    {

        $this->_supprimer = $value;
    }
}

class LigneCommandeManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(LigneCommande $LigneCommande)
    {
        $q = $this->_db->prepare('INSERT INTO ligne_commande SET id = :id, dateDerniere = :dateDerniere, type = :type, supprimer=0');
        $q->bindValue(':id', $LigneCommande->id(), PDO::PARAM_INT);
        $q->bindValue(':type', $LigneCommande->type());
        $q->bindValue(':dateDerniere', $LigneCommande->dateDerniere());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM ligne_commande WHERE supprimer = 0 ')->fetchColumn();
    }
    public function delete(LigneCommande $LigneCommande)
    {
        $this->_db->exec('DELETE FROM ligne_commande WHERE id = ' . $LigneCommande->id());
    }
    public function existsLastId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM ligne_commande ORDER BY `id` DESC LIMIT 1')->fetchColumn();
    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM ligne_commande WHERE supprimer = 0 AND id = ' . $info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new LigneCommande($donnees);
    }
    public function getLastId()
    {

        $q = $this->_db->query('SELECT * FROM ligne_commande ORDER BY `id` DESC LIMIT 1 ');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new LigneCommande($donnees);

    }
    public function getList()
    {
        $LigneCommandes = array();
        $q = $this->_db->prepare('SELECT * FROM ligne_commande WHERE supprimer = 0 ORDER BY type');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $LigneCommandes[] = new LigneCommande($donnees);
        }
        return $LigneCommandes;
    }
    public function getListType($type)
    {
        $LigneCommandes = array();
        $q = $this->_db->prepare('SELECT * FROM ligne_commande WHERE supprimer = 0 AND type = "'.$type.'"');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $LigneCommandes[] = new LigneCommande($donnees);
        }
        return $LigneCommandes;
    }
    public function update(LigneCommande $LigneCommande)
    {

        $q = $this->_db->prepare('UPDATE ligne_commande SET dateDerniere = :dateDerniere, type = :type WHERE id = :id');
        $q->bindValue(':id', $LigneCommande->id(), PDO::PARAM_INT);
        $q->bindValue(':dateDerniere', $LigneCommande->dateDerniere());
        $q->bindValue(':type', $LigneCommande->type());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
