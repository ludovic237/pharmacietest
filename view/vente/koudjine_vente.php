<!-- <?php

        $title_for_layout = ' ALSAS -' . 'Vente';
        $page_for_layout = 'Vente';
        $action_for_layout = 'Ajouter';

        $position_for_layout = '<li><a href="#">Vente</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/icheck/icheck.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/scrolltotop/scrolltopcontrol.js"></script>


<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/owl/owl.carousel.min.js"></script> 

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/settings.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/actions.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_vente.js"></script>



<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
        ?> -->


<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal">

            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Caisse active</a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Total</a></li>
                    <li><a href="#tab-third" role="tab" data-toggle="tab">Par caisse</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <div class="panel panel-default">

                            <div class="panel-heading">
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
                                        <table id="customers2" class="table datatable">
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
                                                        <td class="client"><?php if (isset($user)) echo $user[$i]; ?></td>
                                                        <td class="seller"><?php echo $v->identifiant; ?></td>
                                                        <td class="datevte">
                                                            <?php echo $v->dateVente; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $v->etat; ?>
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
                    <div class="tab-pane" id="tab-second">
                        <div class="panel panel-default">

                            <div class="panel-heading">

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table datatable">
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
                                                        <td class="client"><?php if (isset($user)) echo $user[$i]; ?></td>
                                                        <td class="seller"><?php echo $v->identifiant; ?></td>
                                                        <td class="datevte">
                                                            <?php echo $v->dateVente; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $v->etat; ?>
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
                    <div class="tab-pane" id="tab-third">
                        <div class="row">
                            <div class="col-md-12">

                                <!-- START SALES BLOCK -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">

                                        <div class="form-group panel-title-box" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:10px">
                                            <label class="control-label" style="margin-right: 30px;width: 150px;">Selectionner un caisse
                                                :</label>
                                            <div style="display: flex;flex:1;margin-right: 30px;">
                                                <select class="selectpicker form-control input-xlarge" id="dataEmploye">
                                                    <option value="0">Tous</option>
                                                    <?php
                                                    foreach ($employes as $k => $v) : ?>
                                                        <option <?php if (isset($employes_id)) if ($v->id == $employes_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>" data="<?php echo $v->id; ?>"><?php echo $v->identifiant; ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="col-md-2 col-xs-12">
                                                <button class="btn btn-primary charger_info_employe">Charger</button>
                                            </div>

                                        </div>
                                        <ul class="panel-controls panel-controls-title">
                                            <li>
                                                <div id="reportrange" class="dtrange">
                                                    <span></span><b class="caret"></b>
                                                </div>
                                            </li>
                                            <!-- <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li> -->
                                        </ul>

                                    </div>
                                </div>
                                <!-- END SALES BLOCK -->

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <h3 class="panel-title">Responsive tables</h3>
                                    </div>

                                    <div class="panel-body panel-body-table">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-actions">
                                                <thead>
                                                    <tr>
                                                        <th width="50">id</th>
                                                        <th>Employé</th>
                                                        <th width="100">Session</th>
                                                        <th width="100">Etat</th>
                                                        <th width="100">fond Caisse Ferme</th>
                                                        <th width="100">fond Caisse Ouvert</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tab_employe_id">
                                                    <?php $j = 0;
                                                    if (isset($caisseAll))
                                                        foreach ($caisseAll as $k => $v) : ?>
                                                        <tr id="<?php echo $v->id; ?>">
                                                            <td>
                                                                <?php echo $v->id; ?>
                                                            </td>


                                                            <td><strong class="prixt"><?php if (isset($employe)) echo $employe[$j]; ?></strong></td>

                                                            <td class="prixp"><?php echo $v->session; ?></td>
                                                            <td class="seller"><span class="label label-success"><?php echo $v->etat; ?></span></td>
                                                            <!-- <td class="client"><?php if (isset($user)) echo $user[$i]; ?></td> -->
                                                            <td class="seller"><?php echo $v->fondCaisseFerme; ?></td>
                                                            <td class="datevte">
                                                                <?php echo $v->fondCaisseOuvert; ?>
                                                            </td>

                                                            <p></p>
                                                        </tr>

                                                    <?php $j++;
                                                        endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary pull-right">Save Changes <span class="fa fa-floppy-o fa-right"></span></button>
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;" class="ticketfacture" id="ticketListe">

                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Pharmacie ALSAS</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Dr GAMWO Sandrine</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">BP 38 FOUMBOT</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Tel :(+237) 233 267 487</p>
                                    <div style="display: flex;justify-content:space-between">
                                        <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Ticket N°: <span class="reference"></span></p>
                                        <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;"><span class="datevente"></span> à <span class="heurevente"></span> </p>
                                    </div>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Vendeur: <span class="vendeur"></span> </p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Acheteur: <span class="acheteur"></span> </p>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-actions table-responsive" id="tab_GGBfactureImprimer">
                                        <thead>
                                            <tr>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;" width="200">Libelle</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;" width="150">Prix U.</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;" width="100">Qte</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;" width="100">Total</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;" width="50">Rd(%)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tab_BfactureImprimer">

                                            <tr>
                                                <td colspan="1" style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;" scope="row">Montant Total</td>
                                                <td colspan="4" style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 12px;"><span class="montanttotal"></span> FCFA</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1" style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: start;" scope="row">Remise</td>
                                                <td colspan="4" style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: end;"><span class="remise"></span> FCFA</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1" style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: start;" scope="row">Net à payer</td>
                                                <td colspan="4" style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: end;"><span class="netapayer"></span> FCFA</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Payer en espece : <span class="montantpercu"></span> </p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Montant rendu : <span class="montantrendu"></span> </p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Ce ticket vaut facture</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">Merci et bonne santé</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">NoCT /P058512700488Z</p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;" onClick="imprimer_bloc('ticketListe','ticketListe')"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Imprimer</button>
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