<?php
class StatistiqueController extends Controller
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
        $this->loadModel('Statistique');


        $d['Statistique'] = $this->Statistique->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }

    function koudjine_produitplusvendu()
    {
        $this->loadModel('Statistique');
    }

    function koudjine_chiffre()
    {
        $this->loadModel('Statistique');

        $d['_employes'] = $this->Statistique->find(array(
            'table' => 'employe'
        ));

        $d['caisseAll'] = $this->Statistique->find(array(
            'table' => 'caisse'
        ));

        $j = 0;
        $_prixTotalEncaisser = 0;
        foreach ($d['caisseAll'] as $k => $v) :

            $d['employe'][$j] = $this->Statistique->findFirst(array(
                //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                'table' => 'employe',
                'conditions' => array('id' => $v->user_id, 'supprimer' => 0)
            ));
            $d['employe'][$j] = $d['employe'][$j]->user_id;

            $d['_user'][$j] = $this->Statistique->findFirst(array(
                'table' => 'user',
                'conditions' => array('id' => $d['employe'][$j], 'supprimer' => 0)
            ));
            $d['_user'][$j] = $d['_user'][$j]->nom.'-'.$d['_user'][$j]->prenom;

            $d['venteCaisse'][$j] = $this->Statistique->findFirst(array(
                'table' => 'vente v',
                'conditions' => array('v.caisse_id' => $v->id, 'v.supprimer' => 0),
            ));
            $d['ventes'] = $this->Statistique->find(array(
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

        $this->set($d);
    }
  
}
