<?php

class QuestionCategorie
{
    private $_QUESTION_ID,
        $_CATEGORIE_ID,
        $_TAUX;

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
    public function QUESTION_ID()
    {
        return $this->_QUESTION_ID;
    }
    public function CATEGORIE_ID()
    {
        return $this->_CATEGORIE_ID;
    }
    public function TAUX()
    {
        return $this->_TAUX;
    }

    // SETTERS
    public function setQUESTION_ID($id)
    {

        if ($id > 0)
        {
            $this->_QUESTION_ID = $id;
        }
    }
    public function setCATEGORIE_ID($id)
    {

        if ($id > 0)
        {
            $this->_CATEGORIE_ID = $id;
        }
    }
    public function setTAUX($info)
    {

        $this->_TAUX = $info;

    }

}

class QuestionCategorieManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(QuestionCategorie $question)
    {
        $q = $this->_db->prepare('INSERT INTO question_categorie SET QUESTION_ID = :preid, CATEGORIE_ID = :catid, TAUX = :taux');
        $q->bindValue(':preid', $question->QUESTION_ID(), PDO::PARAM_INT);
        $q->bindValue(':catid', $question->CATEGORIE_ID(), PDO::PARAM_INT);
        $q->bindValue(':taux', $question->TAUX());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM question_categorie')->fetchColumn();
    }
    public function delete($question_id)
    {
        $this->_db->exec('DELETE FROM question_categorie WHERE QUESTION_ID = '.$question_id);
    }
    public function exists($question_id)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM question_categorie WHERE QUESTION_ID = :questid');
        $q->execute(array(':questid' => $question_id));
        return (bool) $q->fetchColumn();

    }
    public function get($question_id,$cat_id)
    {
        $q = $this->_db->prepare('SELECT * FROM question_categorie WHERE CATEGORIE_ID = :catid AND QUESTION_ID = :quesid');
        $q->execute(array(':questid' => $question_id,
                            ':catid' => $cat_id));
        return new QuestionCategorie($q->fetch(PDO::FETCH_ASSOC));
    }
    public function getList()
    {
        $questions = array();
        $q = $this->_db->prepare('SELECT * FROM question_categorie WHERE SUPPRIMER = 0 ');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $questions[] = new QuestionCategorie($donnees);
        }
        return $questions;
    }
    public function update(QuestionCategorie $question)
    {
        $q = $this->_db->prepare('UPDATE question_categorie SET TAUX = :taux WHERE QUESTION_ID= :id AND CATEGORIE_ID= :id1');
        $q->bindValue(':id', $question->QUESTION_ID(), PDO::PARAM_INT);
        $q->bindValue(':id1', $question->CATEGORIE_ID(), PDO::PARAM_INT);
        $q->bindValue(':taux', $question->TAUX());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>