<!-- <?php

$title_for_layout = ' ALSAS -' . 'Catalogue';
$page_for_layout = 'Détail produit';
$action_for_layout = 'Ajouter';
if ($_GET['id']) {
    $id = $_GET['id'];
} else {
    $id = null;
}

if ($this->request->action == "index") {
    $position = "Tout";
} else {
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/qrcode.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Catalogue/functions.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script>
var qrcode = new QRCode(document.getElementById("qrcode"), {
     width: 30,
     height: 30
 });
                                    </script>
<script>
                                        window.onload = function () {
                                            document.getElementById("detail_recherche").focus();
                                        };
                                        
                                    </script>
                                    <script>
var test = "' . $id . '"
                                    </script>' . $add_script;
?> -->


<!-- START RESPONSIVE TABLES -->

<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
            <div class="form-group"
                 style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                <label class="control-label" style="margin-right: 30px;width: 150px;">Recherche d'un médicament:</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="detail_recherche" value=""
                           placeholder="Médicaments">
                </div>
                <div style="width: 150px;">
                </div>
            </div>
            <div class="form-group"
                 style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <div class="panel-body panel-body-table" style="width: 100%;">

                        <div class="table-responsive">
                            <table id="tab_produit_detail" style="display: block;max-height: 200px;overflow: auto;"
                                   class="table table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th style="width: 100%;">Nom</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="tab_produit_detail_data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="width: 150px;">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="detailTab">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table">
                <div class="panel-body">
                    <div class="panel panel-default tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Vente</a></li>
                            <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Commande</a></li>
                            <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false">Gestion de stock</a>
                            </li>
                            <li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false">Sortie</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane panel-body active" id="tab1">
                                <div class="block">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <table id="produit_detail_a"
                                                               class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                            <tr>
                                                                <th width="100">Nom</th>
                                                                <th width="100">Nombre de vente du mois</th>
                                                                <th width="100">Nombre de vente total</th>
                                                                <th width="200">Quantité en stock</th>
                                                                <th width="100">Reduction</th>
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

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Vente du Mois en cours
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_detail_b"
                                                               class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                            <tr>
                                                                <th width="100">Vente id</th>
                                                                <th width="100">Date et heure</th>
                                                                <th width="100">En rayon</th>
                                                                <th width="200">Prix unitaire</th>
                                                                <th width="200">Quantité</th>
                                                                <th width="100">Reduction</th>
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
                            </div>
                            <div class="tab-pane panel-body" id="tab2">
                                <div class="block">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <table id="produit_commande_detail_a"
                                                               class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                            <tr>
                                                                <th width="100">Nom</th>
                                                                <th width="100">Nombre de Commande du mois</th>
                                                                <th width="100">Nombre de Commande total</th>
                                                                <th width="200">Quantité en stock</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_commande_detail_a">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Commande du Mois en cours
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_commande_detail_b"
                                                               class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                            <tr>
                                                                <th width="100">Produit id</th>
                                                                <th width="100">Commande id</th>
                                                                <th width="200">Prix public</th>
                                                                <th width="200">Quantite commande</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_commande_detail_b">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane panel-body" id="tab3">
                                <div class="block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" id="produit_stock_detail_a">

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <h1>Stock total :
                                                            <span id="tab_produit_stock_detail_a">
                                                            </span>
                                                        </h1>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Entrée en rayon
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_stock_detail_b"
                                                               class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                            <tr>
                                                                <th width="100">Nom</th>
                                                                <th width="100">Fournisseur id</th>
                                                                <th width="200">Date livraison</th>
                                                                <th width="200">Date peremption</th>
                                                                <th width="200">Prix achat</th>
                                                                <th width="200">Prix vente</th>
                                                                <th width="200">Quantité restante</th>
                                                                <th width="200">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_stock_detail_b">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane panel-body" id="tab4">
                                <div class="block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" id="produit_stock_detail_sortie_a">

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <h1>Stock total :
                                                            <span id="tab_produit_stock_detail_sortie_a">
                                                            </span>
                                                        </h1>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Sortie
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_stock_detail_sortie_b"
                                                               class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                            <tr>
                                                                <th width="200">Nom</th>
                                                                <th width="100">Quantité</th>
                                                                <th width="100">Nom produit détail</th>
                                                                <th width="100">Forme</th>
                                                                <th width="100">Date Opération</th>
                                                                <th width="100">Opération</th>

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
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewDetailModif" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail</h4> <span id="id"></span>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Prix d'achat:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control erprixachat" name="erprixachat"
                                           id="erprixachat" value="" placeholder=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Prix de vente:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control erprixvente" name="erprixvente"
                                           id="erprixvente" value="" placeholder=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Quantité:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control erquantite" name="erquantite"
                                           id="erquantite" value="" placeholder=""/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Date de peremption:</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control erdatePeremption" name="erdatePeremption"
                                           id="erdatePeremption" value="" placeholder=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" onclick="save_produit_detail()">Sauvegarder</a>
                <a class="btn btn-primary" data-dismiss="modal">Annuler</a>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

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

                                            <div style="display: flex;flex-direction: column;">
                                                <div style="display: flex;flex-direction: row;justify-content: space-between;width:100%">
                                                    <p class="nomp" style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"></p>
                                                    <p class="prixv" style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"></p>
                                                </div>
                                                <div style="justify-content: center;display:flex">
                                                    <p style="font-weight: bold;text-align: center;margin-bottom: 0px;font-size: 12px;display: flex;margin: 0px;padding: 0px;overflow: auto;padding:4px" id="qrcode"></p>
                                                </div>
                                                <div style="display: flex;flex-direction: row;justify-content: space-around;">
                                                    <p class="datel" style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"></p>
                                                    <p class="datep" style="font-weight: bold;text-align:center; margin:0px;font-size: 8px;"></p>
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