<?php

class Caisse
{
    private $_id,
        $_user_id,
        $_ouvertureCaisse,
        $_fermetureCaisse,
        $_dateOuvert,
        $_dateFerme,
        $_session,
        $_fondCaisse,
        $_etat,
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
    public function user_id()
    {
        return $this->_user_id;
    }
    public function ouvertureCaisse()
    {
        return $this->_ouvertureCaisse;
    }
    public function fermetureCaisse()
    {
        return $this->_fermetureCaisse;
    }
    public function dateOuvert()
    {
        return $this->_dateOuvert;
    }
    public function dateFerme()
    {
        return $this->_dateFerme;
    }
    public function session()
    {
        return $this->_session;
    }
    public function fondCaisse()
    {
        return $this->_fondCaisse;
    }
    public function etat()
    {
        return $this->_etat;
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
    public function setuser_id($id)
    {

        if ($id > 0)
        {
            $this->_user_id = $id;
        }
    }
    public function setouvertureCaisse($id)
    {
            $this->_ouvertureCaisse = $id;
    }
    public function setfermetureCaisse($id)
    {
        $this->_fermetureCaisse = $id;
    }
    public function setdateOuvert($value)
    {

        $this->_dateOuvert = $value;

    }
    public function setdateFerme($value)
    {

        $this->_dateFerme = $value;

    }
    public function setsession($value)
    {

        $this->_session = $value;

    }
    public function setfondCaisse($value)
    {

        $this->_fondCaisse = $value;

    }
    public function setetat($value)
    {

        $this->_etat = $value;

    }
    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class CaisseManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Caisse $caisse)
    {
        $q = $this->_db->prepare('INSERT INTO caisse SET id = :id, employe_id = :employe, user_id = :user, prescripteur_id = :prescripteur, prixTotal = :prixTotal, ouvertureCaisse = :ouverture, fermetureCaise = :fermeture, dateOuvert = :dateOuvert, dateFerme = :dateFerme, session = :session, fondCaisse = :fondCaisse, etat = :etat, supprimer=0');
        $q->bindValue(':id', $caisse->id(), PDO::PARAM_INT);
        $q->bindValue(':user', $caisse->user_id(), PDO::PARAM_INT);
        $q->bindValue(':ouverture', $caisse->ouvertureCaisse());
        $q->bindValue(':fermeture', $caisse->fermetureCaisse());
        $q->bindValue(':dateOuvert', $caisse->dateOuvert());
        $q->bindValue(':dateFerme', $caisse->dateFerme());
        $q->bindValue(':session', $caisse->session());
        $q->bindValue(':fondCaisse', $caisse->fondCaisse());
        $q->bindValue(':etat', $caisse->etat());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM caisse WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Caisse $caisse)
    {
        $this->_db->exec('DELETE FROM caisse WHERE id = '.$caisse->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM caisse WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsdateOuvert($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM caisse WHERE supprimer = 0 AND dateOuvert = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsetat()
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM caisse WHERE supprimer = 0 AND etat = "Ouvert"');
        return (bool) $q->fetchColumn();


    }
    public function exists()
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM caisse WHERE supprimer = 0 AND etat = "Ouvert" AND CAST(dateOuvert AS DATE) = CURRENT_DATE');
        return (bool) $q->fetchColumn();


    }
    public function get()
    {

        $q = $this->_db->query('SELECT * FROM caisse WHERE supprimer = 0 AND etat = "Ouvert" AND CAST(dateOuvert AS DATE) = CURRENT_DATE');
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Caisse($donnees);

    }
    public function getList()
    {
        $caisses = array();
        $q = $this->_db->prepare('SELECT * FROM caisse WHERE supprimer = 0 ORDER BY dateOuvert');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $caisses[] = new Caisse($donnees);
        }
        return $caisses;
    }
    public function update(Caisse $caisse)
    {

        $q = $this->_db->prepare('UPDATE caisse SET employe_id = :employe, user_id = :user, prescripteur_id = :prescripteur, malade_id = :malade, caisse_id = :caisse, prixTotal = :prixTotal, ouvertureCaisse = :ouverture, fermetureCaise = :fermeture, dateOuvert = :dateOuvert, dateFerme = :dateFerme, session = :session, fondCaisse = :fondCaisse, etat = :etat WHERE id = :id');
        $q->bindValue(':id', $caisse->id(), PDO::PARAM_INT);
        $q->bindValue(':user', $caisse->user_id(), PDO::PARAM_INT);
        $q->bindValue(':ouverture', $caisse->ouvertureCaisse());
        $q->bindValue(':fermeture', $caisse->fermetureCaisse());
        $q->bindValue(':dateOuvert', $caisse->dateOuvert());
        $q->bindValue(':dateFerme', $caisse->dateFerme());
        $q->bindValue(':session', $caisse->session());
        $q->bindValue(':fondCaisse', $caisse->fondCaisse());
        $q->bindValue(':etat', $caisse->etat());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>