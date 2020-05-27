<?php
class PharmanetController extends Controller
{


    /*function index(){
        $perPage = 1;
        $this->loadModel('Post');
        $condition = array('online' => 1, 'type' => 'post');
        $d['posts'] = $this->Post->find(array(
            'conditions' => $condition,
            'limit' => ($perPage*$this->request->page-1).','.$perPage
        ));
        $d['total'] = $this->Post->findCount($condition);
        $d['page'] = ceil($d['total'] / $perPage);
        $this->set($d);
    }*/



    /**
     * ADMIN
     */
    function koudjine_index()
    {
        $this->loadModel('Pharmanet');


        $d['pharmanet'] = $this->Pharmanet->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }


    function koudjine_user()
    {
        $this->loadModel('Pharmanet');

        $d['pharmanet'] = $this->Pharmanet->find(array(
            'fields' => 'id,name,surname,email,code,password,etat,type,type2,telephone ',
            'table' => 'user',

        ));
        //die($d);
        if (empty($d['pharmanet'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_offiline()
    {
        $this->loadModel('Pharmanet');

        $d['pharmanet'] = $this->Pharmanet->find(array(
            'fields' => 'id,name,surname,email,code,password,etat,type,type2,telephone ',
            'table' => 'user',

        ));
        //die($d);
        if (empty($d['pharmanet'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_aboutus()
    {
        $this->loadModel('Pharmanet');

        $d['pharmanet'] = $this->Pharmanet->find(array(
            'fields' => 'id,name,surname,email,code,password,etat,type,type2,telephone ',
            'table' => 'user',

        ));
        //die($d);
        if (empty($d['pharmanet'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

}

