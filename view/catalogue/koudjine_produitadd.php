<?php

$title_for_layout = ' Admin -' . 'Universités';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter une produit' : 'Modifier une produit';
$action_for_layout = 'produitadd';

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
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">

            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_universite('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $universites->UNIVERSITE_ID;
                                                                                                                                            else echo ""; ?>');">
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Informations générales</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">ean13:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom ou Sigle" />
                            <span class="help-block">exemple: UDM</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Référence:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom_complet" id="nom_complet" value="<?php if ($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="Définition sigle" />
                            <span class="help-block">exemple: Université Des Montagnes</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $universites->VILLE; ?>" name="ville" id="ville" placeholder="Ville" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contenance:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if ($position == 'Modifier') echo $universites->REGION; ?>" name="region" id="region" class="form-control" placeholder="Région" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Unité:</label>
                        <div class="col-md-9">
                            <select class="select" name="statut" id="statut">
                                <option <?php if ($position != 'Modifier') echo "selected=\"selected\""; ?> value="">Choisir Statut</option>
                                <option <?php if ($position == 'Modifier' && $universites->STATUT == 'Public') echo "selected=\"selected\""; ?> value="1">Public</option>
                                <option <?php if ($position == 'Modifier' && $universites->STATUT == 'Privée') echo "selected=\"selected\""; ?> value="0">Privée</option>
                            </select>
                            <span class="help-block">Requis</span>
                        </div>
                    </div>
                </div>
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Stock</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantité en stock:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom ou Sigle" />
                            <span class="help-block">exemple: UDM</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantité max en stock:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom_complet" id="nom_complet" value="<?php if ($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="Définition sigle" />
                            <span class="help-block">exemple: Université Des Montagnes</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantité min en stock:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $universites->VILLE; ?>" name="ville" id="ville" placeholder="Ville" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date de péremption:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if ($position == 'Modifier') echo $universites->REGION; ?>" name="region" id="region" class="form-control" placeholder="Région" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date de commande:</label>
                        <div class="col-md-9">
                            <select class="select" name="statut" id="statut">
                                <option <?php if ($position != 'Modifier') echo "selected=\"selected\""; ?> value="">Choisir Statut</option>
                                <option <?php if ($position == 'Modifier' && $universites->STATUT == 'Public') echo "selected=\"selected\""; ?> value="1">Public</option>
                                <option <?php if ($position == 'Modifier' && $universites->STATUT == 'Privée') echo "selected=\"selected\""; ?> value="0">Privée</option>
                            </select>
                            <span class="help-block">Requis</span>
                        </div>
                    </div>
                </div>
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Prix</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prix public:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom ou Sigle" />
                            <span class="help-block">exemple: UDM</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prix achat:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom_complet" id="nom_complet" value="<?php if ($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="Définition sigle" />
                            <span class="help-block">exemple: Université Des Montagnes</span>
                        </div>
                    </div>
                </div>
                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Géo</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Catégorie:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom ou Sigle" />
                            <span class="help-block">exemple: UDM</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Rayon:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom_complet" id="nom_complet" value="<?php if ($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="Définition sigle" />
                            <span class="help-block">exemple: Université Des Montagnes</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Magasin:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $universites->VILLE; ?>" name="ville" id="ville" placeholder="Ville" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Form:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if ($position == 'Modifier') echo $universites->REGION; ?>" name="region" id="region" class="form-control" placeholder="Région" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fabriquant:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if ($position == 'Modifier') echo $universites->REGION; ?>" name="region" id="region" class="form-control" placeholder="Région" />
                            <span class="help-block">Champ requis</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Fournisseur:</label>
                        <div class="col-md-9">
                            <input type="text" value="<?php if ($position == 'Modifier') echo $universites->REGION; ?>" name="region" id="region" class="form-control" placeholder="Région" />
                            <span class="help-block">Champ requis</span>
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