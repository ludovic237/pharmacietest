<?php
Class Form{

   public $controller;

    public function __construct($controller){
        $this->controller = $controller;
   }

    public function input($name,$label,$type){
        if(!isset($this->controller->request->data->$name)){
            $data = '';
        }
        else{
            $data = $this->controller->request->data->$name;
        }
        return '<div class="form-group">
                    <div class="col-md-12">
                        <input type="'.$type.'" id="input'.$name.'" name="'.$name.'" value="'.$data.'" class="form-control" placeholder="'.$label.'"/>
                    </div>
                </div>';
    }
}