<?php

class user
{
    private $_id,
        $_nom,
        $_prenom,
        $_email,
        $_reduction,
        $_reductionMax,
        $_telephone,
        $_fonction,
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
    public function prenom()
    {
        return $this->_prenom;
    }
    public function email()
    {
        return $this->_email;
    }
    public function reductionMax()
    {
        return $this->_reductionMax;
    }
    public function reduction()
    {
        return $this->_reduction;
    }
    public function telephone()
    {
        return $this->_telephone;
    }
    public function fonction()
    {
        return $this->_fonction;
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
    public function setprenom($id)
    {


        $this->_prenom = $id;
    }
    public function setemail($id)
    {

        $this->_email = $id;
    }
    public function setreduction($id)
    {

        $this->_reduction = $id;
    }
    public function setreductionMax($id)
    {

        $this->_reductionMax = $id;
    }
    public function settelephone($value)
    {

        $this->_telephone = $value;
    }
    public function setfonction($value)
    {

        $this->_fonction = $value;
    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;
    }
}

class UserManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(User $user)
    {
        $q = $this->_db->prepare('INSERT INTO user SET id = :id, nom = :nom, prenom = :prenom, email = :email, reduction = :reduction, reductionMax = :reductionMax, telephone = :telephone, fonction = :fonction, supprimer=0');
        $q->bindValue(':id', $user->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $user->nom());
        $q->bindValue(':prenom', $user->prenom());
        $q->bindValue(':email', $user->email());
        $q->bindValue(':reduction', $user->reduction());
        $q->bindValue(':reductionMax', $user->reductionMax());
        $q->bindValue(':telephone', $user->telephone());
        $q->bindValue(':fonction', $user->fonction());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM user WHERE supprimer = 0 ')->fetchColumn();
    }
    public function delete(User $user)
    {
        $this->_db->exec('DELETE FROM user WHERE id = ' . $user->id());
    }
    public function existsNom($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE supprimer = 0 AND nom = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM user WHERE supprimer = 0 AND id = ' . $info)->fetchColumn();
    }
    public function existstelephone($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE supprimer = 0 AND telephone = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function existsfonction($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE supprimer = 0 AND fonction = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();
    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM user WHERE supprimer = 0 AND id = ' . $info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new User($donnees);
    }
    public function getList()
    {
        $users = array();
        $q = $this->_db->prepare('SELECT * FROM user WHERE supprimer = 0 ORDER BY telephone');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($donnees);
        }
        return $users;
    }
    public function update(User $user)
    {

        $q = $this->_db->prepare('UPDATE user SET nom = :nom, prenom = :prenom, email = :email, reduction = :reduction, reductionMax = :reductionMax, telephone = :telephone, fonction = :fonction WHERE id = :id');
        $q->bindValue(':id', $user->id(), PDO::PARAM_INT);
        $q->bindValue(':nom', $user->nom());
        $q->bindValue(':prenom', $user->prenom());
        $q->bindValue(':email', $user->email());
        $q->bindValue(':reduction', $user->reduction());
        $q->bindValue(':reductionMax', $user->reductionMax());
        $q->bindValue(':telephone', $user->telephone());
        $q->bindValue(':fonction', $user->fonction());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
