<?php

$title_for_layout = ' Admin -' . 'Commande';
// $action_for_layout = 'Ajouter';

//$position = $this->request->action;

$position_for_layout = '<li><a href="#">Commande</a></li><li class="active">Commande express</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery.fittext.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Commande/listcommande.js"></script>';
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Enregister liste commande</h3>
            </div>
            <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
                <div class="form-group"
                     style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:10px">
                    <label class="control-label" style="margin-right: 30px;width: 150px;">Selectionner le type
                        :</label>
                    <div style="display: flex;flex:1;margin-right: 30px;">
                        <select class="selectpicker form-control input-xlarge" id="list_commande_type">
                            <option value="0">Sélectionner un type</option>
                            <option value="express">Express</option>
                            <option value="derive">Derive</option>
                        </select>

                    </div>

                </div>
                <div class="form-group"
                     style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:10px">
                    <label class="control-label" style="margin-right: 30px;width: 150px;">Date :</label>
                    <div style="display: flex;flex:1;margin-right: 30px;">
                        <input type="date" class="form-control col-md-4" name="list_commande_date"
                               id="list_commande_date" value="" placeholder="">
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-success" onclick="enregistrer_list_commande()">Enregistrer
                </button>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <!--<h3>Enregister liste commande</h3>-->
                </div>
                <ul class="panel-controls panel-controls-title">
                    <li>
                        <div id="reportrange" class="dtrange">
                            <span></span><b class="caret"></b>
                        </div>
                    </li>
                    <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li>
                </ul>

            </div>
            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h6 style="color: #fff;margin-bottom: 0px;">Tableau de commande</h6>
                    </div>
                    <table class="table table-bordered table-striped table-actions" id="list_commande_table">
                        <thead>
                        <tr>
                            <th width="200">Nom</th>
                            <th width="100">Quantité</th>
                            <th width="100">Unité gratuite</th>
                            <th width="100">Prix Achat</th>
                            <th width="100">Prix Public</th>
                            <th width="100">Date de perremption</th>
                            <th width="100">Réduction</th>
                            <th width="100">Action</th>
                        </tr>
                        </thead>
                        <tbody id="tab_commande_programme">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

