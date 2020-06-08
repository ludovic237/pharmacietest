<?php

class vente
{
    private $_id,
        $_malade_id,
        $_user_id,
        $_prescripteur_id,
        $_reduction,
        $_montantRegle,
        $_reelPercu,
        $_dateVente,
        $_commentaire,
        $_ref,
        $_etat,
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
    public function malade_id()
    {
        return $this->_malade_id;
    }
    public function user_id()
    {
        return $this->_user_id;
    }
    public function prescripteur_id()
    {
        return $this->_prescripteur_id;
    }
    public function montantRegle()
    {
        return $this->_montantRegle;
    }
    public function reduction()
    {
        return $this->_reduction;
    }
    public function reelPercu()
    {
        return $this->_reelPercu;
    }
    public function dateVente()
    {
        return $this->_dateVente;
    }
    public function commentaire()
    {
        return $this->_commentaire;
    }
    public function ref()
    {
        return $this->_ref;
    }
    public function etat()
    {
        return $this->_etat;
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
    public function setmalade_id($id)
    {

        if ($id > 0)
        {
            $this->_malade_id = $id;
        }
    }
    public function setuser_id($id)
    {

        if ($id > 0)
        {
            $this->_user_id = $id;
        }
    }
    public function setprescripteur_id($id)
    {

        if ($id > 0)
        {
            $this->_prescripteur_id = $id;
        }
    }
    public function setreduction($id)
    {

        if ($id > 0)
        {
            $this->_reduction = $id;
        }
    }
    public function setmontantRegle($id)
    {

        if ($id > 0)
        {
            $this->_montantRegle = $id;
        }
    }
    public function setreelPercu($value)
    {

        $this->_reelPercu = $value;

    }
    public function setdateVente($value)
    {

        $this->_dateVente = $value;

    }
    public function setcommentaire($value)
    {

        $this->_commentaire = $value;

    }
    public function setref($value)
    {

        $this->_ref = $value;

    }
    public function setetat($value)
    {

        $this->_etat = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class VenteManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Vente $vente)
    {
        $q = $this->_db->prepare('INSERT INTO vente SET id = :id, malade_id = :malade, user_id = :user, prescripteur_id = :prescripteur, reduction = :reduction, montantRegle = :montant, reelPercu = :reelPercu, dateVente = :dateVente, commentaire = :commentaire, ref = :ref, etat = :etat, supprimer=0');
        $q->bindValue(':id', $vente->id(), PDO::PARAM_INT);
        $q->bindValue(':malade', $vente->malade_id(), PDO::PARAM_INT);
        $q->bindValue(':user', $vente->user_id(), PDO::PARAM_INT);
        $q->bindValue(':prescripteur', $vente->prescripteur_id(), PDO::PARAM_INT);
        $q->bindValue(':reduction', $vente->reduction(), PDO::PARAM_INT);
        $q->bindValue(':montant', $vente->montantRegle(), PDO::PARAM_INT);
        $q->bindValue(':reelPercu', $vente->reelPercu());
        $q->bindValue(':dateVente', $vente->dateVente());
        $q->bindValue(':commentaire', $vente->commentaire());
        $q->bindValue(':ref', $vente->ref());
        $q->bindValue(':etat', $vente->etat());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM vente WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Vente $vente)
    {
        $this->_db->exec('DELETE FROM vente WHERE id = '.$vente->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM vente WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsreelPercu($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM vente WHERE supprimer = 0 AND reelPercu = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM vente WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsdateVente($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM vente WHERE supprimer = 0 AND dateVente = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM vente WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Vente($donnees);

    }
    public function getList()
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM vente WHERE supprimer = 0 ORDER BY reelPercu');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }
    public function update(Vente $vente)
    {

        $q = $this->_db->prepare('UPDATE vente SET malade_id = :malade, user_id = :user, prescripteur_id = :prescripteur, reduction = :reduction, montantRegle = :montant, reelPercu = :reelPercu, dateVente = :dateVente, commentaire = :commentaire, ref = :ref, etat = :etat WHERE id = :id');
        $q->bindValue(':id', $vente->id(), PDO::PARAM_INT);
        $q->bindValue(':malade', $vente->malade_id(), PDO::PARAM_INT);
        $q->bindValue(':user', $vente->user_id(), PDO::PARAM_INT);
        $q->bindValue(':prescripteur', $vente->prescripteur_id(), PDO::PARAM_INT);
        $q->bindValue(':reduction', $vente->reduction(), PDO::PARAM_INT);
        $q->bindValue(':montant', $vente->montantRegle(), PDO::PARAM_INT);
        $q->bindValue(':reelPercu', $vente->reelPercu());
        $q->bindValue(':dateVente', $vente->dateVente());
        $q->bindValue(':commentaire', $vente->commentaire());
        $q->bindValue(':ref', $vente->ref());
        $q->bindValue(':etat', $vente->etat());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>