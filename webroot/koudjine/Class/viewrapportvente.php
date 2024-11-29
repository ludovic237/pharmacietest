<?php


class VenteviewViewManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Venteview $vente)
    {
        $q = $this->_db->prepare('INSERT INTO vente SET id = :id, employe_id = :employe, malade_id = :malade, user_id = :user1, prescripteur_id = :prescripteur, prixTotal = :prixTotal, prixPercu = :montant, nouveau_info = :nouveau_info, reference = :reference, venteDateVente = now(), commentaire = :commentaire, reduction = :reduction, etat = :etat, caisse_id = :caisse, supprimer=0');
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
        return $this->_db->query('SELECT COUNT(*) FROM pharma_vente_rapport_view WHERE supprimer = 0 ')->fetchColumn();
    }
    public function countMois()
    {
        return $this->_db->query('SELECT COUNT(*) FROM pharma_vente_rapport_view WHERE supprimer = 0 AND MONTH(dateVente) = MONTH(NOW()) AND YEAR(venteDateVente) = YEAR(NOW()) ')->fetchColumn();
    }
    public function delete(Venteview $vente)
    {
        $this->_db->exec('DELETE FROM pharma_vente_rapport_view WHERE id = '.$vente->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM pharma_vente_rapport_view WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsnouveau_info($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM pharma_vente_rapport_view WHERE supprimer = 0 AND nouveau_info = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM pharma_vente_rapport_view WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }

    public function getListCaisseCompleteByEtat_3($id,$type)
    {
//        echo $id;
//        echo $type;
        $ventes = array();
        $q = $this->_db->prepare("SELECT * FROM pharma_vente_rapport_view WHERE caisseId = ".$id." AND venteEtat = '".$type."' AND ventePrixPercu <> 0 ORDER BY venteDateVente DESC");
        $q->execute();
//        echo ' - ';
//        echo json_encode($q->fetch(PDO::FETCH_ASSOC));
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
//        echo json_encode($ventes);
//        echo ' 1235 ';
        return $ventes;
    }

    public function existsventeDateVente($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM pharma_vente_rapport_view WHERE supprimer = 0 AND venteDateVente = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Venteview($donnees);

    }
    public function getList()
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 ORDER BY venteDateVente');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }
    public function getListRange($start,$end)
    {
        $ventes = array();
        $q = $this->_db->prepare("SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND `venteDateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH ) ORDER BY venteDateVente");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }
    public function getListRangeNow($start)
    {
        $ventes = array();
        $q = $this->_db->prepare("SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND `venteDateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( now(),INTERVAL 0  MONTH ) ORDER BY venteDateVente");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }
    public function getListCaisse($id)
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND caisse_id = '.$id.' AND prixPercu = 0 ORDER BY venteDateVente');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListCaisseVenteview($id)
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND caisse_id = '.$id);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListCaisseEmployeVenteview($id)
    {
        $ventes = array();
        $q = $this->_db->prepare("SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND caisse_id = ".$id);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function VenteviewActuMois()
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND venteDateVente > DATE_SUB(now(), INTERVAL 1 MONTH) ');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function VenteviewCountEtat($text)
    {
        $q = $this->_db->prepare("SELECT COUNT(*) as total FROM pharma_vente_rapport_view WHERE etat LIKE '%$text%' ");
        //$q = $this->_db->prepare("SELECT COUNT(*) as total FROM pharma_vente_rapport_view WHERE etat LIKE '%comptant%' ");
        $q->execute();
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return $donnees;
    }

    public function getDateVenteview($info)
    {

        $q = $this->_db->query( 'SELECT `venteDateVente` FROM `vente` WHERE `id`='.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Venteview($donnees);


    }

    public function getDateVenteviewRange($start,$end)
    {
        //$q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 ORDER BY venteDateVente');
        //$q = $this->_db->query( 'SELECT * FROM `vente` WHERE `venteDateVente` BETWEEN DATE_SUB( "2020-05-23 05:33:46",INTERVAL 0  MONTH ) AND DATE_SUB( "2020-10-23 05:33:46",INTERVAL 0  MONTH )');
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE `venteDateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;


    }

    public function getDateVenteviewRangeBegin($start)
    {
        //$q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 ORDER BY venteDateVente');
        //$q = $this->_db->query( 'SELECT * FROM `vente` WHERE `venteDateVente` BETWEEN DATE_SUB( "2020-05-23 05:33:46",INTERVAL 0  MONTH ) AND DATE_SUB( "2020-10-23 05:33:46",INTERVAL 0  MONTH )');
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE `venteDateVente` < DATE_SUB( '".$start."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;


    }

    public function getDateVenteviewRangeEnd($end)
    {
        //$q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 ORDER BY venteDateVente');
        //$q = $this->_db->query( 'SELECT * FROM `vente` WHERE `venteDateVente` BETWEEN DATE_SUB( "2020-05-23 05:33:46",INTERVAL 0  MONTH ) AND DATE_SUB( "2020-10-23 05:33:46",INTERVAL 0  MONTH )');
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE `venteDateVente` > DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;


    }

    public function getDateVenteviewRangeCaisse($start,$end, $caisse_id)
    {
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE caisse_id = '.$caisse_id.' AND `venteDateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListVenteviewRangeEmploye($start,$end, $employe_id)
    {
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE employe_id = ".$employe_id." AND `venteDateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListVenteviewRange($start,$end)
    {
        $q = $this->_db->prepare( "SELECT * FROM `vente` WHERE `venteDateVente` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH )");
        $ventes = array();
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListCaisseComplete($id)
    {
        $ventes = array();
        $q = $this->_db->prepare('SELECT * FROM pharma_vente_rapport_view WHERE supprimer = 0 AND caisse_id = '.$id.' AND prixPercu <> 0 ORDER BY venteDateVente DESC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListCaisseCompleteByEtat($id,$type)
    {
        $ventes = array();
        $q = $this->_db->prepare("SELECT v.id as id, c.id as idc, v.venteDateVente, v.prixTotal, v.prixPercu, v.supprimer, v.reference, v.etat, c.dateOuvert, c.dateFerme, c.user_id FROM pharma_vente_rapport_view v, caisse c WHERE v.supprimer = 0  AND c.id = ".$id." AND v.etat = '".$type."' AND v.venteDateVente BETWEEN DATE_SUB( c.dateOuvert,INTERVAL 0  MONTH) AND DATE_SUB( c.dateFerme,INTERVAL 0  MONTH ) ORDER BY v.venteDateVente DESC");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListCaisseCompleteByEtatOuvert($id,$type)
    {
        $ventes = array();
        $q = $this->_db->prepare("SELECT v.id as id, c.id as idc, v.venteDateVente, v.prixTotal, v.prixPercu, v.supprimer, v.reference, v.etat, c.dateOuvert, c.dateFerme, c.user_id FROM pharma_vente_rapport_view v, caisse c WHERE v.supprimer = 0  AND c.id = ".$id." AND v.etat = '".$type."' AND v.venteDateVente BETWEEN DATE_SUB( c.dateOuvert,INTERVAL 0  MONTH) AND DATE_SUB( NOW(),INTERVAL 0  MONTH ) ORDER BY v.venteDateVente DESC");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function getListCaisseCompleteByEtat_2($id,$type)
    {
        $ventes = array();
        $q = $this->_db->prepare("SELECT v.id as id, c.id as idc, v.venteDateVente, v.prixPercu, v.supprimer, v.reference, v.etat, c.dateOuvert, c.dateFerme, c.user_id FROM pharma_vente_rapport_view v, caisse c WHERE v.supprimer = 0  AND v.caisse_id = c.id AND c.id = ".$id." AND v.etat = '".$type."' AND v.prixPercu <> 0 ORDER BY v.venteDateVente DESC");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            if ($donnees === false) {
                $donnees = [];
            }
            $ventes[] = new Venteview($donnees);
        }
        return $ventes;
    }

    public function update(Venteview $vente)
    {

        $q = $this->_db->prepare('UPDATE vente SET employe_id = :employe, user_id = :user, prescripteur_id = :prescripteur, malade_id = :malade, caisse_id = :caisse, prixTotal = :prixTotal, prixPercu = :montant, nouveau_info = :nouveau_info, venteDateVente = :venteDateVente, commentaire = :commentaire, reduction = :reduction, etat = :etat WHERE id = :id');
        $q->bindValue(':id', $vente->id(), PDO::PARAM_INT);
        $q->bindValue(':employe', $vente->employe_id(), PDO::PARAM_INT);
        $q->bindValue(':caisse', $vente->caisse_id(), PDO::PARAM_INT);
        $q->bindValue(':malade', $vente->malade_id(), PDO::PARAM_INT);
        $q->bindValue(':user', $vente->user_id(), PDO::PARAM_INT);
        $q->bindValue(':prescripteur', $vente->prescripteur_id(), PDO::PARAM_INT);
        $q->bindValue(':prixTotal', $vente->prixTotal(), PDO::PARAM_INT);
        $q->bindValue(':montant', $vente->prixPercu(), PDO::PARAM_INT);
        $q->bindValue(':nouveau_info', $vente->nouveau_info());
        $q->bindValue(':venteDateVente', $vente->venteDateVente());
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
