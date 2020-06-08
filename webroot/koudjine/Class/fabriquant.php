<?php

class Fabriquant
{
    private $_id,
        $_nom,
        $_code,
        $_adresse,
        $_telephone,
        $_email,
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
    public function nom()
    {
        return $this->_nom;
    }
    public function adresse()
    {
        return $this->_adresse;
    }
    public function code()
    {
        return $this->_code;
    }
    public function telephone()
    {
        return $this->_telephone;
    }
    public function email()
    {
        return $this->_email;
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
    public function setnom($value)
    {

        $this->_nom = $value;

    }
    public function setadresse($value)
    {

        $this->_adresse = $value;

    }
    public function setcode($value)
    {

        $this->_code = $value;

    }
    public function settelephone($value)
    {

        $this->_telephone = $value;

    }
    public function setemail($value)
    {

        $this->_email = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class FabriquantManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Fabriquant $fabriquant)
    {
        $q = $this->_db->prepare('INSERT INTO fabriquant SET id = :id, nom = :nom, adresse = :adresse, code = :code, telephone = :telephone, email = :email, supprimer=0');
        $q->bindValue(':id', $fabriquant->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $fabriquant->nom());
        $q->bindValue(':adresse', $fabriquant->adresse());
        $q->bindValue(':code', $fabriquant->code());
        $q->bindValue(':telephone', $fabriquant->telephone());
        $q->bindValue(':email', $fabriquant->email());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM fabriquant WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Fabriquant $fabriquant)
    {
        $this->_db->exec('DELETE FROM fabriquant WHERE id = '.$fabriquant->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM fabriquant WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM fabriquant WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM fabriquant WHERE supprimer = 0 AND code = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsadresse($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM fabriquant WHERE supprimer = 0 AND adresse = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM fabriquant WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Fabriquant($donnees);

    }
    public function getList()
    {
        $fabriquants = array();
        $q = $this->_db->prepare('SELECT * FROM fabriquant WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $fabriquants[] = new Fabriquant($donnees);
        }
        return $fabriquants;
    }
    public function update(Fabriquant $fabriquant)
    {

        $q = $this->_db->prepare('UPDATE fabriquant SET nom = :nom, adresse = :adresse, code = :code, telephone = :telephone, email = :email WHERE id = :id');
        $q->bindValue(':id', $fabriquant->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $fabriquant->nom());
        $q->bindValue(':adresse', $fabriquant->adresse());
        $q->bindValue(':code', $fabriquant->code());
        $q->bindValue(':telephone', $fabriquant->telephone());
        $q->bindValue(':email', $fabriquant->email());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>