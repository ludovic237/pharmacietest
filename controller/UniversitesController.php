<?php
class UniversitesController extends Controller{


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

    function index(){

        $perPage = 4;
        $this->loadModel('Universites');
        $condition = array('universite.SUPPRIMER' => 0);
        $d['universites'] = $this->Universites->find(array(
            'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'universite',
            'order' => 'nom-ASC',
            'conditions' => $condition,
            'limit' => ($perPage*($this->request->page-1)).','.$perPage
        ));
        $condition = array('universite.SUPPRIMER' => 0);
        $d['total'] = $this->Universites->findCount($condition,'universite.UNIVERSITE_ID','universite');
        $d['pages'] = ceil($d['total'] / $perPage);
        if(empty($d['universites'])){
            $this->e404('Page introuvable');
        }else{
            foreach ($d['universites'] as $k => $v):
                $d['type'][$v->id] = $this->Universites->find(array(
                    'fields' => 'type.NOM as nom',
                    'table' => 'type_universite,type',
                    'conditions' => array('type.TYPE_ID' => 'type_universite.TYPE_ID', 'UNIVERSITE_ID' => $v->id)
                ));
                $type=null;
                foreach ($d['type'][$v->id] as $p => $q):
                    if(empty($type)){
                        $type = $q->nom;
                    }else{
                        $type .= ' - '.$q->nom;
                    }
                endforeach;
                $d['type'][$v->id] = $type;
            endforeach;
        }
        $this->set($d);

        // Affichage des concours
        $this->loadModel('Concours');
        $d['concours'] = $this->Concours->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-ASC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));

        if(empty($d['concours'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);

    }
    function categorie($id,$slug){

        $perPage = 4;
        $this->loadModel('Universites');
        $condition = array('universite.UNIVERSITE_ID' => 'type_universite.UNIVERSITE_ID', 'type.TYPE_ID' => 'type_universite.TYPE_ID', 'type_universite.TYPE_ID' => $id,  'universite.SUPPRIMER' => 0);
        $d['universites'] = $this->Universites->find(array(
            'fields' => 'universite.UNIVERSITE_ID as id,type.SLUG as slug,universite.NOM as nom,type.NOM as nomt,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'universite,type_universite,type',
            'conditions' => $condition,
            'order' => 'nom-ASC',
            'limit' => ($perPage*($this->request->page-1)).','.$perPage
        ));
        $d['total'] = $this->Universites->findCount($condition,'type_universite.UNIVERSITE_ID','universite,type_universite,type');
        $d['pages'] = ceil($d['total'] / $perPage);

        if(empty($d['universites'])){
            $this->e404('Page introuvable');
        }

        if($slug != $d['universites'][0]->slug){
            $this->redirect("universites/categorie/id:$id/slug:".$d['universites'][0]->slug,301);
        }
        $this->set($d);

        // Affichage des concours
        $this->loadModel('Concours');
        $d['concours'] = $this->Concours->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-ASC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));

        if(empty($d['concours'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);

    }
    function presentation($id,$slug){

        $this->loadModel('Universites');
        $d['universites'] = $this->Universites->findFirst(array(
            'fields' => 'U.UNIVERSITE_ID as id, U.NOM as nom, U.NOM_COMPLET as nomc, U.VILLE as ville, U.REGION as region, PU.CONTENU as contenu, PU.IMAGE as image, U.CONTACT_ID as idcontact',
            'table' => 'presentation_universite PU, universite U',
            'conditions' => array('PU.UNIVERSITE_ID' => 'U.UNIVERSITE_ID', 'U.UNIVERSITE_ID' => $id, 'U.SUPPRIMER' => 0)
        ));

        if(empty($d['universites'])){
            $d['universites'] = $this->Universites->findFirst(array(
                'fields' => 'U.UNIVERSITE_ID as id, U.NOM as nom, U.NOM_COMPLET as nomc, U.VILLE as ville, U.REGION as region, U.CONTACT_ID as idcontact',
                'table' => ' universite U',
                'conditions' => array( 'U.UNIVERSITE_ID' => $id, 'U.SUPPRIMER' => 0)
            ));
            $d['contact'] = $this->Universites->findFirst(array(
                'table' => 'contacts',
                'conditions' => array('CONTACT_ID' => $d['universites']->idcontact, 'SUPPRIMER' => 0)
            ));
            // Selection des facultes comprise dans une université
            $condition = array('D.UNIVERSITE_ID' => $d['universites']->id, 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID', 'D.SUPPRIMER' => 0);
            $d['faculte'] = $this->Universites->find(array(
                'table' => 'departement D, universite U',
                'fields' => 'D.NOM as nom, D.SIGLE as sigle, D.DEPARTEMENT_ID as iddept',
                'conditions' => $condition
            ));
            $d['tout'] = $this->Universites->findCount($condition,'D.DEPARTEMENT_ID','departement D, universite U');
            // selection de toutes les filieres comprises dans le departement par defaut
            $condition = array('D.UNIVERSITE_ID' => $d['universites']->id, 'D.DEPARTEMENT_ID' => 'F.DEPARTEMENT_ID', 'F.SUPPRIMER' => 0);
            $d['filiere'] = $this->Universites->find(array(
                'table' => 'departement D, filiere F',
                'fields' => 'F.NOM as nom,D.DEPARTEMENT_ID',
                'conditions' => $condition
            ));
            // Selection de toutes les ecoles sous tutelle
            $condition = array('U.PARRAIN_ID' => $d['universites']->id, 'U.SUPPRIMER' => 0);
            $d['ecole'] = $this->Universites->find(array(
                'table' => 'universite U',
                'fields' => 'U.NOM as nom,U.UNIVERSITE_ID as id,U.NOM as nom,U.NOM_COMPLET as nomc',
                'conditions' => $condition
            ));
            // Affichage de la date du concours ou des depots des dossiers si la date n'est pas encore passé
            $d['concours'] = $this->Universites->find(array(
                'fields' => 'DATE_DEBUT_CONCOURS as concours,DATE_DOSSIER',
                'table' => 'acces_concours',
                'conditions' => 'DATE_DEBUT_CONCOURS > NOW() OR DATE_DOSSIER > NOW() AND SUPPRIMER =0'
            ));
        }else{
            $d['contact'] = $this->Universites->findFirst(array(
                'table' => 'contacts',
                'conditions' => array('CONTACT_ID' => $d['universites']->idcontact, 'SUPPRIMER' => 0)
            ));
            // Selection des facultes comprise dans une université
            $condition = array('D.UNIVERSITE_ID' => $d['universites']->id, 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID', 'D.SUPPRIMER' => 0);
            $d['faculte'] = $this->Universites->find(array(
                'table' => 'departement D, universite U',
                'fields' => 'D.NOM as nom, D.SIGLE as sigle, D.DEPARTEMENT_ID as iddept',
                'conditions' => $condition
            ));
            $d['tout'] = $this->Universites->findCount($condition,'D.DEPARTEMENT_ID','departement D, universite U');
            // selection de toutes les filieres comprises dans le departement par defaut
            $condition = array('D.UNIVERSITE_ID' => $d['universites']->id, 'D.DEPARTEMENT_ID' => 'F.DEPARTEMENT_ID', 'F.SUPPRIMER' => 0);
            $d['filiere'] = $this->Universites->find(array(
                'table' => 'departement D, filiere F',
                'fields' => 'F.NOM as nom,D.DEPARTEMENT_ID',
                'conditions' => $condition
            ));
            // Selection de toutes les ecoles sous tutelle
            $condition = array('U.PARRAIN_ID' => $d['universites']->id, 'U.SUPPRIMER' => 0);
            $d['ecole'] = $this->Universites->find(array(
                'table' => 'universite U',
                'fields' => 'U.NOM as nom,U.UNIVERSITE_ID as id,U.NOM as nom,U.NOM_COMPLET as nomc',
                'conditions' => $condition
            ));
            // Affichage de la date du concours ou des depots des dossiers si la date n'est pas encore passé
            $d['concours'] = $this->Universites->find(array(
                'fields' => 'DATE_DEBUT_CONCOURS as concours,DATE_DOSSIER',
                'table' => 'acces_concours',
                'conditions' => 'DATE_DEBUT_CONCOURS > NOW() OR DATE_DOSSIER > NOW() AND SUPPRIMER =0'
            ));
        }
        $slug_univ = str_replace(' ','-',$d['universites']->nom );
        if($slug != $slug_univ){
            $this->redirect("universites/presentation/id:$id/slug:".$slug_univ,301);
        }
        $this->set($d);

    }


    /**
     * ADMIN
     */
    function koudjine_index(){
        $this->loadModel('Universites');
        $d['universites'] = $this->Universites->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'universite',
            'order' => 'nom-ASC',
            'conditions' => array('universite.SUPPRIMER' => 0)
        ));


        if(empty($d['universites'])){
            $this->e404('Page introuvable');
        }
        else{
            // contact de chaque université
            foreach ($d['universites'] as $k => $v):
                $d['contact'][$v->UNIVERSITE_ID] = $this->Universites->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'contacts',
                    'conditions' => array( 'CONTACT_ID' => $v->CONTACT_ID, 'SUPPRIMER' => 0)
                ));
                $d['type'][$v->UNIVERSITE_ID] = $this->Universites->find(array(
                    'fields' => 'type.NOM as nom',
                    'table' => 'type,type_universite',
                    'conditions' => array( 'type_universite.UNIVERSITE_ID' => $v->UNIVERSITE_ID,'type.TYPE_ID' => 'type_universite.TYPE_ID')
                ));
            endforeach;
        }
        $this->set($d);
    }

    function koudjine_edit($id=null){
        if($id != null){
            $d['position'] = 'Modifier';
            $this->loadModel('Universites');
            $d['universites'] = $this->Universites->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'universite',
                'conditions' => array('UNIVERSITE_ID' => $id,'SUPPRIMER' => 0)
            ));
            $d['universitesList'] = $this->Universites->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'universite',
                'order' => 'nom-ASC',
                'conditions' => array('universite.SUPPRIMER' => 0)
            ));


            if(empty($d['universites'])){
                $this->e404('Page introuvable');
            }
            else{
                // contact de chaque université

                $d['contact'] = $this->Universites->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'contacts',
                    'conditions' => array( 'CONTACT_ID' => $d['universites']->CONTACT_ID, 'SUPPRIMER' => 0)
                ));
                $d['type'] = $this->Universites->find(array(
                    'fields' => 'type.NOM as nom,type_universite.TYPE_ID',
                    'table' => 'type,type_universite',
                    'conditions' => array( 'type_universite.UNIVERSITE_ID' => $d['universites']->UNIVERSITE_ID,'type.TYPE_ID' => 'type_universite.TYPE_ID')
                ));

            }
        }
        else {
            $d['position'] = 'Ajouter';
        }

        $this->set($d);
    }

    function koudjine_presentation($id=null){
        $this->loadModel('Universites');
        $d['universites'] = $this->Universites->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'universite',
            'order' => 'nom-ASC',
            'conditions' => array('universite.SUPPRIMER' => 0)
        ));

        if($id != null){
            $d['universite'] = $this->Universites->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'universite',
                'conditions' => array('UNIVERSITE_ID' => $id,'SUPPRIMER' => 0)
            ));
            if(!empty($d['universite'])){
                $d['presentation'] = $this->Universites->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'presentation_universite',
                    'conditions' => array('UNIVERSITE_ID' => $id,'SUPPRIMER' => 0)
                ));
            }
        }


        if(empty($d['universites'])){
            $this->e404('Page introuvable');
        }
        /*else{
            // contact de chaque université
            foreach ($d['universites'] as $k => $v):
                $d['contact'][$v->UNIVERSITE_ID] = $this->Universites->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'contacts',
                    'conditions' => array( 'CONTACT_ID' => $v->CONTACT_ID, 'SUPPRIMER' => 0)
                ));
                $d['type'][$v->UNIVERSITE_ID] = $this->Universites->find(array(
                    'fields' => 'type.NOM as nom',
                    'table' => 'type,type_universite',
                    'conditions' => array( 'type_universite.UNIVERSITE_ID' => $v->UNIVERSITE_ID,'type.TYPE_ID' => 'type_universite.TYPE_ID')
                ));
            endforeach;
        }*/
        $this->set($d);
    }

    function koudjine_delete($id){
        $this->loadModel('Universites');
        $this->Universites->delete($id,'universite','UNIVERSITE_ID');
        $this->redirect('koudjine/universites/index');
    }


}