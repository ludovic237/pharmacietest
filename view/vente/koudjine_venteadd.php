<?php

$title_for_layout = ' Admin -' . 'Universités';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter en Vente' : 'Modifier un assureur';
// $action_for_layout = 'Ajouter';

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Vente</a></li><li class="active">' . $position . '</li>';
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

        </script>
        <script>
                                        window.onload = function () {
                                            document.getElementById("recherche").focus();
                                        };
                                    </script>';
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                <label class="control-label" style="margin-right: 30px;width: 150px;">Ajouter un médicament:</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="recherche" value="" placeholder="Médicaments">
                </div>
                <div style="width: 150px;">
                    <a name="" id="" class="btn btn-primary" href="#" role="button">Ajouter</a>
                </div>
            </div>
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <div class="panel panel-default">

                        <div class="panel-body panel-body-table">

                            <div class="">
                                <table class=" table-bordered table-actions">
                                    <thead>
                                        <tr>
                                            <th width="200">Nom</th>
                                            <th width="100">Prix Unitaire</th>
                                            <th width="100">Quantité</th>
                                            <th width="100">Reduction</th>
                                            <th width="200">Date de Livraison</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tab_recherche">
                                        <tr id="1">
                                            <td>Lion</td>
                                            <td>
                                                2000
                                            </td>
                                            <td>
                                                <input id="qte_vente" type="number">
                                            </td>
                                            <td>
                                                200
                                            </td>
                                            <td>
                                                sss
                                            </td>
                                            <td>
                                                <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_concours(<?php echo $v->CONCOURS_ID; ?>)"><span class="fa fa-pencil"></span></button>
                                                <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->CONCOURS_ID; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
                                            </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div style="width: 150px;">

                </div>
            </div>
            <div class="resultat scroll" id="resultat" style="display: flex; z-index: 1; background-color: #fff">
                <ul class="scroll" style=""></ul>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="200">Nom</th>
                                <th width="100">Prix Unitaire</th>
                                <th width="100">Quantité</th>
                                <th width="100">Prix Total</th>
                                <th width="100">Reduction</th>
                                <th width="200">Date de Livraison</th>
                                <th width="100">Stock après vente</th>
                            </tr>
                        </thead>
                        <tbody id="tab_vente">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Nouveau client </h4>
                        <span>
                            <input type="checkbox" id="check_compo-1">
                        </span>
                    </div>

                    <form id="jvalidate" role="form" class="form-horizontal">
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
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Client existant </h4>
                        <span>
                            <input type="checkbox" id="check_compo-1">
                        </span>
                    </div>
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

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Nouveau prescripteur </h4>
                        <span>
                            <input type="checkbox" id="check_compo-1">
                        </span>
                    </div>
                    <form id="jvalidate" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nom:</label>
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

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Prescripteur existant</h4>
                        <span>
                            <input type="checkbox" id="check_compo-1">
                        </span>
                    </div>
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

<div class="row" style="margin-bottom: 180px;">
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body" style="padding: 0px;">
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

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Commentaire </h4>
                        <!-- <span>
                            <input type="checkbox" id="check_compo-1">
                        </span> -->
                    </div>
                    <form id="jvalidate" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Commentaaire:</label>
                                <div class="col-md-9">
                                    <textarea name="" id="" cols="30" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
<div style="display: flex;justify-content: space-between;background-color: white;position: fixed;bottom: 40px;right: 10px;align-items: baseline;background-color: #fff;
border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 1px 1px 1px rgba(10,0,0,.05);">
    <div style="flex-direction: column;display: flex;padding: 20px;justify-content: center;align-items: center;">
        <p style="font-weight: 200;">Total sans réduction : </p>
        <h4 style="font-weight: bold;font-size: x-large;"><span id="prixTotal">0</span> FCFA</h4>
        <a name="" id="" class="btn btn-primary" href="#" role="button" style="
    width: 100%;
">Paiement avec réduction </a>
    </div>
    <div style="flex-direction: column;display: flex;padding: 10px 20px;justify-content: center;align-items: center;border-left-width: 1px;border-left-style: double;">
        <p style="font-weight: 200;">Total avec réduction : </p>
        <h4 style="font-weight: bold;font-size: x-large;"><span id="prixReduit">0</span> FCFA</h4>
        <a name="" id="" class="btn btn-primary" href="#" role="button" style="
    width: 100%;
">Paiement sans réduction </a>
    </div>
</div>