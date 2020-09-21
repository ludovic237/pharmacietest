<?php
class CommandeController extends Controller
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
        $this->loadModel('Commande');


        $d['Commande'] = $this->Commande->find(array(
            'fields' => 'DATE_DEBUT_CONCOURS,MODALITE_ADMISSION,DATE_FIN_CONCOURS,DESCRIPTION,NOM,DATE_DOSSIER,CONCOURS_ID',
            'table' => 'acces_concours,universite',
            'order' => 'DATE_DEBUT_CONCOURS-DESC',
            'conditions' => array('acces_concours.UNIVERSITE_ID' => 'universite.UNIVERSITE_ID', 'acces_concours.SUPPRIMER' => 0, 'universite.SUPPRIMER' => 0)
        ));
        $this->set($d);
    }

    function koudjine_simplereappro($id = null, $jour = null)
    {
        $this->loadModel('Commande');
        if($jour == null){
            $jour = 14;
        }
        $d['jour'] = $jour;
        if($id == 0){
            $id = null;
        }

        $d['fournisseur'] = $this->Commande->find(array(
            //'fields' => 'nom',
            'table' => 'fournisseur',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));

        if ($id != null) {
            $d['ventes'] = $this->Commande->find(array(
                'fields' => 'distinct(p.id) as idp, prixAchat, stock, reductionMax, p.nom as nom, f.nom as nomf, CAST(dateLivraison AS DATE) as dateLivraison',
                'table' => ' produit p, en_rayon e, concerner c, vente v, fournisseur f',
                //'order' => 'nom-ASC',
                'conditions' => 'v.id = c.vente_id and c.en_rayon_id = e.id and e.fournisseur_id = f.id and e.fournisseur_id = '.$id.' and p.id = e.produit_id and 
dateVente between DATE_ADD(now(), INTERVAL -'.$jour.' day) and now()  AND e.dateLivraison IN 
(select max(dateLivraison) from en_rayon r where r.produit_id = e.produit_id )'
            ));
            $d['fournisseurs'] = $this->Commande->find(array(
                'fields' => 'distinct(p.id) as idp, prixAchat, stock, reductionMax, p.nom as nom, f.nom as nomf, CAST(dateLivraison AS DATE) as dateLivraison',
                'table' => ' produit p, en_rayon e, concerner c, vente v, fournisseur f',
                //'order' => 'nom-ASC',
                'conditions' => 'v.id = c.vente_id and c.en_rayon_id = e.id and e.fournisseur_id = f.id and e.fournisseur_id <> '.$id.' and p.id = e.produit_id and 
dateVente between DATE_ADD(now(), INTERVAL -'.$jour.' day) and now()  AND e.dateLivraison IN 
(select max(dateLivraison) from en_rayon r where r.produit_id = e.produit_id )'
            ));
            $d['fournisseur_id'] = $id;

        } else {
            $d['ventes'] = $this->Commande->find(array(
                'fields' => 'distinct(p.id) as idp, prixAchat, stock, reductionMax, p.nom as nom, f.nom as nomf, CAST(dateLivraison AS DATE) as dateLivraison',
                'table' => ' produit p, en_rayon e, concerner c, vente v, fournisseur f',
                //'order' => 'nom-ASC',
                'conditions' => 'v.id = c.vente_id and c.en_rayon_id = e.id and e.fournisseur_id = f.id and p.id = e.produit_id and 
dateVente between DATE_ADD(now(), INTERVAL -'.$jour.' day) and now()  AND e.dateLivraison IN 
(select max(dateLivraison) from en_rayon r where r.produit_id = e.produit_id )'
            ));
        }
        $this->set($d);
    }

    function koudjine_cmdprogramme()
    {
        $this->loadModel('Commande');
        $d['fournisseur'] = $this->Commande->find(array(
            //'fields' => 'nom',
            'table' => 'fournisseur',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));
        $this->set($d);
    }
  
    function koudjine_cmdparticuliere()
    {
        $this->loadModel('Commande');
        $d['fournisseur'] = $this->Commande->find(array(
            //'fields' => 'nom',
            'table' => 'fournisseur',
            'order' => 'nom-ASC',
            //'conditions' => array('CONCOURS_ID' => $id, 'SUPPRIMER' => 0)
        ));
        $this->set($d);
    }

    function koudjine_list($id = null)
    {
        $this->loadModel('Commande');
        $d['commande'] = $this->Commande->find(array(
            'fields' => 'c.id as id,dateCreation,dateLivraison,nom,fournisseur_id,qtiteCmd,qtiteRecu,montantCmd,montantRecu,etat,ref',
            'table' => 'commande c, fournisseur f',
            'conditions' => 'c.fournisseur_id = f.id and c.supprimer = 0 and  f.supprimer = 0 and c.etat <> "Livré" '
        ));
        if($id != null){
            $d['com'] = $this->Commande->findFirst(array(
                //'fields' => 'c.id as id,dateCreation,dateLivraison,nom,fournisseur_id,qtiteCmd,qtiteRecu,montantCmd,montantRecu,etat,ref',
                'table' => 'commande c',
                'conditions' => array( 'c.id' => $id , 'c.supprimer' => 0)
            ));
        }

        if(empty($d['commande'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
}
