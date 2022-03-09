<?php

class Contact
{
    private $_CONTACT_ID,
        $_BP,
        $_TELEPHONE_1,
        $_TELEPHONE_2,
        $_EMAIL,
        $_SITE;

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
    public function CONTACT_ID()
    {
        return $this->_CONTACT_ID;
    }
    public function BP()
    {
        return $this->_BP;
    }
    public function TELEPHONE_1()
    {
        return $this->_TELEPHONE_1;
    }
    public function TELEPHONE_2()
    {
        return $this->_TELEPHONE_2;
    }
    public function EMAIL()
    {
        return $this->_EMAIL;
    }
    public function SITE()
    {
        return $this->_SITE;
    }
    

    // SETTERS
    public function setCONTACT_ID($id)
    {

        if ($id > 0)
        {
            $this->_CONTACT_ID = $id;
        }
    }
    public function setBP($bp)
    {

            $this->_BP = $bp;

    }
    public function setTELEPHONE_1($telephone)
    {

            $this->_TELEPHONE_1 = $telephone;

    }
    public function setTELEPHONE_2($telephone)
    {

            $this->_TELEPHONE_2 = $telephone;

    }
    public function setEMAIL($email)
    {

            $this->_EMAIL = $email;

    }
    public function setSITE($site)
    {

            $this->_SITE = $site;

    }

}

class ContactManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(Contact $Contact)
    {
        $q = $this->_db->prepare('INSERT INTO contacts SET CONTACT_ID = :contactid, BP = :bp, TELEPHONE_1 = :telephone1, TELEPHONE_2 = :telephone2, EMAIL = :email, SITE = :site');
        $q->bindValue(':contactid', $Contact->CONTACT_ID(), PDO::PARAM_INT);
        $q->bindValue(':bp', $Contact->BP());
        $q->bindValue(':telephone1', $Contact->TELEPHONE_1());
        $q->bindValue(':telephone2', $Contact->TELEPHONE_2());
        $q->bindValue(':email', $Contact->EMAIL());
        $q->bindValue(':site', $Contact->SITE());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
    }
    public function delete(Contact $Contact)
    {
        $this->_db->exec('DELETE FROM contacts WHERE id = '.$Contact->id());
    }
    public function existsId($info)
    {
        return (bool) $this->_db->query('SELECT COUNT(*) FROM contacts WHERE CONTACT_ID = '.$info)->fetchColumn();
    }
    public function existsEmail($info)
    {
            $q = $this->_db->prepare('SELECT COUNT(*) FROM contacts WHERE EMAIL = :email');
            $q->execute(array(':email' => $info));
            return (bool) $q->fetchColumn();
    }
    public function get($info)
    {
        /*if (is_string($info))
        {
            $q = $this->_db->prepare('SELECT * FROM contacts WHERE EMAIL = :email');
            $q->execute(array(':email' => $info));
            return new Contact($q->fetch(PDO::FETCH_ASSOC));
        }
        else
        {*/
            $q = $this->_db->query('SELECT * FROM contacts WHERE CONTACT_ID = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new Contact($donnees);
        //}
    }
    public function getList()
    {
        $Contacts = array();
        $q = $this->_db->prepare('SELECT * FROM contacts  ORDER BY CONTACT_ID');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $Contacts[] = new Contact($donnees);
        }
        return $Contacts;
    }
    public function update(Contact $Contact)
    {
        $q = $this->_db->prepare('UPDATE contacts SET BP = :bp, TELEPHONE_1 = :telephone1, TELEPHONE_2 = :telephone2, EMAIL = :email, SITE = :site WHERE CONTACT_ID = :id');
        $q->bindValue(':bp', $Contact->BP());
        $q->bindValue(':telephone1', $Contact->TELEPHONE_1());
        $q->bindValue(':telephone2', $Contact->TELEPHONE_2());
        $q->bindValue(':email', $Contact->EMAIL());
        $q->bindValue(':site', $Contact->SITE());
        $q->bindValue(':id', $Contact->CONTACT_ID(), PDO::PARAM_INT);
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>