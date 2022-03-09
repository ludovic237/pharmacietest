<?php

class Client
{
    private $_id,
        $_nom,
        $_telephone,
        $_modeReglement,
        $_poid,
        $_taille,
        $_reduction,
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
    public function modeReglement()
    {
        return $this->_modeReglement;
    }
    public function telephone()
    {
        return $this->_telephone;
    }
    public function poid()
    {
        return $this->_poid;
    }
    public function taille()
    {
        return $this->_taille;
    }
    public function reduction()
    {
        return $this->_reduction;
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
    public function setmodeReglement($value)
    {

        $this->_modeReglement = $value;

    }
    public function settelephone($value)
    {

        $this->_telephone = $value;

    }
    public function setpoid($value)
    {

        $this->_poid = $value;

    }
    public function settaille($value)
    {

        $this->_taille = $value;

    }
    public function setreduction($value)
    {

        $this->_reduction = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class ClientManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Client $client)
    {
        $q = $this->_db->prepare('INSERT INTO client SET id = :id, nom = :nom, modeReglement = :modeReglement, telephone = :telephone, poid = :poid, taille = :taille, reduction = :reduction, supprimer=0');
        $q->bindValue(':id', $client->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $client->nom());
        $q->bindValue(':modeReglement', $client->modeReglement());
        $q->bindValue(':telephone', $client->telephone());
        $q->bindValue(':laborex', $client->poid());
        $q->bindValue(':ubipharm', $client->taille());
        $q->bindValue(':reduction', $client->reduction());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM client WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Client $client)
    {
        $this->_db->exec('DELETE FROM client WHERE id = '.$client->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM client WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM client WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM client WHERE supprimer = 0 AND telephone = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsmodeReglement($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM client WHERE supprimer = 0 AND modeReglement = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM client WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Client($donnees);

    }
    public function getList()
    {
        $clients = array();
        $q = $this->_db->prepare('SELECT * FROM client WHERE supprimer = 0 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $clients[] = new Client($donnees);
        }
        return $clients;
    }
    public function update(Client $client)
    {

        $q = $this->_db->prepare('UPDATE client SET nom = :nom, modeReglement = :modeReglement, telephone = :telephone, poid = :poid, taille = :taille, reduction = :reduction WHERE id = :id');
        $q->bindValue(':id', $client->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $client->nom());
        $q->bindValue(':modeReglement', $client->modeReglement());
        $q->bindValue(':telephone', $client->telephone());
        $q->bindValue(':poid', $client->poid());
        $q->bindValue(':taille', $client->taille());
        $q->bindValue(':reduction', $client->reduction());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>