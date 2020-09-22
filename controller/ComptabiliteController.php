<?php
class ComptabiliteController extends Controller
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
        $this->loadModel('Comptabilite');


        $d['Comptabilite'] = $this->Comptabilite->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }


    function koudjine_budget($id = null)
    {
        $this->loadModel('Comptabilite');
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

    function koudjine_caisse()
    {
        $this->loadModel('Comptabilite');
        $d['vente_credit'] = $this->Comptabilite->find(array(
            //'fields' => 'produit.nom as nom',
            'table' => 'vente',
            'conditions' => "supprimer = 0 AND prixPercu = 0 AND etat = \"Crédit\" AND ISNULL(caisse_id) = 1"
        ));
        $d['caisseCheck'] = $this->Comptabilite->findFirst(array(
            //'fields' => 'produit.nom as nom',
            'table' => 'caisse',
            'conditions' => "supprimer = 0 AND etat = \"En cours\" AND user_id =".$_SESSION["Users"]->id
        ));
        if (empty($d['caisseCheck'])) {
            $d['caisse'] = $this->Comptabilite->findFirst(array(
                //'fields' => 'produit.nom as nom',
                'table' => 'caisse',
                'conditions' => "supprimer = 0 AND etat = \"Ouvert\""
            ));
            if (!empty($d['caisse'])) {
                $d['ventes'] = $this->Comptabilite->find(array(
                    //'fields' => 'produit.nom as nom',
                    'table' => 'vente',
                    'conditions' => array('caisse_id' => $d['caisse']->id, 'supprimer' => 0, 'prixPercu' => 0)
                ));
                //print_r($d['caisse']);
                $d['employe'] = $this->Comptabilite->findFirst(array(
                    'fields' => 'user.nom as nom',
                    'table' => 'employe, user',
                    'conditions' => array('employe.id' => $d['caisse']->user_id, 'employe.supprimer' => 0, 'employe.user_id' => 'user.id')
                ));

            }

        }

        $this->set($d);
    }

    function koudjine_entre($id_prod=null,$stock=null,$perime=null)
    {
        $this->loadModel('Comptabilite');
        if($id_prod == 0){
            $id_prod = null;
        }
        else{
            $d['produit'] = $this->Comptabilite->findFirst(array(
                //'fields' => 'produit.nom as nom',
                'table' => 'produit',
                'conditions' => "id=".$id_prod." AND supprimer = 0"
            ));
        }
        if($stock == 0){
            $stock = null;
        }
        $d['id_prod'] = $id_prod;
        $d['stock'] = $stock;
        $d['perime'] = $perime;
        
        if($id_prod != null){

            if($stock != null){
                if($perime == null) {
                    if($stock == 1){
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                        ));
                    }
                    else{
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                        ));
                    }
                }
                else{
                    if($perime == 1){
                        if($stock == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                    }
                    else{
                        if($stock == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                            ));
                        }
                    }

                }
            }else{
                if($perime == null) {
                    $d['catalogue'] = $this->Comptabilite->find(array(
                        'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                        'table' => 'en_rayon,produit,fournisseur',
                        'order' => 'dateLivraison-ASC',
                        'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                    ));
                }else{
                    if($perime == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                    }
                    else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                            ));
                    }
                }

            }
        }
        else {

            if($stock != null){
                if($perime == null) {
                    if($stock == 1){
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                        ));
                    }
                    else{
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                        ));
                    }
                }
                else{
                    if($perime == 1){
                        if($stock == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                    }
                    else{
                        if($stock == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                            ));
                        }
                    }

                }
            }else{
                if($perime == null) {
                    $d['catalogue'] = $this->Comptabilite->find(array(
                        'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                        'table' => 'en_rayon,produit,fournisseur',
                        'order' => 'dateLivraison-ASC',
                        'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                    ));
                }else{
                    if($perime == 1){
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                        ));
                    }
                    else{
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                        ));
                    }
                }

            }
        }


        $this->set($d);
    }

    function koudjine_sortie($id=null)
    {
        $this->loadModel('Comptabilite');
        $d['sorties'] = $this->Comptabilite->find(array(
            //'fields' => 'produit.id as idp,produit.nom as nomp,contenuDetail,grossiste_id,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
            'table' => 'sortie_stock',
            //'order' => 'dateLivraison-ASC',
            'conditions' => "supprimer = 0 "
        ));
        if(!empty($d['sorties'])){
            $i = 0;
            foreach ($d['sorties'] as $k => $v):
                $d['produit_rayon'][$i] = $this->Comptabilite->findFirst(array(
                    'fields' => 'p.nom as nomp, p.id as idp, e.id as ide, f.nom as nomf, e.dateLivraison',
                    'table' => 'produit p, en_rayon e, forme f',
                    'conditions' => array('e.id' => $v->en_rayon_id, 'p.forme_id' =>'f.id', 'e.supprimer' => 0, 'p.id' => 'e.produit_id')
                ));
                if($v->detail_id != '' && $v->detail_id != null){
                    $d['produit_detail'][$i] = $this->Comptabilite->findFirst(array(
                        //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                        'table' => 'produit p, en_rayon e',
                        'conditions' => array('e.id' => $v->detail_id, 'e.supprimer' => 0, 'p.id' => 'e.produit_id')
                    ));
                    $d['produit_detail'][$i] = $d['produit_detail'][$i]->nom;
                    $d['operation'][$i] = 'Détail';
                }else{
                    $d['produit_detail'][$i] = $v->detail_id;
                    $d['operation'][$i] = 'Périmé';
                }

                $i++;
            endforeach;
        }

        if(isset($id)){
            $d['entree'] = $this->Comptabilite->findFirst(array(
                'fields' => 'produit.id as idp,produit.nom as nomp,contenuDetail,grossiste_id,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction, en_rayon.id as ide',
                'table' => 'en_rayon,produit',
                //'order' => 'dateLivraison-ASC',
                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.supprimer = 0 AND en_rayon.id = ".$id
            ));
            if($d['entree']->grossiste_id != '' || $d['entree']->grossiste_id != null){
                $grossistes = $d['entree']->grossiste_id;
                $texto  = explode('-', $grossistes);
                $i = 0;
                foreach ($texto as $k => $v):
                    $d['produits'][$i] = $this->Comptabilite->findFirst(array(
                        //'fields' => 'vente.id as id,prixTotal,prixPercu,commentaire,dateVente,etat,reference',
                        'table' => 'produit',
                        'conditions' => array('id' => $v, 'supprimer' => 0)
                    ));
                    $i++;
                endforeach;
            }

        }
          $this->set($d);
        
    }

    function koudjine_consultation()
    {
        $this->loadModel('Comptabilite');
    }

    function koudjine_entreadd($id = null)
    {
        $this->loadModel('Comptabilite');

        $d['produit'] = $this->Comptabilite->find(array(
            //'fields' => 'nom',
            'table' => 'produit',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));

        $d['fournisseur'] = $this->Comptabilite->find(array(
            //'fields' => 'nom',
            'table' => 'fournisseur',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['en_rayon'] = $this->Comptabilite->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'en_rayon',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['en_rayon'])) {
                $this->e404('Page introuvable');
            }
        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_detail()
    {
        $this->loadModel('Comptabilite');

    }

    function koudjine_destock()
    {
        $this->loadModel('Comptabilite');

    }

}
