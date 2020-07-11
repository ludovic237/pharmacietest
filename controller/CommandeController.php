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

    function koudjine_simplereappro($id = null)
    {
        $this->loadModel('Commande');

        
        $d['client'] = $this->Commande->find(array(
            //'fields' => 'Commande.id as id,Commande.montantRegle as montantRegle,reelPercu',
            'table' => 'user',
            'order' => 'nom-ASC',
            //'conditions' => array('Commande.categorie_id' => 'categorie.id','Commande.rayon_id' => 'rayon.id')
        ));
        $d['prescripteur'] = $this->Commande->find(array(
            //'fields' => 'Commande.id as id,Commande.montantRegle as montantRegle,reelPercu',
            'table' => 'prescripteur',
            'order' => 'nom-ASC',
            //'conditions' => array('Commande.categorie_id' => 'categorie.id','Commande.rayon_id' => 'rayon.id')
        ));

        if ($id != null) {
            $d['position'] = 'Modifier';

        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_cmdprogramme()
    {
        $this->loadModel('Commande');
    }
  
    function koudjine_cmdparticuliere()
    {
        $this->loadModel('Commande');
    }

    function koudjine_list()
    {
        $this->loadModel('Commande');
        $d['commande'] = $this->Commande->find(array(
            'fields' => 'commande.id as id,dateCreation,dateLivraison,note,fournisseur_id,qtiteCmd,qtiteRecu,montantCmd,montantRecu,etat,ref',
            'table' => 'commande',
        ));

        if(empty($d['commande'])){
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }
}
