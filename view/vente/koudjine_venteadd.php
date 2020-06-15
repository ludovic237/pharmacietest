<?php

$title_for_layout = ' Admin -' . 'Universités';
<<<<<<< HEAD
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter en Vente' : 'Modifier un assureur';
// $action_for_layout = 'Ajouter';
=======
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un assureur' : 'Modifier un assureur';
$action_for_layout = 'Ajouter';
>>>>>>> 55b72a2dde0157483615674d5ec5a19c6b5c76a8

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">' . $position . '</li>';
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
<<<<<<< HEAD
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <label class="control-label" style="margin-right: 30px;">Ajouter un médicament:</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control" name="nom" id="nom" value="" placeholder="Médicaments">
                </div>
                <div>
                    <a name="" id="" class="btn btn-primary" href="#" role="button">Ajouter</a>
                </div>
            </div>
        </div>
    </div>
</div>
=======
?> 
>>>>>>> 55b72a2dde0157483615674d5ec5a19c6b5c76a8

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouvelle vente</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_universite('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $universites->UNIVERSITE_ID;
                                                                                                                                            else echo ""; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Téléphone" />
                            <span class="help-block">exemple: 89489233</span>
                        </div>
                    </div>
<<<<<<< HEAD
                    <form id="jvalidate" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nom:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom" />
                                    <span class="help-block">exemple: Boris Daudga</span>
                                </div>
                            </div>
=======
                    <div class="form-group">
                        <label class="col-md-3 control-label">Taux:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Taux" />
                            <span class="help-block">exemple: 10</span>
>>>>>>> 55b72a2dde0157483615674d5ec5a19c6b5c76a8
                        </div>
                    </div>
<<<<<<< HEAD
                    <form id="jvalidate" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nom:</label>
                                <div class="col-md-9">
                                    <select class="form-control input-xlarge " name="catproduit" id="catproduit">
                                        <?php
                                        foreach ($categorie as $k => $v) : ?>
                                            <option <?php if ($position == 'Modifier') if ($v->id == $produit->categorie_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Réduction </h4>
                        <span>
                            <input type="checkbox" id="check_compo-1">
                        </span>
                    </div>
                    <form id="jvalidate" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Taux:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom" />
                                    <span class="help-block">exemple: Boris Daudga</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Commentaire </h4>
                        <span>
                            <input type="checkbox" id="check_compo-1">
                        </span>
                    </div>
                    <form id="jvalidate" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Commentaaire:</label>
                                <div class="col-md-9">
                                    <textarea name="" id="" cols="30" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
=======
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code postal:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Code postal" />
                            <span class="help-block">exemple: 44444</span>
>>>>>>> 55b72a2dde0157483615674d5ec5a19c6b5c76a8
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
<<<<<<< HEAD
</div>
<div style="display: flex;justify-content: space-between;background-color: white;position: fixed;bottom: 40px;right: 10px;align-items: baseline;">
    <div style="flex-direction: column;display: flex;padding: 20px;justify-content: center;align-items: center;">
        <p style="font-weight: 200;">Total sans réduction : </p>
        <h4 style="font-weight: bold;font-size: x-large;">10000 FCFA</h4>
        <a name="" id="" class="btn btn-primary" href="#" role="button" style="
    width: 100%;
">Paiement avec réduction </a>
    </div>
    <div style="flex-direction: column;display: flex;padding: 20px;justify-content: center;align-items: center;border-left-width: 1px;border-left-style: double;">
        <p style="font-weight: 200;">Total avec réduction : </p>
        <h4 style="font-weight: bold;font-size: x-large;">9100 FCFA</h4>
        <a name="" id="" class="btn btn-primary" href="#" role="button" style="
    width: 100%;
">Paiement sans réduction </a>
    </div>
=======

>>>>>>> 55b72a2dde0157483615674d5ec5a19c6b5c76a8
</div>