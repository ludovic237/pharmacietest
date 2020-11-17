<?php
class PharmanetController extends Controller
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
        $this->loadModel('Pharmanet');


        $d['pharmanet'] = $this->Pharmanet->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }

    function koudjine_offiline()
    {
        $this->loadModel('Pharmanet');

    }

    function koudjine_employe()
    {
        $this->loadModel('Pharmanet');

        $d['pharmanet'] = $this->Pharmanet->find(array(
            'fields' => 'employe.id as idemploye,employe.identifiant as identifiantemploye,employe.codebarre_id as codebarreidemploye,employe.user_id as useridemploye,employe.etat as etatemploye,employe.faireReductionMax as reductionemploye,employe.type as typeemploye',
            'table' => 'employe',
            'conditions' => array('supprimer' => 0)
        ));
        //die($d);
        if (empty($d['pharmanet'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_employeadd($id = null)
    {
        $this->loadModel('Pharmanet');

        $d['user'] = $this->Pharmanet->find(array(
            //'fields' => 'nom',
            'table' => 'user',
            'order' => 'nom-ASC',
            'conditions' => array('supprimer' => 0)
        ));

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['employe'] = $this->Pharmanet->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'employe',
                'conditions' => array('id' => $id, 'supprimer' => 0)
            ));


            if (empty($d['employe'])) {
                $this->e404('Page introuvable');
            }
        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_user()
    {
        $this->loadModel('Pharmanet');

        $d['pharmanet'] = $this->Pharmanet->find(array(
            'fields' => 'user.id as iduser,user.nom as nomuser,user.prenom as prenomuser,user.telephone as telephoneuser,user.email as emailuser,user.fonction as fonctionuser,user.reduction as reductionuser',
            'table' => 'user',
            'conditions' => array('supprimer' => 0)
        ));
        //die($d);
        if (empty($d['pharmanet'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_useradd($id = null)
    {
        $this->loadModel('Pharmanet');

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['user'] = $this->Pharmanet->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'user',
                'conditions' => array('id' => $id, 'supprimer' => 0)
            ));


            if (empty($d['user'])) {
                $this->e404('Page introuvable');
            }
        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_userprofile($id = null)
    {
        $this->loadModel('Pharmanet');

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['employe'] = $this->Pharmanet->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'employe',
                'conditions' => array('id' => $id, 'supprimer' => 0)
            ));
            $d['user'] = $this->Pharmanet->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'user',
                'conditions' => array('id' => $d['employe']->user_id, 'supprimer' => 0)
            ));

            if (empty($d['user'])) {
                $this->e404('Page introuvable');
            }
        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_list()
    {
        $this->loadModel('Pharmanet');

    }

    function koudjine_depenseadd()
    {
        $this->loadModel('Pharmanet');

    }

    function koudjine_delete($id, $table)
    {
        $this->loadModel('Pharmanet');
        $this->Pharmanet->delete($id, $table, 'id');
        //$this->redirect('koudjine/universites/index');
    }

}

