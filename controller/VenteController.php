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


        $d['vente'] = $this->Vente->find(array(
            'fields' => 'vente.id as id,vente.montantRegle as montantRegle,reelPercu',
            'table' => 'vente,categorie,montantRegle',
            'order' => 'nomp-ASC',
            'conditions' => array('vente.categorie_id' => 'categorie.id','vente.rayon_id' => 'rayon.id')
        ));
        $this->set($d);
    }


    function koudjine_venteadd($id = null)
    {
        $this->loadModel('Vente');

        $d['client'] = $this->Vente->find(array(
            //'fields' => 'vente.id as id,vente.montantRegle as montantRegle,reelPercu',
            'table' => 'user',
            'order' => 'nom-ASC',
            //'conditions' => array('vente.categorie_id' => 'categorie.id','vente.rayon_id' => 'rayon.id')
        ));
        $d['prescripteur'] = $this->Vente->find(array(
            //'fields' => 'vente.id as id,vente.montantRegle as montantRegle,reelPercu',
            'table' => 'prescripteur',
            'order' => 'nom-ASC',
            //'conditions' => array('vente.categorie_id' => 'categorie.id','vente.rayon_id' => 'rayon.id')
        ));

        if ($id != null) {
            $d['position'] = 'Modifier';






        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_vente()
    {
        $this->loadModel('Vente');

        $d['vente'] = $this->Vente->find(array(
            'fields' => 'vente.id as id,montantRegle,reelPercu,commentaire,dateVente,etat,ref',
            'table' => 'vente',
        ));

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
