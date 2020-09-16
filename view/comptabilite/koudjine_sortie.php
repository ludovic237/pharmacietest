<?php

$title_for_layout = ' Admin -' . 'Comptabilité';
$position = "Sortie";

$position_for_layout = '<li><a href="#">Comptabilité</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/sortie.js"></script>';
?>

<div class="row">
    <div class="col-md-10">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouvelle sortie</h4>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Entrée Produit:</label>
                        <div class="col-md-9">
                            <input type="text" <?php if (isset($entree)) echo 'disabled'; ?> <?php if (isset($entree)) echo 'data = "'.$entree->contenuDetail.'"'; ?> class="form-control" name="nom" id="recherche" value="<?php if (isset($entree)) echo $entree->nomp.'['.$entree->datePeremption.']'.'['.$entree->quantiteRestante.']'; ?>" placeholder="Nom" />
                        </div>
                    </div>
                    <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
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
                                            <tbody id="tab_Brecherche" >

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div style="width: 150px;">

                        </div>
                    </div>
                    <?php if(isset($entree)){ ?>
                    <div  class="row">
                        <div class="col-md-5 control-label">
                            <label class="col-md-3 control-label"> Choix:</label>
                            <div class="col-md-9">
                                <select class="form-control question selectpicker" name="question" id="choix">
                                    <option value="0">Perimée</option>
                                    <option value="1">Détail</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 control-label">
                            <label class="col-md-8 control-label">Quantité:</label>
                            <div class="col-md-4">
                                <input type="text" value="" id="qte" >
                            </div>
                        </div>
                        <div class="col-md-4 control-label contenu">
                            <label class="col-md-8 control-label">Contenu:</label>
                            <div class="col-md-4">
                                <input type="text" disabled value="<?php if (isset($entree)) echo $entree->contenuDetail; ?>" id="contenu" >
                            </div>
                        </div>
                        <div class="col-md-6 control-label">
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
                    </div>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                    <?php } ?>
                </div>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>

</div>
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewVente" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <th width="100">Prix Unitaire</th>
                                    <th width="100">Quantité</th>
                                    <th width="100">Quantité en Stock</th>
                                    <th width="100">Reduction</th>
                                    <th width="200">Date de Livraison</th>
                                </tr>
                                </thead>
                                <tbody id="tab_Bload_produit" >

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