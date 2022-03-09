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
            'conditions' => array('vente.categorie_id' => 'categorie.id', 'vente.rayon_id' => 'rayon.id')
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

        $d['employes'] = $this->Vente->find(array(
            'table' => 'employe'
        ));

        $d['caisse'] = $this->Vente->findFirst(array(
            //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
            'table' => 'caisse',
            'conditions' => array('supprimer' => 0, 'etat' => '"Ouvert"')
        ));


        $d['caisseAll'] = $this->Vente->find(array(
            'table' => 'caisse'
        ));

        $j = 0;
        $_prixTotalEncaisser = 0;
        foreach ($d['caisseAll'] as $k => $v) : 

            $d['employe'][$j] = $this->Vente->findFirst(array(
                //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                'table' => 'employe',
                'conditions' => array('id' => $v->user_id, 'supprimer' => 0)
            ));
            $d['employe'][$j] = $d['employe'][$j]->user_id;

            $d['_user'][$j] = $this->Vente->findFirst(array(
                'table' => 'user',
                'conditions' => array('id' => $d['employe'][$j], 'supprimer' => 0)
            ));
            $d['_user'][$j] = $d['_user'][$j]->nom.'-'.$d['_user'][$j]->prenom;

            $d['venteCaisse'][$j] = $this->Vente->findFirst(array(
                'table' => 'vente v',
                'conditions' => array('v.caisse_id' => $v->id, 'v.supprimer' => 0),
            ));
            $d['ventes'] = $this->Vente->find(array(
                'table' => 'vente',
                'conditions' => array('supprimer' => 0, 'caisse_id' => $v->id)
            ));
            $a = 0;
            $_prix = 0;
            foreach ($d['ventes'] as $k => $v) :

                $_prix = $v->prixTotal + $_prix;

                $a++;
            endforeach;
            $_prixTotalEncaisser = $_prix + $_prixTotalEncaisser;
            $d['venteCaisse'][$j] = $_prix;
            $j++;
        endforeach;
        $d['totalVenteEncaisser'] = $_prixTotalEncaisser;



        $d['venteAll'] = $this->Vente->find(array(
            'fields' => 'v.id as id,prixTotal,prixPercu,commentaire,dateVente,v.etat,v.user_id,nouveau_info,reference,identifiant',
            'table' => 'vente v, employe e',
            'order' => 'dateVente-DESC',
            'conditions' => array('v.supprimer' => 0)
        ));

        if (!empty($d['caisse'])) {
            $d['ventes'] = $this->Vente->find(array(
                'fields' => 'v.id as id,prixTotal,prixPercu,commentaire,dateVente,v.etat,v.user_id,nouveau_info,reference,identifiant',
                'table' => 'vente v, employe e',
                'order' => 'dateVente-DESC',
                'conditions' => array('v.supprimer' => 0, 'caisse_id' => $d['caisse']->id, 'v.employe_id' => 'e.id')
            ));
            // $js_code = json_encode($d['ventes'],JSON_HEX_TAG);
            // for ($i=0; $i < $js_code; $i++) { 
            //     # code...
            // }
            //echo $js_code;

            $i = 0;
            $d['totalVente'] = 0;
            if (!empty($d['ventes'])) {
                $d['vente10Day'] = $this->Vente->find(array(
                    'table' => 'vente',
                    'conditions' => 'dateVente >= DATE_SUB(CURDATE(), INTERVAL 6 day)'
                ));

                $d['ventePresentWeek'] = $this->Vente->find(array(
                    'table' => 'vente',
                    'conditions' => 'WEEKOFYEAR(dateVente)=WEEKOFYEAR(CURDATE())'
                ));

                $d['ventePresentMonth'] = $this->Vente->find(array(
                    'table' => 'vente',
                    'conditions' => 'DATE_FORMAT(CURDATE() ,"%Y-%m-01") AND CURDATE()'
                ));

                $d['vente7Day'] = $this->Vente->find(array(
                    'table' => 'vente',
                    'conditions' => 'dateVente >= DATE_SUB(CURDATE(), INTERVAL 7 day)'
                ));

                //$js_code = json_encode($d['ventePresentMonth'],JSON_HEX_TAG);
                //echo $js_code;
                //print_r($d['ventes']);

                foreach ($d['ventes'] as $k => $v) :
                    $d['produits'][$i] = $this->Vente->find(array(
                        //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                        'table' => 'concerner c, en_rayon e, produit p',
                        'conditions' => array('c.vente_id' => $v->id, 'c.supprimer' => 0, 'c.en_rayon_id' => 'e.id', 'e.produit_id' => 'p.id')
                    ));
                    $js_code = json_encode($d['produits'], JSON_HEX_TAG);
                    //echo $js_code;
                    $d['totalVente'] = $v->prixTotal + $d['totalVente'];
                    if ($v->user_id == NULL) {
                        $d['user'][$i] = $v->nouveau_info;
                    } else {
                        $d['user'][$i] = $this->Vente->findFirst(array(
                            //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                            'table' => 'user',
                            'conditions' => array('id' => $v->user_id, 'supprimer' => 0)
                        ));
                        $d['user'][$i] = $d['user'][$i]->nom;
                    }
                    $i++;
                endforeach;
                //echo $d['totalVente'];
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

    function koudjine_retour_vente()
    {
        $this->loadModel('Vente');
    }
}
