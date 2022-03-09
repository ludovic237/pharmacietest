<?php

class lignecaisse
{
    private $_id,
        $_produit_id,
        $_caisse_id,
        $_libelle,
        $_dateLigne,
        $_debit,
        $_credit,
        $_type,
        $_refProduit,
        $_motif,
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
    public function caisse_id()
    {
        return $this->_caisse_id;
    }
    public function libelle()
    {
        return $this->_libelle;
    }
    public function produit_id()
    {
        return $this->_produit_id;
    }
    public function dateLigne()
    {
        return $this->_dateLigne;
    }
    public function prixTotal()
    {
        return $this->_prixTotal;
    }
    public function debit()
    {
        return $this->_debit;
    }
    public function credit()
    {
        return $this->_credit;
    }
    public function type()
    {
        return $this->_type;
    }
    public function refProduit()
    {
        return $this->_refProduit;
    }
    public function motif()
    {
        return $this->_motif;
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
    public function setproduit_id($id)
    {

        if ($id > 0)
        {
            $this->_produit_id = $id;
        }
    }
    public function setcaisse_id($id)
    {

        if ($id > 0)
        {
            $this->_caisse_id = $id;
        }
    }
    public function setlibelle($id)
    {

        if ($id > 0)
        {
            $this->_libelle = $id;
        }
    }
    public function setdateLigne($id)
    {

        if ($id > 0)
        {
            $this->_dateLigne = $id;
        }
    }
    public function setdebit($value)
    {

        $this->_debit = $value;

    }
    public function setcredit($value)
    {

        $this->_credit = $value;

    }
    public function settype($value)
    {

        $this->_type = $value;

    }
    public function setrefProduit($value)
    {

        $this->_refProduit = $value;

    }
    public function setmotif($value)
    {

        $this->_motif = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class LignecaisseManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Lignecaisse $lignecaisse)
    {
        $q = $this->_db->prepare('INSERT INTO ligne_caisse SET id = :id,produit_id = :produit_id, libelle = :libelle, caisse_id = :caisse_id, dateLigne = :dateLigne, debit = :debit, credit = :credit, type = :type, refProduit = :refProduit, motif = :motif , supprimer=0');
        $q->bindValue(':id', $lignecaisse->id(), PDO::PARAM_INT);
        $q->bindValue(':produit_id', $lignecaisse->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $lignecaisse->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':libelle', $lignecaisse->libelle());
        $q->bindValue(':dateLigne', $lignecaisse->dateLigne());
        $q->bindValue(':debit', $lignecaisse->debit());
        $q->bindValue(':credit', $lignecaisse->credit());
        $q->bindValue(':type', $lignecaisse->type());
        $q->bindValue(':refProduit', $lignecaisse->refProduit());
        $q->bindValue(':motif', $lignecaisse->motif());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM ligne_caisse WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Lignecaisse $lignecaisse)
    {
        $this->_db->exec('DELETE FROM ligne_caisse WHERE id = '.$lignecaisse->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM ligne_caisse WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsdebit($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM ligne_caisse WHERE supprimer = 0 AND debit = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM ligne_caisse WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existscredit($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM ligne_caisse WHERE supprimer = 0 AND credit = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM ligne_caisse WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Lignecaisse($donnees);

    }
    public function getList()
    {
        $lignecaisses = array();
        $q = $this->_db->prepare('SELECT * FROM ligne_caisse WHERE supprimer = 0 ORDER BY debit');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $lignecaisses[] = new Lignecaisse($donnees);
        }
        return $lignecaisses;
    }
    public function update(Lignecaisse $lignecaisse)
    {

        $q = $this->_db->prepare('UPDATE ligne_caisse SET produit_id = :produit_id, libelle = :libelle, caisse_id = :caisse_id, dateLigne = :dateLigne, debit = :debit, credit = :credit, type = :type, refProduit = :refProduit, motif = :motif WHERE id = :id');
        $q->bindValue(':id', $lignecaisse->id(), PDO::PARAM_INT);
        $q->bindValue(':produit_id', $lignecaisse->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $lignecaisse->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':libelle', $lignecaisse->libelle());
        $q->bindValue(':dateLigne', $lignecaisse->dateLigne());
        $q->bindValue(':debit', $lignecaisse->debit());
        $q->bindValue(':credit', $lignecaisse->credit());
        $q->bindValue(':type', $lignecaisse->type());
        $q->bindValue(':refProduit', $lignecaisse->refProduit());
        $q->bindValue(':motif', $lignecaisse->motif());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>