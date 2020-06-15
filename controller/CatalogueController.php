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


    function koudjine_prescripteur()
    {
        $this->loadModel('Catalogue');
        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'id,nom,structure,adresse,telephone',
            'table' => 'prescripteur',

        ));
        //die($d);
        if (empty($d['catalogue'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_assureuradd()
    {
        $this->loadModel('Catalogue');
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

    function koudjine_produitadd($id = null)
    {
        $this->loadModel('Catalogue');

        $d['categorie'] = $this->Catalogue->find(array(
            //'fields' => 'nom',
            'table' => 'categorie',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));
        $d['rayon'] = $this->Catalogue->find(array(
            //'fields' => 'nom',
            'table' => 'rayon',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));
        $d['fabriquant'] = $this->Catalogue->find(array(
            //'fields' => 'nom',
            'table' => 'fabriquant',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));
        $d['forme'] = $this->Catalogue->find(array(
            //'fields' => 'nom',
            'table' => 'forme',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));
        $d['magasin'] = $this->Catalogue->find(array(
            //'fields' => 'nom',
            'table' => 'magasin',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['produit'] = $this->Catalogue->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'produit',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['produit'])) {
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


        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'produit.id as idp,produit.nom as nomp,ean13,stock,categorie.nom as nomc,rayon.nom as nomr',
            'table' => 'produit,categorie,rayon',
            'order' => 'nomp-ASC',
            'conditions' => array('produit.categorie_id' => 'categorie.id','produit.rayon_id' => 'rayon.id')
        ));
        //die($d);
        if(empty($d['catalogue'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
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
