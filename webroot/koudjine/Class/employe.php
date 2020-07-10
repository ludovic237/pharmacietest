<?php

class Employe
{
    private $_id,
        $_identifiant,
        $_password,
        $_type,
        $_faireReductionMax,
        $_etat,
        $_codebarre_id,
        $_user_id,
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
    public function identifiant()
    {
        return $this->_identifiant;
    }
    public function password()
    {
        return $this->_password;
    }
    public function type()
    {
        return $this->_type;
    }
    public function faireReductionMax()
    {
        return $this->_faireReductionMax;
    }
    public function etat()
    {
        return $this->_etat;
    }
    public function codebarre_id()
    {
        return $this->_codebarre_id;
    }
    public function user_id()
    {
        return $this->_user_id;
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
    public function setidentifiant($id)
    {

        $this->_identifiant = $id;
    }
    public function setpassword($id)
    {


        $this->_password = $id;
    }
    public function settype($id)
    {

        $this->_type = $id;
    }
    public function setfaireReductionMax($id)
    {

        $this->_faireReductionMax = $id;
    }
    public function settaille($id)
    {

        $this->_taille = $id;
    }
    public function setetat($value)
    {

        $this->_etat = $value;
    }
    public function setcodebarre_id($value)
    {

        $this->_codebarre_id = $value;
    }
    public function setuser_id($value)
    {

        $this->_user_id = $value;
    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;
    }
}

class EmployeManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Employe $employe)
    {
        $q = $this->_db->prepare('INSERT INTO employe SET id = :id, identifiant = :identifiant, password = :password, type = :type, faireReductionMax = :faireReductionMax, taille = :taille, etat = :etat, codebarre_id = :codebarre_id, user_id = :user_id, supprimer=0');
        $q->bindValue(':id', $employe->id(), PDO::PARAM_INT);
        $q->bindValue(':identifiant', $employe->identifiant());
        $q->bindValue(':password', $employe->password());
        $q->bindValue(':type', $employe->type());
        $q->bindValue(':faireReductionMax', $employe->faireReductionMax());
        $q->bindValue(':etat', $employe->etat());
        $q->bindValue(':codebarre_id', $employe->codebarre_id(), PDO::PARAM_INT);
        $q->bindValue(':user_id', $employe->user_id(), PDO::PARAM_INT);
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM employe WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Employe $employe)
    {
        $this->_db->exec('DELETE FROM employe WHERE id = ' . $employe->id());
    }
    public function existsidentifiant($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM employe WHERE supprimer = 0 AND identifiant = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM employe WHERE supprimer = 0 AND id = ' . $info)->fetchColumn();
    }
    public function existsetat($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM employe WHERE supprimer = 0 AND etat = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM employe WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function existscodebarre_id($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM employe WHERE supprimer = 0 AND codebarre_id = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM employe WHERE supprimer = 0 AND id = ' . $info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Employe($donnees);
    }
    public function getList()
    {
        $employes = array();
        $q = $this->_db->prepare('SELECT * FROM employe WHERE supprimer = 0 ORDER BY etat');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $employes[] = new Employe($donnees);
        }
        return $employes;
    }
    public function update(Employe $employe)
    {

        $q = $this->_db->prepare('UPDATE employe SET identifiant = :identifiant, password = :password, type = :type, faireReductionMax = :faireReductionMax, taille = :taille, etat = :etat, codebarre_id = :codebarre_id, user_id = :user_id WHERE id = :id');
        $q->bindValue(':id', $employe->id(), PDO::PARAM_INT);
        $q->bindValue(':identifiant', $employe->identifiant());
        $q->bindValue(':password', $employe->password());
        $q->bindValue(':type', $employe->type());
        $q->bindValue(':faireReductionMax', $employe->faireReductionMax());
        $q->bindValue(':etat', $employe->etat());
        $q->bindValue(':codebarre_id', $employe->codebarre_id(), PDO::PARAM_INT);
        $q->bindValue(':user_id', $employe->user_id(), PDO::PARAM_INT);
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
