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

    public function select($name,$opts,$j_s = '')
    {
        if ($j_s != '') $j_s = ' onchange="'.$j_s.'"';

        if(!isset($this->controller->request->data->$name)){
            $data = '';
        }
        else{
            $data = $this->controller->request->data->$name;
        }

        $sel = '<select class="form-control selectpicker" name="'.$name.'"'.$j_s.'>';
        foreach($opts as $key => $var)
        {
            $selected = ($var == $data) ? ' selected="selected"' : '';
            if (is_numeric($key))
            {
                $key = $var; $var = '';
            }
            else $var = ' value="'.$var.'"';

            $sel .= '<option'.$var.$selected.'>'.$key.'</option>';
        }
        $sel .= '</select>';

        return $sel;
    }
}