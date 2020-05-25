<?php
class CatalogueController extends Controller
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

    function index()
    {

        $this->loadModel('Concours');
        $d['concours'] = $this->Concours->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));

        if (empty($d['concours'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
    function presentation($id, $slug)
    {

        $this->loadModel('Concours');
        $d['concours'] = $this->Concours->findFirst(array(
            'fields' => 'C.COMPOSITION_DOSSIER,C.MODALITE_ADMISSION,C.DATE_DEBUT_CONCOURS,C.DATE_FIN_CONCOURS,C.DESCRIPTION,U.NOM as nom,C.DATE_DOSSIER,U.NOM_COMPLET as nomc,C.CONCOURS_ID as id',
            'table' => 'acces_concours C,universite U',
            'conditions' => "C.UNIVERSITE_ID = U.UNIVERSITE_ID AND C.SUPPRIMER = 0 AND U.SUPPRIMER = 0  AND C.CONCOURS_ID = " . $id . ""
        ));

        $d['matiere'] = $this->Concours->find(array(
            'fields' => 'NOM,DUREE',
            'table' => 'concours_matiere,matiere',
            'conditions' => array('concours_matiere.MATIERE_ID' => 'matiere.MATIERE_ID', 'matiere.SUPPRIMER' => 0, 'concours_matiere.CONCOURS_ID' => $id)
        ));

        //echo str_replace(' ','_',$d['concours']->nom );
        /*$slug_con = str_replace(' ','_',$d['concours']->nom );
        $slug_con = strtolower($slug_con);
        if($slug != $slug_con){
            $this->redirect("concours/presentation/id:$id/slug:".$slug_con,301);
        }*/

        if (empty($d['concours'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }


    /**
     * ADMIN
     */
    function koudjine_index()
    {
        $this->loadModel('Catalogue');


        $d['Catalogue'] = $this->Catalogue->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }

    function koudjine_assureuradd($id = null)
    {
        $this->loadModel('Catalogue');

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

    function koudjine_assureur()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_clientadd()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_client()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_fabriquantadd()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_fabriquant()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_fournisseuradd($id = null)
    {
        $this->loadModel('Catalogue');

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

    function koudjine_fournisseur()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_prescripteuradd($id = null)
    {
        $this->loadModel('Catalogue');

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

    function koudjine_prescripteur()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_produitadd($id = null)
    {
        $this->loadModel('Catalogue');

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

    function koudjine_produit()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_produit_impression()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_categorieadd($id = null)
    {
        $this->loadModel('Catalogue');

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

    function koudjine_categorie()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_add()
    {
        $this->loadModel('Catalogue');
    }

    function koudjine_edit($id = null)
    {
        $this->loadModel('Concours');
        $d['universitesList'] = $this->Concours->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'universite',
            'order' => 'nom-ASC',
            'conditions' => array('universite.SUPPRIMER' => 0)
        ));

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

    function koudjine_delete($id)
    {
        $this->loadModel('Concours');
        $this->Concours->delete($id, 'acces_concours', 'CONCOURS_ID');
        //$this->redirect('koudjine/universites/index');
    }
}
