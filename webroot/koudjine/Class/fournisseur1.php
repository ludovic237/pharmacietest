<?php

class Fournisseur
{
    private $_id,
        $_codepostal,
        $_code,
        $_nom,
        $_statut,
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
    public function codepostal()
    {
        return $this->_codepostal;
    }
    public function code()
    {
        return $this->_code;
    }
    public function statut()
    {
        return $this->_statut;
    }
    public function adresse()
    {
        return $this->_adresse;
    }
    public function telephone()
    {
        return $this->_telephone;
    }
    public function nom()
    {
        return $this->_nom;
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
    public function setcodepostal($id)
    {

            $this->_codepostal = $id;

    }
    public function setcode($id)
    {

            $this->_code = $id;

    }
    public function setstatut($id)
    {

            $this->_statut = $id;

    }
    public function settelephone($id)
    {

        if ($id > 0)
        {
            $this->_telephone = $id;
        }
    }
    public function setadresse($id)
    {

            $this->_adresse = $id;

    }
    public function setnom($value)
    {

        $this->_nom = $value;

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
        $q = $this->_db->prepare('INSERT INTO fournisseur SET id = :id, code = :code, codepostal = :codepostal, statut = :statut, telephone = :tel, adresse = :adr, nom = :nom, email = :email, supprimer=0');
        $q->bindValue(':id', $fournisseur->id(), PDO::PARAM_INT);
        $q->bindValue(':code', $fournisseur->code());
        $q->bindValue(':codepostal', $fournisseur->codepostal());
        $q->bindValue(':statut', $fournisseur->statut());
        $q->bindValue(':tel', $fournisseur->telephone());
        $q->bindValue(':adr', $fournisseur->adresse());
        $q->bindValue(':nom', $fournisseur->nom());
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
    public function existsemail($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM fournisseur WHERE supprimer = 0 AND email = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM fournisseur WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new fournisseur($donnees);

    }
    public function getList()
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM fournisseur WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new Fournisseur($donnees);
        }
        return $produits;
    }
    public function update(Fournisseur $fournisseur)
    {
        $q = $this->_db->prepare('UPDATE fournisseur SET code = :code, codepostal = :codepostal, statut = :statut, telephone = :tel, adresse = :adr, nom = :nom, email = :email WHERE id = :id');
        $q->bindValue(':id', $fournisseur->id(), PDO::PARAM_INT);
        $q->bindValue(':code', $fournisseur->code());
        $q->bindValue(':codepostal', $fournisseur->codepostal());
        $q->bindValue(':statut', $fournisseur->statut());
        $q->bindValue(':tel', $fournisseur->telephone());
        $q->bindValue(':adr', $fournisseur->adresse());
        $q->bindValue(':nom', $fournisseur->nom());
        $q->bindValue(':email', $fournisseur->email());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>