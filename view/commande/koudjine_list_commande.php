<?php
//echo $datetime;
$title_for_layout = ' Admin -' . 'Commande';
// $action_for_layout = 'Ajouter';
echo $dateDerniere;
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
if (isset($datetime)) {
    $script_for_layout = $script_for_layout . '<script type="text/javascript"> $(document).ready(function () {getListCommande("' . $dateDerniere . '","' . $datetime . '")}) </script>';
}
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
                        <select disabled class="selectpicker form-control input-xlarge" id="list_commande_type">
                            <option value="0">Sélectionner un type</option>
                            <option selected value="express">Express</option>
                            <option value="derive">Derive</option>
                        </select>

                    </div>

                </div>
                <!--<div class="form-group"
                     style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:10px">
                    <label class="control-label" style="margin-right: 30px;width: 150px;">Date :</label>
                    <div style="display: flex;flex:1;margin-right: 30px;">
                        <input type="date" class="form-control col-md-4" name="list_commande_date"
                               id="list_commande_date" value="" placeholder="">
                    </div>
                </div>-->

            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-success" onclick="enregistrer_list_commande('<?php echo $datetime; ?>')">Enregistrer
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
                    <h3>Tableau de commande</h3>
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
                    <table class="table datatable table table-bordered table-striped table-actions" id="list_commande_tables">
                        <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Montant Total</th>
                            <th>Montant percu</th>
                            <th>Nom caissier</th>
                            <th>Date de vente</th>
                            <th>Etat</th>
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

