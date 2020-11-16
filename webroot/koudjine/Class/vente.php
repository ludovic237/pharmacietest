<?php

class vente
{
    private $_id,
        $_employe_id,
        $_caisse_id,
        $_malade_id,
        $_user_id,
        $_prescripteur_id,
        $_prixTotal,
        $_reference,
        $_prixPercu,
        $_nouveau_info,
        $_dateVente,
        $_commentaire,
        $_reduction,
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
    public function caisse_id()
    {
        return $this->_caisse_id;
    }
    public function malade_id()
    {
        return $this->_malade_id;
    }
    public function employe_id()
    {
        return $this->_employe_id;
    }
    public function user_id()
    {
        return $this->_user_id;
    }
    public function prescripteur_id()
    {
        return $this->_prescripteur_id;
    }
    public function prixPercu()
    {
        return $this->_prixPercu;
    }
    public function prixTotal()
    {
        return $this->_prixTotal;
    }
    public function nouveau_info()
    {
        return $this->_nouveau_info;
    }
    public function reference()
    {
        return $this->_reference;
    }
    public function dateVente()
    {
        return $this->_dateVente;
    }
    public function commentaire()
    {
        return $this->_commentaire;
    }
    public function reduction()
    {
        return $this->_reduction;
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
    public function setemploye_id($id)
    {

        if ($id > 0)
        {
            $this->_employe_id = $id;
        }
    }
    public function setcaisse_id($id)
    {

        if ($id > 0)
        {
            $this->_caisse_id = $id;
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
    public function setprixTotal($id)
    {

        if ($id > 0)
        {
            $this->_prixTotal = $id;
        }
    }
    public function setprixPercu($id)
    {

            $this->_prixPercu = $id;

    }
    public function setnouveau_info($value)
    {

        $this->_nouveau_info = $value;

    }
    public function setreference($value)
    {

        $this->_reference = $value;

    }
    public function setdateVente($value)
    {

        $this->_dateVente = $value;

    }
    public function setcommentaire($value)
    {

        $this->_commentaire = $value;

    }
    public function setreduction($value)
    {

        $this->_reduction = $value;

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
        $q = $this->_db->prepare('INSERT INTO vente SET id = :id, employe_id = :employe, malade_id = :malade, user_id = :user1, prescripteur_id = :prescripteur, prixTotal = :prixTotal, prixPercu = :montant, nouveau_info = :nouveau_info, reference = :reference, dateVente = now(), commentaire = :commentaire, reduction = :reduction, etat = :etat, caisse_id = :caisse, supprimer=0');
        $q->bindValue(':id', $vente->id(), PDO::PARAM_INT);
        $q->bindValue(':employe', $vente->employe_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse', $vente->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':malade', $vente->malade_id(), PDO::PARAM_INT);
        $q->bindValue(':user1', $vente->user_id(), PDO::PARAM_INT);
        $q->bindValue(':prescripteur', $vente->prescripteur_id(), PDO::PARAM_INT);
        $q->bindValue(':prixTotal', $vente->prixTotal(), PDO::PARAM_INT);
        $q->bindValue(':montant', $vente->prixPercu(), PDO::PARAM_INT);
        $q->bindValue(':nouveau_info', $vente->nouveau_info());
        $q->bindValue(':reference', $vente->reference());
        $q->bindValue(':commentaire', $vente->commentaire());
        $q->bindValue(':reduction', $vente->reduction());
        $q->bindValue(':etat', $vente->etat());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM vente WHERE supprimer = 0 ')->fetchColumn();
    }
    public function countMois()
    {
        return $this->_db->query('SELECT COUNT(*) FROM vente WHERE supprimer = 0 AND MONTH(dateVente) = MONTH(NOW()) AND YEAR(dateVente) = YEAR(NOW()) ')->fetchColumn();
    }
    public function delete(Vente $vente)
    {
        $this->_db->exec('DELETE FROM vente WHERE id = '.$vente->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM vente WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsnouveau_info($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM vente WHERE supprimer = 0 AND nouveau_info = :info');
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
        $q = $this->_db->prepare('SELECT * FROM vente WHERE supprimer = 0 ORDER BY dateVente');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }
    public function getListRange($start,$end)
    {
        $ventes = array();
        $q = $this->_db->prepare("SELECT * FROM vente WHERE supprimer = 0 AND `dateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH ) ORDER BY dateVente");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }
    public function getListCaisse($id)
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM vente WHERE supprimer = 0 AND caisse_id = '.$id.' AND prixPercu = 0 ORDER BY dateVente');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }

    public function getListCaisseVente($id)
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM vente WHERE supprimer = 0 AND caisse_id = '.$id);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }

    public function VenteActuMois()
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM vente WHERE supprimer = 0 AND DATE_FORMAT(CURDATE() ,"%Y-%m-01") AND CURDATE()');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    } 

    public function VenteCountEtat($text)
    {
        $q = $this->_db->prepare("SELECT COUNT(*) as total FROM vente WHERE etat LIKE '%$text%' ");
        //$q = $this->_db->prepare("SELECT COUNT(*) as total FROM vente WHERE etat LIKE '%comptant%' ");
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return $donnees;
    } 

    public function getDateVente($info)
    {

        $q = $this->_db->query( 'SELECT `dateVente` FROM `vente` WHERE `id`='.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Vente($donnees);


    }

    public function getDateVenteRange($start,$end)
    {
        //$q = $this->_db->prepare('SELECT * FROM vente WHERE supprimer = 0 ORDER BY dateVente');
        //$q = $this->_db->query( 'SELECT * FROM `vente` WHERE `dateVente` BETWEEN DATE_SUB( "2020-05-23 05:33:46",INTERVAL 0  MONTH ) AND DATE_SUB( "2020-10-23 05:33:46",INTERVAL 0  MONTH )');
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE `dateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;


    }

    public function getDateVenteRangeCaisse($start,$end, $caisse_id)
    {
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE caisse_id = '.$caisse_id.' AND `dateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }

    public function getListVenteRangeEmploye($start,$end, $employe_id)
    {
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE employe_id = ".$employe_id." AND `dateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }

    public function getListCaisseComplete($id)
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM vente WHERE supprimer = 0 AND caisse_id = '.$id.' AND prixPercu <> 0 ORDER BY dateVente DESC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $ventes[] = new Vente($donnees);
        }
        return $ventes;
    }
    
    public function update(Vente $vente)
    {

        $q = $this->_db->prepare('UPDATE vente SET employe_id = :employe, user_id = :user, prescripteur_id = :prescripteur, malade_id = :malade, caisse_id = :caisse, prixTotal = :prixTotal, prixPercu = :montant, nouveau_info = :nouveau_info, dateVente = :dateVente, commentaire = :commentaire, reduction = :reduction, etat = :etat WHERE id = :id');
        $q->bindValue(':id', $vente->id(), PDO::PARAM_INT);
        $q->bindValue(':employe', $vente->employe_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse', $vente->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':malade', $vente->malade_id(), PDO::PARAM_INT);
        $q->bindValue(':user', $vente->user_id(), PDO::PARAM_INT);
        $q->bindValue(':prescripteur', $vente->prescripteur_id(), PDO::PARAM_INT);
        $q->bindValue(':prixTotal', $vente->prixTotal(), PDO::PARAM_INT);
        $q->bindValue(':montant', $vente->prixPercu(), PDO::PARAM_INT);
        $q->bindValue(':nouveau_info', $vente->nouveau_info());
        $q->bindValue(':dateVente', $vente->dateVente());
        $q->bindValue(':commentaire', $vente->commentaire());
        $q->bindValue(':reduction', $vente->reduction());
        $q->bindValue(':etat', $vente->etat());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
