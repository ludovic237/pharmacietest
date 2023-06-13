<!-- <?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Liste de commande';
$action_for_layout = 'Ajouter';

if ($this->request->action == "index") {
    $position = "Tout";
} else {
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Commande</a></li><li class="active">Liste</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Commande/list.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/tableExport.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jquery.base64.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery.fittext.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/qrcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/html2canvas.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jspdf/jspdf.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jspdf/libs/base64.js"></script> 
<script src="' . BASE_URL . '/koudjine/js/plugins/jspdf/dist/jspdf.umd.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-blockui/jquery.blockUI.js"></script>';

?> -->


<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">

            <div class="form-group"
                 style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">

                <label class="control-label" style="margin-right: 30px;width: 150px;">Nombre de jours :</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="jour_vente"
                           value="<?php if (isset($jour)) echo $jour; ?>">

                </div>
                <label class="control-label" style="margin-right: 30px;width: 150px;">Afficher
                    :</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <select class="selectpicker form-control input-xlarge" name="fabproduit" id="fournisseur_commande">
                        <option value="0">Sélectionner</option>
                        <option value="1">Tout</option>
                        <option value="1">Commandé</option>
                        <option value="1">Receptioné</option>
                        <option value="1">En partie</option>
                    </select>

                </div>
                <div>
                    <button class="btn btn-primary pull-right" onclick="charger_commande()">Charger</button>
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
                <div class="panel-heading">
                    <h3 class="panel-title">Export Default Table</h3>
                    <div class="pull-right">
                        <button class="btn btn-danger toggle" data-toggle="exportTable"><i
                                    class="fa fa-bars"></i> Export Data
                        </button>
                    </div>
                </div>
                <div class="panel-body" id="exportTable" style="display: none;">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'json',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/json.png "' ?>
                                            width="24"/> JSON</a>
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/json.png "' ?>
                                            width="24"/> JSON (ignoreColumn)</a>
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'json',escape:'true'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/json.png "' ?>
                                            width="24"/> JSON (with Escape)</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'xml',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/xml.png "' ?>
                                            width="24"/> XML</a>
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'sql'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/sql.png "' ?>
                                            width="24"/> SQL</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'csv',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/csv.png "' ?>
                                            width="24"/> CSV</a>
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'txt',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/txt.png "' ?>
                                            width="24"/> TXT</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'excel',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/xls.png "' ?>
                                            width="24"/> XLS</a>
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'doc',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/word.png "' ?>
                                            width="24"/> Word</a>
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'powerpoint',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/ppt.png "' ?>
                                            width="24"/> PowerPoint</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'png',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/png.png "' ?>
                                            width="24"/> PNG</a>
                                <a href="#" class="list-group-item"
                                   onClick="$('#customers').tableExport({type:'pdf',escape:'false'});"><img <?php echo 'src="' . BASE_URL . '/koudjine/img/icons/pdf.png "' ?>
                                            width="24"/> PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions " id="customers">
                        <thead>
                        <tr>
                            <th width="200">Date de creation</th>
                            <th width="200">Date de livraison</th>
                            <!-- <th width="200">Note</th> -->
                            <th width="200">Fournisseur</th>
                            <th width="100">Quantite commande</th>
                            <th width="100">Quantite recu</th>
                            <th width="100">Unité gratuite</th>
                            <th width="200">Montant commande</th>
                            <th width="200">Montant recu</th>
                            <th width="100">Etat</th>
                            <th width="100">Reference</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($commande as $k => $v) : ?>
                            <tr id="<?php echo $v->id; ?>">
                                <td><strong></strong></td>
                                <td><?php echo $v->dateLivraison; ?></td>
                                <!-- <td><?php echo $v->note; ?></td> -->
                                <td>
                                    <?php echo $v->nom; ?>
                                </td>
                                <td>
                                    <?php echo $v->qtiteCmd; ?>
                                </td>
                                <td>
                                    <?php echo $v->qtiteRecu; ?>
                                </td>
                                <td>
                                    <?php echo $v->uniteGratuite; ?>
                                </td>
                                <td>
                                    <?php echo $v->montantCmd; ?>
                                </td>
                                <td>
                                    <?php echo $v->montantRecu; ?>
                                </td>
                                <td>
                                    <?php echo $v->etat; ?>
                                </td>
                                <td>
                                    <?php echo $v->ref; ?>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip"
                                            data-placement="top"
                                            onclick="imprimer_com(<?php echo $v->id; ?>,'<?php echo $v->ref; ?>','<?php echo $v->nom; ?>')">
                                        Imprimer
                                    </button>
                                    <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip"
                                            data-placement="top"
                                            onclick="imprimer_com_recu(<?php echo $v->id; ?>,'<?php echo $v->ref; ?>','<?php echo $v->nom; ?>','<?php echo $datel; ?>','<?php echo $v->note; ?>')">
                                        Imprimer Reçu
                                    </button>
                                    <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip"
                                            data-placement="top"
                                            onclick="charger_produit_commande(<?php echo $v->id; ?>,'<?php echo $v->etat; ?>','<?php echo $v->montantRecu; ?>','<?php echo $v->ref; ?>','<?php echo $v->nom; ?>','<?php echo $datel; ?>')">
                                        Charger
                                    </button>
                                    <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip"
                                            data-placement="top">
                                        Supprimer
                                    </button>
                                    <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip"
                                            data-placement="top"
                                            onclick="charger_all_ticket_commande(<?php echo $v->id; ?>,'<?php echo $v->etat; ?>','<?php echo $v->montantRecu; ?>','<?php echo $v->ref; ?>','<?php echo $v->nom; ?>','<?php echo $datel; ?>')">
                                        print
                                    </button>
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
<div id="qrcode" style="display: none"></div>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table">
                <div class="panel-body">
                    <table class="table  table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Quantite commandé</th>
                            <th>Quantite livré</th>
                            <th>Prix Achat</th>
                            <th>Prix Vente</th>
                            <th>Date de péremption</th>
                        </tr>
                        </thead>
                        <tbody id="tab_produit_commande" <?php if (isset($com)) {
                            echo 'data="' . $com->id . '" ';
                            echo 'etat="' . $com->etat . '" ';
                            echo 'prix="' . $com->montantCmd . '" ';
                        } ?>>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1">

    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table"
                 style="padding-bottom: 40px;padding-left: 20px;padding-right: 20px;">
                <div>
                    <div style="display: flex;align-items: center;justify-content: space-between;padding-top: 20px;">
                        <h4 style="padding:10px; color: white;background-color: #2d3945;" id="fen_facture" data=""
                            data1="" data2="" data3="">Montant : </h4>
                        <div>
                            <h4><span id="facture_commande" data="">0</span> FCFA</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label" style="width: 100px;">Commentaire:</label>
                    <div class="col-md-12">
                        <input class="form-control" name="" id="commentaire_commande" cols="30" rows="10"></textarea>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label" style="width: 100px;">Etat</label>
                    <div class="col-md-12">
                        <div style="display: flex;flex:1;margin-right: 30px;">
                            <select class="selectpicker form-control input-xlarge" name="fabproduit" id="etat_commande">
                                <option value="Commandé">Commandé</option>
                                <option value="Livré">Livré</option>
                                <option value="Imcomplet">Imcomplet</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn btn-primary" disabled id="btn_recept_commande" style="margin-right: 10px"
                            onclick="receptionner_commande(0)">Réceptionner
                    </button>
                    <button class="btn btn-success" disabled id="btn_print_commande" onclick="number_commande()">
                        Imprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="iconPreviewBonCommande" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Commande</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="icon-preview">
                            <div style="display:block;font-size: 10px;flex-direction: column;background-color: white;"
                                 class="ticketfacture" id="commande">

                                <div style="flex-direction: row;display: flex;justify-content: space-between;">
                                    <div>
                                        logo
                                    </div>
                                    <div>
                                        date
                                    </div>
                                </div>
                                <div style="display: flex;margin-top: 40px;">
                                    <h2>bon de commande</h2>
                                </div>

                                <div>
                                    N° bon de commande :
                                    <span class="ref_commande"></span>
                                </div>
                                <div style="display: flex;justify-content: space-between;margin-top: 20px;">
                                    <div>
                                        Fournisseur :
                                        <span class="nomf_commande"></span>
                                    </div>
                                    <div>
                                        recherche produit
                                    </div>
                                </div>
                                <div>
                                    <table style="display: block;overflow: auto;"
                                           class="table table-bordered table-striped table-actions">
                                        <thead>
                                        <tr>
                                            <th width="50">N</th>
                                            <!--                                            <th width="200">Date de delivrance</th>-->
                                            <th width="200">Designation</th>
                                            <th width="100">Quantite</th>
                                            <th width="100">Prix Achat</th>
                                            <th width="100">P T Achat</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_Bcommande_com">
                                        </tbody>
                                    </table>

                                </div>
                                <div style="display: flex;">
                                    <h5>Nombre d'article commandé : <span class="article_commande"></span></h5>
                                </div>
                                <div style="display: flex;">
                                    <h5>Nombre de produit commandé : <span class="produit_commande"></span></h5>
                                </div>


                            </div>
                            <div style="display: flex;justify-content: space-around;">

                                <button type="button" class="btn btn-circle blue" data-dismiss="modal"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i
                                            class="fa fa-print" style="font-size:10px"></i>&nbsp;Annuler
                                </button>
                                <button type="button" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                                        onclick="imprimer_recu('commande','commande')"><i class="fa fa-print"
                                                                                          style="font-size:10px"></i>&nbsp;Imprimer

                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="iconPreviewRecu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Commande</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="icon-preview">
                            <div style="display:block;font-size: 10px;flex-direction: column;background-color: white;"
                                 class="ticketfacture" id="recu">

                                <div style="flex-direction: row;display: flex;justify-content: space-between;">
                                    <div>
                                        logo
                                    </div>
                                    <div>
                                        <span id="date"></span>
                                    </div>
                                </div>
                                <div style="display: flex;margin-top: 40px;">
                                    <h1>Bordereau de réception</h1>
                                </div>
                                <div style="display: flex;margin-top:20px;">
                                    <strong>Numéro de bon</strong>
                                </div>
                                <div style="display: flex;justify-content: space-between;margin-top: 10px;">
                                    <div>
                                        <strong>N° bordereau de réception :</strong>
                                        <span id="rec_commande"></span>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div style="display: flex;justify-content: space-between;margin-top:10px">
                                    <div>
                                        <strong> N° bon de commande :</strong>
                                        <span id="ref_commande"></span>
                                    </div>
                                    <div>
                                        <strong>Date de commande :</strong>
                                        <span id="date_commande"></span>
                                    </div>
                                </div>
                                <div style="display: flex;justify-content: space-between;margin-top:10px">
                                    <div>
                                        <strong>Fournisseur :</strong>
                                        <span id="nomf_commande"></span>
                                    </div>
                                    <div>
                                        <strong> N° bordereau de livraison :</strong>
                                        <span id="bordereau_livraison"></span>
                                    </div>
                                </div>
                                <div>
                                    <table style="display: block;overflow: auto;margin-bottom: 20px;margin-top: 40px;border-collapse: collapse;border-spacing: 0px;border: 0;"
                                           class="table table-bordered table-striped table-actions">
                                        <thead>
                                        <tr>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"
                                                width="50"><strong>N°</strong></th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"
                                                width="200"><strong>Designation</strong></th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"
                                                width="100"><strong>Qte commandé</strong></th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"
                                                width="100"><strong>Qte livré</strong></th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"
                                                width="100"><strong>Prix Achat</strong></th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"
                                                width="100"><strong>Prix Vente</strong></th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"
                                                width="100"><strong>P T Achat</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_Bcommande_Recu">

                                        </tbody>
                                    </table>

                                </div>
                                <div style="display: flex;margin-top:10px">
                                    Nombre d'article commandé : <span id="article_commande"></span>
                                </div>
                                <div style="display: flex;margin-top:10px">
                                    Nombre de produit commandé : <span id="produit_commande"></span>
                                </div>


                            </div>
                            <div style="display: flex;justify-content: space-around;">
                                <button type="button" id="btn_receptionner" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i
                                            class="fa fa-check-square" style="font-size:10px"
                                            onclick="receptionner_commande(0)"></i>&nbsp;Receptionner
                                </button>
                                <button type="button" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                                        onclick="imprimer_recu('recu','recu')"><i class="fa fa-print"
                                                                                  style="font-size:10px"></i>&nbsp;Imprimer
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="message-box animated fadeIn" data-sound="alert" id="numerocmd">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><strong>Numero de bordereau</strong></div>
            <div class="mb-content">
                <p>Veuillez entrer le numero de bordereau de livraison</p>
            </div>
            <div style="width: 100%;float: left;padding: 10px 0px 0px;">
                <input type="text" name="bordereau" value="" id="bordereau"
                       style="color: black;width: 100%;height: 40px;font-size: 20px;">
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a onclick="imprimer_commande()" class="btn btn-success btn-lg">Suivant</a>
                    <a class="btn btn-default btn-lg mb-control-close" data-dismiss="modal"
                       href="<?php echo Router::url('bouwou/commande/list'); ?>">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</div>
