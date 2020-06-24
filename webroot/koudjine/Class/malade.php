<?php

class malade
{
    private $_id,
        $_nom,
        $_modeReglement,
        $_poid,
        $_reduction,
        $_taille,
        $_telephone,
        $_assureur_id,
        $_CodePostal_id,
        $_supprimer;

    // CONSRUCTEUR
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ($key);
            if (method_exists($this, $method)) {
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
    public function telephone()
    {
        return $this->_telephone;
    }
    public function assureur_id()
    {
        return $this->_assureur_id;
    }
    public function CodePostal_id()
    {
        return $this->_CodePostal_id;
    }
    public function supprimer()
    {
        return $this->_supprimer;
    }

    // SETTERS
    public function setid($id)
    {

        $this->_id = $id;
    }
    public function setnom($id)
    {

        $this->_nom = $id;
    }
    public function setmodeReglement($id)
    {


        $this->_modeReglement = $id;
    }
    public function setpoid($id)
    {

        $this->_poid = $id;
    }
    public function setreduction($id)
    {

        $this->_reduction = $id;
    }
    public function settaille($id)
    {

        $this->_taille = $id;
    }
    public function settelephone($value)
    {

        $this->_telephone = $value;
    }
    public function setassureur_id($value)
    {

        $this->_assureur_id = $value;
    }
    public function setCodePostal_id($value)
    {

        $this->_CodePostal_id = $value;
    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;
    }
}

class MaladeManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Malade $malade)
    {
        $q = $this->_db->prepare('INSERT INTO malade SET id = :id, nom = :nom, modeReglement = :modeReglement, poid = :poid, reduction = :reduction, taille = :taille, telephone = :telephone, assureur_id = :assureur_id, CodePostal_id = :CodePostal_id, supprimer=0');
        $q->bindValue(':id', $malade->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $malade->nom());
        $q->bindValue(':modeReglement', $malade->modeReglement());
        $q->bindValue(':poid', $malade->poid());
        $q->bindValue(':reduction', $malade->reduction());
        $q->bindValue(':taille', $malade->taille());
        $q->bindValue(':telephone', $malade->telephone());
        $q->bindValue(':assureur_id', $malade->assureur_id(), PDO::PARAM_INT);
        $q->bindValue(':CodePostal_id', $malade->CodePostal_id(), PDO::PARAM_INT);
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM malade WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Malade $malade)
    {
        $this->_db->exec('DELETE FROM malade WHERE id = ' . $malade->id());
    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM malade WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM malade WHERE supprimer = 0 AND id = ' . $info)->fetchColumn();
    }
    public function existstelephone($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM malade WHERE supprimer = 0 AND telephone = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM malade WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function existsassureur_id($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM malade WHERE supprimer = 0 AND assureur_id = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM malade WHERE supprimer = 0 AND id = ' . $info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Malade($donnees);
    }
    public function getList()
    {
        $malades = array();
        $q = $this->_db->prepare('SELECT * FROM malade WHERE supprimer = 0 ORDER BY telephone');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $malades[] = new Malade($donnees);
        }
        return $malades;
    }
    public function update(Malade $malade)
    {

        $q = $this->_db->prepare('UPDATE malade SET nom = :nom, modeReglement = :modeReglement, poid = :poid, reduction = :reduction, taille = :taille, telephone = :telephone, assureur_id = :assureur_id, CodePostal_id = :CodePostal_id WHERE id = :id');
        $q->bindValue(':id', $malade->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $malade->nom());
        $q->bindValue(':modeReglement', $malade->modeReglement());
        $q->bindValue(':poid', $malade->poid());
        $q->bindValue(':reduction', $malade->reduction());
        $q->bindValue(':taille', $malade->taille());
        $q->bindValue(':telephone', $malade->telephone());
        $q->bindValue(':assureur_id', $malade->assureur_id(), PDO::PARAM_INT);
        $q->bindValue(':CodePostal_id', $malade->CodePostal_id(), PDO::PARAM_INT);
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
