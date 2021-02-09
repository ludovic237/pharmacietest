<?php
class FormationsController extends Controller{


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


        $this->loadModel('Formations');
        if(isset($_GET['param'])){
            extract($_GET);
        }else {
            $param=1;
        }
        if($param==1){
            for ($i="A"; $i <= "D" ; $i++) {
                $d['formations'][$i] = $this->Formations->find(array(
                    'fields' => 'distinct NOM, FILIERE_ID as id',
                    'table' => 'filiere',
                    'order' => 'NOM-ASC',
                    'conditions' => "NOM like '".$i."%'"
                ));
                if(!empty($d['formations'][$i])){
                    foreach ($d['formations'][$i] as $k => $v):
                    $d[$i.$v->id]['idfiliere'] = $this->Formations->findFirst(array(
                        'fields' => 'FILIERE_ID',
                        'table' => 'filiere',
                        'conditions' => array('NOM' => '"'.$v->NOM.'"')
                    ));
                    $d[$i.$v->id]['nomcategorie'] = $this->Formations->findFirst(array(
                        'fields' => 'C.SLUG,C.NOM',
                        'table' => 'categorie_filiere C, filiere F',
                        'conditions' => array('F.FILIERE_ID' => $d[$i.$v->id]['idfiliere']->FILIERE_ID, 'F.CATEGORIE_ID' => 'C.CATEGORIE_ID')
                    ));
                    // Connaitre le nom de ses universités formant dans cette filière
                    $d[$i.$v->id]['nomuniv'] = $this->Formations->find(array(
                        'fields' => 'U.NOM',
                        'table' => 'filiere F, departement D, universite U',
                        'conditions' => array('F.NOM' => '"'.$v->NOM.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
                    ));
                    // Connaitre le nombre d'université formant dans cette filière
                    $d[$i.$v->id]['nombre'] = $this->Formations->findCount(array('NOM' => '"'.$v->NOM.'"'),'NOM','filiere');
                        endforeach;
                }
                if($i=="D"){break;}
            }
        }elseif($param==2) {
            for ($i = "E"; $i <= "H"; $i++) {
                $d['formations'][$i] = $this->Formations->find(array(
                    'fields' => 'distinct NOM, FILIERE_ID as id',
                    'table' => 'filiere',
                    'order' => 'NOM-ASC',
                    'conditions' => "NOM like '".$i."%'"
                ));
                if(!empty($d['formations'][$i])){
                    foreach ($d['formations'][$i] as $k => $v):
                        $d[$i.$v->id]['idfiliere'] = $this->Formations->findFirst(array(
                            'fields' => 'FILIERE_ID',
                            'table' => 'filiere',
                            'conditions' => array('NOM' => '"'.$v->NOM.'"')
                        ));
                        $d[$i.$v->id]['nomcategorie'] = $this->Formations->findFirst(array(
                            'fields' => 'C.SLUG,C.NOM',
                            'table' => 'categorie_filiere C, filiere F',
                            'conditions' => array('F.FILIERE_ID' => $d[$i.$v->id]['idfiliere']->FILIERE_ID, 'F.CATEGORIE_ID' => 'C.CATEGORIE_ID')
                        ));
                        // Connaitre le nom de ses universités formant dans cette filière
                        $d[$i.$v->id]['nomuniv'] = $this->Formations->find(array(
                            'fields' => 'U.NOM',
                            'table' => 'filiere F, departement D, universite U',
                            'conditions' => array('F.NOM' => '"'.$v->NOM.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
                        ));
                        // Connaitre le nombre d'université formant dans cette filière
                        $d[$i.$v->id]['nombre'] = $this->Formations->findCount(array('NOM' => '"'.$v->NOM.'"'),'NOM','filiere');
                    endforeach;
                }
                if($i=="H"){break;}
            }
        }elseif ($param==3) {
            for ($i = "I"; $i <= "L"; $i++) {
                $d['formations'][$i] = $this->Formations->find(array(
                    'fields' => 'distinct NOM, FILIERE_ID as id',
                    'table' => 'filiere',
                    'order' => 'NOM-ASC',
                    'conditions' => "NOM like '".$i."%'"
                ));
                if(!empty($d['formations'][$i])){
                    foreach ($d['formations'][$i] as $k => $v):
                        $d[$i.$v->id]['idfiliere'] = $this->Formations->findFirst(array(
                            'fields' => 'FILIERE_ID',
                            'table' => 'filiere',
                            'conditions' => array('NOM' => '"'.$v->NOM.'"')
                        ));
                        $d[$i.$v->id]['nomcategorie'] = $this->Formations->findFirst(array(
                            'fields' => 'C.SLUG,C.NOM',
                            'table' => 'categorie_filiere C, filiere F',
                            'conditions' => array('F.FILIERE_ID' => $d[$i.$v->id]['idfiliere']->FILIERE_ID, 'F.CATEGORIE_ID' => 'C.CATEGORIE_ID')
                        ));
                        // Connaitre le nom de ses universités formant dans cette filière
                        $d[$i.$v->id]['nomuniv'] = $this->Formations->find(array(
                            'fields' => 'U.NOM',
                            'table' => 'filiere F, departement D, universite U',
                            'conditions' => array('F.NOM' => '"'.$v->NOM.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
                        ));
                        // Connaitre le nombre d'université formant dans cette filière
                        $d[$i.$v->id]['nombre'] = $this->Formations->findCount(array('NOM' => '"'.$v->NOM.'"'),'NOM','filiere');
                    endforeach;
                }
                if($i=="L"){break;}
            }
        }elseif ($param==4) {
            for ($i = "M"; $i <= "P"; $i++) {
                $d['formations'][$i] = $this->Formations->find(array(
                    'fields' => 'distinct NOM, FILIERE_ID as id',
                    'table' => 'filiere',
                    'order' => 'NOM-ASC',
                    'conditions' => "NOM like '".$i."%'"
                ));
                if(!empty($d['formations'][$i])){
                    foreach ($d['formations'][$i] as $k => $v):
                        $d[$i.$v->id]['idfiliere'] = $this->Formations->findFirst(array(
                            'fields' => 'FILIERE_ID',
                            'table' => 'filiere',
                            'conditions' => array('NOM' => '"'.$v->NOM.'"')
                        ));
                        $d[$i.$v->id]['nomcategorie'] = $this->Formations->findFirst(array(
                            'fields' => 'C.SLUG,C.NOM',
                            'table' => 'categorie_filiere C, filiere F',
                            'conditions' => array('F.FILIERE_ID' => $d[$i.$v->id]['idfiliere']->FILIERE_ID, 'F.CATEGORIE_ID' => 'C.CATEGORIE_ID')
                        ));
                        // Connaitre le nom de ses universités formant dans cette filière
                        $d[$i.$v->id]['nomuniv'] = $this->Formations->find(array(
                            'fields' => 'U.NOM',
                            'table' => 'filiere F, departement D, universite U',
                            'conditions' => array('F.NOM' => '"'.$v->NOM.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
                        ));
                        // Connaitre le nombre d'université formant dans cette filière
                        $d[$i.$v->id]['nombre'] = $this->Formations->findCount(array('NOM' => '"'.$v->NOM.'"'),'NOM','filiere');
                    endforeach;
                }
                if($i=="P"){break;}
            }
        }else {
            for ($i = "Q"; $i <= "Z"; $i++) {
                $d['formations'][$i] = $this->Formations->find(array(
                    'fields' => 'distinct NOM, FILIERE_ID as id',
                    'table' => 'filiere',
                    'order' => 'NOM-ASC',
                    'conditions' => "NOM like '".$i."%'"
                ));
                if(!empty($d['formations'][$i])){
                    foreach ($d['formations'][$i] as $k => $v):
                        $d[$i.$v->id]['idfiliere'] = $this->Formations->findFirst(array(
                            'fields' => 'FILIERE_ID',
                            'table' => 'filiere',
                            'conditions' => array('NOM' => '"'.$v->NOM.'"')
                        ));
                        $d[$i.$v->id]['nomcategorie'] = $this->Formations->findFirst(array(
                            'fields' => 'C.SLUG,C.NOM',
                            'table' => 'categorie_filiere C, filiere F',
                            'conditions' => array('F.FILIERE_ID' => $d[$i.$v->id]['idfiliere']->FILIERE_ID, 'F.CATEGORIE_ID' => 'C.CATEGORIE_ID')
                        ));
                        // Connaitre le nom de ses universités formant dans cette filière
                        $d[$i.$v->id]['nomuniv'] = $this->Formations->find(array(
                            'fields' => 'U.NOM',
                            'table' => 'filiere F, departement D, universite U',
                            'conditions' => array('F.NOM' => '"'.$v->NOM.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
                        ));
                        // Connaitre le nombre d'université formant dans cette filière
                        $d[$i.$v->id]['nombre'] = $this->Formations->findCount(array('NOM' => '"'.$v->NOM.'"'),'NOM','filiere');
                    endforeach;
                }
                if($i=="Z"){break;}
            }

        }

        if(empty($d['formations'])){
            $this->e404('Page introuvable');
        }else{
            $d['categorie'] = $this->Formations->find(array(
                'table' => 'categorie_filiere',
                'order' => 'NOM-ASC'
            ));
        }
        $this->set($d);

    }

    function categorie($categorie){

        $d['paramcategorie'] = $categorie;

        $this->loadModel('Formations');
        $d['titre'] = $this->Formations->findFirst(array(
            'fields' => 'C.NOM',
            'table' => 'categorie_filiere C',
            'conditions' => array('C.SLUG' => '"'.$categorie.'"')
        ));
        for ($i="A"; $i <= "Z" ; $i++) {
            $d['formations'][$i] = $this->Formations->find(array(
                'fields' => 'distinct F.NOM, FILIERE_ID as id',
                'table' => 'categorie_filiere C, filiere F',
                'order' => 'NOM-ASC',
                'conditions' => "C.CATEGORIE_ID=F.CATEGORIE_ID AND C.SLUG='".$categorie."' AND F.NOM like '".$i."%'"
            ));
            if(!empty($d['formations'][$i])){
                foreach ($d['formations'][$i] as $k => $v):
                    $d[$i.$v->id]['idfiliere'] = $this->Formations->findFirst(array(
                        'fields' => 'FILIERE_ID',
                        'table' => 'filiere',
                        'conditions' => array('NOM' => '"'.$v->NOM.'"')
                    ));
                    $d[$i.$v->id]['nomcategorie'] = $this->Formations->findFirst(array(
                        'fields' => 'C.SLUG,C.NOM',
                        'table' => 'categorie_filiere C, filiere F',
                        'conditions' => array('F.FILIERE_ID' => $d[$i.$v->id]['idfiliere']->FILIERE_ID, 'F.CATEGORIE_ID' => 'C.CATEGORIE_ID')
                    ));
                    // Connaitre le nom de ses universités formant dans cette filière
                    $d[$i.$v->id]['nomuniv'] = $this->Formations->find(array(
                        'fields' => 'U.NOM',
                        'table' => 'filiere F, departement D, universite U',
                        'conditions' => array('F.NOM' => '"'.$v->NOM.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
                    ));
                    // Connaitre le nombre d'université formant dans cette filière
                    $d[$i.$v->id]['nombre'] = $this->Formations->findCount(array('NOM' => '"'.$v->NOM.'"'),'NOM','filiere');
                endforeach;
            }
            if($i=="Z"){break;}
        }
        if(empty($d['formations'])){
            $this->e404('Page introuvable');
        }else{
            $d['categorie'] = $this->Formations->find(array(
                'table' => 'categorie_filiere',
                'order' => 'NOM-ASC'
            ));
        }

        $name_categorie = str_replace(' ','-',$d['paramcategorie']);
        if($categorie != $name_categorie){
            $this->redirect("formations/categorie/name:".$name_categorie,301);
        }
        $this->set($d);
    }

    function presentation($slug){


        $this->loadModel('Formations');
        $d['formations'] = $this->Formations->findFirst(array(
            'table' => 'filiere',
            'conditions' => array('SLUG' => '"'.$slug.'"')
        ));

        if(empty($d['formations'])){
            $this->e404('Page introuvable');
        }else{
            $d['region'] = $this->Formations->find(array(
                'fields' => 'distinct U.REGION as region',
                'table' => 'universite U,filiere F,departement D',
                'conditions' => array('F.SLUG' => '"'.$slug.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
            ));
            foreach ($d['region'] as $k => $v):
                // Connaitre le nom des universités formant dans cette filière et se trouvant dans une région précise
                $d[$v->region]['nomuniv'] = $this->Formations->find(array(
                    'fields' => 'U.NOM as nom,U.NOM_COMPLET as nomc, U.LOGO as logo',
                    'table' => 'filiere F, departement D, universite U',
                    'conditions' => array('F.SLUG' => '"'.$slug.'"','U.REGION' => '"'.$v->region.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID')
                ));
                // Connaitre le nombre d'université formant dans cette filière pour une région donnée
                $d[$v->region]['nombre'] = $this->Formations->findCount(array('F.SLUG' => '"'.$slug.'"','U.REGION' => '"'.$v->region.'"', 'F.DEPARTEMENT_ID' => 'D.DEPARTEMENT_ID', 'U.UNIVERSITE_ID' => 'D.UNIVERSITE_ID'),'U.NOM','filiere F, departement D, universite U');
            endforeach;
        }

        $this->set($d);
    }

    /**
     * ADMIN
     */

    function koudjine_index($id_univ=null,$id_fac=null,$id_cat=null){
        $this->loadModel('Formations');
        if($id_fac == 0){
            $id_fac = null;
        }
        if($id_univ == 0){
            $id_univ = null;
        }
        if($id_cat == 0){
            $id_cat = null;
        }
        $d['id_univ'] = $id_univ;
        $d['id_fac'] = $id_fac;
        $d['id_cat'] = $id_cat;
        $d['universites'] = $this->Formations->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'universite',
            'order' => 'nom-ASC',
            'conditions' => array('SUPPRIMER' => 0)
        ));
        $d['categories'] = $this->Formations->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'categorie_filiere',
            'order' => 'nom-ASC',
            'conditions' => array('SUPPRIMER' => 0)
            //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
        ));
        //if($id_cat == null){
        if($id_univ != null){



            $d['facultesList'] = $this->Formations->find(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'departement',
                'order' => 'nom-ASC',
                //'conditions' => array('departement.SUPPRIMER' => 0,'departement.UNIVERSITE_ID' => $id,'NOM' => '"GENERAL"')
                'conditions' => 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$id_univ.' AND NOM <> '."\"GENERAL\""
            ));
            //$condition = 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$id_univ.' AND NOM <> '."\"GENERAL\"";
            //$d['total'] = $this->Formations->findCount($condition,'departement.UNIVERSITE_ID','departement');



            if(empty($d['facultesList'])){
                //$this->e404('Page introuvable');
                $d['faculte'] = $this->Formations->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'departement',
                    //'conditions' => array('departement.SUPPRIMER' => 0,'departement.UNIVERSITE_ID' => $id,'NOM' => '"GENERAL"')
                    'conditions' => 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$id_univ.' AND NOM = '."\"GENERAL\""
                ));
                if(empty($d['faculte'])) $this->redirect('koudjine/Formations/index');
            }
            if($id_fac != null){
                if($id_cat == null) {
                    $d['filiere'] = $this->Formations->find(array(
                        'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,C.NOM as nomc,D.NOM as nomd,F.SIGLE as sigle,D.SIGLE as sigled,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                        'table' => 'filiere F,categorie_filiere C,departement D',
                        'order' => 'nomf-ASC',
                        'conditions' => array('F.SUPPRIMER' => 0, 'F.DEPARTEMENT_ID' => $id_fac, 'D.DEPARTEMENT_ID'=>'F.DEPARTEMENT_ID', 'C.CATEGORIE_ID' => 'F.CATEGORIE_ID')
                        //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                    ));
                }
                else{
                    $d['filiere'] = $this->Formations->find(array(
                        'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,C.NOM as nomc,D.NOM as nomd,F.SIGLE as sigle,D.SIGLE as sigled,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                        'table' => 'filiere F,categorie_filiere C,departement D',
                        'order' => 'nomf-ASC',
                        'conditions' => array('F.SUPPRIMER' => 0, 'F.DEPARTEMENT_ID' => $id_fac, 'D.DEPARTEMENT_ID'=>'F.DEPARTEMENT_ID', 'F.CATEGORIE_ID' => $id_cat, 'C.CATEGORIE_ID' => 'F.CATEGORIE_ID')
                        //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                    ));
                }
            }else{
                if($id_cat == null) {
                    if (!empty($d['facultesList'])) {
                        foreach ($d['facultesList'] as $k => $v) {
                            $d['filiere'][$v->DEPARTEMENT_ID] = $this->Formations->find(array(
                                'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,C.NOM as nomc,F.SIGLE as sigle,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                                'table' => 'filiere F,categorie_filiere C',
                                'order' => 'nomf-ASC',
                                'conditions' => array('F.SUPPRIMER' => 0, 'F.DEPARTEMENT_ID' => $v->DEPARTEMENT_ID, 'C.CATEGORIE_ID' => 'F.CATEGORIE_ID')
                                //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                            ));
                        }
                    } elseif (!empty($d['faculte'])) {
                        $d['filiere'] = $this->Formations->find(array(
                            'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,C.NOM as nomc,F.SIGLE as sigle,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                            'table' => 'filiere F,categorie_filiere C',
                            'order' => 'nomf-ASC',
                            'conditions' => array('F.SUPPRIMER' => 0, 'F.DEPARTEMENT_ID' => $d['faculte']->DEPARTEMENT_ID, 'C.CATEGORIE_ID' => 'F.CATEGORIE_ID')
                            //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                        ));
                    }
                }else{
                    if (!empty($d['facultesList'])) {
                        foreach ($d['facultesList'] as $k => $v) {
                            $d['filiere'][$v->DEPARTEMENT_ID] = $this->Formations->find(array(
                                'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,C.NOM as nomc,F.SIGLE as sigle,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                                'table' => 'filiere F,categorie_filiere C',
                                'order' => 'nomf-ASC',
                                'conditions' => array('F.SUPPRIMER' => 0, 'F.DEPARTEMENT_ID' => $v->DEPARTEMENT_ID, 'F.CATEGORIE_ID' => $id_cat, 'C.CATEGORIE_ID' => 'F.CATEGORIE_ID')
                                //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                            ));
                        }
                    } elseif (!empty($d['faculte'])) {
                        $d['filiere'] = $this->Formations->find(array(
                            'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,C.NOM as nomc,F.SIGLE as sigle,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                            'table' => 'filiere F,categorie_filiere C',
                            'order' => 'nomf-ASC',
                            'conditions' => array('F.SUPPRIMER' => 0, 'F.DEPARTEMENT_ID' => $d['faculte']->DEPARTEMENT_ID, 'F.CATEGORIE_ID' => $id_cat, 'C.CATEGORIE_ID' => 'F.CATEGORIE_ID')
                            //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                        ));
                    }
                }

            }
        }
        else {
                if($id_cat!= null){
                    $d['filiere'] = $this->Formations->find(array(
                        'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,D.NOM as nomd, C.NOM as nomc,F.SIGLE as sigle,D.SIGLE as sigled,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                        'table' => 'filiere F,categorie_filiere C,departement D',
                        'order' => 'nomf-ASC',
                        'conditions' => array('F.SUPPRIMER' => 0, 'D.DEPARTEMENT_ID'=>'F.DEPARTEMENT_ID','C.CATEGORIE_ID' => 'F.CATEGORIE_ID','F.CATEGORIE_ID' => $id_cat)
                        //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                    ));
                    //debug($d['filierecat']);
                }
            else{
                $d['filiere'] = $this->Formations->find(array(
                    'fields' => 'F.FILIERE_ID as id,F.NOM as nomf,D.NOM as nomd, C.NOM as nomc,F.SIGLE as sigle,D.SIGLE as sigled,F.NIVEAU_FORMATION as niveau,F.DESCRIPTION as description',
                    'table' => 'filiere F,categorie_filiere C,departement D',
                    'order' => 'nomf-ASC',
                    'conditions' => array('F.SUPPRIMER' => 0, 'D.DEPARTEMENT_ID'=>'F.DEPARTEMENT_ID','C.CATEGORIE_ID' => 'F.CATEGORIE_ID')
                    //'conditions' => 'SUPPRIMER = 0 AND DEPARTEMENT_ID  ='.$id_fac
                ));
            }
        }

        /*else{

        }*/

        $this->set($d);
    }

    function koudjine_edit($id_filiere=null){
        $this->loadModel('Formations');
        $d['universitesList'] = $this->Formations->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'universite',
            'order' => 'nom-ASC',
            'conditions' => array('universite.SUPPRIMER' => 0)
        ));
        $d['categorieList'] = $this->Formations->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => ' categorie_filiere',
            'order' => 'nom-ASC',
            'conditions' => array('SUPPRIMER' => 0)
        ));
        if($id_filiere != null){
            $d['position'] = 'Modifier';

            $d['filiere'] = $this->Formations->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'filiere',
                'conditions' => array('FILIERE_ID' => $id_filiere,'SUPPRIMER' => 0)
            ));
            $this->request->params[0]=$d['filiere']->SLUG;



            if(empty($d['filiere'])){
                $this->e404('Page introuvable');
            }
            else{
                // contact de chaque université
                $d['universite'] = $this->Formations->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'universite,departement,filiere',
                    'conditions' => array( 'filiere.FILIERE_ID' => $id_filiere,'filiere.DEPARTEMENT_ID' => 'departement.DEPARTEMENT_ID', 'universite.UNIVERSITE_ID' => 'departement.UNIVERSITE_ID', 'filiere.SUPPRIMER' => 0)
                ));

                $d['facultesList'] = $this->Formations->find(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'departement',
                    'order' => 'nom-ASC',
                    //'conditions' => array('departement.SUPPRIMER' => 0,'departement.UNIVERSITE_ID' => $id,'NOM' => '"GENERAL"')
                    'conditions' => 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$d['universite']->UNIVERSITE_ID.' AND NOM <> '."\"GENERAL\""
                ));
                //$condition = 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  ='.$d['universite']->UNIVERSITE_ID.' AND NOM <> '."\"GENERAL\"";
                //$d['total'] = $this->Facultes->findCount($condition,'departement.UNIVERSITE_ID','departement');


                if(empty($d['facultesList'])) {
                    //$this->e404('Page introuvable');
                    $d['faculte'] = $this->Formations->findFirst(array(
                        //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                        'table' => 'departement',
                        //'conditions' => array('departement.SUPPRIMER' => 0,'departement.UNIVERSITE_ID' => $d['universite']->UNIVERSITE_ID,'NOM' => '"GENERAL"')
                        'conditions' => 'departement.SUPPRIMER = 0 AND departement.UNIVERSITE_ID  =' . $d['universite']->UNIVERSITE_ID . ' AND NOM = ' . "\"GENERAL\""
                    ));
                    //if (empty($d['faculte'])) $this->redirect('bouwou/facultes/index');
                }


            }
        }
        else {
            $d['position'] = 'Ajouter';
            $d['facultesList']=array();

        }

        $this->set($d);
    }

    function koudjine_categorie(){
        $this->loadModel('Formations');
        $d['categories'] = $this->Formations->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'categorie_filiere',
            'order' => 'nom-ASC',
            'conditions' => array('SUPPRIMER' => 0)
        ));

        $this->set($d);
    }

    function koudjine_presentation($slug=null){
        $this->loadModel('Formations');
        $d['formations'] = $this->Formations->find(array(
            'fields' => 'distinct SLUG',
            'table' => 'filiere',
            'order' => 'SLUG-ASC',
            'conditions' => array('SUPPRIMER' => 0)
        ));

        if($slug != null){
            $d['formation'] = $this->Formations->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'filiere',
                'conditions' => array('SLUG' => '\''.$slug.'\'','SUPPRIMER' => 0)
            ));
            if(!empty($d['formation'])){
                $d['presentation'] = $this->Formations->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'presentation_filiere',
                    'conditions' => array('SLUG' => '\''.$slug.'\'','SUPPRIMER' => 0)
                ));
            }
        }


        if(empty($d['formations'])){
            $this->e404('Page introuvable');
        }
        /*else{
            // contact de chaque université
            foreach ($d['universites'] as $k => $v):
                $d['contact'][$v->UNIVERSITE_ID] = $this->Formations->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'contacts',
                    'conditions' => array( 'CONTACT_ID' => $v->CONTACT_ID, 'SUPPRIMER' => 0)
                ));
                $d['type'][$v->UNIVERSITE_ID] = $this->Formations->find(array(
                    'fields' => 'type.NOM as nom',
                    'table' => 'type,type_universite',
                    'conditions' => array( 'type_universite.UNIVERSITE_ID' => $v->UNIVERSITE_ID,'type.TYPE_ID' => 'type_universite.TYPE_ID')
                ));
            endforeach;
        }*/
        $this->set($d);
    }

    function koudjine_delete($id,$action){
        $this->loadModel('Formations');
        if($action == 'filiere')
        $this->Formations->delete($id,'filiere','FILIERE_ID');
        else $this->Formations->delete($id,'categorie_filiere','CATEGORIE_ID');
        //$this->redirect('koudjine/Formations/index');
    }


}