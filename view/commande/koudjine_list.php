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
                                        <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="envoyer_en_caisse(<?php echo $v->id; ?>,<?php echo $action_fermeture->id; ?>)">
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
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table">
                <div class="panel-body">
                    <table class="table  table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="100">Désignation</th>
                                <th width="100">Quantite commandé</th>
                                <th width="100">Quantite livré</th>
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
                                            <input type='text' name='quant[1]' class='form-control input-number' style='width: 20px;'>
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
                                            <input type='text' name='quant[1]' class='form-control input-number' style='width: 20px;'>
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
                                            <input type='text' name='quant[1]' class='form-control input-number' style='width: 20px;'>
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
                                            <input type='text' name='quant[1]' class='form-control input-number' style='width: 20px;'>
                                            <span class='input-group-btn'>
                                                <button type='button' class='btn btn-default btn-number plus' style='padding: 4px;'>
                                                    <span class='glyphicon glyphicon-plus'></span>
                                                </button>
                                            </span>
                                        </div>
                                    </td>


                                    <td><input id="cellpadding" name="cellpadding" type="date" value="" size="3" maxlength="3" class="number" /></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
        <div class="panel-body panel-body-table" style="
    padding-bottom: 40px;
    padding-left: 20px;
    padding-right: 20px;
">
                <div class="panel-body">
                    <div style="display: flex;align-items: center;justify-content: space-evenly;">
                        <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;" id="fen_facture" data="">Montant commande</h4>
                        <div>
                            <h2><span id="facture_caisse" data="">0</span>F CFA</h2>
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
                    <button class="btn btn-success" >Imprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>