<?php

class SortieStock
{
    private $_id,
        $_en_rayon_id,
        $_quantite,
        $_dateSortie,
        $_detail_id,
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
    public function en_rayon_id()
    {
        return $this->_en_rayon_id;
    }
    public function quantite()
    {
        return $this->_quantite;
    }
    public function dateSortie()
    {
        return $this->_dateSortie;
    }
    public function detail_id()
    {
        return $this->_detail_id;
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
    public function seten_rayon_id($id)
    {

        $this->_en_rayon_id = $id;

    }
    public function setquantite($id)
    {

        $this->_quantite = $id;

    }
    public function setdateSortie($id)
    {

        $this->_dateSortie = $id;

    }
    public function setdetail_id($id)
    {

        $this->_detail_id = $id;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class SortieStockManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(SortieStock $sortie_stock)
    {
        $q = $this->_db->prepare('INSERT INTO sortie_stock SET id = :id, en_rayon_id = :en_rayon_id, quantite = :quantite, dateSortie = now(), detail_id = :detail_id, supprimer=0');
        $q->bindValue(':id', $sortie_stock->id(), PDO::PARAM_INT);
        $q->bindValue(':en_rayon_id', $sortie_stock->en_rayon_id(), PDO::PARAM_INT);
        $q->bindValue(':quantite', $sortie_stock->quantite());
        $q->bindValue(':detail_id', $sortie_stock->detail_id());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM sortie_stock WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(SortieStock $sortie_stock)
    {
        $this->_db->exec('DELETE FROM sortie_stock WHERE id = '.$sortie_stock->id());
    }
    public function existsEn_rayon_id($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM sortie_stock WHERE supprimer = 0 AND en_rayon_id = '.$info)->fetchColumn();

    }
    public function existsDetail_id($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM sortie_stock WHERE supprimer = 0 AND detail_id = '.$info)->fetchColumn();

    }
    public function existsdateSortie($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM sortie_stock WHERE supprimer = 0 AND dateSortie = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM sortie_stock WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new sortie_stock($donnees);

    }
    public function getEn_rayon_id($info)
    {

        $q = $this->_db->query('SELECT * FROM sortie_stock WHERE supprimer = 0 AND en_rayon_id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new sortie_stock($donnees);

    }
    public function getDetail_id($info)
    {

        $q = $this->_db->query('SELECT * FROM sortie_stock WHERE supprimer = 0 AND detail_id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new sortie_stock($donnees);

    }
    public function getList()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM sortie_stock WHERE supprimer = 0 ORDER BY dateSortie');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new SortieStock($donnees);
        }
        return $produits;
    }
    public function update(SortieStock $sortie_stock)
    {
        $q = $this->_db->prepare('UPDATE sortie_stock SET en_rayon_id = :en_rayon_id, quantite = :quantite, dateSortie = now(), detail_id = :detail_id WHERE id = :id');
        $q->bindValue(':id', $sortie_stock->id(), PDO::PARAM_INT);
        $q->bindValue(':en_rayon_id', $sortie_stock->en_rayon_id(), PDO::PARAM_INT);
        $q->bindValue(':quantite', $sortie_stock->quantite());
        $q->bindValue(':detail_id', $sortie_stock->detail_id());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>