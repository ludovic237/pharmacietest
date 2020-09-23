<?php

$title_for_layout = ' Admin -' . 'Commande';
// $action_for_layout = 'Ajouter';

//$position = $this->request->action;

$position_for_layout = '<li><a href="#">Commande</a></li><li class="active">Simple réapprovisionnement</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Commande/simplereappro.js"></script>';
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                <label class="control-label" style="margin-right: 30px;width: 150px;">Selectionner un fournisseur
                    :</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <select class="selectpicker form-control input-xlarge" name="fabproduit" id="fournisseur_commande">
                        <option value="0">Sélectionner Fournisseur</option>
                        <?php
                        foreach ($fournisseur as $k => $v) : ?>
                            <option <?php if (isset($fournisseur_id)) if ($v->id == $fournisseur_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>

                </div>
                <label class="control-label" style="margin-right: 30px;width: 150px;">Nombre de jours de vente:</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="jour_vente" value="<?php if (isset($jour)) echo $jour; ?>">

                </div>
                <div>
                    <button class="btn btn-primary pull-right" onclick="charger_commande()">Charger</button>
                </div>
            </div>
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                <label class="control-label" style="margin-right: 30px;width: 150px;">Ajouter un médicament:</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="recherche_commande" value="" placeholder="Médicaments">
                </div>
                <div style="width: 150px;">
                </div>
            </div>
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <div>

                        <div class="panel-body panel-body-table">

                            <div class="">
                                <table id="tab_GCrecherche" style="display: block;height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                    <thead>
                                        <tr>
                                            <th width="200">Nom</th>
                                            <th width="200">Date de Livraison</th>
                                            <th width="100">Stock total</th>
                                            <th width="100">Prix Achat</th>
                                            <th width="100">Quantité</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tab_BCrecherche">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div style="width: 150px;">

                </div>
            </div>
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px;padding-top: 20px;border-top-style: solid;margin-top: 20px;border-top-width: inherit;">
                <div>
                    <button class="btn btn-primary pull-right" onclick="showProvider()" <?php if (!isset($fournisseur_id)) echo "disabled"; ?>>Autre
                        fournisseur
                    </button>
                </div>
                <!-- <div>
                    <button class="btn btn-primary pull-right" onclick="showBonCommande()" controller="vente" data="">
                        bon
                    </button>
                </div>
                <div>
                    <button class="btn btn-primary pull-right" onclick="showRecu()" controller="vente" data="">recu
                    </button>
                </div> -->

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">

                <div class="table-responsive">
                    <table style="overflow: auto;" class="table table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="200">Nom</th>
                                <th width="100">Fournisseur</th>
                                <th width="100">Date de Livraison</th>
                                <th width="100">Stock total</th>
                                <th width="200">Prix Achat</th>
                                <th width="100">Quantité</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ventes as $k => $v) : ?>
                                <tr id="<?php echo $v->idp; ?>">
                                    <td><strong><?php echo $v->nom; ?></strong></td>
                                    <td><?php echo $v->nomf; ?></td>
                                    <td><?php echo $v->dateLivraison; ?></td>
                                    <td><?php echo $v->stock; ?></td>
                                    <td class=''>
                                        <p>
                                        </p>
                                        <div class='input-group' style="width: 95px;">

                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins' onclick="change_input('moins','inputPrix<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                            <input type='text' name='quant[1]' class='form-control input-number' id="inputPrix<?php echo $v->idp; ?>" value='<?php echo $v->prixAchat; ?>' style='width: 90px;'>
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus' onclick="change_input('plus','inputPrix<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                        </div>
                                        <p></p>

                                    </td>
                                    <td class=''>
                                        <p>
                                        </p>
                                        <div class='input-group' style="width: 95px;">

                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins' onclick="change_input('moins','inputQte<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                            <input type='text' name='quant[1]' class='form-control input-number' id="inputQte<?php echo $v->idp; ?>" value='1' style='width: 40px;'>
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus' onclick="change_input('plus','inputQte<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                        </div>
                                        <p></p>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" id="btn-ajouter<?php echo $v->idp; ?>" onclick="ajouter_commande(<?php echo $v->idp; ?>)">Ajouter à la commande
                                        </button>
                                        <button class="btn btn-info btn-rounded btn-sm btn-modifier" id="btn-modifier<?php echo $v->idp; ?>" data-placement="top" onclick="modifier_commande(<?php echo $v->idp; ?>)">Modifier
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

<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                        <h6 style="color: #fff;">Tableau de commande</h6>
                    </div>
                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="200">Désignation</th>
                                <th width="100">Prix Unitaire</th>
                                <th width="100">Quantité</th>
                                <th width="100">Prix Total</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tab_commande">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>
<div style="display: flex;justify-content: space-between;background-color: white;position: fixed;bottom: 10px;right: 10px;align-items: baseline;background-color: #fff;
border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 1px 1px 1px rgba(10,0,0,.05);">
    <div style="flex-direction: column;display: flex;padding: 20px;justify-content: center;align-items: center;width: 250px;">
        <!-- <div style="display: flex;flex-direction: column;width: 100%;">
            <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                <p>Total</p>
                <p><span id="prixTotal">0</span> FCFA</p>
            </div>
            <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
                <p>Réduction</p>
                <p><span id="prixReduit">0</span> FCFA</p>
            </div>
        </div> -->
        <div style="display: flex;padding-top: 12px;flex-direction: row;width: 100%;justify-content: space-between;">
            <p style="font-weight: 200;">Total : </p>
            <h6 style="font-weight: bold;font-size: large;"><span id="prixTotal" data="">0</span> FCFA</h6>
        </div>

        <div style="display: flex;flex-direction: row;justify-content: space-between;width: 100%;">
            <a onclick="valider_commande(false)" data="<?php echo $_SESSION['Users']->id; ?>" id="comptant" class="btn btn-success" role="button" style="float: left; width: 40%;">Valider</a>
            <!-- <a onclick="valider_vente('2', 'Crédit')" id="credit" disabled="disabled" class="btn btn-danger" role="button" style="float: left; width: 40%;">Imprimer</a> -->
            <a onclick="valider_commande(true)" class="btn btn-primary" role="button" style="float: left; width: 40%;">Imprimer</a>
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
<div class="modal fade" id="iconPreviewAutreFournisseur" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="">
                            <table id="tab_load_produit" style="display: block;height: 200px;overflow: auto;" class="table datatable table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width="200">Nom</th>
                                        <th width="100">Fournisseur</th>
                                        <th>Date de Livraison</th>
                                        <th>Stock total</th>
                                        <th width="100">Prix Achat</th>
                                        <th width="100">Quantité</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tab_FCommande">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="ajouter_produit();">Valider</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewProvider" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <table style="display: block;overflow: auto;" class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width="200">Nom</th>
                                        <th width="100">Fournisseur</th>
                                        <th>Date de Livraison</th>
                                        <th>Stock total</th>
                                        <th width="100">Prix Achat</th>
                                        <th width="100">Quantité</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tab_FCommande">
                                    <?php if (isset($fournisseurs)) foreach ($fournisseurs as $k => $v) : ?>
                                        <tr id="<?php echo $v->idp; ?>">
                                            <td><strong><?php echo $v->nom; ?></strong></td>
                                            <td><?php echo $v->nomf; ?></td>
                                            <td><?php echo $v->dateLivraison; ?></td>
                                            <td><?php echo $v->stock; ?></td>
                                            <td>
                                                <p>
                                                </p>
                                                <div class='input-group' style="width: 100px;">
                                                    <span class='input-group-btn'>
                                                        <button type='button' class='btn btn-default btn-number moins' onclick="change_input('moins','inputPrix<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                            <span class='glyphicon glyphicon-minus'></span>
                                                        </button>
                                                    </span>
                                                    <input type='text' name='quant[1]' class='form-control input-number' id="inputPrix<?php echo $v->idp; ?>" value='<?php echo trim($v->prixAchat); ?>' style='width: 80px;'>
                                                    <span class='input-group-btn'>
                                                        <button type='button' class='btn btn-default btn-number plus' onclick="change_input('plus','inputPrix<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                            <span class='glyphicon glyphicon-plus'></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <p>
                                                </p>
                                                <div class='input-group' style='width:100px;'>
                                                    <span class='input-group-btn'>
                                                        <button type='button' class='btn btn-default btn-number moins' onclick="change_input('moins','input<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                            <span class='glyphicon glyphicon-minus'></span>
                                                        </button>
                                                    </span>
                                                    <input type='text' name='quant[1]' class='form-control input-number' id="input<?php echo $v->idp; ?>" value='1' style='width: 40px;'>
                                                    <span class='input-group-btn'>
                                                        <button type='button' class='btn btn-default btn-number plus' onclick="change_input('plus','input<?php echo $v->idp; ?>')" style='padding: 4px;'>
                                                            <span class='glyphicon glyphicon-plus'></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" id="btn-ajouter<?php echo $v->idp; ?>" onclick="ajouter_commande(<?php echo $v->idp; ?>)">Ajouter à la
                                                    commande
                                                </button>
                                                <button class="btn btn-info btn-rounded btn-sm btn-modifier" id="btn-modifier<?php echo $v->idp; ?>" data-placement="top" onclick="modifier_commande(<?php echo $v->idp; ?>)">Modifier
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
            <div class="modal-footer">

                <a class="mb-control" data-box="#mb-confirmation"><span class="fa fa-sign-out" data-toggle="tooltip" data-placement="bottom" title="Déconnexion"></span></a>

                <button type="button" class="btn btn-success" onclick="ajouter_produit();">Valider</button>
                <button type="button" class="btn btn-danger" href="koudjine_simplereappro.php">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewBonCommande" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Commande</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="icon-preview">
                            <div style="display:block;font-size: 10px;flex-direction: column;background-color: white;" class="ticketfacture" id="commande">

                                <div style="flex-direction: row;display: flex;justify-content: space-between;">
                                    <div>
                                        logo
                                    </div>
                                    <div>
                                        <span id="date"></span>
                                    </div>
                                </div>
                                <div style="display: flex;margin-top: 40px;">
                                    <h1>Bon de commande</h1>
                                </div>
                                <div style="display: flex;margin-top:20px;">
                                    <strong>N° bon de commande :</strong>
                                    <span class="ref_commande"></span>
                                </div>
                                <div style="display: flex;justify-content: space-between;margin-top: 10px;">
                                    <div>
                                        <strong>Fournisseur :</strong>
                                        <span class="nomf_commande"></span>
                                    </div>
                                    <div>
                                        recherche produit
                                    </div>
                                </div>
                                <div>
                                    <table style="display: block;overflow: auto;margin-bottom: 20px;margin-top: 40px;border-collapse: collapse;border-spacing: 0px;border: 0;" class="table table-bordered table-striped table-actions">
                                        <thead>
                                            <tr>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="50"><strong>N°</strong></th>
                                                <!--                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="200">Date de delivrance</th>-->
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="200"><strong>Designation</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>Quantite</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>Prix Achat</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>P T Achat</strong></th>
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
                                <button type="button" class="btn btn-circle blue" data-dismiss="modal" style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Annuler
                                </button>
                                <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;" onclick="imprimer_recu('commande','commande')"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Imprimer
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
<!-- END MODAL ICON PREVIEW -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewRecu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="icon-preview">
                            <div style="display:block;font-size: 10px;flex-direction: column;background-color: white;" class="ticketfacture" id="recu">

                                <div style="flex-direction: row;display: flex;justify-content: space-between;">
                                    <div>
                                        logo
                                    </div>
                                    <div>
                                        date
                                    </div>
                                </div>
                                <div style="display: flex;margin-top: 40px;">
                                    Bordereau de réception
                                </div>
                                <div style="display: flex;margin-top: 20px;margin-bottom: 20px;">
                                    n bon
                                </div>
                                <div style="display: flex;justify-content: space-between;">
                                    <div>
                                        N° de bordereau de réception
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div style="display: flex;justify-content: space-between;">
                                    <div>
                                        N° bon de commande
                                    </div>
                                    <div>
                                        Date de commande
                                    </div>
                                </div>
                                <div style="display: flex;justify-content: space-between;">
                                    <div>
                                        Nom fournisseur
                                    </div>
                                    <div>
                                        N° de bordereau de livraison
                                    </div>
                                </div>
                                <div>
                                    <table style="display: block;overflow: auto;margin-bottom: 20px;margin-top: 20px;border-collapse: collapse;border-spacing: 0px;border: 0;" class="table table-bordered table-striped table-actions">
                                        <thead>
                                            <tr>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="50">N</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="200">Designation</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Quantite commandé</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Quantite livré</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Prix Achat</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Prix Vente</th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">P T Achat</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"></td>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"></td>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"></td>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"></td>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;"></td>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">

                                                </td>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" colspan="6">total</td>
                                                <td style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;">
                                                    20000
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div style="display: flex;">
                                    <h5>Nombre d'article commandé</h5>
                                </div>
                                <div style="display: flex;">
                                    <h5>Nombre de produit commandé</h5>
                                </div>


                            </div>
                            <div style="display: flex;justify-content: space-around;">
                                <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Annuler
                                </button>
                                <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Receptionner
                                </button>
                                <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;" onclick="imprimer_recu('recu','recu')"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Imprimer
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
<!-- END MODAL ICON PREVIEW -->

<div class="message-box animated fadeIn" data-sound="alert" id="mb-confirmation" data="">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Confirmation <strong>commande</strong> ?</div>
            <div class="mb-content">
                <p>Voulez vous réceptionner votre commande?</p>
                <p>Cliquez sur oui si vous le voulez ou sur non pour pas maintenant.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a class="btn btn-success btn-lg" onclick="valider_reception_commande(true)">Oui</a>
                    <a class="btn btn-default btn-lg mb-control-close" onclick="valider_reception_commande(false)">Non</a>
                </div>
            </div>
        </div>
    </div>
</div>