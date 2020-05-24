<?php
class MediasController extends Controller{

    function koudjine_index($rubrique = null){
        //$this->layout ='modal';
        if($rubrique == null){
            $this->loadModel('Media');
            $perPage = 8;
            $condition = array('SUPPRIMER' => 0);
            $d['medias'] = $this->Media->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'medias',
                'order' => 'MEDIA_ID-ASC',
                'conditions' => $condition,
                'limit' => ($perPage*($this->request->page-1)).','.$perPage
            ));
            $d['total'] = $this->Media->findCount($condition,'MEDIA_ID','medias');
            $d['pages'] = ceil($d['total'] / $perPage);
        }
        else{
            $this->loadModel('Media');
            $perPage = 8;
            $condition = array('SUPPRIMER' => 0,'RUBRIQUE' => '\''.$rubrique.'\'');
            $d['medias'] = $this->Media->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'medias',
                'order' => 'MEDIA_ID-ASC',
                'conditions' => $condition,
                'limit' => ($perPage*($this->request->page-1)).','.$perPage
            ));
            $d['total'] = $this->Media->findCount($condition,'MEDIA_ID','medias');
            $d['pages'] = ceil($d['total'] / $perPage);
            $d['rubrique'] = $rubrique;
        }
        $d['total1'] = $this->Media->findCount(array('SUPPRIMER' => 0),'MEDIA_ID','medias');
        $d['total2'] = $this->Media->findCount(array('SUPPRIMER' => 0,'RUBRIQUE' => '\''.'universites'.'\''),'MEDIA_ID','medias');
        $d['total3'] = $this->Media->findCount(array('SUPPRIMER' => 0,'RUBRIQUE' => '\''.'formations'.'\''),'MEDIA_ID','medias');
        $d['total4'] = $this->Media->findCount(array('SUPPRIMER' => 0,'RUBRIQUE' => '\''.'vie-etudiante'.'\''),'MEDIA_ID','medias');

        $this->set($d);
    }
}