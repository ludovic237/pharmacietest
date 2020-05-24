<?php
class Dispatcher{

    var $request;

    function __construct(){
        $this->request = new Request();
        Router::parse($this->request->url,$this->request);
        $controller = $this->loadController();
        //print_r(get_class_methods($controller)); die();
        //get_class_methods permet de renvoyer toutes les methodes compris dans la classe passée en paramètre
        $action = $this->request->action;
        if($this->request->prefix){

            $action = $this->request->prefix.'_'.$action;
            //debug($action);
        }
        if(!in_array($action,array_diff(get_class_methods($controller),get_class_methods('Controller')))){
            $this->error('le controller '.$this->request->controller.'  n\'a pas de méthode '.$this->request->action);
        }
        call_user_func_array(array($controller,$action),$this->request->params);
        $controller->render($action);
    }

    function error($message){
        $controller = new Controller($this->request);
        $controller->e404($message);
    }

    function loadController(){
        $name = ucfirst($this->request->controller).'Controller';
        $file = ROOT.DS.'controller'.DS.$name.'.php';
        if(!file_exists($file)){
            $this->error('Le controller '.$this->request->controller.' n existe pas');
        }
        require $file;
        $controller = new $name($this->request);

        return $controller;
    }
}