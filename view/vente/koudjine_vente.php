<!-- <?php

        $title_for_layout = ' ALSAS -' . 'Vente';
        $page_for_layout = 'Vente';
        $action_for_layout = 'Ajouter';

        $position_for_layout = '<li><a href="#">Vente</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
        ?> -->


<!-- START WIDGETS -->
<div class="row">
    
    <div class="col-md-3">

        <!-- START WIDGET MESSAGES -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
            <div class="widget-item-left">
                <span class="fa fa-money"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count"><?php echo $totalVente; ?></div>
                <div class="widget-title">Vente total</div>
                <!-- <div class="widget-subtitle">In your mailbox</div> -->
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET MESSAGES -->

    </div>
    <div class="col-md-3">

        <!-- START WIDGET MESSAGES -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
            <div class="widget-item-left">
                <span class="fa fa-money"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count"><?php echo $totalVente; ?></div>
                <div class="widget-title">Vente d'aujourdhui</div>
                <!-- <div class="widget-subtitle">In your mailbox</div> -->
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET MESSAGES -->

    </div>
    <div class="col-md-3">

        <!-- START WIDGET MESSAGES -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
            <div class="widget-item-left">
                <span class="fa fa-money"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count"><?php echo $totalVente; ?></div>
                <div class="widget-title">Vente sur une semaine</div>
                <!-- <div class="widget-subtitle">In your mailbox</div> -->
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET MESSAGES -->

    </div>
    <div class="col-md-3">

        <!-- START WIDGET MESSAGES -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
            <div class="widget-item-left">
                <span class="fa fa-money"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count"><?php echo $totalVente; ?></div>
                <div class="widget-title">Vente total</div>
                <!-- <div class="widget-subtitle">In your mailbox</div> -->
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET MESSAGES -->

    </div>
    
</div>
<!-- END WIDGETS -->

<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">
                <div class="btn-group pull-right">
                    <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                    <ul class="dropdown-menu">
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'json',escape:'false'});"><img src="img/icons/json.png" width="24"> JSON</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src="img/icons/json.png" width="24"> JSON (ignoreColumn)</a></li>
                        <li><a href="#" onclick="$('#customers2'). tableExport({type:'json',escape:'true'});"><img src="img/icons/json.png" width="24"> JSON (with Escape)</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'xml',escape:'false'});"><img src="img/icons/xml.png" width="24"> XML</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'sql'});"><img src="img/icons/sql.png" width="24"> SQL</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'csv',escape:'false'});"><img src="img/icons/csv.png" width="24"> CSV</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src="img/icons/txt.png" width="24"> TXT</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src="img/icons/xls.png" width="24"> XLS</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src="img/icons/word.png" width="24"> Word</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'powerpoint',escape:'false'});"><img src="img/icons/ppt.png" width="24"> PowerPoint</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'png',escape:'false'});"><img src="img/icons/png.png" width="24"> PNG</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src="img/icons/pdf.png" width="24"> PDF</a></li>
                    </ul>
                </div>
                <div>
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="customers2" class="table datatable table-bordered table-striped table-actions export tableExport">
                            <thead>
                                <tr>
                                    <th width="100">Montant</th>
                                    <th width="200">Montant percu</th>
                                    <th width="200">Client</th>
                                    <th width="200">Vendeur</th>
                                    <th width="200">Date de vente</th>
                                    <th width="100">Etat</th>
                                    <th width="100">Ref</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                if (isset($ventes)) foreach ($ventes as $k => $v) : ?>
                                    <tr id="<?php echo $v->id; ?>">
                                        <td><strong class="prixt"><?php echo $v->prixTotal; ?></strong></td>
                                        <td class="prixp"><?php echo $v->prixPercu; ?></td>
                                        <td class="client"><?php if (isset($user)) echo $user[$i]; ?></td>
                                        <td class="seller"><?php echo $v->identifiant; ?></td>
                                        <td class="datevte">
                                            <?php echo $v->dateVente; ?>
                                        </td>
                                        <td>
                                            <?php echo $v->etat; ?>
                                        </td>
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
                                        <td>
                                            <button class="btn btn-success btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="reimprime_ticket(<?php echo $v->id; ?>)">Imprimer ticket</button>
                                            <!-- <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->CONCOURS_ID; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button> -->
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
</div>
<!-- END RESPONSIVE TABLES -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewFacture" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;" class="ticketfacture" id="ticketListe">

                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;">Pharmacie ALSAS</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">Dr GAMWO Sandrine</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">BP 38 FOUMBOT</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">Tel :(+237) 233 267 487</p>
                                    <div style="display: flex;justify-content:space-between">
                                        <p style="margin: 0px; color: black;font-weight: 400;">Ticket N°: <span class="reference"></span></p>
                                        <p style="margin: 0px; color: black;font-weight: 400;"><span class="datevente"></span> à <span class="heurevente"></span> </p>
                                    </div>
                                    <p style="margin: 0px; color: black;font-weight: 400;">Vendeur: <span class="vendeur"></span> </p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">Acheteur: <span class="acheteur"></span> </p>
                                </div>
                                <div>
                                    <table class="table table-inverse table-responsive" id="tab_GGBfactureImprimer">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th style="background-color: white;color: black;font-weight: 400;">LIBELLE PRODUIT</th>
                                                <th style="background-color: white;color: black;font-weight: 400;">Prix U.</th>
                                                <th style="background-color: white;color: black;font-weight: 400;">Qte</th>
                                                <th style="background-color: white;color: black;font-weight: 400;">TOTAL</th>
                                                <th style="background-color: white;color: black;font-weight: 400;">Rd</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tab_BfactureImprimer">

                                            <tr>
                                                <td colspan="3" style=" background-color: white;color: black;font-weight: 400;text-align: end;" scope="row">Montant Total</td>
                                                <td colspan="2" style=" background-color: white;color: black;font-weight: 400;text-align: end;"><span class="montanttotal"></span> FCFA</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style=" background-color: white;color: black;font-weight: 400;text-align: end;" scope="row">Remise</td>
                                                <td colspan="2" style=" background-color: white;color: black;font-weight: 400;text-align: end;"><span class="remise"></span> FCFA</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style=" background-color: white;color: black;font-weight: 400;text-align: end;" scope="row">Net à payer</td>
                                                <td colspan="2" style=" background-color: white;color: black;font-weight: 400;text-align: end;"><span class="netapayer"></span> FCFA</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;">Payer en espece : <span class="montantpercu"></span> </p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">Montant rendu : <span class="montantrendu"></span> </p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">Ce ticket vaut facture</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">Merci et bonne santé</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;">NoCT /rtdrstrdsy</p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;" onClick="imprimer_bloc('ticket','ticket')"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Imprimer</button>
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
<!-- END MODAL ICON PREVIEW -->