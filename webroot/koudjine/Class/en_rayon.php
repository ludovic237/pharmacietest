<?php

class En_rayon
{
    private $_id,
        $_produit_id,
        $_fournisseur_id,
        $_commande_id,
        $_dateLivraison,
        $_datePeremption,
        $_prixAchat,
        $_prixVente,
        $_quantite,
        $_quantiteRestante,
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
    public function produit_id()
    {
        return $this->_produit_id;
    }
    public function fournisseur_id()
    {
        return $this->_fournisseur_id;
    }
    public function commande_id()
    {
        return $this->_commande_id;
    }
    public function dateLivraison()
    {
        return $this->_dateLivraison;
    }
    public function datePeremption()
    {
        return $this->_datePeremption;
    }
    public function prixAchat()
    {
        return $this->_prixAchat;
    }
    public function prixVente()
    {
        return $this->_prixVente;
    }
    public function quantite()
    {
        return $this->_quantite;
    }
    public function quantiteRestante()
    {
        return $this->_quantiteRestante;
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
    public function setproduit_id($id)
    {

        if ($id > 0)
        {
            $this->_produit_id = $id;
        }
    }
    public function setfournisseur_id($id)
    {

        if ($id > 0)
        {
            $this->_fournisseur_id = $id;
        }
    }
    public function setcommaande_id($id)
    {

        if ($id > 0)
        {
            $this->_commande_id = $id;
        }
    }
    public function setdateLivraison($id)
    {
            $this->_dateLivraison = $id;
    }
    public function setdatePeremption($id)
    {
            $this->_datePeremption = $id;
    }
    public function setprixVente($id)
    {
            $this->_prixVente = $id;
    }
    public function setprixAchat($id)
    {

            $this->_prixAchat = $id;
    }
    public function setquantite($value)
    {

        $this->_quantite = $value;

    }
    public function setquantiteRestante($value)
    {

        $this->_quantiteRestante = $value;

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

class En_rayonManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(En_rayon $en_rayon)
    {
        $q = $this->_db->prepare('INSERT INTO en_rayon SET id = :id, produit_id = :produit_id, fournisseur_id = :fournisseur_id, commande_id = :commande_id, dateLivraison = now(), datePeremption = :datePeremption, prixVente = :prixv, prixAchat = :prixa, quantite = :quantite, quantiteRestante = :quantiteRestante, reduction = :reduction, supprimer=0');
        $q->bindValue(':id', $en_rayon->id(), PDO::PARAM_INT);
        $q->bindValue(':produit_id', $en_rayon->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':fournisseur_id', $en_rayon->fournisseur_id(), PDO::PARAM_INT);
        $q->bindValue(':commande_id', $en_rayon->commande_id(), PDO::PARAM_INT);
        $q->bindValue(':datePeremption', $en_rayon->datePeremption());
        $q->bindValue(':prixv', $en_rayon->prixVente());
        $q->bindValue(':prixa', $en_rayon->prixAchat());
        $q->bindValue(':quantite', $en_rayon->quantite());
        $q->bindValue(':quantiteRestante', $en_rayon->quantiteRestante());
        $q->bindValue(':reduction', $en_rayon->reduction());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM en_rayon WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(En_rayon $en_rayon)
    {
        $this->_db->exec('DELETE FROM en_rayon WHERE id = '.$en_rayon->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM en_rayon WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }

    public function existsproduit_id($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM en_rayon WHERE supprimer = 0 AND produit_id = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsQuantiteRestante($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM en_rayon WHERE supprimer = 0 AND quantiteRestante >= :info AND id = '.$id);
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsQuantite($id, $info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM en_rayon WHERE supprimer = 0 AND quantite = :info AND id = '.$id);
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM en_rayon WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new en_rayon($donnees);

    }
    public function getList($info)
    {
        $produits = array();
        $q = $this->_db->prepare('SELECT * FROM en_rayon WHERE supprimer = 0 AND quantiteRestante > 0 AND produit_id = '.$info.' ORDER BY dateLivraison ASC');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $produits[] = new En_rayon($donnees);
        }
        return $produits;
    }
    public function update(En_rayon $en_rayon)
    {

        $q = $this->_db->prepare('UPDATE en_rayon SET produit_id = :produit_id, fournisseur_id = :fournisseur_id, dateLivraison = :dateLivraison, datePeremption = :datePeremption, prixVente = :prixv, prixAchat = :prixa, quantite = :quantite, quantiteRestante = :quantiteRestante, reduction = :reduction WHERE id = :id');
        $q->bindValue(':id', $en_rayon->id(), PDO::PARAM_INT);
        $q->bindValue(':produit_id', $en_rayon->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':fournisseur_id', $en_rayon->fournisseur_id(), PDO::PARAM_INT);
        $q->bindValue(':dateLivraison', $en_rayon->dateLivraison());
        $q->bindValue(':datePeremption', $en_rayon->datePeremption());
        $q->bindValue(':prixv', $en_rayon->prixVente());
        $q->bindValue(':prixa', $en_rayon->prixAchat());
        $q->bindValue(':quantite', $en_rayon->quantite());
        $q->bindValue(':quantiteRestante', $en_rayon->quantiteRestante());
        $q->bindValue(':reduction', $en_rayon->reduction());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}
