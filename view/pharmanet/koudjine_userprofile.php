<?php

$title_for_layout = ' Admin -' . 'Pharmanet';
$page_for_layout = ($position == 'Ajouter') ? 'Profile utilisateur' : 'Modifier un utilisateur';


if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action; 
}
$position_for_layout = '<li><a href="#">Pharmanet</a></li><li class="active">mon profile</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
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
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Profile utilisateur</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">nom:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $user->nom; ?>" placeholder="" />
                            <span class="help-block">exemple: nom - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">prenom:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="prenom" id="prenom" value="<?php if ($position == 'Modifier') echo $user->prenom; ?>" placeholder="" />
                            <span class="help-block">exemple: AXA - Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">email:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="email" id="email" value="<?php if ($position == 'Modifier') echo $user->email; ?>" placeholder="" />
                            <span class="help-block">exemple: LAB 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">fonction:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="fonction" id="fonction" value="<?php if ($position == 'Modifier') echo $user->fonction; ?>" placeholder="" />
                            <span class="help-block">exemple: UBI 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">telephone:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="telephone" id="telephone" value="<?php if ($position == 'Modifier') echo $user->telephone; ?>" placeholder="" />
                            <span class="help-block">exemple: UBI 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Réduction:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $user->reduction; ?>" name="reduction" id="reduction" placeholder="" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Réduction maximal:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $user->reductionMax; ?>" name="reductionMax" id="reductionMax" placeholder="" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">

            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_user('<?php echo $position; ?>',
             '<?php if ($position == 'Modifier')  echo $employe->id;
                else echo ""; ?>');">
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Profile employé</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">identifiant:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="identifiant" id="identifiant" value="<?php if ($position == 'Modifier') echo $employe->identifiant; ?>" placeholder="" />
                            <span class="help-block">exemple: identifiant - Champ requis</span>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-md-3 control-label">Password:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="password" id="password" value="<?php if ($position == 'Modifier') echo $employe->password; ?>" placeholder="" />
                            <span class="help-block">exemple: AXA - Champ requis</span>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Type:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="type" id="type" value="<?php if ($position == 'Modifier') echo $employe->type; ?>" placeholder="" />
                            <span class="help-block">exemple: LAB 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Etat:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="etat" id="etat" value="<?php if ($position == 'Modifier') echo $employe->etat; ?>" placeholder="" />
                            <span class="help-block">exemple: UBI 001</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Code barre id:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" name="codebarre_id" id="codebarre_id" value="<?php if ($position == 'Modifier') echo $employe->codebarre_id; ?>" placeholder="" />
                            <span class="help-block">exemple: UBI 001</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Réduction:</label>
                        <div class="col-md-9">
                            <input style="color: black;" disabled type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $employe->faireReductionMax; ?>" name="faireReductionMax" id="faireReductionMax" placeholder="" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>

<div style="display: flex;justify-content: space-between;background-color: white;position: fixed;bottom: 50%;right: 10px;align-items: baseline;background-color: #fff0;
border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 1px 1px 1px rgba(10,0,0,.05);">
    <div style="flex-direction: column;display: flex;padding: 20px;justify-content: center;align-items: center;width: 250px;">
        <div style="display: flex;flex-direction: column;width: 100%;">
            <button onclick="update_row_employe(<?php echo $employe->id; ?>)"class="btn btn-success" type="submit">Modifier</button>
        </div>

    </div>
    <!-- <div style="flex-direction: column;display: flex;padding: 10px 20px;justify-content: center;align-items: center;border-left-width: 1px;border-left-style: double;">
        <p style="font-weight: 200;">Total avec réduction : </p>
        <h4 style="font-weight: bold;font-size: x-large;"><span id="prixReduit">0</span> FCFA</h4>
        <a id="" onclick="valider_vente('')" class="btn btn-primary"  role="button" style="
    width: 100%;
">Paiement avec réduction </a>
    </div> -->
</div>