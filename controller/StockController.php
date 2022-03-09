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


    function koudjine_inventaire($id=null)
    {
        $this->loadModel('Stock');
        $d['inventaire'] = $this->Stock->findFirst(array(
            //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'inventaire',
            //'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('etat' => "'En cours'", 'supprimer' => 0)
        ));
        $d['inventaires'] = $this->Stock->find(array(
            //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'inventaire',
            //'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('etat' => "'Clot'", 'supprimer' => 0)
        ));
        if(!empty($d['inventaire'])){
            if($_SESSION['Users']->type == 'Administrateur'){
            $d['produits'] = $this->Stock->find(array(
                //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
                'table' => 'produit_inventaire, en_rayon, produit, employe',
                //'order' => 'DATE_DEBUT_CONCOURS-DESC',
                'conditions' => array('inventaire_id' => $d['inventaire']->id, 'en_rayon.id' => 'produit_inventaire.en_rayon_id', 'produit.id' => 'en_rayon.produit_id', 'employe.id' => 'produit_inventaire.employe_id', 'en_rayon.supprimer' => 0, 'employe.supprimer' => 0, 'produit_inventaire.supprimer' => 0)
            ));
                $d['produits_nonI'] = $this->Stock->find(array(
                    'fields' => 'en_rayon.id as id, dateLivraison, prixVente, quantiteRestante, nom',
                    'table' => 'en_rayon, produit',
                    //'order' => 'DATE_DEBUT_CONCOURS-DESC',
                    'conditions' => ('produit.id = en_rayon.produit_id  AND etat = "Utile" AND en_rayon.supprimer = 0 AND produit.supprimer = 0 AND en_rayon.id NOT IN (select en_rayon_id from produit_inventaire where inventaire_id = '.$d['inventaire']->id.' AND produit_inventaire.supprimer = 0  )')
                ));
            }
            else{
                $d['produits'] = $this->Stock->find(array(
                    //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
                    'table' => 'produit_inventaire, en_rayon, produit, employe',
                    //'order' => 'DATE_DEBUT_CONCOURS-DESC',
                    'conditions' => array('inventaire_id' => $d['inventaire']->id, 'produit_inventaire.employe_id' => $_SESSION["Users"]->id, 'en_rayon.id' => 'produit_inventaire.en_rayon_id', 'produit.id' => 'en_rayon.produit_id', 'employe.id' => 'produit_inventaire.employe_id', 'en_rayon.supprimer' => 0, 'employe.supprimer' => 0, 'produit_inventaire.supprimer' => 0)
                ));
            }
            //print_r($d['produits']);
           // die();
        }else{
            if(isset($id)){
                $d['produits'] = $this->Stock->find(array(
                    //'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
                    'table' => 'produit_inventaire, en_rayon, produit, employe',
                    //'order' => 'DATE_DEBUT_CONCOURS-DESC',
                    'conditions' => array('inventaire_id' => $id, 'en_rayon.id' => 'produit_inventaire.en_rayon_id', 'produit.id' => 'en_rayon.produit_id', 'employe.id' => 'produit_inventaire.employe_id', 'en_rayon.supprimer' => 0, 'employe.supprimer' => 0, 'produit_inventaire.supprimer' => 0)
                ));
                $d['id'] = $id;
            }
        }

        $this->set($d);
    }

}
