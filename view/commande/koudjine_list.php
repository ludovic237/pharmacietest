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
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Commande/list.js"></script>';

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
                                <th width="100">Quantite commande</th>
                                <th width="100">Quantite recu</th>
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
                                    <td><strong><?php
                                                $date = DateTime::createFromFormat('Y-m-d H:i:s', $v->dateCreation);
                                                $datel = $date->format('d-m-Y');
                                                echo $v->dateCreation; ?></strong></td>
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
                                        <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="imprimer_com(<?php echo $v->id; ?>,'<?php echo $v->ref; ?>','<?php echo $v->nom; ?>')">
                                            Imprimer
                                        </button>
                                        <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="charger_produit_commande(<?php echo $v->id; ?>,'<?php echo $v->etat; ?>','<?php echo $v->montantRecu; ?>','<?php echo $v->ref; ?>','<?php echo $v->nom; ?>','<?php echo $datel; ?>')">
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
                                <th>Désignation</th>
                                <th>Quantite commandé</th>
                                <th>Quantite livré</th>
                                <th>Prix Achat</th>
                                <th>Prix Vente</th>
                                <th>Date de péremption </th>
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
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table" style="padding-bottom: 40px;padding-left: 20px;padding-right: 20px;">
                <div>
                    <div style="display: flex;align-items: center;justify-content: space-between;padding-top: 20px;">
                        <h4 style="padding:10px; color: white;background-color: #2d3945;" id="fen_facture" data="" data1="" data2="" data3="">Montant : </h4>
                        <div>
                            <h4><span id="facture_commande" data="">0</span> FCFA</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label">Commentaire:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="" id="commentaire_commande" cols="30" rows="10"></textarea>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label">Etat</label>
                    <div class="col-md-9">
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
                    <button class="btn btn-primary" disabled id="btn_recept_commande" style="margin-right: 10px" onclick="receptionner_commande(0)">Réceptionner</button>
                    <button class="btn btn-success" disabled id="btn_print_commande" onclick="number_commande()">Imprimer</button>
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
                                    <table style="display: block;overflow: auto;" class="table table-bordered table-striped table-actions">
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
                                    <table style="display: block;overflow: auto;margin-bottom: 20px;margin-top: 40px;border-collapse: collapse;border-spacing: 0px;border: 0;" class="table table-bordered table-striped table-actions">
                                        <thead>
                                            <tr>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="50"><strong>N°</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="200"><strong>Designation</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>Qte commandé</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>Qte livré</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>Prix Achat</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>Prix Vente</strong></th>
                                                <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100"><strong>P T Achat</strong></th>
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
                                <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;"><i class="fa fa-check-square" style="font-size:10px" onclick="receptionner_commande(0)"></i>&nbsp;Receptionner
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

<div class="message-box animated fadeIn" data-sound="alert" id="numerocmd">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><strong>Numero de bordereau</strong></div>
                <div class="mb-content">
                    <p>Veuillez entrer le numero de bordereau de livraison</p>
                </div>
                <div style="width: 100%;float: left;padding: 10px 0px 0px;">
                    <input type="text" name="bordereau" value="" id="bordereau" style="color: black;width: 100%;height: 40px;font-size: 20px;">
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a onclick="imprimer_commande()" class="btn btn-success btn-lg">Suivant</a>
                        <button class="btn btn-default btn-lg mb-control-close" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>