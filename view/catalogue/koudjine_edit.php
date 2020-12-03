<?php

$title_for_layout = ' Admin -'.'Concours';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un concours' : 'Modifier un concours';
//$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "";
}else{
    //$position = $this->request->action;
}

if($position == 'Modifier')
    $id = $concours->CONCOURS_ID;
else $id = null;

$position_for_layout = '<li><a href="#">Concours</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/Catalogue/functions.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                validClass: "success",
                  submitHandler: function(form) {
                            // do other things for a valid form
                            enregistrer_concours(\''.$position.'\',\''.$id.'\')
                            form.submit();
                          },
                rules: {
                    description: {
                        required: true
                    },
                    modalite: {
                        required: true
                    }

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-10">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4>Informations générales</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Université</label>
                        <div class="col-md-4 col-xs-12">
                            <select class="form-control selectpicker universite col-md-6" name="universite" id="universite">
                                <?php

                                foreach ($universitesList as $k => $v): ?>
                                    <option <?php if($position == 'Modifier') if($v->UNIVERSITE_ID == $concours->UNIVERSITE_ID) echo "selected=\"selected\""; ?> value="<?php echo $v->UNIVERSITE_ID; ?>" ><?php echo $v->NOM; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="hidden" class="form-control datepicker" value="2014-08-04">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Date de début: </label>
                        <div class="col-md-3 col-xs-12">
                            <div class="input-group date">
                                <input type="text" id="dp-3" class="form-control" value="<?php if($position != 'Modifier') echo date('d-m-Y'); else {if($concours->DATE_DEBUT_CONCOURS != null) {$date = DateTime::createFromFormat('Y-m-d', $concours->DATE_DEBUT_CONCOURS);echo $date->format('d-m-Y');}} ?>" data-date="<?php if($position != 'Modifier') echo date('d-m-Y'); else {if($concours->DATE_DEBUT_CONCOURS != null) {$date = DateTime::createFromFormat('Y-m-d', $concours->DATE_DEBUT_CONCOURS);echo $date->format('d-m-Y');}} ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>

                        <label class="col-md-3 col-xs-12 control-label">Date de fin: </label>
                        <div class="col-md-3 col-xs-12">
                            <div class="input-group date">
                                <input type="text" id="dp-2" class="form-control" value="<?php if($position != 'Modifier') echo date('d-m-Y'); else {if($concours->DATE_FIN_CONCOURS != null) {$date = DateTime::createFromFormat('Y-m-d', $concours->DATE_FIN_CONCOURS);echo $date->format('d-m-Y');}} ?>" data-date="<?php if($position != 'Modifier') echo date('d-m-Y'); else {if($concours->DATE_FIN_CONCOURS != null) {$date = DateTime::createFromFormat('Y-m-d', $concours->DATE_FIN_CONCOURS);echo $date->format('d-m-Y');}} ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description:</label>
                        <div class="col-md-9">
                            <textarea  class="form-control" name="description" value=""  id="description" ><?php  if($position == 'Modifier') echo $concours->DESCRIPTION; ?></textarea>
                            <span class="help-block">Description brieve sur le concours en question</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Modalité d'admission:</label>
                        <div class="col-md-9">
                            <textarea  class="form-control" name="modalite" value=""  id="modalite" ><?php  if($position == 'Modifier') echo $concours->MODALITE_ADMISSION; ?></textarea>
                            <span class="help-block">Modalité brieve sur le concours en question</span>
                        </div>
                    </div>
                    <div>&nbsp;</div>
                    <h4 style="margin:0 0 30px -15px">Composition du dossier</h4>
                    <?php if($position == 'Ajouter'||$concours->COMPOSITION_DOSSIER == null){ ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-1"/>
                                                </span>
                            <input type="text" id="input_compo-1" value="une demande d'inscription dûment remplie par le candidat" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-2"/>
                                                </span>
                            <input type="text" id="input_compo-2" value="une copie certifiée 'conforme d'acte de 'naissance dactylographiée" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-3"/>
                                                </span>
                            <input type="text" id="input_compo-3" value="les relevés de notes certifiés du Probatoire ou du GCE/OL, du Baccalauréat ou du GCE-AL" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-4"/>
                                                </span>
                            <input type="text" id="input_compo-4" value="une copie certifiée conforme du Baccalauréat ou du GCEIAL, ou du diplôme reconnu équivalent" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-5"/>
                                                </span>
                            <input type="text" id="input_compo-5" value="un certificat médical délivré par un médecin de l'Administration" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-6"/>
                                                </span>
                            <input type="text" id="input_compo-6" value="un extrait de casier judiciaire" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-7"/>
                                                </span>
                            <input type="text" id="input_compo-7" value="une enveloppe grand format timbrée et portant l'adresse du candidat" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-8"/>
                                                </span>
                            <input type="text" id="input_compo-8" value="deux photos (4x4) d'identité" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-9"/>
                                                </span>
                            <input type="text" id="input_compo-9" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-10"/>
                                                </span>
                            <input type="text" id="input_compo-10" class="form-control" placeholder="Constitution du dossier"/>
                        </div>
                    </div>
                    <?php }
                    else{
                        $composition = array();
                        $composition = explode(';', $concours->COMPOSITION_DOSSIER);
                        $i=1;
                        if($concours->COMPOSITION_DOSSIER != null) {
                            foreach ($composition as $k => $v) {
                                ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>

                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" checked="checked"
                                                           id="check_compo-<?php echo $i; ?>"/>
                                                </span>
                                        <input type="text" id="input_compo-<?php echo $i; ?>" class="form-control"
                                               value="<?php echo $v; ?>" placeholder="Constitution du dossier"/>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                            while ($i <= 10) {
                                ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>

                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="check_compo-<?php echo $i; ?>"/>
                                                </span>
                                        <input type="text" id="input_compo-<?php echo $i; ?>" class="form-control"
                                               placeholder="Constitution du dossier"/>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                        }
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="input-group">
                            <span>&nbsp; &nbsp;</span>

                            <span class="help-block">Veuillez vérifier que la ligne a été cocché pour qu'on puisse tenir compte de cette ligne</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Date pour dossier: </label>
                        <div class="col-md-3 col-xs-12">
                            <div class="input-group date">
                                <input type="text" id="dp-4" class="form-control" value="<?php if($position != 'Modifier') echo date('d-m-Y'); else {if($concours->DATE_DOSSIER != null) {$date = DateTime::createFromFormat('Y-m-d', $concours->DATE_DOSSIER);echo $date->format('d-m-Y');}} ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary"  type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>

</div>



