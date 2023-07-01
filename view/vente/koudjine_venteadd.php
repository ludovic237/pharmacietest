<?php

$title_for_layout = ' ALSAS -' . 'Vente';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter en Vente' : 'Modifier un assureur';
// $action_for_layout = 'Ajouter';

//print_r($_SESSION['Users']);
//echo $_SESSION['Users']->identifiant;

$position_for_layout = '<li><a href="#">Vente</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Vente/functions.js"></script>
        <script>
                                        window.onload = function () {
                                            document.getElementById("recherche").focus();
                                        };
                                    </script>'; 
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                <label class="control-label" style="margin-right: 30px;width: 150px;">Ajouter un médicament:</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="recherche" value="" autocomplete="off" placeholder="Médicaments">
                </div>
                <div style="width: 150px;">
                </div>
            </div>
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                <div style="display: flex;flex:1;margin-right: 30px;">

                    <div class="panel-body panel-body-table" style="width: 100%;" >

                        <div class="table-responsive">
                            <table id="tab_Grecherche" style="display: block;max-height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th style="width: 100%;">Nom</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tab_Brecherche">

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

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th width="200">Nom</th>
                                    <th width="100">Prix Unitaire</th>
                                    <th width="100">Quantité</th>
                                    <th width="100">Prix Total</th>
                                    <th width="100">Reduction</th>
                                    <th width="200">Date de Livraison</th>
                                    <th width="100">Stock total</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tab_vente">

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <select class="form-control selectpicker select_client" style="width: 150px;">
                            <option class="option_nouveauClient" value="0">Nouveau Client</option>
                            <option value="2">Client Existant</option>
                        </select>
                    </div>

                    <form id="" role="form" class="form-horizontal">
                        <div class="panel-body nouveauClient">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Nom:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="nom" id="input_vente_nomClient" value="" placeholder="Nom" />
                                </div>
                                <label class="col-md-2 control-label">Téléphone:</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nom" id="input_vente_phoneClient" value="" placeholder="Téléphone" />
                                </div>
                            </div>
                        </div>
                        <div class="panel-body clientExistant">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Client:</label>
                                <div class="col-md-6">
                                    <select class="form-control selectpicker" id="select_vente_client">
                                        <option value="0">Sélectionner Client</option>
                                        <?php
                                        foreach ($client as $k => $v) : ?>
                                            <option <?php if ($position == 'Modifier') if ($v->id == $vente->user_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>" name="<?php echo $v->reduction; ?>" data="<?php echo $v->reductionMax; ?>"><?php echo $v->nom; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label">Réduction:</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="reduction" readonly id="reduction_vente_client" value="0" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body" style="padding: 0px;">
                <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                    <select class="form-control selectpicker select_prescripteur" style="width: 150px;">
                        <option value="1">Nouveau Prescripteur</option>
                        <option value="2">Prescripteur Existant</option>
                    </select>
                </div>

                <form id="" role="form" class="form-horizontal">
                    <div class="panel-body nouveauPrescripteur">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nom:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nom" id="input_vente_nomPrescripteur" value="" placeholder="Nom" />
                            </div>
                        </div>
                    </div>
                    <div class="panel-body prescripteurExistant">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Prescripteur:</label>
                            <div class="col-md-6">
                                <select class="form-control selectpicker" id="select_vente_prescripteur">
                                    <option value="0">Sélectionner Prescripteur</option>
                                    <?php
                                    foreach ($prescripteur as $k => $v) : ?>
                                        <option <?php if ($position == 'Modifier') if ($v->id == $vente->user_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="row" style="margin-bottom: 180px;">
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Réduction </h4>
                        <span>
                            <input type="checkbox" id="check_reductionGenerale">
                        </span>
                    </div>
                    <form id="" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Taux:</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" readonly name="<?php echo $_SESSION['Users']->faireReductionMax; ?>" id="taux" value="10" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body" style="padding: 0px;">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h4 style="background-color: #2d3945;color: white;">Commentaire </h4>
                        <!-- <span>
                            <input type="checkbox" id="check_compo-1">
                        </span> -->
                    </div>
                    <form id="" role="form" class="form-horizontal">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Commentaire:</label>
                                <div class="col-md-9">
                                    <textarea name="" id="commentaire_vente" cols="30" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
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
            <p style="font-weight: 200;">Net à payer : </p>
            <h6 style="font-weight: bold;font-size: large;"><span id="netTotal">0</span> FCFA</h6>
        </div>

        <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
            <a onclick="valider_vente('1', 'Comptant')" data="<?php echo $_SESSION['Users']->id; ?>" data1="<?php echo $_SESSION['Users']->identifiant; ?>" id="comptant" class="btn btn-success" role="button" style="float: left; font-weight: bold;background-color: #66e17f;border-color: #66e17f;width: 50%;display: flex;justify-content: center;align-items: center;font-size: 18px;">Comptant</a>
            <div style="display: flex;flex-direction: column;width: 40%;">
                <a onclick="valider_vente('2', 'Assurance')" data1="Assurance" id="assurance" class="btn btn-primary" role="button" style="float: left; width: 100%;padding: 4px;">Assurance</a>
                <a onclick="valider_vente('2', 'Crédit')" id="credit" disabled="disabled" class="btn btn-danger" role="button" style="float: left; width: 100%;padding: 4px;margin-top: 4px;">Crédit</a>
            </div>


        </div>

    </div>
    <!-- <div style="flex-direction: column;display: flex;padding: 10px 20px;justify-content: center;align-items: center;border-left-width: 1px;border-left-style: double;">
        <p style="font-weight: 200;">Total avec réduction : </p>
        <h4 style="font-weight: bold;font-size: x-large;"><span id="prixReduit">0</span> FCFA</h4>
        <a id="" onclick="valider_vente('')" class="btn btn-primary"  role="button" style="
    width: 100%;
">Paiement avec réduction </a>
    </div> -->
</div>
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewVente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">

                            <div class="panel-body panel-body-table">

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="tab_load_produit" style="height: 200px;overflow: auto;" class="table datatable table-bordered table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="200">Nom</th>
                                                    <th width="100">Prix Unitaire</th>
                                                    <th width="50">Quantité</th>
                                                    <th width="100">Quantité en Stock</th>
                                                    <th width="100">Stock générale</th>
                                                    <th width="100">Reduction (%)</th>
                                                    <th width="200">Date de Livraison</th>
                                                    <th width="100">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tab_Bload_produit">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="ajouter_produit();">Valider</button>
                <button type="button" class="btn btn-danger" onclick="focus_recherche()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewVenteAugmenterQuantite" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Augmenter quantite</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">

                            <div class="panel-body panel-body-table">

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Scan produit:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="" id="detail_info" data-detail_id="" placeholder="" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="ajouter_produit();">Valider</button>
                <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewFormVenteDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Nom</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="form-horizontal">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Quantité:</label>
                            <div class="col-md-9">
                                <input type="text" disabled="true" class="form-control" value="" id="nom_cmdprogramme" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                            <label class="control-label" style="margin-right: 30px;width: 150px;">Selectionner un fournisseur
                                :</label>
                            <div style="display: flex;flex:1;margin-right: 30px;">
                                <select class="selectpicker form-control input-xlarge" name="fabproduit" id="fournisseur_commande">
                                    <option value="0">Sélectionner Fournisseur</option>

                                </select>

                            </div>

                        </div>
                        <div class="table-responsive">
                            <table id="" style="height: 200px;overflow: auto;" class="table datatable table-bordered table-actions">
                                <thead>
                                    <tr>
                                        <th width="100">Nom</th>
                                        <th width="100">Quantité</th>
                                        <th width="100">Quantité en Stock</th>
                                        <th width="100">Date de Livraison</th>
                                    </tr>
                                </thead>
                                <tbody id="">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="id_xr" class="btn btn-success" data="" type="submit" onclick="enregistrer_commande_programme()">Valider</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewFacture" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;" class="ticketfacture" id="ticketVente">

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
                                    <table class="table table-inverse table-responsive">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;" width="200">Libelle</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;" width="100">Prix U.</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;" width="100">Qte</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;" width="100">Total</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;" width="50">Rd(%)</th>
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


<!-- START MODAL ICON PREVIEW -->
<div class="message-box message-box-danger animated fadeIn" id="alertCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Danger</div>
            <div class="mb-content">
                <h2>Pas de caisse ouverte !!!</h2>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->


<div class="message-box animated fadeIn" data-sound="alert" id="mb-confirmation-impression" data="">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Confirmation <strong>commande</strong> ?</div>
            <div class="mb-content">
                <p>Voulez vous imprimer une facture?</p>
                <p>Cliquez sur oui si vous le voulez ou sur non si c'est pas le cas.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a class="btn btn-success btn-lg">Oui</a>
                    <a class="btn btn-default btn-lg mb-control-close">Non</a>
                </div>
            </div>
        </div>
    </div>
</div>