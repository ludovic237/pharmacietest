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
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
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
                </div>
            </div>
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <div>

                        <div class="panel-body panel-body-table">

                            <div class="">
                                <table id="tab_Grecherche" style="display: block;height: 200px;overflow: auto;" class="table datatable table-bordered table-striped table-actions">
                                    <thead>
                                        <tr>
                                            <th width="200">Nom</th>
                                            <th width="100">Prix Unitaire</th>
                                            <th width="100">Quantité</th>
                                            <th width="100">Prix Total</th>
                                            <th width="100">Reduction</th>
                                            <th width="200">Date de Livraison</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tab_Brecherche">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div style="width: 150px;">

                </div>
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
                                <th width="100">Action</th>
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
                        <select class="form-control selectpicker select_client" style="width: 150px;">
                            <option class="option_nouveauClient" value="0">Nouveau Client</option>
                            <option value="2">Client Existant</option>
                        </select>
                    </div>

                    <form id="" role="form" class="form-horizontal">
                        <div class="panel-body nouveauClient">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nom:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="nom" id="input_vente_nomClient" value="" placeholder="Nom" />
                                </div>
                                <label class="col-md-2 control-label">Téléphone:</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nom" id="input_vente_phoneClient" value="" placeholder="Téléphone" />
                                </div>
                            </div>
                        </div>
                        <div class="panel-body clientExistant">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Client:</label>
                                <div class="col-md-6">
                                    <select class="form-control selectpicker" id="select_vente_client">
                                        <option value="0">Sélectionner Client</option>
                                        <?php
                                        foreach ($client as $k => $v) : ?>
                                            <option <?php if ($position == 'Modifier') if ($v->id == $vente->user_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>" name="<?php echo $v->reduction; ?>" data="<?php echo $v->reductionMax; ?>"><?php echo $v->nom; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label">Réduction:</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="reduction" readonly id="reduction_vente_client" value="0" />
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

            <div class="panel-body" style="padding: 0px;">
                <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                    <select class="form-control selectpicker select_prescripteur" style="width: 150px;">
                        <option value="1">Nouveau Prescripteur</option>
                        <option value="2">Prescripteur Existant</option>
                    </select>
                </div>

                <form id="" role="form" class="form-horizontal">
                    <div class="panel-body nouveauPrescripteur">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nom:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nom" id="input_vente_nomPrescripteur" value="" placeholder="Nom" />
                            </div>
                        </div>
                    </div>
                    <div class="panel-body prescripteurExistant">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Prescripteur:</label>
                            <div class="col-md-6">
                                <select class="form-control selectpicker" id="select_vente_prescripteur">
                                    <option value="0">Sélectionner Prescripteur</option>
                                    <?php
                                    foreach ($prescripteur as $k => $v) : ?>
                                        <option <?php if ($position == 'Modifier') if ($v->id == $vente->user_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
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

<div class="row" style="margin-bottom: 180px;">
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Réduction </h4>
                        <span>
                            <input type="checkbox" id="check_reductionGenerale">
                        </span>
                    </div>
                    <form id="jvalidate" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Taux:</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" readonly name="<?php echo $_SESSION['Users']->faireReductionMax; ?>" id="taux" value="15" />
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
                                <label class="col-md-3 control-label">Commentaire:</label>
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
    <div style="flex-direction: column;display: flex;padding: 20px;justify-content: center;align-items: center;width: 250px;">
        <div style="display: flex;flex-direction: column;width: 100%;">
            <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                <p>Total</p>
                <p>1000 FCFA</p>
            </div>
            <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                <p>Réduction</p>
                <p>10%</p>
            </div>  
        </div>
        <div style="display: flex;padding-top: 12px;flex-direction: row;width: 100%;justify-content: space-between;border-top-style: solid;border-top-width: 1px;">
            <p style="font-weight: 200;">Total : </p>
            <h6 style="font-weight: bold;font-size: large;"><span id="prixTotal">0</span> FCFA</h6>
        </div>

        <a onclick="valider_vente('')" id="" class="btn btn-primary" role="button" style="
    width: 100%;
">Paiement</a>
    </div>
    <!-- <div style="flex-direction: column;display: flex;padding: 10px 20px;justify-content: center;align-items: center;border-left-width: 1px;border-left-style: double;">
        <p style="font-weight: 200;">Total avec réduction : </p>
        <h4 style="font-weight: bold;font-size: x-large;"><span id="prixReduit">0</span> FCFA</h4>
        <a id="" onclick="valider_vente('')" class="btn btn-primary"  role="button" style="
    width: 100%;
">Paiement avec réduction </a>
    </div> -->
</div>