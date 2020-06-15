<?php

class Categorie
{
    private $_id,
        $_nom,
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
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class CategorieManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Categorie $categorie)
    {
        $q = $this->_db->prepare('INSERT INTO categorie SET id = :id, nom = :nom, supprimer=0');
        $q->bindValue(':id', $categorie->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $categorie->nom());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM categorie WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Categorie $categorie)
    {
        $this->_db->exec('DELETE FROM categorie WHERE id = '.$categorie->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM categorie WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM categorie WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM categorie WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsReference($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM categorie WHERE supprimer = 0 AND reference = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM categorie WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Categorie($donnees);

    }
    public function getList()
    {
        $categories = array();
        $q = $this->_db->prepare('SELECT * FROM categorie WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $categories[] = new Categorie($donnees);
        }
        return $categories;
    }
    public function update(Categorie $categorie)
    {

        $q = $this->_db->prepare('UPDATE categorie SET categorie_id = :cat, forme_id = :forme, rayon_id = :ray, fabriquant_id = :fab, magasin_id = :mag, nom = :nom, reference = :reference, ean13 = :ean13, codeLaborex = :laborex, codeUbipharm = :ubipharm, stock = :stock, stockMin = :stockmin, stockMax = :stockmax, reductionMax = :reduction WHERE id = :id');
        $q->bindValue(':id', $categorie->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $categorie->nom());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>