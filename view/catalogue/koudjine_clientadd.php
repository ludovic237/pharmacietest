<?php

$title_for_layout = ' Admin -' . 'Catalogue';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un client' : 'Modifier un client';
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
                    telephone: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    modeReglement: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    poid: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    taille: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    reduction: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    assureur_id: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    CodePostal_id: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">>Nouveau client</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_client('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $malade->id;
                                                                                                                                            else echo ""; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $malade->nom; ?>" placeholder="" />
                            <span class="help-block">Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php if ($position == 'Modifier') echo $malade->telephone; ?>" placeholder="" />
                            <span class="help-block">89489233</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mode de règlement:</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker stock col-md-6" title='Tout...' name="srch_faculte" id="srch_stock">
                                <option <?php if ($stock == null || $stock == 0) echo "selected=\"selected\""; ?> value="0">Tout...</option>
                                <option <?php if ($stock == 1) echo "selected=\"selected\""; ?> value="1">Recu</option>
                                <option <?php if ($stock == 2) echo "selected=\"selected\""; ?> value="2">Cheque</option>
                            </select>
                            <span class="help-block">Chèque</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Pourcentage de réduction:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="reduction" id="reduction" value="<?php if ($position == 'Modifier') echo $malade->reduction; ?>" placeholder="" />
                            <span class="help-block">Pourcent</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Poid:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="poid" id="poid" value="<?php if ($position == 'Modifier') echo $malade->poid; ?>" placeholder="" />
                            <span class="help-block">10Kg</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Taille:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="taille" id="taille" value="<?php if ($position == 'Modifier') echo $malade->taille; ?>" placeholder="" />
                            <span class="help-block">189m</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code postal:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="CodePostal_id" id="CodePostal_id" value="<?php if ($position == 'Modifier') echo $malade->CodePostal_id; ?>" placeholder="" />
                            <span class="help-block">4444</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Assureur:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="assureur_id" id="assureur_id" value="<?php if ($position == 'Modifier') echo $malade->assureur_id; ?>" placeholder="" />
                            <span class="help-block">GMC</span>
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