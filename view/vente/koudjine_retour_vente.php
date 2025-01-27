<?php

$title_for_layout = ' ALSAS -' . 'Vente retour';
$page_for_layout = 'Retour produits';
// $action_for_layout = 'Ajouter';

//print_r($_SESSION['Users']);
//echo $_SESSION['Users']->identifiant;

$position_for_layout = '<li><a href="#">Vente</a></li><li class="active">Retouner produits</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-blockui/jquery.blockUI.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/myFunction.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Vente/retour_produit.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Vente/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Vente/retour_produit.js"></script>';

?>
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Reference vente</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" placeholder="Saisir reference produit"
                                       id="search-reference-produit">
                                <div id="suggesstion-reference-produit-block">
                                    <div id="suggesstion-reference-produit"></div>
                                </div>
                            </div>
                            <!-- <span class="help-block">This is sample of text field</span> -->
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row" style="display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading ui-draggable-handle">
                                    <h3 class="panel-title">Produit achetés</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions"
                                               id="tab_produit_achat">
                                            <thead>
                                            <tr>
                                                <th width="200">Nom</th>
                                                <th width="100">Prix Unitaire</th>
                                                <th width="100">Quantité</th>
                                                <th width="100">Réduction</th>
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
                            <div style="display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;">
                                <i style="font-size: 30px" class="fa fa-arrow-right"></i>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading ui-draggable-handle">
                                    <h3 class="panel-title">Produit retourné</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions"
                                               id="tab_produit_achat">
                                            <thead>
                                            <tr>
                                                <th width="200">Nom</th>
                                                <th width="100">Prix Unitaire</th>
                                                <th width="100">Quantité</th>
                                                <th width="100">Réduction</th>
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

            </div>

        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title">Liste des produits retourne</h3>
            </div>
            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="tabRetourProduit" class="table datatable table-bordered table-striped table-actions">
                            <thead>
                            <tr>
                                <th width="100">Nom employe</th>
                                <th width="100">Date</th>
                                <th width="100">Caisse</th>
                                <th width="100">Produits</th>
                                <th width="100">Quantite</th>
                                <th width="100">Prix total</th>
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

</div>

<div style="display: flex;justify-content: space-between;background-color: white;position: fixed;bottom: 40px;right: 10px;align-items: baseline;background-color: #fff;
border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 1px 1px 1px rgba(10,0,0,.05);">
    <div style="flex-direction: column;display: flex;padding: 20px;justify-content: center;align-items: center;width: 250px;">
        <div style="display: flex;flex-direction: column;width: 100%;">
            <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                <p>Total</p>
                <p><span id="prixTotal">0</span> FCFA</p>
            </div>
            <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                <p>Réduction</p>
                <p><span id="prixReduit">0</span> FCFA</p>
            </div>
        </div>
        <div style="display: flex;padding-top: 12px;flex-direction: row;width: 100%;justify-content: space-between;border-top-style: solid;border-top-width: 1px;">
            <p style="font-weight: 200;">Net retouner : </p>
            <h6 style="font-weight: bold;font-size: large;"><span id="netTotal">0</span> FCFA</h6>
        </div>

        <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
            <a onclick="valider_retour('<?php echo $_SESSION['Users']->id; ?>')" class="btn btn-success" role="button"
               style="float: left; font-weight: bold;background-color: #66e17f;border-color: #66e17f;width: 75%;display: flex;justify-content: center;align-items: center;font-size: 18px;">Valider
                retour </a>
        </div>

    </div>
</div>

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewRetourProduit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail retour</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;"
                                 class="ticketfacture" id="ticketCaisse">

                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Pharmacie ALSAS</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Dr GAMWO Sandrine</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        BP 38 FOUMBOT</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Tel :(+237) 233 267 487</p>
                                    <div style="display: flex;justify-content:space-between">
                                        <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                            Ticket N°: <span class="reference"></span></p>
                                        <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                            <span class="datevente"></span> à <span class="heurevente"></span>
                                        </p>
                                    </div>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Client: <span class="client"></span></p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Employe: <span class="employe"></span></p>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-actions table-responsive"
                                           id="tab_GGBfactureImprimer">
                                        <thead>
                                        <tr>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="200">Libelle
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="150">Prix U.
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100">Qte
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100">Total
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_BfactureImprimer">

                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row">Montant Total
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <span class="montanttotal"></span> FCFA
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="display: flex; flex-direction: column; text-align: left;">

                                        <p style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            Ce ticket vaut facture
                                        </p>
                                        <p style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            Merci et bonne santé
                                        </p>
                                        <p style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            NoCT /P058512700488Z
                                        </p>
                                    </div>
                                    <p id="qrcodeTicket" alt="Image à droite" style="height: auto;">
                                </div>
                            </div>
                            <a class="btn btn-circle blue"
                               style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                               onClick="imprimer_bloc('ticketCaisse','ticketCaisse')"><i class="fa fa-print"
                                                                                         style="font-size:10px"></i>&nbsp;Imprimer</a>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="backToModalListVente()">Retour</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->