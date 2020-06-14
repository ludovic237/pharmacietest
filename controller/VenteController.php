<?php
class VenteController extends Controller
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
        $this->loadModel('Vente');


        $d['Vente'] = $this->Vente->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }


    function koudjine_venteadd($id = null)
    {
        $this->loadModel('Vente');
        if ($id != null) {
            $d['position'] = 'Modifier';
 
            $d['concours'] = $this->Concours->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'acces_concours',
                'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
            ));



            if (empty($d['concours'])) {
                $this->e404('Page introuvable');
            }
        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_vente()
    {
        $this->loadModel('Catalogue');
        
        $d['vente'] = $this->Catalogue->find(array(
            'fields' => 'vente.id as idv,vente.montantRegle as montantReglev,vente.reelPercu as reelPercuv,vente.dateVente as dateVentev,vente.commentaire as commentairev,vente.etat as etatv,vente.caisse_id as caisse_idv,vente.ref as refv',
            'table' => 'vente',
        ));
        //die($d);
        if(empty($d['vente'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_reglement()
    {
        $this->loadModel('Vente');
    }

    function koudjine_chiffreaffaire()
    {
        $this->loadModel('Vente');
    }

}
