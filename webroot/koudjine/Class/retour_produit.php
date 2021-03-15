<?php

class RetourProduit
{
    private $_id,
        $_vente_id,
        $_employe_id,
        $_caisse_id,
        $_dateRetour,
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
    public function vente_id()
    {
        return $this->_vente_id;
    }
    public function employe_id()
    {
        return $this->_employe_id;
    }
    public function caisse_id()
    {
        return $this->_caisse_id;
    }
    public function dateRetour()
    {
        return $this->_dateRetour;
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

        $this->_vente_id = $id;

    }
    public function setemploye_id($id)
    {

        $this->_employe_id = $id;

    }
    public function setcaisse_id($id)
    {

        $this->_caisse_id = $id;

    }
    public function setdateRetour($id)
    {

        $this->_dateRetour = $id;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class RetourProduitManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(RetourProduit $retour_produit)
    {
        $q = $this->_db->prepare('INSERT INTO retour_produit SET id = :id, vente_id = :vente_id, employe_id = :employe_id, caisse_id = :caisse_id, dateRetour = now(), supprimer=0');
        $q->bindValue(':id', $retour_produit->id(), PDO::PARAM_INT);
        $q->bindValue(':vente_id', $retour_produit->vente_id(), PDO::PARAM_INT);
        $q->bindValue(':employe_id', $retour_produit->employe_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $retour_produit->caisse_id(), PDO::PARAM_INT);
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM retour_produit WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(RetourProduit $retour_produit)
    {
        $this->_db->exec('DELETE FROM retour_produit WHERE id = '.$retour_produit->id());
    }
    public function existsVente_id($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM retour_produit WHERE supprimer = 0 AND vente_id = '.$info)->fetchColumn();

    }
    public function existsdateRetour($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM retour_produit WHERE supprimer = 0 AND dateRetour = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM retour_produit WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new RetourProduit($donnees);

    }
    public function getLastId()
    {

        $q = $this->_db->query('SELECT * FROM retour_produit ORDER BY `id` DESC LIMIT 1 ');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new RetourProduit($donnees);

    }
    public function getVente_id($info)
    {

        $q = $this->_db->query('SELECT * FROM retour_produit WHERE supprimer = 0 AND vente_id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new RetourProduit($donnees);

    }

    public function getListEmployeId($info)
    {
        $stocks = array();
        $q = $this->_db->prepare('SELECT * FROM retour_produit WHERE supprimer = 0 AND employe_id = '.$info);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $stocks[] = new RetourProduit($donnees);
        }
        return $stocks;

    }
    public function getListCaisseId($info)
    {
        $stocks = array();
        $q = $this->_db->prepare('SELECT * FROM retour_produit WHERE supprimer = 0 AND caisse_id = '.$info);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $stocks[] = new RetourProduit($donnees);
        }
        return $stocks;

    }
    public function getList()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM retour_produit WHERE supprimer = 0 ORDER BY dateRetour');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new RetourProduit($donnees);
        }
        return $produits;
    }
    public function update(RetourProduit $retour_produit           )
    {
        $q = $this->_db->prepare('UPDATE retour_produit SET vente_id = :vente_id, employe_id = :employe_id, caisse_id = :caisse_id, dateRetour = :dateRetour WHERE id = :id');
        $q->bindValue(':id', $retour_produit->id(), PDO::PARAM_INT);
        $q->bindValue(':vente_id', $retour_produit->vente_id(), PDO::PARAM_INT);
        $q->bindValue(':employe_id', $retour_produit->employe_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $retour_produit->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':dateRetour', $retour_produit->dateRetour());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}