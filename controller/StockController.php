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
        $d['inventaire'] = $this->Stock->findFirst(array(
            //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'inventaire',
            //'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('etat' => "'En cours'", 'supprimer' => 0)
        ));
        if(!empty($d['inventaire'])){
            $d['produits'] = $this->Stock->find(array(
                //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
                'table' => 'produit_inventaire, en_rayon, produit, employe',
                //'order' => 'DATE_DEBUT_CONCOURS-DESC',
                'conditions' => array('inventaire_id' => $d['inventaire']->id, 'en_rayon.id' => 'produit_inventaire.en_rayon_id', 'produit.id' => 'en_rayon.produit_id', 'employe.id' => 'produit_inventaire.employe_id', 'en_rayon.supprimer' => 0, 'employe.supprimer' => 0, 'produit_inventaire.supprimer' => 0)
            ));
            //print_r($d['produits']);
           // die();
        }

        $this->set($d);
    }

}
