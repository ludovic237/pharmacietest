<?php

class Concerner_view
{
    private $_venteId,
        $_concernerId,
        $_concernerQuantite,
        $_concernerPrixUnit,
        $_concernerReduction,
        $_venteReference,
        $_ventePrixPercu,
        $_ventePrixTotal,
        $_enrayPrixAchat,
        $_enrayPrixVente,
        $_enrayDateLivraison,
        $_enrayDatePeremption,
        $_enrayQuantiteRayon,
        $_enrayQuantiteRestante,
        $_nom,
        $_produitId,
        $_venteDateVente;

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
    public function venteId()
    {
        return $this->_venteId;
    }
    public function concernerId()
    {
        return $this->_concernerId;
    }
    public function concernerQuantite()
    {
        return $this->_concernerQuantite;
    }
    public function concernerPrixUnit()
    {
        return $this->_concernerPrixUnit;
    }
    public function concernerReduction()
    {
        return $this->_concernerReduction;
    }
    public function venteReference()
    {
        return $this->_venteReference;
    }
    public function ventePrixPercu()
    {
        return $this->_ventePrixPercu;
    }
    public function ventePrixTotal()
    {
        return $this->_ventePrixTotal;
    }
    public function enrayPrixAchat()
    {
        return $this->_enrayPrixAchat;
    }
    public function enrayPrixVente()
    {
        return $this->_enrayPrixVente;
    }
    public function enrayDateLivraison()
    {
        return $this->_enrayDateLivraison;
    }
    public function enrayDatePeremption()
    {
        return $this->_enrayDatePeremption;
    }
    public function enrayQuantiteRayon()
    {
        return $this->_enrayQuantiteRayon;
    }
    public function enrayQuantiteRestante()
    {
        return $this->_enrayQuantiteRestante;
    }
    public function nom()
    {
        return $this->_nom;
    }
    public function produitId()
    {
        return $this->_produitId;
    }
    public function venteDateVente()
    {
        return $this->_venteDateVente;
    }

}

class ConcernerViewManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM pharma_concerner_view')->fetchColumn();
    }

    public function getAll()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_concerner_view');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new Concerner_view($donnees);
        }
        return $produits;
    }

    public function getAllLast()
    {

        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_concerner_view  WHERE dateLivraison IN(SELECT max(dateLivraison) FROM  pharma_concerner_view where nom=pharma_concerner_view.nom)');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new Concerner_view($donnees);
        }
        return $produits;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>