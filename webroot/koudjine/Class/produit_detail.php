<?php

class produit_detail
{
    private $_id,
        $_nom,
        $_reference,
        $_stock,
        $_stockMin,
        $_stockMax,
        $_reductionMax,
        $_prix,
        $_grossiste_list,
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
    public function grossiste_list()
    {
        return $this->_grossiste_list;
    }
    public function nom()
    {
        return $this->_nom;
    }
    public function reference()
    {
        return $this->_reference;
    }
    public function stock()
    {
        return $this->_stock;
    }
    public function stockMin()
    {
        return $this->_stockMin;
    }
    public function stockMax()
    {
        return $this->_stockMax;
    }
    public function prix()
    {
        return $this->_prix;
    }
    public function reductionMax()
    {
        return $this->_reductionMax;
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
    public function setgrossiste_list($value)
    {

        $this->_grossiste_list = $value;

    }
    public function setnom($value)
    {

        $this->_nom = $value;

    }
    public function setreference($value)
    {

        $this->_reference = $value;

    }
    public function setstock($value)
    {

        $this->_stock = $value;

    }
    public function setstockMin($value)
    {

        $this->_stockMin = $value;

    }
    public function setstockMax($value)
    {

        $this->_stockMax = $value;

    }
    public function setreductionMax($value)
    {

        $this->_reductionMax = $value;

    }
    public function setprix($value)
    {

        $this->_prix = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class Produit_detailManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Produit_detail $produit_detail)
    {
        $q = $this->_db->prepare('INSERT INTO produit_detail SET id = :id, grossiste_list = :grossiste, nom = :nom, reference = :reference, prix = :prix, stock = :stock, stockMin = :stockmin, stockMax = :stockmax, reductionMax = :reduction, supprimer=0');
        $q->bindValue(':id', $produit_detail->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $produit_detail->nom());
        $q->bindValue(':grossiste', $produit_detail->grossiste_list());
        $q->bindValue(':reference', $produit_detail->reference());
        $q->bindValue(':stock', $produit_detail->stock());
        $q->bindValue(':stockmin', $produit_detail->stockMin());
        $q->bindValue(':stockmax', $produit_detail->stockMax(), PDO::PARAM_INT);
        $q->bindValue(':reduction', $produit_detail->reductionMax());
        $q->bindValue(':prix', $produit_detail->prix());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM produit_detail WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Produit_detail $produit_detail)
    {
        $this->_db->exec('DELETE FROM produit_detail WHERE id = '.$produit_detail->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM produit_detail WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsStock($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit_detail WHERE supprimer = 0 AND stock >= '.$info.' AND id = '.$id);
        return (bool) $q->fetchColumn();


    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit_detail WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsReference($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit_detail WHERE supprimer = 0 AND reference = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {
        if ($info!=null){
            $q = $this->_db->query('SELECT * FROM produit_detail WHERE supprimer = 0 AND id = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new produit_detail($donnees);
        }
        $donnees=array();
        return new produit_detail($donnees);
    }
    public function getNom($info)
    {

        $q = $this->_db->query('SELECT * FROM produit_detail WHERE supprimer = 0 AND nom = "'.$info.'"');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new produit_detail($donnees);

    }
    public function getLast()
    {

        $q = $this->_db->query('SELECT * FROM produit_detail WHERE supprimer = 0 order by id desc limit 1');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new produit_detail($donnees);

    }
    public function getStock($id, $info)
    {

        $q = $this->_db->query('SELECT * FROM produit_detail WHERE supprimer = 0 AND stock >= '.$info.' AND id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new produit_detail($donnees);


    }
    public function getList()
    {
        $produit_details = array();
        $q = $this->_db->prepare('SELECT * FROM produit_detail WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produit_details[] = new produit_detail($donnees);
        }
        return $produit_details;
    }
    public function update(produit_detail $produit_detail)
    {

        $q = $this->_db->prepare('UPDATE produit_detail SET grossiste_list = :grossiste, nom = :nom, reference = :reference, prix = :prix, stock = :stock, stockMin = :stockmin, stockMax = :stockmax, reductionMax = :reduction WHERE id = :id');
        $q->bindValue(':id', $produit_detail->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $produit_detail->nom());
        $q->bindValue(':grossiste', $produit_detail->grossiste_list());
        $q->bindValue(':reference', $produit_detail->reference());
        $q->bindValue(':stock', $produit_detail->stock());
        $q->bindValue(':stockmin', $produit_detail->stockMin());
        $q->bindValue(':stockmax', $produit_detail->stockMax(), PDO::PARAM_INT);
        $q->bindValue(':reduction', $produit_detail->reductionMax());
        $q->bindValue(':prix', $produit_detail->prix());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>