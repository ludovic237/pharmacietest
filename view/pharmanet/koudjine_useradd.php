<?php

$title_for_layout = ' Admin -' . 'Pharmanet';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un utilisateur' : 'Modifier un utilisateur';


if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action; 
}
$position_for_layout = '<li><a href="#">Pharmanet</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    reduction: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    prenom: {
                        required: false,
                    },
                    stockmin: {
                        required: true
                    },
                    stockmax: {
                        required: true,
                    },
                    stock: {
                        required: true,
                    },
                    reduction: {
                        required: true
                    },
                    nom: {
                        required: true
                    }

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">

            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_user('<?php echo $position; ?>',
             '<?php if ($position == 'Modifier')  echo $user->id;
                else echo ""; ?>');">
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouvelle employé</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $user->nom; ?>" placeholder="" />
                            <span class="help-block">exemple: nom - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">prenom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="prenom" id="prenom" value="<?php if ($position == 'Modifier') echo $user->prenom; ?>" placeholder="" />
                            <span class="help-block">exemple: AXA - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">email:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" id="email" value="<?php if ($position == 'Modifier') echo $user->email; ?>" placeholder="" />
                            <span class="help-block">exemple: LAB 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">fonction:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="fonction" id="fonction" value="<?php if ($position == 'Modifier') echo $user->fonction; ?>" placeholder="" />
                            <span class="help-block">exemple: UBI 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">telephone:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="telephone" id="telephone" value="<?php if ($position == 'Modifier') echo $user->telephone; ?>" placeholder="" />
                            <span class="help-block">exemple: UBI 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Réduction:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $user->reduction; ?>" name="reduction" id="reduction" placeholder="" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Réduction maximal:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $user->reductionMax; ?>" name="reductionMax" id="reductionMax" placeholder="" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                </div>
                

                    <div class="btn-group pull-right">
                        <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>