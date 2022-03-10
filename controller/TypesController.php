<?php
class TypesController extends Controller{

    /**
     * ADMIN
     */
    function koudjine_index(){
        $this->loadModel('Types');


            $d['typescertif'] = $this->Types->find(array(
                'table' => 'type',
                'conditions' => array('SUPPRIMER' => 0,'CERTIFICATION' => '"'."Certifié".'"')
            ));
            $d['typesnoncertif'] = $this->Types->find(array(
                'table' => 'type',
                'conditions' => array('SUPPRIMER' => 0,'CERTIFICATION' => '"'.'En attente'.'"')
            ));





        $this->set($d);
    }

    function koudjine_delete($id){
        $this->loadModel('Types');
        $this->Types->delete($id,'type','TYPE_ID');
        //$this->redirect('koudjine/universites/index');
    }
}
