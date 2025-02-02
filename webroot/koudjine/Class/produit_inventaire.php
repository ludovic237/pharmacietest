<?php

class Produit_inventaire
{
    private $_id,
        $_inventaire_id,
        $_employe_id,
        $_en_rayon_id,
        $_stockAvant,
        $_stockValide,
        $_date_debut,
        $_date_fin,
        $_type,
        $_statut,
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
    public function inventaire_id()
    {
        return $this->_inventaire_id;
    }
    public function employe_id()
    {
        return $this->_employe_id;
    }
    public function en_rayon_id()
    {
        return $this->_en_rayon_id;
    }
    public function stockAvant()
    {
        return $this->_stockAvant;
    }
    public function stockValide()
    {
        return $this->_stockValide;
    }
    public function date_debut()
    {
        return $this->_date_debut;
    }
    public function date_fin()
    {
        return $this->_date_fin;
    }
    public function type()
    {
        return $this->_type;
    }
    public function statut()
    {
        return $this->_statut;
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
    public function setinventaire_id($id)
    {

        if ($id > 0)
        {
            $this->_inventaire_id = $id;
        }
    }
    public function setemploye_id($id)
    {

        if ($id > 0)
        {
            $this->_employe_id = $id;
        }
    }
    public function seten_rayon_id($id)
    {
            $this->_en_rayon_id = $id;
    }
    public function setstockAvant($id)
    {
            $this->_stockAvant = $id;
    }
    public function setstockValide($id)
    {
            $this->_stockValide = $id;
    }
    public function setdate_debut($id)
    {
        $this->_date_debut = $id;
    }
    public function setdate_fin($id)
    {
        $this->_date_fin = $id;
    }
    public function settype($id)
    {
        $this->_type = $id;
    }
    public function setstatut($id)
    {
        $this->_statut = $id;
    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class Produit_inventaireManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Produit_inventaire $produit_inventaire)
    {
        $q = $this->_db->prepare('INSERT INTO produit_inventaire SET id = :id, inventaire_id = :inventaire_id, employe_id = :employe_id, en_rayon_id = :en_rayon_id, stockAvant = :stockAvant, stockValide = :stockValide, date_debut = now(), date_fin = :date_fin, type = :type, statut = :statut, supprimer=0');
        $q->bindValue(':id', $produit_inventaire->id(), PDO::PARAM_INT);
        $q->bindValue(':inventaire_id', $produit_inventaire->inventaire_id(), PDO::PARAM_INT);
        $q->bindValue(':employe_id', $produit_inventaire->employe_id(), PDO::PARAM_INT);
        $q->bindValue(':en_rayon_id', $produit_inventaire->en_rayon_id());
        $q->bindValue(':stockAvant', $produit_inventaire->stockAvant());
        $q->bindValue(':stockValide', $produit_inventaire->stockValide());
        $q->bindValue(':date_fin', $produit_inventaire->date_fin());
        $q->bindValue(':type', $produit_inventaire->type());
        $q->bindValue(':statut', $produit_inventaire->statut());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM produit_inventaire WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Produit_inventaire $produit_inventaire)
    {
        $this->_db->exec('DELETE FROM produit_inventaire WHERE id = '.$produit_inventaire->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM produit_inventaire WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }

    public function existsinventaire_id($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit_inventaire WHERE supprimer = 0 AND inventaire_id = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEn_rayon($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit_inventaire WHERE supprimer = 0 AND en_rayon_id = '.$info.' AND inventaire_id = '.$id);
        $q->execute();
        return (bool) $q->fetchColumn();


    }
    public function existsQuantite($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit_inventaire WHERE supprimer = 0 AND quantite = :info AND id = '.$id);
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM produit_inventaire WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Produit_inventaire($donnees);

    }
    public function getEn_rayon($id, $info)
    {

        $q = $this->_db->query('SELECT * FROM produit_inventaire WHERE supprimer = 0 AND en_rayon_id = '.$info.' AND inventaire_id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Produit_inventaire($donnees);

    }
    public function getList($info)
    {
        $produit_inventaires = array();
        $q = $this->_db->prepare('SELECT * FROM produit_inventaire WHERE supprimer = 0 AND inventaire_id = '.$info);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produit_inventaires[] = new Produit_inventaire($donnees);
        }
        return $produit_inventaires;
    }
    public function getListProduit($info)
    {
        $produit_inventaires = array();
        $q = $this->_db->prepare('SELECT p.stockValide as qte, e.dateLivraison as dateL, e.datePeremtion as dateP FROM produit_inventaire p, en_rayon e, produit r WHERE p.supprimer = 0 AND p.en_rayon_id = e.id AND e.produit_id = r.id AND r.id = '.$info);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produit_inventaires[] = new Produit_inventaire($donnees);
        }
        return $produit_inventaires;
    }


    public function update(Produit_inventaire $produit_inventaire)
    {

        $q = $this->_db->prepare('UPDATE produit_inventaire SET inventaire_id = :inventaire_id, employe_id = :employe_id, en_rayon_id = :en_rayon_id, stockAvant = :stockAvant, stockValide = :stockValide, date_debut = :date_debut, date_fin = :date_fin, type = :type, statut = :statut WHERE id = :id');
        $q->bindValue(':id', $produit_inventaire->id(), PDO::PARAM_INT);
        $q->bindValue(':inventaire_id', $produit_inventaire->inventaire_id(), PDO::PARAM_INT);
        $q->bindValue(':employe_id', $produit_inventaire->employe_id(), PDO::PARAM_INT);
        $q->bindValue(':en_rayon_id', $produit_inventaire->en_rayon_id());
        $q->bindValue(':stockAvant', $produit_inventaire->stockAvant());
        $q->bindValue(':stockValide', $produit_inventaire->stockValide());
        $q->bindValue(':date_debut', $produit_inventaire->date_debut());
        $q->bindValue(':date_fin', $produit_inventaire->date_fin());
        $q->bindValue(':type', $produit_inventaire->type());
        $q->bindValue(':statut', $produit_inventaire->statut());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
