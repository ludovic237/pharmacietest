<?php
class RechercheController extends Controller{

    function filiere(){

        $this->loadModel('Recherche');



        if(isset($_GET['srch_for'])){

            $type = array();
            $niveau = array();
            $getters = array();
            $queries = array();

            foreach($_GET as $key => $value){
                $temp = is_array($value) ? $value : trim($value);
                if(!empty($temp)){
                    list($key) = explode("-",$key);
                    if($key == 'srch_type'){
                        array_push($type,$value);
                    }
                    if($key == 'srch_niveau'){
                        array_push($niveau,$value);
                    }
                    if(!in_array($key,$getters)){
                        $getters[$key] = $value;
                    }
                }
            }

            if(!empty($type)){
                $loc_qry = implode(",",$type);
            }
            if(!empty($niveau)){
                $niv_qry = implode("%",$niveau);
            }

            if(!empty($getters)){
                foreach($getters as $key => $value) {
                    ${$key} = $value;
                    switch($key){
                        case 'srch_for':
                            array_push($queries,"(fl.NOM LIKE '%$srch_for%' || fl.DESCRIPTION LIKE '%$srch_for%')");
                            break;
                        case 'srch_categorie':
                            array_push($queries,"fl.CATEGORIE_ID= $srch_categorie");
                            break;
                        case 'srch_ville':
                            array_push($queries,"un.VILLE = '$srch_ville'");
                            break;
                        case 'srch_universite':
                            array_push($queries,"un.UNIVERSITE_ID = $srch_universite");
                            break;
                        case 'srch_type':
                            array_push($queries,"tu.TYPE_ID IN ($loc_qry)");
                            break;
                        case 'srch_niveau':
                            array_push($queries,"fl.NIVEAU_FORMATION LIKE '%$niv_qry%'");
                            break;
                    }
                }
            }

            if(!empty($queries)){
                $querysql = "";
                $i=1;
                foreach($queries as $query){
                    if($i < count($queries)){
                        $querysql .=$query." AND ";
                    } else {
                        $querysql .= $query;
                    }
                    $i++;
                }
                $d['recherche'] = $this->Recherche->find(array(
                    'fields' => 'distinct fl.NOM AS Filiere, de.DEPARTEMENT_ID AS id_dep, fl.NIVEAU_FORMATION AS niveau, fl.FILIERE_ID AS id, un.UNIVERSITE_ID AS id_u, un.NOM AS Universite, un.VILLE AS Ville, un.UNIVERSITE_ID, cat.NOM AS Categorie',
                    'table' => 'filiere fl

	JOIN categorie_filiere cat
		ON cat.CATEGORIE_ID = fl.CATEGORIE_ID

	JOIN departement de
		ON de.DEPARTEMENT_ID = fl.DEPARTEMENT_ID

	JOIN universite un
		ON un.UNIVERSITE_ID = de.UNIVERSITE_ID

	JOIN type_universite tu
		ON tu.UNIVERSITE_ID = un.UNIVERSITE_ID

	JOIN type ty
		ON ty.TYPE_ID = tu.TYPE_ID',
                    'order' => 'fl.NOM-ASC',
                    'conditions' => $querysql
                ));
            }
            //$sql .= " ORDER BY fl.NOM ASC";
        }



        // Liste des villes où on retrouve des universités
        $this->loadModel('Universites');
        $d['ville'] = $this->Universites->find(array(
            'fields' => 'distinct VILLE AS ville',
            'table' => 'universite',
            'order' => 'VILLE-ASC'
        ));

        // Liste des universités
        $this->loadModel('Universites');
        $d['universite'] = $this->Universites->find(array(
            'table' => 'universite',
            'order' => 'NOM-ASC'
        ));

        // Liste des categories pour les filieres
        $this->loadModel('Universites');
        $d['categorie'] = $this->Universites->find(array(
            'table' => 'categorie_filiere',
            'order' => 'NOM-ASC'
        ));

        // Liste des villes où on retrouve des universités
        $this->loadModel('Universites');
        $d['type'] = $this->Universites->find(array(
            'table' => 'type',
            'order' => 'TYPE_ID-ASC'
        ));

        /*if(empty($d['recherche'])){
            $this->e404('Page introuvable');
        }*/
        $this->set($d);

    }

    function universite(){

        $this->loadModel('Recherche');



        if(isset($_GET['srch_for'])){

            $type = array();
            $niveau = array();
            $getters = array();
            $queries = array();

            foreach($_GET as $key => $value){
                $temp = is_array($value) ? $value : trim($value);
                if(!empty($temp)){
                    list($key) = explode("-",$key);
                    if($key == 'srch_type'){
                        array_push($type,$value);
                    }
                    if($key == 'srch_niveau'){
                        array_push($niveau,$value);
                    }
                    if(!in_array($key,$getters)){
                        $getters[$key] = $value;
                    }
                }
            }

            if(!empty($type)){
                $loc_qry = implode(",",$type);
            }
            if(!empty($niveau)){
                $niv_qry = implode("%",$niveau);
            }

            if(!empty($getters)){
                foreach($getters as $key => $value) {
                    ${$key} = $value;
                    switch($key){
                        case 'srch_for':
                            array_push($queries,"(un.NOM LIKE '%$srch_for%' || un.NOM_COMPLET LIKE '%$srch_for%')");
                            break;
                        case 'srch_ville':
                            array_push($queries,"un.VILLE = '$srch_ville'");
                            break;
                        case 'srch_type':
                            array_push($queries,"tu.TYPE_ID IN ($loc_qry)");
                            break;
                        case 'srch_niveau':
                            array_push($queries,"fl.NIVEAU_FORMATION LIKE '%$niv_qry%'");
                            break;
                    }
                }
            }

            if(!empty($queries)){
                $querysql = "";
                $i=1;
                foreach($queries as $query){
                    if($i < count($queries)){
                        $querysql .=$query." AND ";
                    } else {
                        $querysql .= $query;
                    }
                    $i++;
                }
                $d['recherche'] = $this->Recherche->find(array(
                    'fields' => 'fl.NOM AS Filiere, de.DEPARTEMENT_ID AS id_dep, fl.NIVEAU_FORMATION AS niveau, fl.FILIERE_ID AS id, un.UNIVERSITE_ID AS id_u, distinct un.NOM AS Universite, un.VILLE AS Ville, un.UNIVERSITE_ID, cat.NOM AS Categorie, ty.NOM AS nomtype',
                    'table' => 'universite un

	JOIN filiere fl

	JOIN categorie_filiere cat
		ON cat.CATEGORIE_ID = fl.CATEGORIE_ID

	JOIN departement de
		ON de.DEPARTEMENT_ID = fl.DEPARTEMENT_ID

	JOIN universite un
		ON un.UNIVERSITE_ID = de.UNIVERSITE_ID

	JOIN type_universite tu
		ON tu.UNIVERSITE_ID = un.UNIVERSITE_ID

	JOIN type ty
		ON ty.TYPE_ID = tu.TYPE_ID',
                    'order' => 'fl.NOM-ASC',
                    'conditions' => $querysql
                ));
            }
            //$sql .= " ORDER BY fl.NOM ASC";
        }



        // Liste des villes où on retrouve des universités
        $this->loadModel('Universites');
        $d['ville'] = $this->Universites->find(array(
            'fields' => 'distinct VILLE AS ville',
            'table' => 'universite',
            'order' => 'VILLE-ASC'
        ));

        // Liste des types d'université
        $this->loadModel('Universites');
        $d['type'] = $this->Universites->find(array(
            'table' => 'type',
            'order' => 'TYPE_ID-ASC'
        ));

        /*if(empty($d['recherche'])){
            $this->e404('Page introuvable');
        }*/
        $this->set($d);

    }


}