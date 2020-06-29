<?php

class Produit_cmd
{
    private $_id,
        $_produit_id,
        $_commande_id,
        $_prixPublic,
        $_puCmd,
        $_ptCmd,
        $_qtiteCmd,
        $_puRecept,
        $_ptRecept,
        $_qtiteRecu,
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
    public function commande_id()
    {
        return $this->_commande_id;
    }
    public function prixPublic()
    {
        return $this->_prixPublic;
    }
    public function produit_id()
    {
        return $this->_produit_id;
    }
    public function puCmd()
    {
        return $this->_puCmd;
    }
    public function ptCmd()
    {
        return $this->_ptCmd;
    }
    public function puRecept()
    {
        return $this->_puRecept;
    }
    public function qtiteCmd()
    {
        return $this->_qtiteCmd;
    }
    public function ptRecept()
    {
        return $this->_ptRecept;
    }
    public function qtiteRecu()
    {
        return $this->_qtiteRecu;
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
    public function setproduit_id($id)
    {

        if ($id > 0)
        {
            $this->_produit_id = $id;
        }
    }
    public function setcommande_id($id)
    {

        if ($id > 0)
        {
            $this->_commande_id = $id;
        }
    }
    public function setprixPublic($id)
    {

        if ($id > 0)
        {
            $this->_prixPublic = $id;
        }
    }
    public function setpuCmd($id)
    {

        if ($id > 0)
        {
            $this->_puCmd = $id;
        }
    }
    public function setptCmd($id)
    {

        if ($id > 0)
        {
            $this->_ptCmd = $id;
        }
    }
    public function setqtiteCmd($id)
    {

        if ($id > 0)
        {
            $this->_qtiteCmd = $id;
        }
    }
    public function setpuRecept($id)
    {

        if ($id > 0)
        {
            $this->_puRecept = $id;
        }
    }
    public function setptRecept($value)
    {

        $this->_ptRecept = $value;

    }
    public function setqtiteRecu($value)
    {

        $this->_qtiteRecu = $value;

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

class Produit_cmdManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Produit_cmd $Produit_cmd)
    {
        $q = $this->_db->prepare('INSERT INTO produit_cmd SET id = :id, produit_id = :produit, puCmd = :user, ptCmd = :prescripteur, qtiteCmd = :qtiteCmd, puRecept = :montant, ptRecept = :ptRecept, qtiteRecu = :qtiteRecu, etat = :etat, reduction = :reduction, etat = :etat, supprimer=0');
        $q->bindValue(':id', $Produit_cmd->id(), PDO::PARAM_INT);
        $q->bindValue(':produit', $Produit_cmd->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':commande', $Produit_cmd->commande_id(), PDO::PARAM_INT);
        $q->bindValue(':malade', $Produit_cmd->prixPublic());
        $q->bindValue(':user', $Produit_cmd->puCmd());
        $q->bindValue(':prescripteur', $Produit_cmd->ptCmd());
        $q->bindValue(':qtiteCmd', $Produit_cmd->qtiteCmd());
        $q->bindValue(':montant', $Produit_cmd->puRecept());
        $q->bindValue(':ptRecept', $Produit_cmd->ptRecept());
        $q->bindValue(':qtiteRecu', $Produit_cmd->qtiteRecu());
        $q->bindValue(':etat', $Produit_cmd->etat());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM Produit_cmd WHERE SUPPRIMER = 0 ')->fetchColumn();
    }
    public function delete(Produit_cmd $Produit_cmd)
    {
        $this->_db->exec('DELETE FROM Produit_cmd WHERE id = '.$Produit_cmd->id());
    }
    public function existsId($info)
    {

        return (bool) $this->_db->query('SELECT COUNT(*) FROM Produit_cmd WHERE supprimer = 0 AND id = '.$info)->fetchColumn();

    }
    public function existsptRecept($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM Produit_cmd WHERE supprimer = 0 AND ptRecept = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsEan($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM Produit_cmd WHERE supprimer = 0 AND ean13 = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function existsqtiteRecu($info)
    {

        $q = $this->_db->prepare('SELECT COUNT(*) FROM Produit_cmd WHERE supprimer = 0 AND qtiteRecu = :info');
        $q->execute(array(':info' => $info));
        return (bool) $q->fetchColumn();


    }
    public function get($info)
    {

        $q = $this->_db->query('SELECT * FROM Produit_cmd WHERE supprimer = 0 AND id = '.$info);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Produit_cmd($donnees);

    }
    public function getList()
    {
        $Produit_cmds = array();
        $q = $this->_db->prepare('SELECT * FROM Produit_cmd WHERE supprimer = 0 ORDER BY ptRecept');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Produit_cmds[] = new Produit_cmd($donnees);
        }
        return $Produit_cmds;
    }
    public function update(Produit_cmd $Produit_cmd)
    {

        $q = $this->_db->prepare('UPDATE Produit_cmd SET produit_id = :produit, puCmd = :user, ptCmd = :prescripteur, prixPublic = :malade, commande_id = :commande, qtiteCmd = :qtiteCmd, puRecept = :montant, ptRecept = :ptRecept, qtiteRecu = :qtiteRecu, etat = :etat, reduction = :reduction, etat = :etat WHERE id = :id');
        $q->bindValue(':id', $Produit_cmd->id(), PDO::PARAM_INT);
        $q->bindValue(':produit', $Produit_cmd->produit_id(), PDO::PARAM_INT);
        $q->bindValue(':commande', $Produit_cmd->commande_id(), PDO::PARAM_INT);
        $q->bindValue(':malade', $Produit_cmd->prixPublic());
        $q->bindValue(':user', $Produit_cmd->puCmd());
        $q->bindValue(':prescripteur', $Produit_cmd->ptCmd());
        $q->bindValue(':qtiteCmd', $Produit_cmd->qtiteCmd());
        $q->bindValue(':montant', $Produit_cmd->puRecept());
        $q->bindValue(':ptRecept', $Produit_cmd->ptRecept());
        $q->bindValue(':qtiteRecu', $Produit_cmd->qtiteRecu());
        $q->bindValue(':etat', $Produit_cmd->etat());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>