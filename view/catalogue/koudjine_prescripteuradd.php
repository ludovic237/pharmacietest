<?php

$title_for_layout = ' Admin -' . 'Universités';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter une prescripteur' : 'Modifier une prescripteur';
$action_for_layout = 'Ajouter';

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/noty/jquery.noty.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/noty/themes/default.js"></script>
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
                    adresse: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    telephone: {
                        required: true
                    },
                    structure: {
                        required: true,
                        minlength: 3,
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
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau prescripteur</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_prescripteur('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $prescripteur->id;
                                                                                                                                            else echo ""; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $prescripteur->nom; ?>" placeholder="" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php if ($position == 'Modifier') echo $prescripteur->telephone; ?>" placeholder="" />
                            <span class="help-block">exemple: 89489233</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Adresse:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="adresse" id="adresse" value="<?php if ($position == 'Modifier') echo $prescripteur->adresse; ?>" placeholder="" />
                            <span class="help-block">exemple: Yaounde</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Structure:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="structure" id="structure" value="<?php if ($position == 'Modifier') echo $prescripteur->structure; ?>" placeholder="" />
                            <span class="help-block">exemple: RAS</span>
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