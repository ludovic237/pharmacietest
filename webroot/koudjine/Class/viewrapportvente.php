<?php

class venteview
{
    private $_venteId,
        $_userNom,
        $_userPrenom,
        $_ventePrixTotal,
        $_ventePrixPercu,
        $_venteDateVente,
        $_venteCommentaire,
        $_venteMalade_id,
        $_venteEtat,
        $_venteReference,
        $_venteNouveau_info,
        $_venteUser_id,
        $_ventePrescripteur_id,
        $_venteEmploye_id,
        $_venteReduction,
        $_venteCaisseId,
        $_caisseId,
        $_caisseEtat,
        $_conVenteview_id,
        $_conProduit_id,
        $_conEn_rayon_id,
        $_conPrixUnit,
        $_conQuantite,
        $_conReduction,
        $_enrayId,
        $_fourNom,
        $_fourStatut,
        $_pdtNom,
        $_pdtStock,
        $_pdtGrossisteId,
        $_pdtEtat;

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
    public function userNom()
    {
        return $this->_userNom;
    }
    public function userPrenom()
    {
        return $this->_userPrenom;
    }
    public function ventePrixTotal()
    {
        return $this->_ventePrixTotal;
    }
    public function ventePrixPercu()
    {
        return $this->_ventePrixPercu;
    }
    public function venteDateVente()
    {
        return $this->_venteDateVente;
    }
    public function venteCommentaire()
    {
        return $this->_venteCommentaire;
    }
    public function venteMalade_id()
    {
        return $this->_venteMalade_id;
    }
    public function venteEtat()
    {
        return $this->_venteEtat;
    }
    public function venteReference()
    {
        return $this->_venteReference;
    }
    public function venteNouveau_info()
    {
        return $this->_venteNouveau_info;
    }
    public function venteUser_id()
    {
        return $this->_venteUser_id;
    }
    public function ventePrescripteur_id()
    {
        return $this->_ventePrescripteur_id;
    }
    public function venteEmploye_id()
    {
        return $this->_venteEmploye_id;
    }
    public function venteReduction()
    {
        return $this->_venteReduction;
    }
    public function venteCaisseId()
    {
        return $this->_venteCaisseId;
    }
    public function caisseId()
    {
        return $this->_caisseId;
    }
    public function caisseEtat()
    {
        return $this->_caisseEtat;
    }
    public function conVenteview_id()
    {
        return $this->_conVenteview_id;
    }
    public function conProduit_id()
    {
        return $this->_conProduit_id;
    }
    public function conEn_rayon_id()
    {
        return $this->_conEn_rayon_id;
    }
    public function conPrixUnit()
    {
        return $this->_conPrixUnit;
    }
    public function conQuantite()
    {
        return $this->_conQuantite;
    }
    public function conReduction()
    {
        return $this->_conReduction;
    }
    public function enrayId()
    {
        return $this->_enrayId;
    }
    public function fourNom()
    {
        return $this->_fourNom;
    }
    public function fourStatut()
    {
        return $this->_fourStatut;
    }
    public function pdtNom()
    {
        return $this->_pdtNom;
    }
    public function pdtStock()
    {
        return $this->_pdtStock;
    }
    public function pdtGrossisteId()
    {
        return $this->_pdtGrossisteId;
    }
    public function pdtEtat()
    {
        return $this->_pdtEtat;
    }


    // SETTERS
    public function setventeId($id)
    {
            $this->_venteId = $id;
    }
    public function setuserNom($id)
    {
            $this->_userNom = $id;
    }
    public function setuserPrenom($id)
    {
            $this->_userPrenom = $id;
    }
    public function setventePrixTotal($id)
    {
            $this->_ventePrixTotal = $id;
    }
    public function setventePrixPercu($id)
    {
            $this->_ventePrixPercu = $id;
    }
    public function setventeDateVente($id)
    {
            $this->_venteDateVente = $id;
    }
    public function setventeCommentaire($id)
    {
            $this->_venteCommentaire = $id;
    }
    public function setventeMalade_id($id)
    {
            $this->_venteMalade_id = $id;
    }
    public function setventeEtat($id)
    {
            $this->_venteEtat = $id;
    }
    public function setventeReference($id)
    {
            $this->_venteReference = $id;
    }
    public function setventeNouveau_info($id)
    {
            $this->_venteNouveau_info = $id;
    }
    public function setventeUser_id($id)
    {
            $this->_venteUser_id = $id;
    }
    public function setventePrescripteur_id($id)
    {
            $this->_ventePrescripteur_id = $id;
    }
    public function setventeEmploye_id($id)
    {
            $this->_venteEmploye_id = $id;
    }
    public function setventeReduction($id)
    {
            $this->_venteReduction = $id;
    }
    public function setventeCaisseId($id)
    {
            $this->_venteCaisseId = $id;
    }
    public function setcaisseId($id)
    {
            $this->_caisseId = $id;
    }
    public function setcaisseEtat($id)
    {
            $this->_caisseEtat = $id;
    }
    public function setconVenteview_id($id)
    {
            $this->_conVenteview_id = $id;
    }
    public function setconProduit_id($id)
    {
            $this->_conProduit_id = $id;
    }
    public function setconEn_rayon_id($id)
    {
            $this->_conEn_rayon_id = $id;
    }
    public function setconPrixUnit($id)
    {
            $this->_conPrixUnit = $id;
    }
    public function setconQuantite($id)
    {
            $this->_conQuantite = $id;
    }
    public function setconReduction($id)
    {
            $this->_conReduction = $id;
    }
    public function setenrayId($id)
    {
            $this->_enrayId = $id;
    }
    public function setfourNom($id)
    {
            $this->_fourNom = $id;
    }
    public function setfourStatut($id)
    {
            $this->_fourStatut = $id;
    }
    public function setpdtNom($id)
    {
            $this->_pdtNom = $id;
    }
    public function setpdtStock($id)
    {
            $this->_pdtStock = $id;
    }
    public function setpdtGrossisteId($id)
    {
            $this->_pdtGrossisteId = $id;
    }
    public function setpdtEtat($id)
    {
            $this->_pdtEtat = $id;
    }


}

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
