<?php

$title_for_layout = ' Admin -'.'Universités';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter une université' : 'Modifier une université';
$action_for_layout = 'Présentation';

if($this->request->action == "index"){
    $position = "Toutes les universités";
}else{
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/functions.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/noty/jquery.noty.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/noty/themes/default.js"></script>
<script type="text/javascript">
                function notyConfirm(){
                    noty({
                        text: \'Do you want to continue?\',
                        layout: \'topRight\',
                        buttons: [
                                {addClass: \'btn btn-success btn-clean\', text: \'Ok\', onClick: function($noty) {
                                    $noty.close();
                                    noty({text: \'You clicked "Ok" button\', layout: \'topRight\', type: \'success\'});
                                }
                                },
                                {addClass: \'btn btn-danger btn-clean\', text: \'Cancel\', onClick: function($noty) {
                                    $noty.close();
                                    noty({text: \'You clicked "Cancel" button\', layout: \'topRight\', type: \'error\'});
                                    }
                                }
                            ]
                    })
                }
            </script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    region: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    telephone_1: {
                        required: true
                    },
                    ville: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    statut: {
                        required: true
                    },
                    "type[]": "required"

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4>Informations générales</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_universite('<?php  echo $position; ?>','<?php if($position == 'Modifier')  echo $universites->UNIVERSITE_ID; else echo ""; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php  if($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom ou Sigle"/>
                            <span class="help-block">exemple: UDM</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom Complet:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom_complet" id="nom_complet" value="<?php if($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="Définition sigle" />
                            <span class="help-block">exemple: Université Des Montagnes</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ville:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php  if($position == 'Modifier') echo $universites->VILLE; ?>" name="ville" id="ville" placeholder="Ville"/>
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Région:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if($position == 'Modifier') echo $universites->REGION; ?>" name="region" id="region" class="form-control" placeholder="Région"/>
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Statut:</label>
                        <div class="col-md-9">
                            <select class="select" name="statut" id="statut" >
                                <option <?php if($position != 'Modifier') echo "selected=\"selected\""; ?> value="">Choisir Statut</option>
                                <option <?php if($position == 'Modifier'&&$universites->STATUT =='Public') echo "selected=\"selected\""; ?> value="1">Public</option>
                                <option <?php if($position == 'Modifier'&&$universites->STATUT =='Privée') echo "selected=\"selected\""; ?> value="0">Privée</option>
                            </select>
                            <span class="help-block">Requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Type:</label>
                        <div class="col-md-3">
                            <select multiple class="select" name="type[]" id="type">
                                <option
                                    <?php
                                    if($position == 'Modifier')
                                        foreach ($type as $key => $value)
                                        {
                                            if($value->TYPE_ID==3){
                                                echo "selected=\"selected\"";
                                                break;
                                            }
                                        }
                                    ?>
                                    value="3">Ecole de médécine </option>
                                <option
                                    <?php
                                    if($position == 'Modifier')
                                        foreach ($type as $key => $value)
                                        {
                                            if($value->TYPE_ID==2){
                                                echo "selected=\"selected\"";
                                                break;
                                            }
                                        }
                                    ?>
                                    value="2">Ecole d'ingénierie </option>
                                <option
                                    <?php
                                    if($position == 'Modifier')
                                        foreach ($type as $key => $value)
                                        {
                                            if($value->TYPE_ID==1){
                                                echo "selected=\"selected\"";
                                                break;
                                            }
                                        }
                                    ?>
                                    value="1">Université d'état </option>
                                <option
                                    <?php
                                    if($position == 'Modifier')
                                        foreach ($type as $key => $value)
                                        {
                                            if($value->TYPE_ID==4){
                                                echo "selected=\"selected\"";
                                                break;
                                            }
                                        }
                                    ?>
                                    value="4">Autre université</option>
                            </select>
                            <span class="help-block">Choix multiple</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Responsable:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="responsable" id="responsable" placeholder="Recteur ou Doyen"/>
                            <span class="help-block">Responsable facultatif</span>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <h4 style="margin:0 0 30px -15px">Informations de contact</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">B.P:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if($position == 'Modifier') echo $contact->BP; ?>" name="bp" id="bp" class="form-control" placeholder="B.P"/>
                            <span class="help-block">Exemple: 90 Douala</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone 1:</label>
                        <div class="col-md-9">
                            <input type="text" class="mask_phone form-control" name="telephone_1" id="telephone_1" value="<?php if($position == 'Modifier') echo $contact->TELEPHONE_1; ?>"/>
                            <span class="help-block">Exemple:  666-66-66-66</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone 2:</label>
                        <div class="col-md-9">
                            <input type="text" class="mask_phone form-control" name="telephone_2" id="telephone_2" value="<?php if($position == 'Modifier') echo $contact->TELEPHONE_2; ?>"/>
                            <span class="help-block">Exemple:  666-66-66-66</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if($position == 'Modifier') echo $contact->EMAIL; ?>" name="email" id="email" class="form-control" placeholder="Email"/>
                            <span class="help-block">Email requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Site:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if($position == 'Modifier') echo $contact->SITE; ?>" name="site" id="site" class="form-control"/>
                            <span class="help-block">URL Facultatif</span>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <h4 style="margin:0 0 30px -15px">Autres Informations</h4>
                    <div class="form-group" <?php if($this->Session->user('STATUT') != 'Administrateur'){ ?>style="visibility: hidden;"<?php } ?>>
                        <label class="col-md-3 control-label">Certification:</label>
                        <div class="col-md-9">
                            <select class="select" name="certif" id="certif" >
                                <option <?php if($position == 'Modifier'&&$universites->CERTIFICATION =='En attente') echo "selected=\"selected\""; ?> value="1">En attente</option>
                                <option <?php if($position == 'Modifier'&&$universites->CERTIFICATION =='Certifié') echo "selected=\"selected\""; ?> value="0">Certifié</option>
                            </select>
                            <span class="help-block">Requis</span>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="check"><input type="checkbox" <?php if($position == 'Modifier'&&$universites->PARRAIN_ID!=null) echo "checked=\"checked\"" ?> id="tutelle" name="tutelle" onchange="change();" /> Est-il sous tutelle</label>
                    </div>
                    <div class="form-group" style="">
                        <label class="col-md-3 control-label">Université:</label>
                        <div class="col-md-3">
                            <select class="" <?php if($position == 'Modifier'&&$universites->PARRAIN_ID!=null) echo ""; else echo "disabled=\"disabled\""; ?> id="universite">
                                <?php
                                if($position == 'Modifier')$param = $universites->PARRAIN_ID;
                                else $param = "";
                                //getUniversiteSelect($param);
                                foreach ($universitesList as $k => $v):
                                ?>
                                <option <?php if($v->UNIVERSITE_ID==$param) echo "selected=\"selected\""; ?> value="<?php echo $v->UNIVERSITE_ID; ?>" <?php //getSticky(2,'srch_universite',$rows['UNIVERSITE_ID']) ?>><?php echo $v->NOM; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>-->
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary"  type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>

</div>



