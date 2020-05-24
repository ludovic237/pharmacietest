<?php
class FacultesController extends Controller{

    /**
     * ADMIN
     */
    function koudjine_index($id=null){
        $this->loadModel('Facultes');
        $d['id'] = $id;
        if($id != null){


            $d['universites'] = $this->Facultes->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'universite',
                'order' => 'nom-ASC',
                'conditions' => array('SUPPRIMER' => 0)
            ));
            $d['facultesList'] = $this->Facultes->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'departement',
                'order' => 'nom-ASC',
                //'conditions' => array('departement.SUPPRIMER' => 0,'departement.UNIVERSITE_ID' => $id,'NOM' => '"GENERAL"')
                'conditions' => 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$id.' AND NOM <> '."\"GENERAL\""
            ));
            $condition = 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$id.' AND NOM <> '."\"GENERAL\"";
            $d['total'] = $this->Facultes->findCount($condition,'departement.UNIVERSITE_ID','departement');


            if(empty($d['facultesList'])){
                //$this->e404('Page introuvable');
                $d['faculte'] = $this->Facultes->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'departement',
                    //'conditions' => array('departement.SUPPRIMER' => 0,'departement.UNIVERSITE_ID' => $id,'NOM' => '"GENERAL"')
                    'conditions' => 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$id.' AND NOM = '."\"GENERAL\""
                ));
                if(empty($d['faculte'])) $this->redirect('bouwou/facultes/index');
            }
        }
        else {
            $d['universites'] = $this->Facultes->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'universite',
                'order' => 'nom-ASC',
                'conditions' => array('SUPPRIMER' => 0)
            ));
        }

        $this->set($d);
    }

    function koudjine_delete($id){
        $this->loadModel('Facultes');
        $this->Facultes->delete($id,'departement','DEPARTEMENT_ID');
        //$this->redirect('koudjine/universites/index');
    }
}
