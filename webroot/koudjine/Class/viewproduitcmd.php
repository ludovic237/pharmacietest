<?php

class Produit_cmd_view
{
    private $_nom,
        $_ean13,
        $_puCmd,
        $_ptCmd,
        $_qtiteCmd,
        $_etat,
        $_ref,
        $_montantCmd,
        $_fournisseurName,
        $_montantRecu,
        $_dateCreation,
        $_dateLivraison;

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
    public function nom()
    {
        return $this->_nom;
    }
    public function ean13()
    {
        return $this->_ean13;
    }
    public function puCmd()
    {
        return $this->_puCmd;
    }
    public function fournisseurName()
    {
        return $this->_fournisseurName;
    }
    public function ptCmd()
    {
        return $this->_ptCmd;
    }
    public function qtiteCmd()
    {
        return $this->_qtiteCmd;
    }
    public function etat()
    {
        return $this->_etat;
    }
    public function ref()
    {
        return $this->_ref;
    }
    public function montantCmd()
    {
        return $this->_montantCmd;
    }
    public function montantRecu()
    {
        return $this->_montantRecu;
    }
    public function dateCreation()
    {
        return $this->_dateCreation;
    }
    public function dateLivraison()
    {
        return $this->_dateLivraison;
    }

    // SETTERS
    public function setnom($id)
    {

        if ($id > 0)
        {
            $this->_nom = $id;
        }
    }
    public function setean13($id)
    {

        if ($id > 0)
        {
            $this->_ean13 = $id;
        }
    }
    public function setpuCmd($id)
    {

        if ($id > 0)
        {
            $this->_puCmd = $id;
        }
    }
    public function setptCmd($id)
    {

        if ($id > 0)
        {
            $this->_ptCmd = $id;
        }
    }
    public function setqtiteCmd($id)
    {

        if ($id > 0)
        {
            $this->_qtiteCmd = $id;
        }
    }
    public function setetat($id)
    {

        if ($id > 0)
        {
            $this->_etat = $id;
        }
    }
    public function setref($id)
    {

        if ($id > 0)
        {
            $this->_ref = $id;
        }
    }
    public function setmontantCmd($id)
    {

        if ($id > 0)
        {
            $this->_montantCmd = $id;
        }
    }
    public function setmontantRecu($value)
    {

        $this->_montantRecu = $value;

    }
    public function setdateCreation($value)
    {

        $this->_dateCreation = $value;

    }
    public function setdateLivraison($value)
    {

        $this->_dateLivraison = $value;

    }
    public function setfournisseurName($value)
    {

        $this->_fournisseurName = $value;

    }
}

class ProduitcmdViewManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM pharma_produit_commande_view')->fetchColumn();
    }

    public function getAll()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_produit_commande_view');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new Produit_cmd_view($donnees);
        }
        return $produits;
    }

    public function getAllLast()
    {

        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_produit_commande_view  WHERE dateLivraison IN(SELECT max(dateLivraison) FROM  pharma_produit_commande_view where nom=pharma_produit_commande_view.nom)');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new Produit_cmd_view($donnees);
        }
        return $produits;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>