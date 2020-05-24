<?php
if($this->request->prefix == 'koudjine'){
    $this->layout = 'koudjine';
    if(!$this->Session->isLogged()){
        $this->redirect('users/login');
    }

}
if($this->request->controller == 'users' && $this->request->action == 'login' && $this->request->prefix != 'koudjine'){
    $this->layout = 'log';

}
?>