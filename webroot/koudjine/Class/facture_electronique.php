<?php

class FactureElectronique
{
    private $_id,
        $_facturation_id,
        $_numeroTelephone,
        $_montant,
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
    public function facturation_id()
    {
        return $this->_facturation_id;
    }
    public function numeroTelephone()
    {
        return $this->_numeroTelephone;
    }
    public function montant()
    {
        return $this->_montant;
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
    public function setfacturation_id($id)
    {

        if ($id > 0)
        {
            $this->_facturation_id = $id;
        }
    }
    public function setnumeroTelephone($id)
    {
            $this->_numeroTelephone = $id;
    }
    public function setmontant($id)
    {

        if ($id > 0)
        {
            $this->_montant = $id;
        }
    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class FactureElectroniqueManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(FactureElectronique $facturation)
    {
        $q = $this->_db->prepare('INSERT INTO facture_electronique SET id = :id, facturation_id = :facturation_id, numeroTelephone = :numeroTelephone, montant = :montant, supprimer=0');
        $q->bindValue(':id', $facturation->id(), PDO::PARAM_INT);
        $q->bindValue(':facturation_id', $facturation->facturation_id(), PDO::PARAM_INT);
        $q->bindValue(':montant', $facturation->montant(), PDO::PARAM_INT);
        $q->bindValue(':numeroTelephone', $facturation->numeroTelephone());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM facture_electronique WHERE supprimer = 0 ')->fetchColumn();
    }
    public function delete(FactureElectronique $facturation)
    {
        $this->_db->exec('DELETE FROM facture_electronique WHERE id = '.$facturation->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM facture_electronique WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }

    public function existsfacturation_id($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM facture_electronique WHERE supprimer = 0 AND facturation_id = '.$info);
        $q->execute();
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM facture_electronique WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new FactureElectronique($donnees);

    }
    public function getFacture($info)
    {

        $q = $this->_db->query('SELECT * FROM facture_electronique WHERE supprimer = 0 AND facturation_id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new FactureElectronique($donnees);

    }
    public function getList($info)
    {
        $facturation = array();
        $q = $this->_db->prepare('SELECT * FROM facture_electronique WHERE supprimer = 0 AND montant > '.$info.' ORDER BY montant ASC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $facturation[] = new FactureElectronique($donnees);
        }
        return $facturation;
    }
    public function update(FactureElectronique $facturation)
    {

        $q = $this->_db->prepare('UPDATE facture_electronique SET facturation_id = :facturation_id, numeroTelephone = :numeroTelephone, montant = :montant WHERE id = :id');
        $q->bindValue(':id', $facturation->id(), PDO::PARAM_INT);
        $q->bindValue(':facturation_id', $facturation->facturation_id(), PDO::PARAM_INT);
        $q->bindValue(':montant', $facturation->montant(), PDO::PARAM_INT);
        $q->bindValue(':numeroTelephone', $facturation->numeroTelephone());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
