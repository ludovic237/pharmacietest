<?php

$title_for_layout = ' Admin -'.'Utilisateurs';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un utilisateur' : 'Modifier un utilisateur';
//$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "Toutes les universités";
}else{
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Utilisateurs</a></li><li class="active">'.$position.'</li>';
if($position == 'Ajouter')
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/functions.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {

                        identifiant: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    password: {
                                required: true,
                                minlength: 5,
                                maxlength: 10
                        },
                    \'re-password\' : {
                                required: true,
                                minlength: 5,
                                maxlength: 10,
                                equalTo: "#password"
                        },
                    telephone_1: {
                        required: true
                    },
                    noms: {
                        required: true
                    },
                    statut: {
                        required: true
                    },
                    prenoms: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    }

                }
            });

        </script>"';
else
    $script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/functions.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {

                        statut: {
                        required: true
                    }

                }
            });

        </script>"';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4>Informations générales</h4>
            <form id="jvalidate" role="form" enctype="multipart/form-data" class="form-horizontal" action="javascript:enregistrer_utilisateur('<?php  echo $position; ?>','<?php if($position == 'Modifier')  echo $utilisateur->PERSONNE_ID; else echo ""; ?>','<?php  echo $_FILES['photo_profil']['tmp_name']; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Noms:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="noms" id="noms" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php  if($position == 'Modifier') echo $utilisateur->NOM; ?>" placeholder="<?php if($position != 'Modifier') echo 'Noms'; ?>"/>
                            <span class="help-block">Veuillez saisir tous vos noms</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prénoms:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="prenoms" id="prenoms" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php if($position == 'Modifier') echo $utilisateur->PRENOM; ?>" placeholder="<?php if($position != 'Modifier') echo 'Prénoms'; ?>" />
                            <span class="help-block">Veuillez saisir tous vos prénoms</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Identifiant:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php  if($position == 'Modifier') echo $utilisateur->IDENTIFIANT; ?>" name="identifiant" id="identifiant" placeholder="<?php if($position != 'Modifier') echo 'Identifiant'; ?>"/>
                            <span class="help-block">Le nom que vous allez utiliser pour vous connecter (en miniucule)</span>
                        </div>
                    </div>
                    <div class="form-group" <?php if($position == 'Modifier') { ?>style="display: none" <?php } ?>>
                        <label class="col-md-3 control-label">Mot de passe:</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe"/>
                            <span class="help-block">min size = 5, max size = 10</span>
                        </div>
                    </div>
                    <div class="form-group" <?php if($position == 'Modifier') { ?>style="display: none" <?php } ?>>
                        <label class="col-md-3 control-label">Confirmer mot de passe:</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="re-password" placeholder="Confirmer"/>
                            <span class="help-block">Requis, retaper le mot de passe</span>
                        </div>
                    </div>
                    <div class="form-group" <?php if($position == 'Modifier') { ?>style="display: none" <?php } ?>>
                        <div class="col-md-7">
                            <label class="checkbox">
                                <label>
                                    <input type="checkbox" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> id="envoi" name="envoi" value="1"/> Envoyez le mot de passe par email.
                                </label>
                            </label>
                        </div>
                        <div class="col-md-5">
                            <input type="hidden" class="form-control datepicker" value="2014-08-04">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Date de naissance: </label>
                        <div class="col-md-9 col-xs-12">
                            <div class="input-group date">
                                <input type="text" name="date_naissance" id="dp-3" class="form-control" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php if($position != 'Modifier') echo ''; else {if($utilisateur->DATE_NAISSANCE != null) {$date = DateTime::createFromFormat('Y-m-d', $utilisateur->DATE_NAISSANCE);echo $date->format('d-m-Y');}} ?>" data-date="<?php if($position != 'Modifier') echo ''; else {if($utilisateur->DATE_NAISSANCE != null) {$date = DateTime::createFromFormat('Y-m-d', $utilisateur->DATE_NAISSANCE);echo $date->format('d-m-Y');}} ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fonction:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="fonction" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php  if($position == 'Modifier') echo $utilisateur->FONCTION; ?>" id="fonction" placeholder="<?php if($position != 'Modifier') echo 'Fonction'; ?>"/>
                            <span class="help-block">Votre poste actuel</span>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <h4 style="margin:0 0 30px -15px">Informations de contact</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">B.P:</label>
                        <div class="col-md-9">
                            <input type="text" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php if($position == 'Modifier') echo $contact->BP; ?>" name="bp" id="bp" class="form-control" placeholder="<?php if($position != 'Modifier') echo 'B.P'; ?>"/>
                            <span class="help-block">Exemple: 90 Douala</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone 1:</label>
                        <div class="col-md-9">
                            <input type="text" class="mask_phone form-control" name="telephone_1" id="telephone_1" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php if($position == 'Modifier') echo $contact->TELEPHONE_1; ?>"/>
                            <span class="help-block">Exemple:  666-66-66-66</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone 2:</label>
                        <div class="col-md-9">
                            <input type="text" class="mask_phone form-control" name="telephone_2" id="telephone_2" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php if($position == 'Modifier') echo $contact->TELEPHONE_2; ?>"/>
                            <span class="help-block">Exemple:  666-66-66-66</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email:</label>
                        <div class="col-md-9">
                            <input type="text" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php if($position == 'Modifier') echo $contact->EMAIL; ?>" name="email" id="email" class="form-control" placeholder="<?php if($position != 'Modifier') echo 'Email'; ?>"/>
                            <span class="help-block">Email requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Site:</label>
                        <div class="col-md-9">
                            <input type="text" <?php if($position == 'Modifier') echo "disabled=\"disabled\""; ?> value="<?php if($position == 'Modifier') echo $contact->SITE; ?>" name="site" id="site" class="form-control" placeholder="<?php if($position != 'Modifier') echo 'Site'; ?>"/>
                            <span class="help-block">URL Facultatif</span>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <h4 style="margin:0 0 30px -15px">Autres Informations</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Photo de profil:</label>
                        <div class="col-md-9">
                            <?php if($position == 'Modifier'&&$utilisateur->PHOTO_PROFIL!=null)  ?>
                            <input type="file"   name="photo_profil" id="photo_profil"  title="Parcourir"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Statut:</label>
                        <div class="col-md-9">
                            <select class="select" name="statut" id="statut" >
                                <option></option>
                                <option <?php if($position == 'Modifier'&&$utilisateur->STATUT =='Administrateur') echo "selected=\"selected\""; ?> value="Administrateur">Administrateur</option>
                                <option <?php if($position == 'Modifier'&&$utilisateur->STATUT =='Superviseur') echo "selected=\"selected\""; ?> value="Superviseur">Superviseur</option>
                                <option <?php if($position == 'Modifier'&&$utilisateur->STATUT =='Universitaire') echo "selected=\"selected\""; ?> value="Universitaire">Universitaire</option>
                                <option <?php if($position == 'Modifier'&&$utilisateur->STATUT =='Informateur') echo "selected=\"selected\""; ?> value="Informateur">Informateur</option>
                                <option <?php if($position == 'Modifier'&&$utilisateur->STATUT =='Abonné') echo "selected=\"selected\""; ?> value="">Abonné</option>
                            </select>
                            <span class="help-block">Requis</span>
                        </div>
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary"  type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>

</div>



