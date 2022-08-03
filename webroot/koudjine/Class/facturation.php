<?php

class Facturation
{
    private $_id,
        $_vente_id,
        $_caisse_id,
        $_typePaiement,
        $_montantPercu,
        $_reste,
        $_montantTtc,
        $_dateFacture,
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
    public function vente_id()
    {
        return $this->_vente_id;
    }
    public function caisse_id()
    {
        return $this->_caisse_id;
    }
    public function typePaiement()
    {
        return $this->_typePaiement;
    }
    public function montantPercu()
    {
        return $this->_montantPercu;
    }
    public function reste()
    {
        return $this->_reste;
    }
    public function montantTtc()
    {
        return $this->_montantTtc;
    }
    public function dateFacture()
    {
        return $this->_dateFacture;
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
    public function setvente_id($id)
    {

        if ($id > 0)
        {
            $this->_vente_id = $id;
        }
    }
    public function setcaisse_id($id)
    {

        if ($id > 0)
        {
            $this->_caisse_id = $id;
        }
    }
    public function settypePaiement($id)
    {
            $this->_typePaiement = $id;
    }
    public function setmontantPercu($id)
    {
            $this->_montantPercu = $id;
    }
    public function setmontantTtc($id)
    {
            $this->_montantTtc = $id;
    }
    public function setreste($id)
    {

            $this->_reste = $id;
    }
    public function setdateFacture($value)
    {

        $this->_dateFacture = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class FacturationManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Facturation $facturation)
    {
        $q = $this->_db->prepare('INSERT INTO facturation SET id = :id, vente_id = :vente_id, caisse_id = :caisse_id, typePaiement = :typePaiement, montantPercu = :montantPercu, montantTtc = :montant, reste = :reste, dateFacture = now(), supprimer=0');
        $q->bindValue(':id', $facturation->id(), PDO::PARAM_INT);
        $q->bindValue(':vente_id', $facturation->vente_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $facturation->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':typePaiement', $facturation->typePaiement());
        $q->bindValue(':montantPercu', $facturation->montantPercu());
        $q->bindValue(':montant', $facturation->montantTtc());
        $q->bindValue(':reste', $facturation->reste());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM facturation WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Facturation $facturation)
    {
        $this->_db->exec('DELETE FROM facturation WHERE id = '.$facturation->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM facturation WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }

    public function existsvente_id($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM facturation WHERE supprimer = 0 AND vente_id = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsdateFacture($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM facturation WHERE supprimer = 0 AND dateFacture >= :info AND id = '.$id);
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsQuantite($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM facturation WHERE supprimer = 0 AND quantite = :info AND id = '.$id);
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM facturation WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Facturation($donnees);

    }
    public function getVente($info)
    {

        $q = $this->_db->query('SELECT * FROM facturation WHERE supprimer = 0 AND vente_id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Facturation($donnees);

    }
    public function getList($info)
    {
        $facturation = array();
        $q = $this->_db->prepare('SELECT * FROM facturation WHERE supprimer = 0 AND vente_id = '.$info.' ORDER BY typePaiement ASC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $facturation[] = new Facturation($donnees);
        }
        return $facturation;
    }
    public function getListCaisseType($caisse_id, $type)
    {
        $facturation = array();
        $q = $this->_db->prepare('SELECT * FROM facturation WHERE supprimer = 0 AND caisse_id = '.$caisse_id.' AND typePaiement = "'.$type.'" ORDER BY typePaiement ASC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $facturation[] = new Facturation($donnees);
        }
        return $facturation;
    }

    public function getListByCaisse($caisse_id)
    {
        $facturation = array();
        $q = $this->_db->prepare('SELECT * FROM facturation WHERE supprimer = 0 AND caisse_id = '.$caisse_id.'  ORDER BY typePaiement ASC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $facturation[] = new Facturation($donnees);
        }
        return $facturation;
    }
    public function update(Facturation $facturation)
    {

        $q = $this->_db->prepare('UPDATE facturation SET vente_id = :vente_id, caisse_id = :caisse_id, typePaiement = :typePaiement, montantPercu = :montantPercu, montantTtc = :prixv, reste = :prica, quantite = :quantite, dateFacture = :dateFacture, reduction = :reduction WHERE id = :id');
        $q->bindValue(':id', $facturation->id(), PDO::PARAM_INT);
        $q->bindValue(':vente_id', $facturation->vente_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $facturation->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':typePaiement', $facturation->typePaiement());
        $q->bindValue(':montantPercu', $facturation->montantPercu());
        $q->bindValue(':prixv', $facturation->montantTtc());
        $q->bindValue(':prixa', $facturation->reste());
        $q->bindValue(':dateFacture', $facturation->dateFacture());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
