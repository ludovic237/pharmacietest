<?php

class Depense
{
    private $_id,
        $_caisse_id,
        $_designation,
        $_quantite,
        $_prixUnitaire,
        $_dateDepense,
        $_beneficiaire,
        $_numeroCni,
        $_dateDelivrance,
        $_lieuDelivrance,
        $_societe,
        $_typeDepense,
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
    public function designation()
    {
        return $this->_designation;
    }
    public function quantite()
    {
        return $this->_quantite;
    }
    public function dateDepense()
    {
        return $this->_dateDepense;
    }
    public function beneficiaire()
    {
        return $this->_beneficiaire;
    }
    public function prixUnitaire()
    {
        return $this->_prixUnitaire;
    }
    public function numeroCni()
    {
        return $this->_numeroCni;
    }
    public function lieuDelivrance()
    {
        return $this->_lieuDelivrance;
    }
    public function dateDelivrance()
    {
        return $this->_dateDelivrance;
    }
    public function societe()
    {
        return $this->_societe;
    }
    public function typeDepense()
    {
        return $this->_typeDepense;
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
    public function setcaisse_id($id)
    {

            $this->_caisse_id = $id;

    }
    public function setdesignation($id)
    {
            $this->_designation = $id;
    }
    public function setquantite($id)
    {
            $this->_quantite = $id;
    }
    public function setprixUnitaire($id)
    {
            $this->_prixUnitaire = $id;
    }
    public function setdateDepense($id)
    {

            $this->_dateDepense = $id;
    }
    public function setbeneficiaire($value)
    {

        $this->_beneficiaire = $value;

    }
    public function setnumeroCni($value)
    {

        $this->_numeroCni = $value;

    }
    public function setlieuDelivrance($value)
    {

        $this->_lieuDelivrance = $value;

    }
    public function setdateDelivrance($value)
    {

        $this->_dateDelivrance = $value;

    }
    public function setsociete($value)
    {

        $this->_societe = $value;

    }
    public function settypeDepense($value)
    {

        $this->_typeDepense = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class DepenseManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Depense $Depense)
    {
        $q = $this->_db->prepare('INSERT INTO depense SET id = :id, caisse_id = :caisse_id, designation = :designation, quantite = :quantite, prixUnitaire = :prixUnitaire, dateDepense = :dateDepense, beneficiaire = :beneficiaire, numeroCni = :numeroCni, lieuDelivrance = :lieuDelivrance, dateDelivrance = :dateDelivrance, societe = :societe, typeDepense = :typeDepense, supprimer=0');
        $q->bindValue(':id', $Depense->id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $Depense->caisse_id());
        $q->bindValue(':designation', $Depense->designation());
        $q->bindValue(':quantite', $Depense->quantite());
        $q->bindValue(':prixUnitaire', $Depense->prixUnitaire());
        $q->bindValue(':dateDepense', $Depense->dateDepense());
        $q->bindValue(':numeroCni', $Depense->numeroCni());
        $q->bindValue(':beneficiaire', $Depense->beneficiaire());
        $q->bindValue(':lieuDelivrance', $Depense->lieuDelivrance());
        $q->bindValue(':dateDelivrance', $Depense->dateDelivrance());
        $q->bindValue(':societe', $Depense->societe());
        $q->bindValue(':typeDepense', $Depense->typeDepense());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM depense WHERE supprimer = 0 ')->fetchColumn();
    }
    public function delete(Depense $Depense)
    {
        $this->_db->exec('DELETE FROM depense WHERE id = '.$Depense->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM depense WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsStock($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM depense WHERE supprimer = 0 AND stock >= '.$info.' AND id = '.$id);
        return (bool) $q->fetchColumn();


    }
    public function existsnumeroCni($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM depense WHERE supprimer = 0 AND numeroCni = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM depense WHERE supprimer = 0 AND dateDelivrance = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existslieuDelivrance($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM depense WHERE supprimer = 0 AND lieuDelivrance = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query("SELECT * FROM depense WHERE supprimer = 0 AND id = ".$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Depense($donnees);

    }
    public function getLast()
    {

        $q = $this->_db->query('SELECT * FROM depense WHERE supprimer = 0 order by id desc limit 1');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Depense($donnees);

    }
    public function getStock($id, $info)
    {

        $q = $this->_db->query('SELECT * FROM depense WHERE supprimer = 0 AND stock >= '.$info.' AND id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Depense($donnees);


    }
    public function getList($id)
    {
        $Depenses = array();
        $q = $this->_db->prepare('SELECT * FROM depense WHERE supprimer = 0 AND caisse_id = '.$id.' ORDER BY designation');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Depenses[] = new Depense($donnees);
        }
        return $Depenses;
    }

    public function getDateRangeDepenseUserid($start,$end,$id)
    {
        $Depenses = array();
        $q = $this->_db->prepare( "SELECT * FROM `depense` WHERE `caisse_id` = ".$id." AND `dateDepense` BETWEEN DATE_SUB( '".$start."',INTERVAL 0  MONTH) AND DATE_SUB( '".$end."',INTERVAL 0  MONTH ) ");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Depenses[] = new Depense($donnees);
        }
        return $Depenses;


    }


    public function getListEtat()
    {
        $Depenses = array();
        $q = $this->_db->prepare('SELECT * FROM depense WHERE supprimer = 0 AND etat = "Utile" ORDER BY numeroCni');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Depenses[] = new Depense($donnees);
        }
        return $Depenses;
    }
    public function update(Depense $Depense)
    {

        $q = $this->_db->prepare('UPDATE depense SET caisse_id = :caisse_id, designation = :designation, quantite = :quantite, prixUnitaire = :prixUnitaire, dateDepense = :dateDepense, beneficiaire = :beneficiaire, numeroCni = :numeroCni, lieuDelivrance = :lieuDelivrance, dateDelivrance = :dateDelivrance, societe = :societe, typeDepense = :typeDepense WHERE id = :id');
        $q->bindValue(':id', $Depense->id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $Depense->caisse_id());
        $q->bindValue(':designation', $Depense->designation());
        $q->bindValue(':quantite', $Depense->quantite());
        $q->bindValue(':prixUnitaire', $Depense->prixUnitaire());
        $q->bindValue(':dateDepense', $Depense->dateDepense());
        $q->bindValue(':numeroCni', $Depense->numeroCni());
        $q->bindValue(':beneficiaire', $Depense->beneficiaire());
        $q->bindValue(':lieuDelivrance', $Depense->lieuDelivrance());
        $q->bindValue(':dateDelivrance', $Depense->dateDelivrance());
        $q->bindValue(':societe', $Depense->societe());
        $q->bindValue(':typeDepense', $Depense->typeDepense());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>