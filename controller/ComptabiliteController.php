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
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                        ));
                    }
                    else{
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
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
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                    }
                    else{
                        if($stock == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
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
                        'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                        'table' => 'en_rayon,produit,fournisseur',
                        'order' => 'dateLivraison-ASC',
                        'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                    ));
                }else{
                    if($perime == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.produit_id=".$id_prod." AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                    }
                    else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
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
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                        ));
                    }
                    else{
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
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
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante = 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                            ));
                        }
                    }
                    else{
                        if($stock == 1){
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                                'table' => 'en_rayon,produit,fournisseur',
                                'order' => 'dateLivraison-ASC',
                                'conditions' => "en_rayon.produit_id = produit.id AND quantiteRestante <> 0 AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption BETWEEN NOW() AND ADDDATE(NOW(), INTERVAL ".$perime." DAY)"
                            ));
                        }
                        else{
                            $d['catalogue'] = $this->Comptabilite->find(array(
                                'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
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
                        'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                        'table' => 'en_rayon,produit,fournisseur',
                        'order' => 'dateLivraison-ASC',
                        'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0"
                    ));
                }else{
                    if($perime == 1){
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
                            'table' => 'en_rayon,produit,fournisseur',
                            'order' => 'dateLivraison-ASC',
                            'conditions' => "en_rayon.produit_id = produit.id AND en_rayon.fournisseur_id = fournisseur.id AND en_rayon.supprimer = 0 AND en_rayon.datePeremption <= NOW()"
                        ));
                    }
                    else{
                        $d['catalogue'] = $this->Comptabilite->find(array(
                            'fields' => 'produit.id as idp,produit.nom as nomp,fournisseur.nom as nomf,dateLivraison,datePeremption,quantite,quantiteRestante,prixAchat,prixVente,reduction',
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

    function koudjine_sortie()
    {
        $this->loadModel('Comptabilite');
    }

    function koudjine_consultation()
    {
        $this->loadModel('Comptabilite');
    }

}