<?php
class StockController extends Controller
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
        $this->loadModel('Stock');
        $d['inventaire'] = $this->Stock->find(array(
            //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'inventaire',
            //'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('etat' => "'En cours'", 'supprimer' => 0)
        ));

        $this->set($d);
    }


    function koudjine_inventaire()
    {
        $this->loadModel('Stock');
        $d['inventaire'] = $this->Stock->find(array(
            //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'inventaire',
            //'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('etat' => "'En cours'", 'supprimer' => 0)
        ));

        $this->set($d);
    }

}
