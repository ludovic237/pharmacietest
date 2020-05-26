<?php
class GeonetlisteController extends Controller
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
        $this->loadModel('Geonetliste');


        $d['Geonetliste'] = $this->Geonetliste->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }

    function koudjine_rayonadd($id = null)
    {
        $this->loadModel('Geonetliste');

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

    function koudjine_rayon()
    {
        $this->loadModel('Geonetliste');
    }

    function koudjine_magasinadd()
    {
        $this->loadModel('Geonetliste');
    }

    function koudjine_magasin()
    {
        $this->loadModel('Geonetliste');
    }

    function koudjine_villeadd()
    {
        $this->loadModel('Geonetliste');
    }

    function koudjine_ville()
    {
        $this->loadModel('Geonetliste');
    }

    function koudjine_uniteadd($id = null)
    {
        $this->loadModel('Geonetliste');

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

    function koudjine_unite()
    {
        $this->loadModel('Geonetliste');
    }

    function koudjine_formeadd($id = null)
    {
        $this->loadModel('Geonetliste');

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

    function koudjine_forme()
    {
        $this->loadModel('Geonetliste');
    }

    function koudjine_produitadd($id = null)
    {
        $this->loadModel('Geonetliste');

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
        $this->loadModel('Geonetliste');


        $d['Geonetliste'] = $this->Geonetliste->find(array(
            'fields' => 'produit.id as idp,produit.nom as nomp,ean13,datePeremption,stock,prixPublic,categorie.nom as nomc,rayon.nom as nomr',
            'table' => 'produit,categorie,rayon',
            'order' => 'nomp-ASC',
            'conditions' => array('produit.categorie_id' => 'categorie.id','produit.rayon_id' => 'rayon.id')
        ));
        //die($d);
        if(empty($d['Geonetliste'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_codepostaladd($id = null)
    {
        $this->loadModel('Geonetliste');

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

    function koudjine_codepostal()
    {
        $this->loadModel('Geonetliste');
    }

}
