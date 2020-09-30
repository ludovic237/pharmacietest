<?php

class Produit
{
    private $_id,
        $_categorie_id,
        $_forme_id,
        $_rayon_id,
        $_fabriquant_id,
        $_magasin_id,
        $_grossiste_id,
        $_nom,
        $_ean13,
        $_reference,
        $_codeLaborex,
        $_codeUbipharm,
        $_stock,
        $_stockMin,
        $_stockMax,
        $_reductionMax,
        $_etat,
        $_etagere,
        $_contenuDetail,
        $_prixDetail,
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
    public function categorie_id()
    {
        return $this->_categorie_id;
    }
    public function forme_id()
    {
        return $this->_forme_id;
    }
    public function rayon_id()
    {
        return $this->_rayon_id;
    }
    public function magasin_id()
    {
        return $this->_magasin_id;
    }
    public function grossiste_id()
    {
        return $this->_grossiste_id;
    }
    public function fabriquant_id()
    {
        return $this->_fabriquant_id;
    }
    public function nom()
    {
        return $this->_nom;
    }
    public function reference()
    {
        return $this->_reference;
    }
    public function ean13()
    {
        return $this->_ean13;
    }
    public function codeLaborex()
    {
        return $this->_codeLaborex;
    }
    public function codeUbipharm()
    {
        return $this->_codeUbipharm;
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
    public function etat()
    {
        return $this->_etat;
    }
    public function etagere()
    {
        return $this->_etagere;
    }
    public function contenuDetail()
    {
        return $this->_contenuDetail;
    }
    public function prixDetail()
    {
        return $this->_prixDetail;
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
    public function setcategorie_id($id)
    {

        if ($id > 0)
        {
            $this->_categorie_id = $id;
        }
    }
    public function setforme_id($id)
    {

        if ($id > 0)
        {
            $this->_forme_id = $id;
        }
    }
    public function setrayon_id($id)
    {

        if ($id > 0)
        {
            $this->_rayon_id = $id;
        }
    }
    public function setfabriquant_id($id)
    {

        if ($id > 0)
        {
            $this->_fabriquant_id = $id;
        }
    }
    public function setmagasin_id($id)
    {

        if ($id > 0)
        {
            $this->_magasin_id = $id;
        }
    }
    public function setgrossiste_id($value)
    {

        $this->_grossiste_id = $value;

    }
    public function setnom($value)
    {

        $this->_nom = $value;

    }
    public function setreference($value)
    {

        $this->_reference = $value;

    }
    public function setean13($value)
    {

        $this->_ean13 = $value;

    }
    public function setcodeLaborex($value)
    {

        $this->_codeLaborex = $value;

    }
    public function setcodeUbipharm($value)
    {

        $this->_codeUbipharm = $value;

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
    public function setetat($value)
    {

        $this->_etat = $value;

    }
    public function setetagere($value)
    {

        $this->_etagere = $value;

    }
    public function setcontenuDetail($value)
    {

        $this->_contenuDetail = $value;

    }
    public function setprixDetail($value)
    {

        $this->_prixDetail = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class ProduitManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Produit $produit)
    {
        $q = $this->_db->prepare('INSERT INTO produit SET id = :id, categorie_id = :cat, forme_id = :forme, rayon_id = :ray, fabriquant_id = :fab, magasin_id = :mag, grossiste_id = :grossiste, nom = :nom, reference = :reference, ean13 = :ean13, codeLaborex = :laborex, codeUbipharm = :ubipharm, etat = :etat, etagere = :etagere, contenuDetail = :contenuDetail, prixDetail = :prixDetail, stock = :stock, stockMin = :stockmin, stockMax = :stockmax, reductionMax = :reduction, supprimer=0');
        $q->bindValue(':id', $produit->id(), PDO::PARAM_INT);
        $q->bindValue(':cat', $produit->categorie_id(), PDO::PARAM_INT);
        $q->bindValue(':forme', $produit->forme_id(), PDO::PARAM_INT);
        $q->bindValue(':ray', $produit->rayon_id(), PDO::PARAM_INT);
        $q->bindValue(':fab', $produit->fabriquant_id(), PDO::PARAM_INT);
        $q->bindValue(':mag', $produit->magasin_id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $produit->nom());
        $q->bindValue(':grossiste', $produit->grossiste_id());
        $q->bindValue(':reference', $produit->reference());
        $q->bindValue(':ean13', $produit->ean13());
        $q->bindValue(':laborex', $produit->codeLaborex());
        $q->bindValue(':ubipharm', $produit->codeUbipharm());
        $q->bindValue(':stock', $produit->stock());
        $q->bindValue(':stockmin', $produit->stockMin());
        $q->bindValue(':stockmax', $produit->stockMax(), PDO::PARAM_INT);
        $q->bindValue(':reduction', $produit->reductionMax());
        $q->bindValue(':etat', $produit->etat());
        $q->bindValue(':etagere', $produit->etagere());
        $q->bindValue(':contenuDetail', $produit->contenuDetail());
        $q->bindValue(':prixDetail', $produit->prixDetail());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM produit WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Produit $produit)
    {
        $this->_db->exec('DELETE FROM produit WHERE id = '.$produit->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM produit WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsStock($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit WHERE supprimer = 0 AND stock >= '.$info.' AND id = '.$id);
        return (bool) $q->fetchColumn();


    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsReference($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM produit WHERE supprimer = 0 AND reference = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM produit WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new produit($donnees);

    }
    public function getLast()
    {

        $q = $this->_db->query('SELECT * FROM produit WHERE supprimer = 0 order by id desc limit 1');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new produit($donnees);

    }
    public function getStock($id, $info)
    {

        $q = $this->_db->query('SELECT * FROM produit WHERE supprimer = 0 AND stock >= '.$info.' AND id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new produit($donnees);


    }
    public function getList()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM produit WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new Produit($donnees);
        }
        return $produits;
    }
    public function getListEtat()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM produit WHERE supprimer = 0 AND etat = "Utile" ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new Produit($donnees);
        }
        return $produits;
    }
    public function update(Produit $produit)
    {

        $q = $this->_db->prepare('UPDATE produit SET categorie_id = :cat, forme_id = :forme, rayon_id = :ray, fabriquant_id = :fab, magasin_id = :mag, grossiste_id = :grossiste, nom = :nom, reference = :reference, ean13 = :ean13, etat = :etat, etagere = :etagere, contenuDetail = :contenuDetail, prixDetail = :prixDetail, codeLaborex = :laborex, codeUbipharm = :ubipharm, stock = :stock, stockMin = :stockmin, stockMax = :stockmax, reductionMax = :reduction WHERE id = :id');
        $q->bindValue(':id', $produit->id(), PDO::PARAM_INT);
        $q->bindValue(':cat', $produit->categorie_id(), PDO::PARAM_INT);
        $q->bindValue(':forme', $produit->forme_id(), PDO::PARAM_INT);
        $q->bindValue(':ray', $produit->rayon_id(), PDO::PARAM_INT);
        $q->bindValue(':fab', $produit->fabriquant_id(), PDO::PARAM_INT);
        $q->bindValue(':mag', $produit->magasin_id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $produit->nom());
        $q->bindValue(':grossiste', $produit->grossiste_id());
        $q->bindValue(':reference', $produit->reference());
        $q->bindValue(':ean13', $produit->ean13());
        $q->bindValue(':laborex', $produit->codeLaborex());
        $q->bindValue(':ubipharm', $produit->codeUbipharm());
        $q->bindValue(':stock', $produit->stock());
        $q->bindValue(':stockmin', $produit->stockMin());
        $q->bindValue(':stockmax', $produit->stockMax(), PDO::PARAM_INT);
        $q->bindValue(':reduction', $produit->reductionMax());
        $q->bindValue(':etat', $produit->etat());
        $q->bindValue(':etagere', $produit->etagere());
        $q->bindValue(':contenuDetail', $produit->contenuDetail());
        $q->bindValue(':prixDetail', $produit->prixDetail());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>