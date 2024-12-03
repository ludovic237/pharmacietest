<?php

class CategorieFiliere
{
    private $_CATEGORIE_ID,
        $_NOM,
        $_DESCRIPTION,
        $_SLUG,
        $_SUPPRIMER;

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
    public function CATEGORIE_ID()
    {
        return $this->_CATEGORIE_ID;
    }
    public function NOM()
    {
        return $this->_NOM;
    }
    public function DESCRIPTION()
    {
        return $this->_DESCRIPTION;
    }
    public function SLUG()
    {
        return $this->_SLUG;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }

    // SETTERS
    public function setCATEGORIE_ID($id)
    {

        if ($id > 0)
        {
            $this->_CATEGORIE_ID = $id;
        }
    }
    public function setNOM($nom)
    {

        $this->_NOM = $nom;

    }
    public function setDESCRIPTION($description)
    {

        $this->_DESCRIPTION = $description;

    }
    public function setSLUG($slug)
    {

        $this->_SLUG = $slug;

    }
    public function setSUPPRIMER($del)
    {

        $this->_SUPPRIMER = $del;

    }

}

class CategorieFiliereManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(CategorieFiliere $categorie)
    {
        $q = $this->_db->prepare('INSERT INTO categorie_filiere SET CATEGORIE_ID = :catid, NOM = :nom, DESCRIPTION = :description, SLUG = :slug, SUPPRIMER = 0');
        $q->bindValue(':catid', $categorie->CATEGORIE_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $categorie->NOM());
        $q->bindValue(':description', $categorie->DESCRIPTION());
        $q->bindValue(':slug', $categorie->SLUG());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM categorie_filiere')->fetchColumn();
    }
    public function delete(CategorieFiliere $categorie)
    {
        $this->_db->exec('DELETE FROM categorie_filiere WHERE id = '.$categorie->CATEGORIE_ID());
    }
    public function exists($info)
    {
        return (bool) $this->_db->query('SELECT COUNT(*) FROM categorie_filiere WHERE SUPPRIMER = 0 AND CATEGORIE_ID = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM categorie_filiere WHERE SUPPRIMER = 0 AND NOM = :nom');
        $q->execute(array(':nom' => $info));
        return (bool) $q->fetchColumn();

    }
    public function getNom($info)
    {
        $q = $this->_db->prepare('SELECT * FROM categorie_filiere WHERE SUPPRIMER = 0 AND NOM = :nom');
        $q->execute(array(':nom' => $info));
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new CategorieFiliere($donnees);

    }
    public function get($info)
    {
        $q = $this->_db->query('SELECT * FROM categorie_filiere WHERE SUPPRIMER = 0 AND CATEGORIE_ID = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new CategorieFiliere($donnees);


    }
    public function getList()
    {
        $Types = array();
        $q = $this->_db->prepare('SELECT * FROM categorie_filiere WHERE SUPPRIMER = 0  ORDER BY CATEGORIE_ID');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Types[] = new CategorieFiliere($donnees);
        }
        return $Types;
    }
    public function update(CategorieFiliere $categorie)
    {
        $q = $this->_db->prepare('UPDATE categorie_filiere SET NOM = :nom, DESCRIPTION = :description, SLUG = :slug WHERE CATEGORIE_ID= :id');
        $q->bindValue(':id', $categorie->CATEGORIE_ID(), PDO::PARAM_INT);
        $q->bindValue(':nom', $categorie->NOM());
        $q->bindValue(':description', $categorie->DESCRIPTION());
        $q->bindValue(':slug', $categorie->SLUG());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>