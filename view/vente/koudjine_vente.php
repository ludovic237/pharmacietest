<!-- <?php

$title_for_layout = ' ALSAS -' . 'Vente';
$page_for_layout = 'Vente';
$action_for_layout = 'Ajouter';

$position_for_layout = '<li><a href="#">Vente</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '   <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/qrcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-blockui/jquery.blockUI.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/myFunction.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap.min.js"></script>

  <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/qrcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery.fittext.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.min.js"></script>
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/icheck/icheck.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/icheck/icheck.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/tableExport.js"></script>
	<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/tableexport/jspdf/libs/base64.js"></script>    
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/owl/owl.carousel.min.js"></script> 

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Vente/functions.js"></script>';
?> -->


<div class="row">
    <div class="col-md-12">


        <form class="form-horizontal">

            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Caisse active</a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Total</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Export Default Table</h3>
                                <div class="btn-group pull-right">
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
                            <div class="panel-body panel-body-table">
                                <table id="customers" class="table table-striped">
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
                                    <?php $i = 0;
                                    if (isset($ventes)) foreach ($ventes as $k => $v) : ?>
                                        <tr id="<?php echo $v->id; ?>">
                                            <td>
                                                <?php
                                                echo '<p style="font-size: 14px;" class="reference">' . $v->reference . '</p>';
                                                $count = 0;
                                                if (isset($produits)) foreach ($produits[$i] as $p => $q) :
                                                    if ($count == 3) break;
                                                    echo '<p style="font-size: 8px;font-weight: bold;margin-bottom: 0px;">' . $q->nom . '</p>';
                                                    //echo $q->nom."\n";
                                                    if ($count == 2)
                                                        echo '<p style="font-size: 8px;font-weight: bold;margin-bottom: 0px;">' . $q->nom . '</p>';
                                                    $count++;
                                                endforeach;
                                                $i++;
                                                ?>
                                            </td>

                                            <td><strong class="prixt"><?php echo $v->prixTotal; ?></strong></td>
                                            <td class="prixp"><?php echo $v->prixPercu; ?></td>
                                            <td class="client">
                                                <?php
                                                if (isset($user) && is_array($user)) { // Vérifie si $user est défini et est un tableau
                                                    if (isset($user[$i])) { // Vérifie si l'index $i existe dans le tableau $user
                                                        echo $user[$i]; // Affiche la valeur correspondante
                                                    } else {
                                                        echo "N/A"; // Erreur d'index non défini
                                                    }
                                                } elseif (isset($user)) { // Si $user est défini mais pas un tableau
                                                    echo "'user' n'est pas un tableau. Type : " . gettype($user);
                                                } else { // Si $user n'est pas défini
                                                    echo "N/A";
                                                }
                                                ?></td>
                                            <td class="seller"><?php echo $v->identifiant; ?></td>
                                            <td class="datevte">
                                                <?php echo $v->dateVente; ?>
                                            </td>
                                            <td>
                                                <?php echo $v->etat; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-rounded btn-sm" data-toggle="tooltip"
                                                   data-placement="top" title="Modifier"
                                                   onclick="reimprime_ticket(<?php echo $v->id; ?>)">Imprimer ticket</a>
                                            </td>
                                            <p></p>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-second">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table datatable table-bordered table-striped table-actions"
                                       id="customers3">
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
                                    <?php $i = 0;
                                    if (isset($venteAll)) foreach ($ventes as $k => $v) : ?>
                                        <tr id="<?php echo $v->id; ?>">
                                            <td>
                                                <?php
                                                echo '<p style="font-size: 14px;" class="reference">' . $v->reference . '</p>';
                                                $count = 0;
                                                if (isset($produits)) foreach ($produits[$i] as $p => $q) :
                                                    if ($count == 3) break;
                                                    echo '<p style="font-size: 8px;font-weight: bold;margin-bottom: 0px;">' . $q->nom . '</p>';
                                                    //echo $q->nom."\n";
                                                    if ($count == 2)
                                                        echo '<p style="font-size: 8px;font-weight: bold;margin-bottom: 0px;">' . $q->nom . '</p>';
                                                    $count++;
                                                endforeach;
                                                $i++;
                                                ?>
                                            </td>

                                            <td><strong class="prixt"><?php echo $v->prixTotal; ?></strong></td>
                                            <td class="prixp"><?php echo $v->prixPercu; ?></td>
                                            <td class="client"><?php
                                                if (isset($user) && is_array($user)) { // Vérifie si $user est défini et est un tableau
                                                    if (isset($user[$i])) { // Vérifie si l'index $i existe dans le tableau $user
                                                        echo $user[$i]; // Affiche la valeur correspondante
                                                    } else {
                                                        echo "N/A"; // Erreur d'index non défini
                                                    }
                                                } elseif (isset($user)) { // Si $user est défini mais pas un tableau
                                                    echo "'user' n'est pas un tableau. Type : " . gettype($user);
                                                } else { // Si $user n'est pas défini
                                                    echo "N/A";
                                                }
                                                ?></td>
                                            <td class="seller"><?php echo $v->identifiant; ?></td>
                                            <td class="datevte">
                                                <?php echo $v->dateVente; ?>
                                            </td>
                                            <td>
                                                <?php echo $v->etat; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-rounded btn-sm" data-toggle="tooltip"
                                                   data-placement="top" title="Modifier"
                                                   onclick="reimprime_ticket(<?php echo $v->id; ?>)">Imprimer ticket</a>
                                                <!-- <a class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->CONCOURS_ID; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></a> -->
                                            </td>
                                            <p></p>
                                        </tr>
                                    <?php endforeach; ?>
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
<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">


    </div>
</div>
<!-- END RESPONSIVE TABLES -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewFacture" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></a>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;"
                                 class="ticketfacture2" id="ticketListe2">

                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Pharmacie ALSAS</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Dr GAMWO Sandrine</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>BP 38 FOUMBOT</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Tel :(+237) 233 267 487</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Ticket N°: <span class="reference"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Vendu le : <span class="datevente"></span> à <span class="heurevente"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Encaisser le: <span class="dateencaisser"></span> à <span class="heureencaisser"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Vendeur: <span class="vendeur"></span> et Caissier : <span class="caissier"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Acheteur: <span class="acheteur"></span></strong></strong>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-actions table-responsive"
                                           id="tab_GGBfactureImprimer">
                                        <thead>
                                        <tr>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="200"><strong>Libellé</strong>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="150"><strong></strong>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100"><strong>Qte</strong>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100"><strongg>Total</strongg>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="50"><strong>Rd(%)</strong>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_BfactureImprimer">
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Total</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span class="montanttotal"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: start;"
                                                scope="row"><strong>Remise</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: end;">
                                                <strong><span class="remise"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: start;"
                                                scope="row"><strong>Net à payer</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: end;">
                                                <strong><span class="netapayer"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr type="hidden" id="rowmontantespece">
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Espece</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span id="montantespece"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr type="hidden" id="rowmontantelectronique">
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Electronique</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span id="montantelectronique"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr type="hidden" id="rowmontantticket">
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Ticket</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span id="montantticket"></span> FCFA</strong>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="display: flex; flex-direction: column; text-align: left;">
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Montant total encaissé : <span class="montanttotalencaisser"></span></strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Total en caisse : <span class="montantpercu"></span></strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Montant rendu : <span class="montantrendu"></span></strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Ce ticket vaut facture</strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Merci et bonne santé</strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>NoCT /P058512700488Z</strong>
                                        </strong>
                                    </div>
                                    <p id="qrcodeTicket" alt="Image à droite" style="height: auto;">
                                </div>
                            </div>
                            <a class="btn btn-circle blue"
                               style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                               onClick="imprimer_bloc('ticketListe','ticketListe')"><i class="fa fa-print"
                                                                                       style="font-size:10px"></i>&nbsp;Imprimer</a>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewListVenteCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></a>
                <h4 class="modal-title">Liste de vente de la caisse</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default" style="display: flex;flex-direction: column;">

                            <div class="widget widget-warning widget-item-icon" style="min-height: 0px">
                                <div class="widget-item-right">
                                    <span style="font-size: 24px;font-weight: bold;">FCFA</span>
                                </div>
                                <div class="widget-data-left">
                                    <div class="widget-int num-count" id="totalEncaissement">0</div>
                                    <div class="widget-title">Total encaissé</div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tab_list_vente_caisse" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th width="100">Ref</th>
                                        <th width="100">Montant Total</th>
                                        <th width="200">Montant percu</th>
                                        <th width="200">Nom caissier</th>
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
            <div class="modal-footer">
                <a class="btn btn-primary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

<div class="modal fade" id="iconPreviewFacture2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></a>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;"
                                 class="ticketfacture2" id="ticketListe2">

                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Pharmacie ALSAS</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Dr GAMWO Sandrine</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>BP 38 FOUMBOT</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Tel :(+237) 233 267 487</strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Ticket N°: <span class="reference"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Vendu le : <span class="datevente"></span> à <span class="heurevente"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Encaisser le: <span class="vendeur"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Vendeur: <span class="vendeur"></span> et Caissier : <span class="caissier"></span></strong></strong>
                                    <strong style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        <strong>Acheteur: <span class="acheteur"></span></strong></strong>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-actions table-responsive"
                                           id="tab_GGBfactureImprimer">
                                        <thead>
                                        <tr>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="200"><strong>Libelle</strong>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="150"><strong></strong>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100"><strong>Qte</strong>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100"><strongg>Total</strongg>
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="50"><strong>Rd(%)</strong>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_BfactureImprimer">
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Total</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span class="montanttotal"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: start;"
                                                scope="row"><strong>Remise</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: end;">
                                                <strong><span class="remise"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: start;"
                                                scope="row"><strong>Net à payer</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: end;">
                                                <strong><span class="netapayer"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr type="hidden" id="rowmontantespece">
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Espece</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span id="montantespece"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr type="hidden" id="rowmontantelectronique">
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Electronique</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span id="montantelectronique"></span> FCFA</strong>
                                            </td>
                                        </tr>
                                        <tr type="hidden" id="rowmontantticket">
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row"><strong>Montant Ticket</strong>
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <strong><span id="montantticket"></span> FCFA</strong>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="display: flex; flex-direction: column; text-align: left;">
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Total en caisse : <span class="montantpercu"></span></strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Montant rendu : <span class="montantrendu"></span></strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Ce ticket vaut facture</strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>Merci et bonne santé</strong>
                                        </strong>
                                        <strong style="margin: 0px; color: black; font-weight: 400; font-family: 'Courier New', Courier, monospace; font-size: 12px;">
                                            <strong>NoCT /P058512700488Z</strong>
                                        </strong>
                                    </div>
                                    <p id="qrcodeTicket" alt="Image à droite" style="height: auto;">
                                </div>
                            </div>
                            <a class="btn btn-circle blue"
                               style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                               onClick="imprimer_bloc('ticketListe','ticketListe')"><i class="fa fa-print"
                                                                                       style="font-size:10px"></i>&nbsp;Imprimer</a>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
