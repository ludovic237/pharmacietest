<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un assureur' : 'Modifier un assureur';
// $action_for_layout = 'Ajouter';

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">' . $position . '</li>';

$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
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
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">
                <!-- START MASKED INPUT PLUGIN -->
                <div class="block">
                    <h4>Recherche</h4>
                    <form class="form-horizontal" role="form">
                        <div class="col-md-6">

                            <div style="margin-bottom: 15px;" class="form-group">
                                <label class="col-md-3 control-label">Nom employé:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Country Name" id="search-employe-box" />
                                    <div id="suggesstion-employe-box-block">
                                        <div id="suggesstion-employe-box"></div>
                                    </div>

                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date:</label>
                                <div class="col-md-9">
                                    <div id="reportrangepharmanet" class="dtrange">
                                        <span></span><b class="caret"></b>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 15px;" class="form-group">
                                <label class="col-md-3 control-label">Catégorie:</label>
                                <div class="col-md-9">
                                    <select class="selectpicker form-control" name="pharmanettype" id="pharmanettype">
                                       <option value="0">Depense</option>
                                       <option value="1">Vente</option>
                                       <option value="2">Commandé</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 15px;" class="form-group">
                                <label class="col-md-3 control-label">Caisse:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="" id="pharmanetcaisse" />
                                    <div id="suggesstion-caisse-box-block">
                                        <div id="suggesstion-caisse-box"></div>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END MASKED INPUT PLUGIN -->
            </div>
        </div>


    </div>
</div>

<div class="row">


    <!-- START PROJECTS BLOCK -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">

                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li> <a href="#" class="btn btn-default btn-rounded btn-sm">Modifier</a></li>
                            <li><a href="#" class="btn btn-default btn-rounded btn-sm">Ajouter</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body panel-body-table">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tab_depense">
                        <thead>
                            <tr>
                                <th>Designation </th>
                                <th>Quantite</th>
                                <th>Prix unitaire</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="tab_Gdepense">

                        </tbody>
                    </table>
                </div>
                <div style="display: flex;justify-content: end; margin:50px 30px 0px 0px;">
                    <h6>Total <span id="total_depense">0</span> FCFA </h6>
                </div>
            </div>
        </div>
    </div>
    <!-- END PROJECTS BLOCK -->


</div>