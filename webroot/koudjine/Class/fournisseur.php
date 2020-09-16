<?php

class Fournisseur
{
    private $_id,
        $_nom,
        $_code,
        $_adresse,
        $_telephone,
        $_statut,
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
    public function statut()
    {
        return $this->_statut;
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
    public function setstatut($value)
    {

        $this->_statut = $value;

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

class FournisseurManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Fournisseur $fournisseur)
    {
        $q = $this->_db->prepare('INSERT INTO fournisseur SET id = :id, nom = :nom, adresse = :adresse, code = :code, telephone = :telephone, email = :email,statut = :statut, supprimer=0');
        $q->bindValue(':id', $fournisseur->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $fournisseur->nom());
        $q->bindValue(':adresse', $fournisseur->adresse());
        $q->bindValue(':code', $fournisseur->code());
        $q->bindValue(':statut', $fournisseur->statut());
        $q->bindValue(':telephone', $fournisseur->telephone());
        $q->bindValue(':email', $fournisseur->email());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM fournisseur WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Fournisseur $fournisseur)
    {
        $this->_db->exec('DELETE FROM fournisseur WHERE id = '.$fournisseur->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM fournisseur WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM fournisseur WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM fournisseur WHERE supprimer = 0 AND code = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsadresse($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM fournisseur WHERE supprimer = 0 AND adresse = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM fournisseur WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Fournisseur($donnees);

    }
    public function getList()
    {
        $fournisseurs = array();
        $q = $this->_db->prepare('SELECT * FROM fournisseur WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $fournisseurs[] = new Fournisseur($donnees);
        }
        return $fournisseurs;
    }
    public function update(Fournisseur $fournisseur)
    {

        $q = $this->_db->prepare('UPDATE fournisseur SET nom = :nom, adresse = :adresse, code = :code, telephone = :telephone, email = :email,statut = :statut WHERE id = :id');
        $q->bindValue(':id', $fournisseur->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $fournisseur->nom());
        $q->bindValue(':adresse', $fournisseur->adresse());
        $q->bindValue(':statut', $fournisseur->statut());
        $q->bindValue(':code', $fournisseur->code());
        $q->bindValue(':telephone', $fournisseur->telephone());
        $q->bindValue(':email', $fournisseur->email());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>