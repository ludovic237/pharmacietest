<?php

class Prescripteur
{
    private $_id,
        $_nom,
        $_structure,
        $_adresse,
        $_telephone;

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
    public function structure()
    {
        return $this->_structure;
    }
    public function telephone()
    {
        return $this->_telephone;
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
    public function setstructure($value)
    {

        $this->_structure = $value;

    }
    public function settelephone($value)
    {

        $this->_telephone = $value;

    }
    
}

class PrescripteurManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Prescripteur $prescripteur)
    {
        $q = $this->_db->prepare('INSERT INTO prescripteur SET id = :id, nom = :nom, adresse = :adresse, structure = :structure, telephone = :telephone');
        $q->bindValue(':id', $prescripteur->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $prescripteur->nom());
        $q->bindValue(':adresse', $prescripteur->adresse());
        $q->bindValue(':structure', $prescripteur->structure());
        $q->bindValue(':telephone', $prescripteur->telephone());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM prescripteur WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Prescripteur $prescripteur)
    {
        $this->_db->exec('DELETE FROM prescripteur WHERE id = '.$prescripteur->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM prescripteur WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM prescripteur WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM prescripteur WHERE supprimer = 0 AND structure = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsadresse($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM prescripteur WHERE supprimer = 0 AND adresse = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM prescripteur WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Prescripteur($donnees);

    }
    public function getList()
    {
        $prescripteurs = array();
        $q = $this->_db->prepare('SELECT * FROM prescripteur WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $prescripteurs[] = new Prescripteur($donnees);
        }
        return $prescripteurs;
    }
    public function update(Prescripteur $prescripteur)
    {

        $q = $this->_db->prepare('UPDATE prescripteur SET nom = :nom, adresse = :adresse, structure = :structure, telephone = :telephone, WHERE id = :id');
        $q->bindValue(':id', $prescripteur->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $prescripteur->nom());
        $q->bindValue(':adresse', $prescripteur->adresse());
        $q->bindValue(':structure', $prescripteur->structure());
        $q->bindValue(':telephone', $prescripteur->telephone());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>