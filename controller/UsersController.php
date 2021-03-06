<?php
class UsersController extends Controller
{

    /**
     * Login
     */
    function login(){
        //debug($this->request->data);
        if($this->request->data){
            $data = $this->request->data;
            $data->password = sha1($data->password);
            $this->loadModel('Users');
            $user = $this->Users->findFirst(array(
                'conditions' => array('IDENTIFIANT' => '"'.$data->username.'"', 'PASSWORD' => '"'.$data->password.'"'),
                'table' => 'personne'
            ));
            if(!empty($user)){
                $this->Session->write('Users',$user);
            }
                $data->password = '';

            if($this->Session->isLogged()){
                if($this->Session->user('STATUT') == 'Administrateur'||$this->Session->user('STATUT') == 'Superviseur'||$this->Session->user('STATUT') == 'Universitaire'||$this->Session->user('STATUT') == 'Informateur'){
                    $this->redirect('bouwou/home');}
                else{
                    $this->redirect('users/login');
                }
            }
        }
        elseif($this->Session->isLogged()){
            if($this->Session->user('STATUT') == 'Administrateur'||$this->Session->user('STATUT') == 'Superviseur'||$this->Session->user('STATUT') == 'Universitaire'||$this->Session->user('STATUT') == 'Informateur'){
                $this->redirect('bouwou/home');}
            else{
                $this->redirect('users/login');
            }
        }

    }

    /**
     * Logout
     */
    function logout(){
        unset($_SESSION['Users']);
        session_destroy();
        $this->redirect('');

    }

    /**
     * Admin
     */

    function koudjine_index(){
        $this->loadModel('Users');

        $d['utilisateurs'] = $this->Users->find(array(
            //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
            'table' => 'personne',
            'order' => 'IDENTIFIANT-ASC',
            'conditions' => array('SUPPRIMER' => 0)
        ));


        if(empty($d['utilisateurs'])){
            $this->e404('Page introuvable');
        }
        else{
            // contact de chaque université
            foreach ($d['utilisateurs'] as $k => $v):
                $d['contact'][$v->PERSONNE_ID] = $this->Users->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'contacts',
                    'conditions' => array( 'CONTACT_ID' => $v->CONTACT_ID, 'SUPPRIMER' => 0)
                ));
            endforeach;
        }
        $this->set($d);
    }

    function koudjine_edit($id=null){
        if($id != null){
            $d['position'] = 'Modifier';
            $this->loadModel('Users');
            $d['utilisateur'] = $this->Users->findFirst(array(
                //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                'table' => 'personne',
                'conditions' => array('PERSONNE_ID' => $id,'SUPPRIMER' => 0)
            ));


            if(empty($d['utilisateur'])){
                $this->e404('Page introuvable');
            }
            else{
                // contact de chaque université

                $d['contact'] = $this->Users->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'contacts',
                    'conditions' => array( 'CONTACT_ID' => $d['utilisateur']->CONTACT_ID, 'SUPPRIMER' => 0)
                ));

            }
        }
        else{
            $d['position'] = 'Ajouter';
        }


        $this->set($d);
    }

    function koudjine_profile($id){
        if($this->Session->user('STATUT') == 'Administrateur'|| $this->Session->user('PERSONNE_ID') == $id){
            if($id != null){
                $d['position'] = 'Profil';
                $this->loadModel('Users');
                $d['utilisateur'] = $this->Users->findFirst(array(
                    //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                    'table' => 'personne',
                    'conditions' => array('PERSONNE_ID' => $id,'SUPPRIMER' => 0)
                ));


                if(empty($d['utilisateur'])){
                    $this->e404('Page introuvable');
                }
                else{
                    // contact de chaque université

                    $d['contact'] = $this->Users->findFirst(array(
                        //'fields' => 'universite.UNIVERSITE_ID as id,universite.NOM as nom,universite.VILLE as ville,universite.STATUT as statut',
                        'table' => 'contacts',
                        'conditions' => array( 'CONTACT_ID' => $d['utilisateur']->CONTACT_ID, 'SUPPRIMER' => 0)
                    ));

                }
            }
            else {
                $this->redirect('koudjine/users/index');
            }
        }
        else{
            $this->redirect('bouwou/users');
        }


        $this->set($d);
    }

    function koudjine_delete($id){
        $this->loadModel('Users');
        $this->Users->delete($id,'personne','PERSONNE_ID');
        $this->redirect('koudjine/users/index');
    }
}