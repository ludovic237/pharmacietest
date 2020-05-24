<?php

class QuestionOrientation
{
    private $_QUESTION_ID,
        $_QUESTION,
        $_TYPE,
        $_SUPPRIMER;

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
    public function QUESTION()
    {
        return $this->_QUESTION;
    }
    public function TYPE()
    {
        return $this->_TYPE;
    }
    public function SUPPRIMER()
    {
        return $this->_SUPPRIMER;
    }

    // SETTERS
    public function setQUESTION_ID($id)
    {

        if ($id > 0)
        {
            $this->_QUESTION_ID = $id;
        }
    }
    public function setQUESTION($info)
    {

        $this->_QUESTION = $info;

    }
    public function setTYPE($info)
    {

        $this->_TYPE = $info;

    }
    public function setSUPPRIMER($del)
    {

        $this->_SUPPRIMER = $del;

    }

}

class QuestionOrientationManager
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }
    public function add(QuestionOrientation $question)
    {
        $q = $this->_db->prepare('INSERT INTO question_orientation SET QUESTION_ID = :preid, QUESTION = :question, TYPE = :type, SUPPRIMER = 0');
        $q->bindValue(':preid', $question->QUESTION_ID(), PDO::PARAM_INT);
        $q->bindValue(':question', $question->QUESTION());
        $q->bindValue(':type', $question->TYPE());
        $q->execute();
    }
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM question_orientation')->fetchColumn();
    }
    public function delete(QuestionOrientation $question)
    {
        $this->_db->exec('DELETE FROM question_orientation WHERE QUESTION_ID = '.$question->QUESTION_ID());
    }
    public function exists($info)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM question_orientation WHERE QUESTION = :question AND SUPPRIMER = 0');
        $q->execute(array(':question' => $info));
        return (bool) $q->fetchColumn();

    }
    public function get($info)
    {
        $q = $this->_db->prepare('SELECT * FROM question_orientation WHERE QUESTION = :question AND SUPPRIMER = 0');
        $q->execute(array(':question' => $info));
        return new QuestionOrientation($q->fetch(PDO::FETCH_ASSOC));
    }
    public function getList()
    {
        $questions = array();
        $q = $this->_db->prepare('SELECT * FROM question_orientation WHERE SUPPRIMER = 0 ');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $questions[] = new QuestionOrientation($donnees);
        }
        return $questions;
    }
    public function update(QuestionOrientation $question)
    {
        $q = $this->_db->prepare('UPDATE question_orientation SET QUESTION = :question, TYPE = :type WHERE QUESTION_ID= :id');
        $q->bindValue(':id', $question->QUESTION_ID(), PDO::PARAM_INT);
        $q->bindValue(':question', $question->QUESTION());
        $q->bindValue(':type', $question->TYPE());
        $q->execute();
    }
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

?>