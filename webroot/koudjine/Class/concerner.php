<?php

class Concerner
{
    private $_id,
        $_vente_id,
        $_produit_id,
        $_en_rayon_id,
        $_prixUnit,
        $_quantite,
        $_reduction,
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
    public function produit_id()
    {
        return $this->_produit_id;
    }
    public function en_rayon_id()
    {
        return $this->_en_rayon_id;
    }
    public function vente_id()
    {
        return $this->_vente_id;
    }
    public function prixUnit()
    {
        return $this->_prixUnit;
    }
    public function quantite()
    {
        return $this->_quantite;
    }
    public function reduction()
    {
        return $this->_reduction;
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
    public function setvente_id($id)
    {

        if ($id > 0)
        {
            $this->_vente_id = $id;
        }
    }
    public function setproduit_id($id)
    {

        if ($id > 0)
        {
            $this->_produit_id = $id;
        }
    }
    public function seten_rayon_id($id)
    {

        if ($id > 0)
        {
            $this->_en_rayon_id = $id;
        }
    }
    public function setprixUnit($id)
    {

        if ($id > 0)
        {
            $this->_prixUnit = $id;
        }
    }
    public function setquantite($id)
    {

        if ($id > 0)
        {
            $this->_quantite = $id;
        }
    }
    public function setreduction($id)
    {

        if ($id >= 0)
        {
            $this->_reduction = $id;
        }
    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class ConcernerManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Concerner $concerner)
    {
        $q = $this->_db->prepare('INSERT INTO concerner SET id = :id, vente_id = :vente_id, produit_id = :produit_id, en_rayon_id = :en_rayon_id, prixUnit = :prixUnit, quantite = :quantite, reduction = :reduction, supprimer=0');
        $q->bindValue(':id', $concerner->id(), PDO::PARAM_INT);
        $q->bindValue(':vente_id', $concerner->vente_id(), PDO::PARAM_INT);
        $q->bindValue(':produit_id', $concerner->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':en_rayon_id', $concerner->en_rayon_id(), PDO::PARAM_INT);
        $q->bindValue(':prixUnit', $concerner->prixUnit());
        $q->bindValue(':quantite', $concerner->quantite());
        $q->bindValue(':reduction', $concerner->reduction());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM concerner WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Concerner $concerner)
    {
        $this->_db->exec('DELETE FROM concerner WHERE id = '.$concerner->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM concerner WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsEn_rayonId($idv, $ide)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM concerner WHERE supprimer = 0 AND vente_id = '.$idv.' AND en_rayon_id = '.$ide)->fetchColumn();

    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM concerner WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
  
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM concerner WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Concerner($donnees);

    }
    public function getList()
    {
        $concerners = array();
        $q = $this->_db->prepare('SELECT * FROM concerner WHERE supprimer = 0 ORDER BY nouveau_info');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $concerners[] = new Concerner($donnees);
        }
        return $concerners;
    }
    public function update(Concerner $concerner)
    {

        $q = $this->_db->prepare('UPDATE concerncer SET vente_id = :vente_id,produit_id = :produit_id, en_rayon_id = :en_rayon_id,prixUnit = :prixUnit, quantite = :quantite, reduction = :reduction WHERE id = :id');
        $q->bindValue(':id', $concerner->id(), PDO::PARAM_INT);
        $q->bindValue(':vente_id', $concerner->vente_id(), PDO::PARAM_INT);
        $q->bindValue(':produit_id', $concerner->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':en_rayon_id', $concerner->en_rayon_id(), PDO::PARAM_INT);
        $q->bindValue(':prixUnit', $concerner->prixUnit());
        $q->bindValue(':quantite', $concerner->quantite());
        $q->bindValue(':reduction', $concerner->reduction());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>