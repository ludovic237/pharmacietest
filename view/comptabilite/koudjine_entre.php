<?php

$title_for_layout = ' Admin -' . 'Comptabilité';
$page_for_layout = 'Entrées Stock';
$action_for_layout = 'Ajouter';

if ($this->request->action == "entre") {
    $position = "Entrées Stock";
}
$position_for_layout = '<li><a href="#">Comptabilité</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/qrcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery.fittext.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/entree.js"></script>
<script>
var qrcode = new QRCode(document.getElementById("qrcode"), {
     width: 30,
     height: 30
 });
                                    </script>

';
?>


<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;margin-bottom:0px">
                <label class="col-md-2 col-xs-12 control-label" style="margin-right: 30px;width: 150px;">Selectionner un produit:</label>
                <div class="col-md-8 col-xs-12 " style="display: flex;flex:1;margin-right: 30px;flex-direction:column">
                    <input type="text" class="form-control col-md-4" data="<?php if (isset($produit)) echo $produit->id; ?>" name="nom" id="rechercheEntre" value="" placeholder="Médicaments">
                    <div>

                        <div class="panel-body panel-body-table">

                            <div class="table-responsive">
                                <table id="tab_GrechercheEntre" style="height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">

                                    <tbody id="tab_BRechercheEntre">

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

            <div class="panel-body">

                <div class="table-responsive">
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
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <!-- <div style="border: 1px solid black;width: 40mm;display:flex;height: 30mm;flex-direction: column;" id="ticket"> -->
                            <div style="width: 35mm;display:flex;height: 30mm;flex-direction: column;" id="ticket">
                                <!-- <table class="fixed" style="display: flex;overflow: auto;border-collapse: collapse;border-spacing: 0px;border: 0;">
                                    <tbody>
                                        <tr style="display: flex;">
                                            <td style="width: 30mm;background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">
                                                <p class="nomp" style="font-weight: bold;text-align:center; margin-bottom:0px;font-size: 8px;"></p>
                                            </td>
                                            <td style="width: 5mm;background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">
                                                <p class="prixv " style="font-weight: bold;text-align:center; margin-bottom:0px;font-size: 8px;"></p>
                                            </td>
                                        </tr>
                                        <tr style="display: flex;">
                                            <td style="width: 39.75mm;background-color: white;color: black;font-weight: 400;padding: 4px 0px 0px 0px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="2">
                                                <p style="font-weight: bold;text-align:center; margin-bottom:0px;font-size: 8px;display: flex;" id="demo"></p>
                                            </td>

                                        </tr>
                                        <tr style="display: flex;">
                                            <td style="width: 17.5mm;background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="1">
                                                <p class="datel " style="font-weight: bold;text-align:center; margin-left:0px;font-size: 8px;"></p>
                                            </td>
                                            <td style="width: 17.5mm;background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="1">
                                                <p class="datep " style="font-weight: bold;text-align:center; margin-bottom:0px;font-size: 8px;"></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> -->
                                <table style="table-layout: fixed; width: 40mm;display: flex;overflow: hidden;border-collapse: collapse;border-spacing: 0px;border: 0;">
                                    <tbody>
                                        <!-- <tr style="display: flex;">
                                            <td style="width: 25mm;background-color: white;color: black;font-weight: 400; text-align: end;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">

                                            </td>
                                            <td style="width: 10mm;background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">

                                            </td>
                                            <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">
                                                <p class="code " style="width: 10mm; font-weight: bold;text-align:center; margin-bottom:0px;font-size: 8px;"></p>
                                            </td>
                                        </tr> -->
                                        <tr style="display: flex;table-layout: fixed; width: 40mm ;">
                                            <td style="width: 39.75mm;background-color: white;color: black;font-weight: 400;padding: 4px 0px 0px 0px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="2">

                                                <div style="display: flex;flex-direction: column;padding: 4px;">
                                                    <div style="display: flex;flex-direction: row;justify-content: space-between;width:100%">
                                                        <p class="nomp" style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"></p>
                                                        <!--<p class="prixv" style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"></p>-->
                                                    </div>
                                                    <div style="display: flex;flex-direction: row;justify-content: space-between;width:100%">
                                                        <p style="font-weight: bold;text-align:center; margin:0px;font-size: 12px;align-content: center;align-items: center;justify-content: center;justify-items: center;display: flex;"><span class="prixv"></span> FCFA</p>
                                                        <p style="font-weight: bold;text-align: center;margin-bottom: 0px;font-size: 12px;display: flex;margin: 0px;padding: 0px;overflow: auto;padding:4px" id="qrcode"></p>
                                                    </div>
                                                    <div style="display: flex;flex-direction: column;justify-content: space-between;width:100%">
                                                        <p class="nomf" style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"></p>
                                                        <p style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"><span class="datep"></span> / <span class="datel" ></span></p>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <!-- <tr style="display: flex">
                                            <td style="width: 17.5mm;background-color: white;color: black;font-weight: 400; text-align: end;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="1">

                                            </td>
                                            <td style="width: 17.5mm;background-color: white;color: black;font-weight: 400; text-align: end;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="1">

                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>

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
                                        <td width="100">Code barre:</td>
                                        <td class="codebarre"></td>
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
                                        <td width="100">Réduction(%):</td>
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
