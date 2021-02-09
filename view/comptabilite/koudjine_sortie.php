<?php

$title_for_layout = ' Admin -' . 'Comptabilité';
$position = "Sortie";

$position_for_layout = '<li><a href="#">Comptabilité</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/sortie.js"></script>';
?>

<div class="row">
    <div class="col-md-10">

        <div class="panel panel-default">
            <div class="panel-body panel-body-table">
                <!-- START JQUERY VALIDATION PLUGIN -->
                <div class="block">
                    <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouvelle sortie</h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Entrée Produit:</label>
                            <div class="col-md-5">
                                <input type="text" <?php if (isset($entree)) echo 'disabled'; ?> <?php if (isset($entree)) echo 'data = "' . $entree->ide . '"'; ?> <?php if (isset($entree)) echo 'data2 = "' . $entree->idp . '"'; ?> data1="sortie" class="form-control" name="nom" id="recherche" value="<?php if (isset($entree)) echo $entree->nomp . '[' . $entree->datePeremption . ']' . '[' . $entree->quantiteRestante . ']'; ?>" placeholder="Nom" />
                            </div>
                            <label class="col-md-2 control-label">Stock:</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="nom" id="stock_detail" data="<?php if (isset($entree)) echo $entree->quantiteRestante; ?>" value="<?php if (isset($entree)) echo $entree->quantiteRestante; ?>" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 control-label">
                                <table id="tab_Grecherche" style="display: block;height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                    <thead>
                                        <tr>
                                            <th style="width: 100%;">Nom</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tab_Brecherche">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                            <div style="display: flex;flex:1;margin-right: 30px;">
                                <div>

                                    <div class="panel-body panel-body-table">

                                        <div class="">
                                            <table id="tab_Grecherche" style="display: block;height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                                <thead>
                                                    <tr>
                                                        <th width="200">Nom</th>
                                                        <th width="100">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tab_Brecherche">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div style="width: 150px;">

                            </div>
                        </div> -->
                        <?php if (isset($entree)) { ?>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-md-4 control-label">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Parent:</label>
                                        <div class="col-md-9">
                                            <select class="form-control question selectpicker" name="question" id="parent">
                                                <option value="0">Veuillez selectionner</option>
                                                <?php if (isset($produits))
                                                    foreach ($produits as $k => $v) : ?>
                                                        <option data="<?php echo $v->contenuDetail; ?>" value="<?php echo $v->id; ?>"><?php echo $v->nom; ?> &nbsp;&nbsp <?php echo '[' . $v->contenuDetail . ']'; ?>
                                                        </option>
                                                    <?php
                                                    endforeach;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 control-label">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Contenu:</label>
                                        <div class="col-md-5">
                                            <input width="200px" class="form-control" type="text" disabled value="<?php //if (isset($entree)) echo $produits[0]->contenuDetail; ?>" id="contenu">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 control-label">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Quantité:</label>
                                        <div class="col-md-5">
                                            <input width="200px" class="form-control" type="text" value="" id="qte_sortie">
                                        </div>
                                        <button class="btn btn-success" onclick="load_produit_parent()">Valider</button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row" style="margin-top: 15px">
                                <div class="col-md-6 control-label">

                                </div>
                                <div class="col-md-6 control-label contenu">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contenu:</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" disabled value="<?php if (isset($entree)) echo $entree->contenuDetail; ?>" id="contenu">
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row" style="margin-top: 15px">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Recherchrer parent:</label>
                                    <div class="col-md-5">
                                        <input class="form-control" type="text" value="" id="recherche_parent">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 15px">
                                <div class="col-md-12 control-label contenu">
                                    <table class="table  table-bordered table-striped table-actions">
                                        <thead>
                                            <tr>
                                                <th width="200">Nom</th>
                                                <th width="100">Quantité</th>
                                                <th width="100">Contenu</th>
                                                <th width="100">Quantité en stock</th>
                                                <th width="100">Date de Livraison</th>
                                                <th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tab_Bsortie">

                                        </tbody>
                                    </table>
                                </div>

                            </div>



                            <!-- <div class="row" style="margin-top: 15px">
                                <div class="col-md-12 control-label">
                                    <table class="table datatable table-bordered table-striped table-actions">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th width="100">Prix</th>
                                                <th width="100">Quantité en stock</th>
                                                <th width="100">Quantité à convertir</th>
                                                <th width="100">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div> -->
                            <div class="btn-group pull-right" style="margin-top: 15px">
                                <a class="btn btn-primary" style="margin-right: 20px" href="<?php echo Router::url('bouwou/catalogue/assureur'); ?>">Annuler</a>
                                <button class="btn btn-success" onclick="valider_produit_sortie()" type="submit">Enregistrer</button>
                            </div>
                        <?php } ?>

                    </div>
                    <!-- END JQUERY VALIDATION PLUGIN -->
                </div>

            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 15px">
        <div class="col-md-12 control-label">
            <div class="table-responsive">
                <table class="table  table-bordered table-striped table-actions">
                    <thead>
                        <tr>
                            <th width="200">Nom</th>
                            <th width="100">Quantité</th>
                            <th width="100">Nom produit détail</th>
                            <th width="100">Forme</th>
                            <th width="100">Date Opération</th>
                            <th width="100">Opération</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tab_Lsortie">
                        <?php $i = 0;
                        if (isset($sorties) && !empty($sorties)) foreach ($sorties as $k => $v) : ?>
                            <tr id="<?php echo $v->id; ?>">
                                <td><strong><a href="<?php echo Router::url('bouwou/comptabilite/entre/') . $produit_rayon[$i]->idp; ?>"><?php echo $produit_rayon[$i]->nomp . '[' . $produit_rayon[$i]->dateLivraison . ']'; ?></a></strong></td>
                                <td><?php echo $v->quantite; ?></td>
                                <td><strong><?php echo $produit_detail[$i]; ?></strong></td>
                                <td><strong><?php echo $produit_rayon[$i]->nomf; ?></strong></td>
                                <td><?php echo $v->dateSortie; ?></td>
                                <td><?php echo $operation[$i]; ?></td>
                                <td>
                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_produit(<?php echo $v->ide; ?>)"><span class="fa fa-pencil"></span></button>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewVente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="table-responsive">
                            <table id="tab_load_produit" class="table datatable table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th width="200">Nom</th>
                                        <th width="100">Prix Unitaire</th>
                                        <th width="100">Quantité</th>
                                        <th width="100">Quantité en Stock</th>
                                        <th width="100">Reduction(%)</th>
                                        <th width="200">Date de Livraison</th>
                                    </tr>
                                </thead>
                                <tbody id="tab_Bload_produit">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewSortie" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="table-responsive">
                            <table id="tab_load_produit" class="table datatable table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th width="200">Nom</th>
                                    <th width="100">Prix Unitaire</th>
                                    <th width="100">Quantité</th>
                                    <th width="100">Quantité en Stock</th>
                                    <th width="100">Reduction(%)</th>
                                    <th width="200">Date de Livraison</th>
                                    <th width="100">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tab_Bload_produit_sortie">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->