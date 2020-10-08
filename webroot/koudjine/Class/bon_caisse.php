<?php

class BonCaisse
{
    private $_id,
        $_caisse_id,
        $_nom_client,
        $_codebarre_id,
        $_montant,
        $_dateGenerer,
        $_type,
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
    public function nom_client()
    {
        return $this->_montant;
    }
    public function codebarre_id()
    {
        return $this->codebarre_id;
    }
    public function montant()
    {
        return $this->_montant;
    }
    public function dateGenerer()
    {
        return $this->_dateGenerer;
    }
    public function type()
    {
        return $this->_type;
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
    
    public function setcaisse_id($value)
    {

        $this->_caisse_id = $value;

    }
    public function setnom_client($value)
    {

        $this->_nom_client = $value;

    }
    public function setcodebarre_id($value)
    {

        $this->_codebarre_id = $value;

    }
    public function setmontant($value)
    {

        $this->_montant = $value;

    }
    public function setdateGenerer($value)
    {

        $this->_dateGenerer = $value;

    }
    public function settype($value)
    {

        $this->_type = $value;

    }

    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class BonCaisseManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(BonCaisse $BonCaisse)
    {
        $q = $this->_db->prepare('INSERT INTO BonCaisse SET id = :id, caisse_id = :caisse_id, nom_client = :nom_client, montant = :montant, codebarre_id = :codebarre_id, dateGenerer = :dateGenerer, type = :type, supprimer=0');
        $q->bindValue(':id', $BonCaisse->id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $BonCaisse->caisse_id());
        $q->bindValue(':nom_client', $BonCaisse->nom_client());
        $q->bindValue(':codebarre_id', $BonCaisse->codebarre_id());
        $q->bindValue(':montant', $BonCaisse->montant());
        $q->bindValue(':dateGenerer', $BonCaisse->dateGenerer());
        $q->bindValue(':type', $BonCaisse->type());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM BonCaisse WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(BonCaisse $BonCaisse)
    {
        $this->_db->exec('DELETE FROM BonCaisse WHERE id = '.$BonCaisse->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM BonCaisse WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM BonCaisse WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM BonCaisse WHERE supprimer = 0 AND telephone = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsnom_client($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM BonCaisse WHERE supprimer = 0 AND montant = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM BonCaisse WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new BonCaisse($donnees);

    }
    public function getList()
    {
        $BonCaisses = array();
        $q = $this->_db->prepare('SELECT * FROM BonCaisse WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $BonCiaaisses[] = new BonCaisse($donnees);
        }
        return $BonCaisses;
    }
    public function update(BonCaisse $BonCaisse)
    {

        $q = $this->_db->prepare('UPDATE BonCaisse SET nom = :nom, montant = :montant, CodePostal_id = :CodePostal_id, telephone = :telephone WHERE id = :id');
        $q->bindValue(':id', $BonCaisse->id(), PDO::PARAM_INT);
        $q->bindValue(':caisse_id', $BonCaisse->caisse_id());
        $q->bindValue(':nom_client', $BonCaisse->nom_client());
        $q->bindValue(':codebarre_id', $BonCaisse->codebarre_id());
        $q->bindValue(':montant', $BonCaisse->montant());
        $q->bindValue(':dateGenerer', $BonCaisse->dateGenerer());
        $q->bindValue(':type', $BonCaisse->type());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>