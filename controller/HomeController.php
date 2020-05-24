<?php
class HomeController extends Controller{


/* function view($nom){
$this->set(array(
'phrase' => 'Salut',
'test' => 'machin'
));
$this->render('index');
}*/
function koudjine_index(){

    $this->loadModel('Home');
    $d['total_univ'] = $this->Home->findCount('SUPPRIMER = 0','universite.UNIVERSITE_ID','universite');
    $d['total_formations'] = $this->Home->findCount('SUPPRIMER = 0','distinct NOM','filiere');
    $d['total_concours'] = $this->Home->findCount('SUPPRIMER = 0',' CONCOURS_ID','acces_concours');

    $this->set($d);
}


}