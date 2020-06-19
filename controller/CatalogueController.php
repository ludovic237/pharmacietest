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


    // function koudjine_prescripteur($id)
    // {
    //     $this->loadModel('Catalogue');
    //     $d['catalogue'] = $this->Catalogue->find(array(
    //         'fields' => 'id,nom,structure,adresse,telephone',
    //         'table' => 'prescripteur',


    //     ));
    //     //die($d);
    //     if (empty($d['catalogue'])) {
    //         $this->e404('Page introuvable');

    //         if ($id != null) {
    //             //die('pass');
    //             $d['position'] = 'Modifier';

    //             $d['assureur'] = $this->Catalogue->findFirst(array(
    //                 //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
    //                 'table' => 'assureur',
    //                 'conditions' => array('id' => $id)
    //             ));


    //             if (empty($d['assureur'])) {
    //                 $this->e404('Page introuvable');
    //             }
    //         } else {
    //             $d['position'] = 'Ajouter';

    //         }
    //         $this->set($d);
    //     }
    // }

    function koudjine_assureuradd($id = null)
    {
        $this->loadModel('Catalogue');

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['assureur'] = $this->Catalogue->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'assureur',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['assureur'])) {
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

        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'assureur.id as idass,assureur.taux as tauxass,assureur.nom as nomass,assureur.CodePostal_id as codeass,assureur.telephone as telephoneass',
            'table' => 'assureur',
        ));
        //die($d);
        if (empty($d['catalogue'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_clientadd($id = null)
    {
        $this->loadModel('Catalogue');

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['client'] = $this->Catalogue->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'client',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['client'])) {
                $this->e404('Page introuvable');
            }
        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_client()
    {
        $this->loadModel('Catalogue');

        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'malade.id as idcl,malade.nom as nomcl,malade.poid as poidcl,malade.reduction as reductioncl,malade.telephone as telephonecl,malade.taille as taillecl,malade.modeReglement as modeReglementcl',
            'table' => 'malade',
            // 'order' => 'nomp-ASC',
            // 'conditions' => array('produit.categorie_id' => 'categorie.id','produit.rayon_id' => 'rayon.id')
        ));

        if (empty($d['catalogue'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_fabriquantadd($id = null)
    {
        $this->loadModel('Catalogue');

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['fabriquant'] = $this->Catalogue->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'fabriquant',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['fabriquant'])) {
                $this->e404('Page introuvable');
            }
        } else {
            $d['position'] = 'Ajouter';
        }
        $this->set($d);
    }

    function koudjine_fabriquant()
    {
        $this->loadModel('Catalogue');

        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'fabriquant.id as idfa,fabriquant.nom as nomfa,fabriquant.code as codefa,fabriquant.adresse as adressefa,fabriquant.telephone as telephonefa,fabriquant.CodePostal_id as codef,fabriquant.email as emailfa',
            'table' => 'fabriquant',
            // 'order' => 'nomp-ASC',
            // 'conditions' => array('produit.categorie_id' => 'categorie.id','produit.rayon_id' => 'rayon.id')
        ));

        if (empty($d['catalogue'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_fournisseuradd($id = null)
    {
        $this->loadModel('Catalogue');

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['fournisseur'] = $this->Catalogue->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'fournisseur',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['fournisseur'])) {
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
        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'fournisseur.id as idf,fournisseur.nom as nomf,fournisseur.code as codef,fournisseur.statut as statutf,fournisseur.adresse as adressef,fournisseur.telephone as telephonef,fournisseur.CodePostal_id as codef,fournisseur.email as emailf',
            'table' => 'fournisseur',
        ));

        //die($d);
        if (empty($d['catalogue'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
    }

    function koudjine_prescripteuradd($id = null)
    {
        $this->loadModel('Catalogue');

        if ($id != null) {
            //die('pass');
            $d['position'] = 'Modifier';

            $d['prescripteur'] = $this->Catalogue->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'prescripteur',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['prescripteur'])) {
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

        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'prescripteur.id as idpresc,prescripteur.Nom as nompresc,prescripteur.Structure as structpresc,prescripteur.Adresse as adressepresc,prescripteur.Telephone as telepresc',
            'table' => 'prescripteur',
        ));
        //die($d);
        if (empty($d['catalogue'])) {
            $this->e404('Page introuvable');
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
            'conditions' => array('produit.categorie_id' => 'categorie.id', 'produit.rayon_id' => 'rayon.id')
        ));
        //die($d);
        if (empty($d['catalogue'])) {
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
            //die('pass');
            $d['position'] = 'Modifier';

            $d['categorie'] = $this->Catalogue->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'categorie',
                'conditions' => array('id' => $id)
            ));


            if (empty($d['categorie'])) {
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

        $d['catalogue'] = $this->Catalogue->find(array(
            'fields' => 'categorie.id as idcat,categorie.nom as nomcat',
            'table' => 'categorie',
            // 'order' => 'nomp-ASC',
            // 'conditions' => array('produit.categorie_id' => 'categorie.id','produit.rayon_id' => 'rayon.id')
        ));
        //die($d);
        if (empty($d['catalogue'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
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
