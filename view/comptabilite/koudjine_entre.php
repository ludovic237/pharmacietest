<?php

$title_for_layout = ' Admin -' . 'Comptabilité';
$page_for_layout = 'Entrées Stock';
$action_for_layout = 'Ajouter';

if ($this->request->action == "entre") {
    $position = "Entrées Stock";
}
$position_for_layout = '<li><a href="#">Comptabilité</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery.fittext.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/noty/jquery.noty.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/noty/themes/default.js"></script>
<script type="text/javascript">
';
?>


<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;margin-bottom:0px">
                <label class="col-md-2 col-xs-12 control-label" style="margin-right: 30px;width: 150px;">Selectionner un produit:</label>
                <div class="col-md-8 col-xs-12 " style="display: flex;flex:1;margin-right: 30px;flex-direction:column">
                    <input type="text" class="form-control col-md-4" name="nom" id="recherches" value="" placeholder="Médicaments">
                    <div>

                        <div class="panel-body panel-body-table">

                            <div class="">
                                <table id="tab_Grecherche" style="display: block;height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                    <thead>
                                        <tr>
                                            <th width="200">Nom</th>
                                            <th width="100">Prix Unitaire</th>
                                            <th width="100">Quantité</th>
                                            <th width="100">Stock</th>
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
                <label class="col-md-2 col-xs-12 control-label">Afficher</label>
                <div class="col-md-3 col-xs-12">
                    <select class="form-control selectpicker stock col-md-6" title='Tout...' name="srch_faculte" id="srch_stock">
                        <option <?php if ($stock == null || $stock == 0) echo "selected=\"selected\""; ?> value="0">Tout...</option>
                        <option <?php if ($stock == 1) echo "selected=\"selected\""; ?> value="1">En stock</option>
                        <option <?php if ($stock == 2) echo "selected=\"selected\""; ?> value="2">En rupture</option>
                    </select>
                </div>
            </div>
            <div style="padding-top: 40px;"></div>
            <div class="form-group">
                <label class="col-md-2 col-xs-12 control-label">Sélection des produits</label>
                <div class="col-md-4 col-xs-12">
                    <select class="form-control perime selectpicker" title='Tout...' name="categorie" id="srch_perime">
                        <option <?php if ($perime == null) echo "selected=\"selected\""; ?> value="defaut">Tout...</option>
                        <option <?php if ($perime == 1) echo "selected=\"selected\""; ?> value="1">Périmés</option>
                        <option <?php if ($perime > 1) echo "selected=\"selected\""; ?> value="2">bientôt Périmés</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-12">
                    <input type="number" class="form-control" value="<?php if ($perime > 1) echo $perime; ?>" name="jours" id="jours" placeholder="Nombre de jours avant la peremption" />
                    <!--                        <span class="help-block">Jours</span>-->
                </div>
                <div class="col-md-2 col-xs-12">
                    <button id="charger" class="btn btn-primary pull-right" onclick="charger_stock();">Charger</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th width="200">Fournisseur</th>
                                <th width="200">Date de Livraison</th>
                                <th width="200">Date de Peremtion</th>
                                <th width="100">Prix d'achat</th>
                                <th width="100">Prix de vente</th>
                                <th width="100">Quantité</th>
                                <th width="100">Quantité restante</th>
                                <th width="100">Reduction</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($catalogue as $k => $v) : ?>
                                <tr id="<?php echo $v->ide; ?>">
                                    <td><strong><a href="<?php echo Router::url('bouwou/comptabilite/entre/') . $v->idp; ?>"><?php echo $v->nomp; ?></a></strong></td>
                                    <td><?php echo $v->nomf; ?></td>
                                    <td><?php echo $v->dateLivraison; ?></td>
                                    <td><?php echo $v->datePeremption; ?></td>
                                    <td><?php echo $v->prixAchat; ?></td>
                                    <td><?php echo $v->prixVente; ?></td>
                                    <td><?php echo $v->quantite; ?></td>
                                    <td><?php echo $v->quantiteRestante; ?></td>
                                    <td><?php echo $v->reduction; ?></td>
                                    <td>
                                        <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Info" onclick="info_row_entree(<?php echo $v->ide; ?>)"><span class="fa fa-info"></span></button>
                                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_produit(<?php echo $v->ide; ?>)"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->ide; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- END RESPONSIVE TABLES -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewEntree" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <div style="border: 1px solid black;width: 30mm;display:block;height: 15mm;flex-direction: column;" id="ticket">

                                <div style="display: flex; ">
                                    <div style="border: 1px solid black;height: 5mm;justify-content: center;align-items: center;display: flex;width: 15mm;">
                                        <p class="nomp fittext1" style="width: 15mm; font-weight: bold;text-align:center; margin-bottom:0px"></p>
                                    </div>
                                    <div style="border: 1px solid black;height: 5mm;justify-content: center;align-items: center;display: flex;width: 10mm;">
                                        <p class="prixv " style="width: 10mm;font-weight: bold;text-align:center;margin-bottom:0px;font-size: 12px;"></p>
                                    </div>
                                    <div style="border: 1px solid black;height: 5mm;justify-content: center;align-items: center;display: flex;width: 5mm;">
                                        <p class="code " style="width: 5mm;font-weight: bold;text-align:center;margin-bottom:0px;font-size: 12px;"></p>
                                    </div>
                                </div>
                                <div style="display: flex;">
                                    <div style="border: 1px solid black;height: 6mm;justify-content: center;align-items: center;display: flex;width: 30mm;padding-right: 2px;">
                                        <div class="fittext1" style="display: contents;" id="demo"></div>
                                    </div>
                                </div>
                                <div style="display: flex;">
                                    <div style="border: 1px solid black; height: 4mm;justify-content: center;align-items: center;display: flex;width: 15mm;">
                                        <p class="datel fittext1" style="width: 15mm;font-weight: bold;text-align:center;margin-bottom:0px;font-size: 12px;"></p>
                                    </div>
                                    <div style="border: 1px solid black; height: 4mm;justify-content: center;align-items: center;display: flex;width: 15mm;">
                                        <p class="datep fittext1" style="width: 15mm;font-weight: bold;text-align:center;margin-bottom:0px;font-size: 12px;"></p>
                                    </div>
                                </div>

                            </div>
                            <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;" onClick="imprimer_bloc('ticket','ticket')"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Imprimer</button>
                        </div>
                    </div>
                    <div class="col-md-8 scroll">
                        <ul class="list-group border-bottom">
                            <h4>Informations Codebarre</h4>
                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <td width="100">Nom Produit:</td>
                                        <td class="nomp"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Nom Fournisseur:</td>
                                        <td class="nomf"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Code Fournisseur:</td>
                                        <td class="code"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Date Livraison:</td>
                                        <td class="datel"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Date Peremption:</td>
                                        <td class="datep"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Prix vente:</td>
                                        <td class="prixv"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4>Autres Informations</h4>
                            <table class="table table-bordered">

                                <tbody>
                                    <tr>
                                        <td width="100">Quantite:</td>
                                        <td class="quantite"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Quantité restante:</td>
                                        <td class="quantiter"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Prix Achat:</td>
                                        <td class="prixa"></td>
                                    </tr>
                                    <tr>
                                        <td width="100">Réduction:</td>
                                        <td class="reduction"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->