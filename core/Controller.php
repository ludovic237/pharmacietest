<?php
class Controller{

    public $request;
    private  $vars = array();
    public $layout = 'default';
    private $rendered = false;


    function __construct($request = null){

        $this->Form = new Form($this);
        $this->Session = new Session();
        if($request){
            $this->request = $request;
        }
        require ROOT.DS.'config'.DS.'hook.php';
    }

    public function render($view){
        if($this->rendered){return false;}
        extract($this->vars);
        if($this->Session->isLogged() && $this->request->prefix == 'koudjine') {
            if (!in_array($this->Session->user('STATUT'), Conf::$acces[$this->request->controller]) && $this->request->prefix == 'koudjine') {
                $this->redirect('bouwou/home');
            }
        }
        if(strpos($view,'/')===0){
            $view = ROOT.DS.'view'.$view.'.php';
        }
        else{;

            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
        }

        ob_start();
        require ($view);
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
        $this->rendered = true;
        //die($view);
    }
    public  function set($key,$value=null){
        if(is_array($key)){
            $this->vars += $key;
        }else{
            $this->vars[$key] = $value;
        }

    }

    /**
     * Permet de charger un model
     */
    function loadModel($name){
        $file = ROOT.DS.'model'.DS.$name.'.php';
        require_once($file);
        if(!isset($this->$name)){
            $this->$name = new $name();
        }


    }

    /**
     * Permet de gérer les erreurs 404
     */
    function e404($message){
        header("HTTP/1.0 404 Not Found");
        $this->set('message',$message);
        $this->render('/error/404');
        die();
    }

    /**
     * Permet d'appeller un controller depuis une vue
     */
    function request($controller,$action){
        $controller .='Controller';
        require_once ROOT.DS.'controller'.DS.$controller.'.php';
        $c = new $controller();
        return $c->$action();
    }

    /**
     * Redirect
     */
    function redirect($url,$code = null){
        if($code == 301){
            header("HTTP/1.1 301 Moved Permanently");
        }
        header("Location: ".Router::url($url));
    }

}
