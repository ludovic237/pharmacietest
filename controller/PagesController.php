<?php
class PagesController extends Controller{


   /* function view($nom){
        $this->set(array(
            'phrase' => 'Salut',
            'test' => 'machin'
        ));
       $this->render('index');
    }*/
    function view($id){
        $this->loadModel('Post');
        $d['page'] = $this->Post->findFirst(array(
            'conditions' => array('online' => 1, 'id' => $id, 'type' => 'page')
        ));
        if(empty($d['page'])){
            $this->e404('Page introuvable');
        }

        $d['pages'] = $this->Post->find(array(
            'conditions' => array('online' => 1, 'type' => 'page')
        ));
        $this->set($d);

    }

    /**
     * Permet de récupérer les pages pour le menu
     */
    function getMenu(){
        $this->loadModel('Post');
        return $this->Post->find(array( 'conditions' =>array('online' => 1,'type' => 'page')));

    }

}