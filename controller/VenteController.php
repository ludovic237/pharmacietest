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

        $d['caisse'] = $this->Vente->findFirst(array(
            //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
            'table' => 'caisse',
            'conditions' => array('supprimer' => 0,'etat' => '"Ouvert"')
        ));

        if(!empty($d['caisse'])){
            $d['ventes'] = $this->Vente->find(array(
                //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                'table' => 'vente',
                'order' => 'dateVente-DESC',
                'conditions' => array('supprimer' => 0,'caisse_id' => $d['caisse']->id)
            ));
            $i = 0;
            if(!empty($d['ventes'])){
                foreach ($d['ventes'] as $k => $v):
                    $d['produits'][$i] = $this->Vente->find(array(
                        //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                        'table' => 'concerner c, en_rayon e, produit p',
                        'conditions' => array('c.vente_id' => $v->id, 'c.supprimer' => 0, 'C.en_rayon_id' => 'e.id', 'e.produit_id' => 'p.id')
                    ));
                if($v->user_id == null){
                    $d['user'][$i] = $v->nouveau_info;
                }
                else{
                    $d['user'][$i] = $this->Vente->findFirst(array(
                        //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                        'table' => 'user',
                        'conditions' => array('id' => $v->user_id, 'supprimer' => 0)
                    ));
                    $d['user'][$i] = $d['user'][$i]->nom;
                }
                $i++;
                endforeach;
            }
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
