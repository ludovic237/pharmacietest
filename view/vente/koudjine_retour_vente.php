<?php

$title_for_layout = ' ALSAS -' . 'Vente retour';
$page_for_layout = 'Retour produits';
// $action_for_layout = 'Ajouter';

//print_r($_SESSION['Users']);
//echo $_SESSION['Users']->identifiant;

$position_for_layout = '<li><a href="#">Vente</a></li><li class="active">Retouner produits</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Vente/retour_produit.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Vente/functions.js"></script>';
?>
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading ui-draggable-handle">
                        <!-- <h3 class="panel-title"><strong>One Column</strong> Layout</h3> -->
                        <!-- <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul> -->
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Reference vente</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" placeholder="Saisir reference produit" id="search-reference-produit">
                                    <div id="suggesstion-reference-produit-block">
                                        <div id="suggesstion-reference-produit"></div>
                                    </div>
                                </div>
                                <!-- <span class="help-block">This is sample of text field</span> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading ui-draggable-handle">
                                        <h3 class="panel-title">Produit achetés</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-actions" id="tab_produit_achat">
                                                <thead>
                                                    <tr>
                                                        <th width="200">Nom</th>
                                                        <th width="100">Prix Unitaire</th>
                                                        <th width="100">Quantité</th>
                                                        <th width="100">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tab_RetourProduit_Achete">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div>toto</div>
                            </div>
                            <div class="col-md-5">
                            <div class="panel panel-default">
                                    <div class="panel-heading ui-draggable-handle">
                                        <h3 class="panel-title">Produit retourné</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-actions" id="tab_produit_achat">
                                                <thead>
                                                    <tr>
                                                        <th width="200">Nom</th>
                                                        <th width="100">Prix Unitaire</th>
                                                        <th width="100">Quantité</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tab_RetourProduit_Retourne">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <!-- <button class="btn btn-default">Clear Form</button> -->
                        <button class="btn btn-primary pull-right" onclick="valider_retour('<?php echo $_SESSION['Users']->id; ?>')">Valider retour</button>
                    </div>
                </div>

        </div>
    </div>

</div>