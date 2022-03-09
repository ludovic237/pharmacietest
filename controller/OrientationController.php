<?php
class OrientationController extends Controller{

    function index(){

    }

    // Questions d'ordre général
    function interets_professionnels(){
        $this->loadModel('Orientation');

        $d['questions'] = $this->Orientation->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'question_orientation',
            'conditions' => array('SUPPRIMER' => 0,'TYPE' =>'"General"')
        ));

        $this->set($d);
    }

    // Questions d'ordre personnel
    function personnalite(){
        $this->loadModel('Orientation');

        $d['questions'] = $this->Orientation->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'question_orientation',
            'conditions' => array('SUPPRIMER' => 0,'TYPE' =>'"Personnalite"')
        ));

        $this->set($d);
    }

    /**
     * ADMIN
     */

    function koudjine_questions(){
        $this->loadModel('Orientation');

        $d['questions'] = $this->Orientation->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'question_orientation',
            'conditions' => array('SUPPRIMER' => 0)
        ));

        $this->set($d);
    }

    function koudjine_configuration($id=null){
        $this->loadModel('Orientation');
        if($id == null){
            //$this->redirect("bouwou/orientation/question",301);
            $d['categories'] = $this->Orientation->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'categorie_filiere',
                'order' => 'nom-ASC',
                'conditions' => array('SUPPRIMER' => 0)
            ));
            $d['total'] = $this->Orientation->findCount(array('SUPPRIMER' => 0),'CATEGORIE_ID','categorie_filiere');
        }
        else {

            $d['id'] = $id;

            $d['question'] = $this->Orientation->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'question_orientation',
                'conditions' => array('QUESTION_ID' => $id, 'SUPPRIMER' => 0)
            ));
            $d['categories'] = $this->Orientation->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'categorie_filiere',
                'order' => 'nom-ASC',
                'conditions' => array('SUPPRIMER' => 0)
            ));
            $d['total'] = $this->Orientation->findCount(array('SUPPRIMER' => 0),'CATEGORIE_ID','categorie_filiere');
            $d['question_conf'] = $this->Orientation->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'question_categorie',
                'conditions' => array('QUESTION_ID' => $id)
            ));
        }

        $this->set($d);
    }

    function  koudjine_recapitulatif($option=null,$id=null){
        $this->loadModel('Orientation');
        $d['option'] = $option;
        $d['id'] = $id;
        $d['questions'] = $this->Orientation->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'question_orientation',
            'conditions' => array( 'SUPPRIMER' => 0)
        ));
        $d['categories'] = $this->Orientation->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'categorie_filiere',
            'order' => 'nom-ASC',
            'conditions' => array('SUPPRIMER' => 0)
        ));
        if($option != null && $id != null){

            if($option == "categorie"){
                $d['quest_cat'] = $this->Orientation->find(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'question_categorie c,question_orientation o,categorie_filiere f',
                    'conditions' => array('c.CATEGORIE_ID' => $id,'c.QUESTION_ID' => 'o.QUESTION_ID','f.CATEGORIE_ID' => 'c.CATEGORIE_ID' ,'o.SUPPRIMER' => 0 ,'f.SUPPRIMER' => 0)
                ));
                $d['categorie'] = $this->Orientation->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'categorie_filiere',
                    'order' => 'nom-ASC',
                    'conditions' => array('CATEGORIE_ID' => $id,'SUPPRIMER' => 0)
                ));
            }
            else{
                $d['quest_cat'] = $this->Orientation->find(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'question_categorie c,question_orientation o,categorie_filiere f',
                    'conditions' => array('c.QUESTION_ID' => $id,'o.QUESTION_ID' => 'c.QUESTION_ID','f.CATEGORIE_ID' => 'c.CATEGORIE_ID' ,'o.SUPPRIMER' => 0 ,'f.SUPPRIMER' => 0)
                ));
                $d['question'] = $this->Orientation->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'question_orientation',
                    'conditions' => array( 'QUESTION_ID' => $id, 'SUPPRIMER' => 0)
                ));
            }
        }

        $this->set($d);
    }
}