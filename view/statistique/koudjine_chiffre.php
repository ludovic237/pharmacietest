<?php

$title_for_layout = ' ALSAS -' . 'Statistique';
$page_for_layout = 'Chiffre';
$action_for_layout = 'Ajouter';

if ($this->request->action == "index") {
    //$position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Statistique</a></li><li class="active">Chiffre</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/fileinput/fileinput.min.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Statistique/functions.js"></script>';
?>

<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal">

            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#tab-first" role="tab" data-toggle="tab">Fournisseurs</a>
                    </li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Caisse</a></li>
                    <!--<li><a href="#tab-third" role="tab" data-toggle="tab">Depense</a></li>
                    <li><a href="#tab-fourth" role="tab" data-toggle="tab">Bon de Caisse</a></li>-->
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <!-- START SALES BLOCK -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading"
                                             style="display: flex;align-items: center;justify-content: space-between;">
                                            <div style="margin-bottom: 15px;" class="form-group">
                                                <label class="col-md-3 control-label">Type :</label>
                                                <div class="col-md-6">
                                                    <select class="selectpicker form-control" name="fournisseurType"
                                                            id="fournisseurType">
                                                        <option value="Tous">Tous</option>
                                                        <option value="Grossiste">Grossiste</option>
                                                        <option value="Detaillant">Detaillant</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">

                                                    <a class="btn btn-success" onclick="getGroupStatistique()">Recherche <span class="fa fa-search"></span></a>

                                                </div>
                                            </div>
                                            <ul class="panel-controls panel-controls-title">
                                                <li>
                                                    <div id="reportRangeDate" class="dtrange">
                                                        <span></span><b class="caret"></b>
                                                    </div>
                                                </li>
                                                <li><a href="#" class="panel-fullscreen rounded"><span
                                                                class="fa fa-expand"></span></a></li>

                                            </ul>

                                        </div>
                                        <div class="panel-body">
                                            <div style="display: flex; flex-direction: row">
                                                <h3>Total : </h3>
                                                <h3><span style="color: black;font-size: larger;margin-bottom: 0px;"
                                                          id="grossisteTotal"> 0</span> FCFA</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table id="tableGrossiste" class="table datatable">
                                                    <thead>
                                                    <tr>
                                                        <th width="100">code</th>
                                                        <th width="100">Statut</th>
                                                        <th width="200">Nom</th>
                                                        <th width="200">Montant</th>
                                                        <th width="200">Etat</th>
                                                        <th width="200">Email</th>
                                                        <th width="100">Telephone</th>
                                                        <th width="100">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SALES BLOCK -->
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="tab-pane" id="tab-second">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <!-- START SALES BLOCK -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading"
                                             style="display: flex;align-items: center;justify-content: space-between;">
                                            <div style="margin-bottom: 15px;" class="form-group">
                                                <label class="col-md-3 control-label">Type :</label>
                                                <div class="col-md-6">
                                                    <select class="selectpicker form-control input-xlarge" id="dataEmploye">
                                                        <option value="0">Tous</option>
                                                        <?php
                                                        foreach ($_employes as $k => $v) : ?>
                                                            <option <?php if (isset($employes_id)) if ($v->id == $employes_id) echo "selected=\"selected\""; ?>
                                                                    value="<?php echo $v->id; ?>"
                                                                    data="<?php echo $v->id; ?>"><?php echo $v->identifiant; ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">

                                                    <a class="btn btn-success" onclick="getGroupStatistiqueCaisse()">Recherche <span class="fa fa-search"></span></a>

                                                </div>
                                            </div>
                                            <ul class="panel-controls panel-controls-title">
                                                <li>
                                                    <div id="reportRangeDateCaisse" class="dtrange">
                                                        <span></span><b class="caret"></b>
                                                    </div>
                                                </li>
                                                <li><a href="#" class="panel-fullscreen rounded"><span
                                                                class="fa fa-expand"></span></a></li>

                                            </ul>

                                        </div>
                                        <div class="panel-body">
                                            <div style="display: flex; flex-direction: row">
                                                <h3>Total : </h3>
                                                <h3><span style="color: black;font-size: larger;margin-bottom: 0px;"
                                                          id="caisseTotal"> 0</span> FCFA</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table id="tableCaisse" class="table datatable table-bordered table-striped table-actions">
                                                    <thead>
                                                    <tr>
                                                        <th width="50">id</th>
                                                        <th>Employé</th>
                                                        <th width="100">Session</th>
                                                        <th width="100">Etat</th>
                                                        <th width="100">fond Caisse Ouvert</th>
                                                        <th width="100">fond Caisse Ferme</th>
                                                        <th width="100">Montant encaissé</th>
                                                        <th width="100">Date Ouverture</th>
                                                        <th width="100">Date fermeture</th>
                                                        <th width="100">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tab_employe_id">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SALES BLOCK -->
                                </div>
                            </div>


                        </div>
                    </div>
                    <!--<div class="tab-pane" id="tab-third">
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

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>-->

                </div>

            </div>

        </form>

    </div>
</div>

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
                                <table style="width: 100%;height: 75%;overflow-y: -moz-scrollbars-vertical" id="tab_list_vente_caisse" class="table datatable">
                                    <thead>
                                    <tr>
                                        <th >Ref</th>
                                        <th >Montant Total</th>
                                        <th >Montant percu</th>
                                        <th >Nom caissier</th>
                                        <th >Date de vente</th>
                                        <th >Etat</th>
                                        <th >Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody >

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
                                            <span class="datevente"></span> à <span class="heurevente"></span></p>
                                    </div>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Vendeur: <span class="vendeur"></span></p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Acheteur: <span class="acheteur"></span></p>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-actions table-responsive"
                                           id="tab_GGBfactureImprimer">
                                        <thead>
                                        <tr>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;"
                                                width="200">Libelle
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;"
                                                width="150">Prix U.
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;"
                                                width="100">Qte
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;"
                                                width="100">Total
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;"
                                                width="50">Rd(%)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_BfactureImprimer2">

                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 12px;"
                                                scope="row">Montant Total
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                                <span class="montanttotal"></span> FCFA
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: start;"
                                                scope="row">Remise
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: end;">
                                                <span class="remise"></span> FCFA
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: start;"
                                                scope="row">Net à payer
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;text-align: end;">
                                                <span class="netapayer"></span> FCFA
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Payer en espece : <span class="montantpercu"></span></p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Montant rendu : <span class="montantrendu"></span></p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Ce ticket vaut facture</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Merci et bonne santé</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        NoCT /P058512700488Z</p>
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

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewRapport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></a>
                <h4 class="modal-title">Liste de vente de la caisse</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Entrée</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <!-- <tr>
                    <th>Entree</th>
               </tr> -->
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Espece</td>
                                            <td>
                                                <span id="espece_caisse_rapport">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>OM</td>
                                            <td>
                                                <span id="electronique_rapport">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>
                                                <span id="total_entree_rapport_caisse">0</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Depense</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                                <!--<ul class="panel-controls" style="margin-top: 2px;">
                                     <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <li><a href="#" onclick="ajouter_une_depense()" class=""><span class="fa fa-plus"></span></a></li>
                                </ul>-->
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="50">N°</th>
                                            <th>Motifs</th>
                                            <th>Quantite</th>
                                            <th>Prix unitaire</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_RapportDepense">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Bon de caisse</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nom client </th>
                                            <th>Montant</th>
                                            <th>Type</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_RapportBon">


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

                            <div class="panel-heading" style="background: #333;">
                                <div class="panel-title-box" style="color: aquamarine;">
                                    <h3 style="color: white;">Recapitulatif</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th> </th>
                                            <th>Total entrée </th>
                                            <th>Total sortie</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Caisse</td>
                                            <td id="total_entree_caisse">0</td>
                                            <td id="total_sortie_caisse">
                                                0
                                            </td>
                                            <td id="total_tout_caisse">
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Systeme</td>
                                            <td id="total_entree_syst">0</td>
                                            <td id="total_sortie_syst">
                                                0
                                            </td>
                                            <td id="total_tout_syst">
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Difference</td>
                                            <td id="diff_entree">0</td>
                                            <td id="diff_sortie">
                                                0
                                            </td>
                                            <td id="diff_total">
                                                0
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
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
