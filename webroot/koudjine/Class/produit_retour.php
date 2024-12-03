<?php

class ProduitRetour
{
    private $_id,
        $_retour_produit_id,
        $_concerner_id,
        $_quantite,
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
    public function retour_produit_id()
    {
        return $this->_retour_produit_id;
    }
    public function concerner_id()
    {
        return $this->_concerner_id;
    }
    public function quantite()
    {
        return $this->_quantite;
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
    public function setretour_produit_id($id)
    {

        $this->_retour_produit_id = $id;

    }
    public function setconcerner_id($id)
    {

        $this->_concerner_id = $id;

    }
    public function setquantite($id)
    {

        $this->_quantite = $id;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class ProduitRetourManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(ProduitRetour $produit_retour)
    {
        $q = $this->_db->prepare('INSERT INTO produit_retour SET id = :id, retour_produit_id = :retour_produit_id, concerner_id = :concerner_id, quantite = :quantite, supprimer=0');
        $q->bindValue(':id', $produit_retour->id(), PDO::PARAM_INT);
        $q->bindValue(':retour_produit_id', $produit_retour->retour_produit_id(), PDO::PARAM_INT);
        $q->bindValue(':concerner_id', $produit_retour->concerner_id(), PDO::PARAM_INT);
        $q->bindValue(':quantite', $produit_retour->quantite());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM produit_retour WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(ProduitRetour $produit_retour)
    {
        $this->_db->exec('DELETE FROM produit_retour WHERE id = '.$produit_retour->id());
    }
    public function existsretour_produit_id($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM produit_retour WHERE supprimer = 0 AND retour_produit_id = '.$info)->fetchColumn();

    }
    public function existsdateRetour($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit_retour WHERE supprimer = 0 AND dateRetour = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM produit_retour WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new ProduitRetour($donnees);

    }
    public function getListRetourProduitId($info)
    {
        $stocks = array();
        $q = $this->_db->prepare('SELECT * FROM produit_retour WHERE supprimer = 0 AND retour_produit_id = '.$info);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $stocks[] = new ProduitRetour($donnees);
        }
        return $stocks;

    }
    public function getListEnRayonId($info)
    {
        $stocks = array();
        $q = $this->_db->prepare('SELECT * FROM produit_retour WHERE supprimer = 0 AND concerner_id = '.$info);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $stocks[] = new ProduitRetour($donnees);
        }
        return $stocks;

    }
    public function getList()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM produit_retour WHERE supprimer = 0 ORDER BY concerner_id');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new ProduitRetour($donnees);
        }
        return $produits;
    }
    public function update(ProduitRetour $produit_retour           )
    {
        $q = $this->_db->prepare('UPDATE produit_retour SET retour_produit_id = :retour_produit_id, concerner_id = :concerner_id, quantite = :quantite WHERE id = :id');
        $q->bindValue(':id', $produit_retour->id(), PDO::PARAM_INT);
        $q->bindValue(':retour_produit_id', $produit_retour->retour_produit_id(), PDO::PARAM_INT);
        $q->bindValue(':concerner_id', $produit_retour->concerner_id());
        $q->bindValue(':quantite', $produit_retour->quantite());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
