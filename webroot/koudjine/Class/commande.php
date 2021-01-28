<?php

class Commande
{
    private $_id,
        $_fournisseur_id,
        $_dateCreation,
        $_dateLivraison,
        $_note,
        $_qtiteCmd,
        $_qtiteRecu,
        $_montantCmd,
        $_montantRecu,
        $_etat,
        $_ref,
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

    public function dateCreation()
    {
        return $this->_dateCreation;
    }

    public function dateLivraison()
    {
        return $this->_dateLivraison;
    }

    public function fournisseur_id()
    {
        return $this->_fournisseur_id;
    }

    public function note()
    {
        return $this->_note;
    }

    public function qtiteCmd()
    {
        return $this->_qtiteCmd;
    }

    public function montantCmd()
    {
        return $this->_montantCmd;
    }

    public function qtiteRecu()
    {
        return $this->_qtiteRecu;
    }

    public function montantRecu()
    {
        return $this->_montantRecu;
    }

    public function etat()
    {
        return $this->_etat;
    }

    public function ref()
    {
        return $this->_ref;
    }

    public function supprimer()
    {
        return $this->_supprimer;
    }

    // SETTERS
    public function setid($id)
    {

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setfournisseur_id($id)
    {

        if ($id > 0) {
            $this->_fournisseur_id = $id;
        }
    }

    public function setdateCreation($id)
    {

        $this->_dateCreation = $id;

    }

    public function setdateLivraison($id)
    {
        $this->_dateLivraison = $id;
    }

    public function setnote($id)
    {

        $this->_note = $id;

    }

    public function setqtiteCmd($id)
    {

        if ($id > 0) {
            $this->_qtiteCmd = $id;
        }
    }

    public function setqtiteRecu($id)
    {

        if ($id > 0) {
            $this->_qtiteRecu = $id;
        }
    }

    public function setmontantCmd($id)
    {

        if ($id > 0) {
            $this->_montantCmd = $id;
        }
    }

    public function setmontantRecu($value)
    {

        $this->_montantRecu = $value;

    }

    public function setetat($value)
    {

        $this->_etat = $value;

    }

    public function setref($value)
    {

        $this->_ref = $value;

    }

    public function setsupprimer($value)
    {

        $this->_supprimer = $value;

    }

}

class CommandeManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public
    function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function add(Commande $commande)
    {
        $q = $this->_db->prepare('INSERT INTO commande SET id = :id, dateLivraison = :datelivraison, dateCreation = now(), fournisseur_id = :fournisseur_id, note = :note, qtiteCmd = :qtitecmd, qtiteRecu = :qtiteRecu, montantCmd = :montant, montantRecu = :montantRecu, etat = "Commandé", ref = :ref, supprimer=0');
        $q->bindValue(':id', $commande->id(), PDO::PARAM_INT);
        $q->bindValue(':fournisseur_id', $commande->fournisseur_id(), PDO::PARAM_INT);
        $q->bindValue(':datelivraison', $commande->dateLivraison());
        $q->bindValue(':note', $commande->note());
        $q->bindValue(':qtitecmd', $commande->qtiteCmd());
        $q->bindValue(':qtiteRecu', $commande->qtiteRecu());
        $q->bindValue(':montant', $commande->montantCmd());
        $q->bindValue(':montantRecu', $commande->montantRecu());
        $q->bindValue(':ref', $commande->ref());
        $q->execute();
    }

    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM commande WHERE supprimer = 0 ')->fetchColumn();
    }

    public function countMois()
    {
        return $this->_db->query('SELECT COUNT(*) FROM commande WHERE supprimer = 0 AND MONTH(dateCreation) = MONTH(NOW()) AND YEAR(dateCreation) = YEAR(NOW()) ')->fetchColumn();
    }

    public function delete(Commande $commande)
    {
        $this->_db->exec('DELETE FROM commande WHERE id = ' . $commande->id());
    }

    public function existsId($info)
    {

        return (bool)$this->_db->query('SELECT COUNT(*) FROM commande WHERE supprimer = 0 AND id = ' . $info)->fetchColumn();

    }

    public function existsmontantRecu($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM commande WHERE supprimer = 0 AND montantRecu = :info');
        $q->execute(array(':info' => $info));
        return (bool)$q->fetchColumn();


    }

    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM commande WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool)$q->fetchColumn();


    }

    public function existsetat($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM commande WHERE supprimer = 0 AND etat = :info');
        $q->execute(array(':info' => $info));
        return (bool)$q->fetchColumn();


    }

    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM commande WHERE supprimer = 0 AND id = ' . $info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Commande($donnees);

    }

    public function CommandeActuMois()
    {
        $commandes = array();
        $q = $this->_db->prepare('SELECT * FROM commande WHERE supprimer = 0 AND dateCreation > DATE_SUB(now(), INTERVAL 1 MONTH))');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $commandes[] = new Commande($donnees);
        }
        return $commandes;
    }

    public function getListRange($start, $end)
    {
        $commandes = array();
        $q = $this->_db->prepare("SELECT * FROM commande WHERE supprimer = 0 AND `dateCreation` BETWEEN DATE_SUB( '" . $start . "',INTERVAL 0  MONTH) AND DATE_SUB( '" . $end . "',INTERVAL 0  MONTH ) ");
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $commandes[] = new Commande($donnees);
        }
        return $commandes;
    }

    public function getList()
    {
        $commandes = array();
        $q = $this->_db->prepare('SELECT * FROM commande WHERE supprimer = 0 ORDER BY montantRecu');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $commandes[] = new Commande($donnees);
        }
        return $commandes;
    }

    public
    function update(Commande $commande)
    {

        $q = $this->_db->prepare('UPDATE commande SET fournisseur_id = :fournisseur_id, note = :note, qtiteCmd = :qtitecmd, dateLivraison = :datelivraison, dateCreation = :dateCreation, qtiteRecu = :qtiteRecu, montantCmd = :montant, montantRecu = :montantRecu, etat = :etat, ref = :ref WHERE id = :id');
        $q->bindValue(':id', $commande->id(), PDO::PARAM_INT);
        $q->bindValue(':fournisseur_id', $commande->fournisseur_id(), PDO::PARAM_INT);
        $q->bindValue(':dateCreation', $commande->dateCreation());
        $q->bindValue(':datelivraison', $commande->dateLivraison());
        $q->bindValue(':note', $commande->note());
        $q->bindValue(':qtitecmd', $commande->qtiteCmd());
        $q->bindValue(':qtiteRecu', $commande->qtiteRecu());
        $q->bindValue(':montant', $commande->montantCmd());
        $q->bindValue(':montantRecu', $commande->montantRecu());
        $q->bindValue(':etat', $commande->etat());
        $q->bindValue(':ref', $commande->ref());
        $q->execute();
    }
}

?>