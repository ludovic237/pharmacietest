<?php

$title_for_layout = ' Admin -' . 'Catalogue';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un fournisseur' : 'Modifier un fournisseur';
$action_for_layout = 'Ajouter';

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    code: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    telephone: {
                        required: true
                    },
                    adresse: {
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
                    CodePostal_id: {
                        required: true,
                        minlength: 1,
                        maxlength: 100
                    },

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau fournisseur</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_fournisseur('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $fournisseur->id;
                                                                                                                                            else echo ""; ?>');">
                <div class="panel-body">
                    <!-- <div class="form-group">
                        <label class="col-md-3 control-label">Code:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="code" id="code" value="<?php if ($position == 'Modifier') echo $fournisseur->code; ?>" placeholder="" />
                            <span class="help-block">exemple: 20JDI022DJD</span>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $fournisseur->nom; ?>" placeholder="" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php if ($position == 'Modifier') echo $fournisseur->telephone; ?>" placeholder="" />
                            <span class="help-block">exemple: 89489233</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Adresse:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="adresse" id="adresse" value="<?php if ($position == 'Modifier') echo $fournisseur->adresse; ?>" placeholder="" />
                            <span class="help-block">exemple: 43333</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" id="email" value="<?php if ($position == 'Modifier') echo $fournisseur->email; ?>" placeholder="" />
                            <span class="help-block">exemple: toto@gmail.com</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Statut:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="statut" id="statut" value="<?php if ($position == 'Modifier') echo $fournisseur->statut; ?>" placeholder="" />
                            <span class="help-block">exemple: Gellule</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code postal:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="CodePostal_id" id="CodePostal_id" value="<?php if ($position == 'Modifier') echo $fournisseur->CodePostal_id; ?>" placeholder="" />
                            <span class="help-block">exemple: 4444</span>
                        </div>
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>

</div>