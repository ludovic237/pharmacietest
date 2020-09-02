<!-- <?php

        $title_for_layout = ' Admin -' . 'Universités';
        $page_for_layout = 'Liste de commande';
        $action_for_layout = 'Ajouter';

        if ($this->request->action == "index") {
            $position = "Tout";
        } else {
            $position = $this->request->action;
        }
        $position_for_layout = '<li><a href="#">Commande</a></li><li class="active">Liste</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Commande/simplereappro.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';

        ?> -->


<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">

            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">

                <label class="control-label" style="margin-right: 30px;width: 150px;">Nombre de jours :</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="jour_vente" value="<?php if (isset($jour)) echo $jour; ?>">

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

                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="200">Date de creation</th>
                                <th width="200">Date de livraison</th>
                                <!-- <th width="200">Note</th> -->
                                <th width="200">Fournisseur</th>
                                <th width="100">Quantite recu</th>
                                <th width="100">Quantite commande</th>
                                <th width="200">Montant recu</th>
                                <th width="200">Montant commande</th>
                                <th width="100">Etat</th>
                                <th width="100">Reference</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commande as $k => $v) : ?>
                                <tr id="<?php echo $v->id; ?>">
                                    <td><strong><?php echo $v->dateCreation; ?></strong></td>
                                    <td><?php echo $v->dateLivraison; ?></td>
                                    <!-- <td><?php echo $v->note; ?></td> -->
                                    <td>
                                        <?php echo $v->fournisseur_id; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->qtiteCmd; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->qtiteRecu; ?>
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
                                        <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="showBonCommande()">
                                            Imprimer
                                        </button>
                                        <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="envoyer_en_caisse(<?php echo $v->id; ?>,<?php echo $action_fermeture->id; ?>)">
                                            Charger
                                        </button>
                                        <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="envoyer_en_caisse(<?php echo $v->id; ?>,<?php echo $action_fermeture->id; ?>)">
                                            Supprimer
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

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table">
                <div class="panel-body">
                    <table class="table  table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="200">Désignation</th>
                                <th width="200">Quantite commandé</th>
                                <th width="200">Quantite livré</th>
                                <th width="100">Prix Achat</th>
                                <th width="100">Prix Vente</th>
                                <th width="100">Date de péremption </th>
                            </tr>
                        </thead>
                        <tbody id="tab_vente_caisse">
                            <?php foreach ($commande as $k => $v) : ?>
                                <tr id="<?php echo $v->id; ?>">
                                    <td></td>
                                    <td>
                                        <div class='input-group' style='display:-webkit-inline-box;'>
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins' style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                            <input type='text' name='quant[1]' class='form-control input-number' style='width: 40px;'>
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus' style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class='input-group' style='display:-webkit-inline-box;'>
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number moins' style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-minus'></span>
                                                </button>
                                            </span>
                                            <input type='text' name='quant[1]' class='form-control input-number' style='width: 40px;'>
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus' style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                    <input type='text' name='quant[1]' class='form-control input-number' style='width: 80px;'>
                                    </td>

                                    <td>
                                    <input type='text' name='quant[1]' class='form-control input-number' style='width: 80px;'>
                                    </td>


                                    <td><input id="cellpadding" style="width: 120px" name="cellpadding" type="date" value="" size="3" maxlength="3" class="number" /></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table" style="padding-bottom: 40px;padding-left: 20px;padding-right: 20px;">
                <div>
                    <div style="display: flex;align-items: center;justify-content: space-between;padding-top: 20px;">
                    <h4 style="padding:10px; color: white;background-color: #2d3945;" id="fen_facture" data="">Montant : </h4>
                        <div>
                            <h4><span id="facture_caisse" data="">0</span>FCFA</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label">Commentaire:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label">Etat</label>
                    <div class="col-md-9">
                        <div style="display: flex;flex:1;margin-right: 30px;">
                            <select class="selectpicker form-control input-xlarge" name="fabproduit" id="fournisseur_commande">

                                <option value="1">Livrer</option>
                                <option value="1">Imcomplet</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn btn-primary" style="margin-right: 20px">Terminer</button>
                    <button class="btn btn-success">Imprimer</button>
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
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <!-- <div class="row">
                         <div class="col-md-4">
                              <div class="icon-preview">
                                   <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;" class="ticketfacture" id="ticket">

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

                    </div> -->
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
                                    bon de commande
                                </div>
                                <div style="display: flex;margin-top: 20px;margin-bottom: 20px;">
                                    n bon
                                </div>
                                <div style="display: flex;justify-content: space-between;">
                                    <div>
                                        selection fournisseur
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
                                            <th width="200">Date de delivrance</th>
                                            <th width="200">Designation</th>
                                            <th width="100">Quantite</th>
                                            <th width="100">Prix Achat</th>
                                            <th width="100">Prix Vente</th>
                                            <th width="100">P T Achat</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">total</td>
                                            <td>
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
                                <button type="button" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i
                                            class="fa fa-print" style="font-size:10px"></i>&nbsp;Annuler
                                </button>
                                <button type="button" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i
                                            class="fa fa-print" style="font-size:10px"></i>&nbsp;Créer commande
                                </button>
                                <button type="button" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                                        onclick="imprimer_bon('commande','commande')"><i class="fa fa-print"
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
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
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
                                    <table style="display: block;overflow: auto;"
                                           class="table table-bordered table-striped table-actions">
                                        <thead>
                                        <tr>
                                            <th width="50">N</th>
                                            <th width="200">Designation</th>
                                            <th width="100">Quantite commandé</th>
                                            <th width="100">Quantite livré</th>
                                            <th width="100">Prix Achat</th>
                                            <th width="100">Prix Vente</th>
                                            <th width="100">P T Achat</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">total</td>
                                            <td>
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
                                <button type="button" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i
                                            class="fa fa-print" style="font-size:10px"></i>&nbsp;Annuler
                                </button>
                                <button type="button" class="btn btn-circle blue"
                                        style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i
                                            class="fa fa-print" style="font-size:10px"></i>&nbsp;Receptionner
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