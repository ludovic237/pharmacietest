<?php
class HomeController extends Controller
{


    /* function view($nom){
$this->set(array(
'phrase' => 'Salut',
'test' => 'machin'
));
$this->render('index');
}*/
    function koudjine_index()
    {

        $this->loadModel('Home');
        //$d['total_univ'] = $this->Home->findCount('SUPPRIMER = 0','universite.UNIVERSITE_ID','universite');
        //$d['total_formations'] = $this->Home->findCount('SUPPRIMER = 0','distinct NOM','filiere');
        //$d['total_concours'] = $this->Home->findCount('SUPPRIMER = 0',' CONCOURS_ID','acces_concours');

        //$this->set($d);

        $d['caisse'] = $this->Home->findFirst(array(
            //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
            'table' => 'caisse',
            'conditions' => array('supprimer' => 0, 'etat' => '"Ouvert"')
        ));

        if (!empty($d['caisse'])) {
            $d['ventes'] = $this->Home->find(array(
                //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                'table' => 'vente',
                'order' => 'dateVente-DESC',
                'conditions' => array('supprimer' => 0, 'caisse_id' => $d['caisse']->id)
            ));
            // $js_code = json_encode($d['ventes'],JSON_HEX_TAG);
            // for ($i=0; $i < $js_code; $i++) { 
            //     # code...
            // }
            //echo $js_code;

            $i = 0;
            $d['totalVente'] = 0;
            $d['totalVente10'] = 0;
            $d['totalVenteWeek'] = 0;
            $d['totalVenteMonth'] = 0;
            $d['totalVenteYear'] = 0;
            if (!empty($d['ventes'])) {
                $d['vente10Day'] = $this->Home->find(array(
                    'table' => 'vente',
                    'conditions' => 'dateVente >= DATE_SUB(CURDATE(), INTERVAL 10 day)'
                ));
                foreach ($d['vente10Day'] as $k => $v) :
                    $d['totalVente10'] = $v->prixTotal + $d['totalVente10'];
                endforeach;


                $d['ventePresentWeek'] = $this->Home->find(array(
                    'table' => 'vente',
                    'conditions' => 'WEEKOFYEAR(dateVente)=WEEKOFYEAR(CURDATE())'
                ));
                foreach ($d['ventePresentWeek'] as $k => $v) :
                    $d['totalVenteWeek'] = $v->prixTotal + $d['totalVenteWeek'];
                endforeach;

                $d['ventePresentMonth'] = $this->Home->find(array(
                    'table' => 'vente',
                    'conditions' => 'DATE_FORMAT(CURDATE() ,"%Y-%m-01") AND CURDATE()'
                ));
                foreach ($d['ventePresentMonth'] as $k => $v) :
                    $d['totalVenteMonth'] = $v->prixTotal + $d['totalVenteMonth'];
                endforeach;
                $d['ventePresentYear'] = $this->Home->find(array(
                    'table' => 'vente',
                    'conditions' => 'DATE_FORMAT(CURDATE() ,"%Y-01-01") AND CURDATE()'
                ));
                foreach ($d['ventePresentYear'] as $k => $v) :
                    $d['totalVenteYear'] = $v->prixTotal + $d['totalVenteYear'];
                endforeach;
                $d['vente7Day'] = $this->Home->find(array(
                    'table' => 'vente',
                    'conditions' => 'dateVente >= DATE_SUB(CURDATE(), INTERVAL 7 day)'
                ));

                //$js_code = json_encode($d['ventePresentMonth'],JSON_HEX_TAG);
                //echo $js_code;

                foreach ($d['ventes'] as $k => $v) :
                    $d['produits'][$i] = $this->Home->find(array(
                        //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                        'table' => 'concerner c, en_rayon e, produit p',
                        'conditions' => array('c.vente_id' => $v->id, 'c.supprimer' => 0, 'c.en_rayon_id' => 'e.id', 'e.produit_id' => 'p.id')
                    ));
                    $js_code = json_encode($d['produits'], JSON_HEX_TAG);
                    //echo $js_code;
                    $d['totalVente'] = $v->prixTotal + $d['totalVente'];
                    if ($v->user_id == null) {
                        $d['user'][$i] = $v->nouveau_info;
                    } else {
                        $d['user'][$i] = $this->Home->findFirst(array(
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
}
