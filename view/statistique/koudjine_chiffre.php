<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Chiffre';
$action_for_layout = 'Ajouter';

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

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Statistique/functions.js"></script>';
?>

<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal">

            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Fournisseurs</a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Produits</a></li>
                    <li><a href="#tab-third" role="tab" data-toggle="tab">Commandes</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <!-- START SALES BLOCK -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading"
                                             style="display: flex;align-items: center;justify-content: space-between;">
                                            <div style="margin-bottom: 15px;" class="form-group">
                                                <label class="col-md-3 control-label">Type :</label>
                                                <div class="col-md-6">
                                                    <select class="selectpicker form-control" name="fournisseurType"
                                                            id="fournisseurType">
                                                        <option value="Tous">Tous</option>
                                                        <option value="Grossiste">Grossiste</option>
                                                        <option value="Detaillant">Detaillant</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">

                                                    <a class="btn btn-success" onclick="getGroupStatistique()">Recherche <span class="fa fa-search"></span></a>

                                                </div>
                                            </div>
                                            <ul class="panel-controls panel-controls-title">
                                                <li>
                                                    <div id="reportRangeDate" class="dtrange">
                                                        <span></span><b class="caret"></b>
                                                    </div>
                                                </li>
                                                <li><a href="#" class="panel-fullscreen rounded"><span
                                                                class="fa fa-expand"></span></a></li>

                                            </ul>

                                        </div>
                                        <div class="panel-body">
                                            <div style="display: flex; flex-direction: row">
                                                <h3>Total : </h3>
                                                <h3><span style="color: black;font-size: larger;margin-bottom: 0px;"
                                                          id="grossisteTotal"> 0</span> FCFA</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table id="tableGrossiste" class="table datatable">
                                                    <thead>
                                                    <tr>
                                                        <th width="100">code</th>
                                                        <th width="100">Statut</th>
                                                        <th width="200">Nom</th>
                                                        <th width="200">Montant</th>
                                                        <th width="200">Etat</th>
                                                        <th width="200">Email</th>
                                                        <th width="100">Telephone</th>
                                                        <th width="100">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SALES BLOCK -->
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="tab-pane" id="tab-second">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="customers2" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th width="100">Ref</th>
                                        <th width="100">Montant</th>
                                        <th width="200">Montant percu</th>
                                        <th width="200">Client</th>
                                        <th width="200">Vendeur</th>
                                        <th width="200">Date de vente</th>
                                        <th width="100">Etat</th>
                                        <th width="100">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab-third">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="customers2" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th width="100">Ref</th>
                                        <th width="100">Montant</th>
                                        <th width="200">Montant percu</th>
                                        <th width="200">Client</th>
                                        <th width="200">Vendeur</th>
                                        <th width="200">Date de vente</th>
                                        <th width="100">Etat</th>
                                        <th width="100">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>

    </div>
</div>