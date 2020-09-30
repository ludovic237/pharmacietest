<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter une formation' : 'Modifier une formation';
$action_for_layout = 'Présentation';

if($this->request->action == "index"){
    $position = "Toutes les universités";
}else{
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Formations</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/functions.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    check: {
                        required: true,
                        email: true
                    },
                    faculte: {
                        required: true
                    },
                    "type[]": "required"

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-10">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4>Informations générales</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_filiere('<?php  echo $position; ?>','<?php if($position == 'Modifier')  echo $filiere->FILIERE_ID; else echo ""; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php  if($position == 'Modifier') echo $filiere->NOM; ?>" placeholder="Nom "/>
                            <span class="help-block">Nom de la filière</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sigle:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="sigle" id="sigle" value="<?php if($position == 'Modifier') echo $filiere->SIGLE; ?>" placeholder="Sigle" />
                            <span class="help-block">Sigle de la filière </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description:</label>
                        <div class="col-md-9">
                            <textarea  class="form-control" value=""  id="description" ><?php  if($position == 'Modifier') echo $filiere->DESCRIPTION; ?></textarea>
                            <span class="help-block">Description brieve sur la formation en question</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Categorie:</label>
                        <div class="col-md-3 col-xs-12">
                            <select class="form-control selectpicker categorie col-md-6" name="categorie" id="categorie">
                                <?php

                                foreach ($categorieList as $k => $v): ?>
                                    <option <?php if($position == 'Modifier') if($v->CATEGORIE_ID == $filiere->CATEGORIE_ID) echo "selected=\"selected\""; ?> value="<?php echo $v->CATEGORIE_ID; ?>" ><?php echo $v->NOM; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Université</label>
                    <div class="col-md-3 col-xs-12">
                        <select class="form-control selectpicker universite col-md-6" name="universite" id="universite">
                            <?php

                            foreach ($universitesList as $k => $v): ?>
                                <option <?php if($position == 'Modifier') if($v->UNIVERSITE_ID == $universite->UNIVERSITE_ID) echo "selected=\"selected\""; ?> value="<?php echo $v->UNIVERSITE_ID; ?>" ><?php echo $v->NOM; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <label class="col-md-3 col-xs-12 control-label">Faculté</label>
                    <div class="col-md-3 col-xs-12">
                        <select class="form-control selectpicker faculte col-md-6" name="faculte" id="faculte">
                            <?php
                            if(!empty($facultesList)){
                                foreach ($facultesList as $k => $v): ?>
                                    <option <?php if($position == 'Modifier') if($v->DEPARTEMENT_ID == $filiere->DEPARTEMENT_ID) echo "selected=\"selected\""; ?> value="<?php echo $v->DEPARTEMENT_ID; ?>" ><?php echo $v->NOM; ?></option>
                                <?php
                                endforeach;
                            }
                            else{
                                if($position == 'Modifier') {
                                    ?>
                                    <option <?php if ($position == 'Modifier') if ($faculte->DEPARTEMENT_ID == $filiere->DEPARTEMENT_ID) echo "selected=\"selected\""; ?>
                                        value="<?php echo $faculte->DEPARTEMENT_ID; ?>"><?php echo 'Par Défaut'; ?></option>
                                <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    </div>
                    <div class="form-group" id="niveau">
                        <?php
                        if($position == 'Modifier') {
                            $niveau = array();
                            $niveau = explode(';', $filiere->NIVEAU_FORMATION);
                        }
                        ?>
                        <label class="col-md-3 col-xs-12 control-label">Niveau de formation:</label>
                        <div class="col-md-4 col-xs-12">
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-1" <?php if($position == 'Modifier') if(in_array('DUT',$niveau)) echo "checked=\"checked\""; ?> value="DUT" id="srch_niveau-1"/>DUT</label>
                            <span>&nbsp; &nbsp;</span>
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-2" <?php if($position == 'Modifier') if(in_array('BTS',$niveau)) echo "checked=\"checked\""; ?> value="BTS" id="srch_niveau-2"/>BTS</label>
                            <span>&nbsp; &nbsp;</span>
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-3" <?php if($position == 'Modifier') if(in_array('DSEP',$niveau)) echo "checked=\"checked\""; ?> value="DSEP" id="srch_niveau-3"/>DSEP</label>
                            <span>&nbsp; &nbsp;</span>
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-4" <?php if($position == 'Modifier')if(in_array('Licence',$niveau)) echo "checked=\"checked\""; ?> value="Licence" id="srch_niveau-4"/>Licence</label>
                            <span>&nbsp; &nbsp;</span>
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-5" <?php if($position == 'Modifier') if(in_array('Ingenieur',$niveau)) echo "checked=\"checked\""; ?> value="Ingenieur" id="srch_niveau-5"/>Ingenieur</label>
                            <span>&nbsp; &nbsp;</span>
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-6" <?php if($position == 'Modifier')if(in_array('Master',$niveau)) echo "checked=\"checked\""; ?> value="Master" id="srch_niveau-6"/>Master</label>
                            <span>&nbsp; &nbsp;</span>
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-7" <?php if($position == 'Modifier') if(in_array('Doctorat',$niveau)) echo "checked=\"checked\""; ?> value="Doctorat" id="srch_niveau-7"/>Doctorat</label>
                            <span>&nbsp; &nbsp;</span>
                            <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-8" <?php if($position == 'Modifier') if(in_array('Spécialisation',$niveau)) echo "checked=\"checked\""; ?> value="Spécialisation" id="srch_niveau-8"/>Spécialisation</label>
                            <span>&nbsp; &nbsp;</span>

                            <span class="help-block">possiblilité de choisir un ou plusieurs niveau d'étude en fonction de son université</span>
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



