<!-- <?php

        $title_for_layout = ' Admin -' . 'Catalogue';
        $page_for_layout = 'Catalogue';
        $action_for_layout = 'Ajouter';

        if ($this->request->action == "index") {
            $position = "Tout";
        } else {
            $position = $this->request->action;
        }
        $position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
        ?> -->



<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th width="100">ean13</th>
                                <th width="200">Quantité en stock</th>
                                <th width="200">Catégorie</th>
                                <th width="100">Rayon</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($catalogue as $k => $v) : ?>
                                <tr id="<?php echo $v->idp; ?>">
                                    <td><strong><?php echo $v->nomp; ?></strong></td>
                                    <td><?php echo $v->ean13; ?></td>
                                    <td><?php echo $v->stock; ?></td>
                                    <td>
                                        <?php echo $v->nomc; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->nomr; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Info" onclick="info_row(<?php echo $v->idp; ?>)">
                                            <span class="fa fa-info"></span>
                                        </button>
                                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_produit(<?php echo $v->idp; ?>)">
                                            <span class="fa fa-pencil"></span>
                                        </button>
                                        <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idp; ?>','<?php echo $this->request->controller; ?>');">
                                            <span class="fa fa-times"></span>
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


<!-- END RESPONSIVE TABLES -->
<!-- START MODAL ICON PREVIEW -->
<!-- <div class="modal fade" id="iconPreview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_universite('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $universites->UNIVERSITE_ID;
                                                                                                                                                else echo ""; ?>');">
                    <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Informations générales</h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">ean13:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="" />
                                <span class="help-block">exemple: ean13</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Référence:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nom_complet" id="nom_complet" value="<?php if ($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="" />
                                <span class="help-block">exemple: AXA</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nom:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?php if ($position == 'Modifier') echo $universites->VILLE; ?>" name="ville" id="ville" placeholder="" />
                                <span class="help-block">Champ requis</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contenance:</label>
                            <div class="col-md-9">
                                <input type="text" value="<?php if ($position == 'Modifier') echo $universites->REGION; ?>" name="region" id="region" class="form-control" placeholder="" />
                                <span class="help-block">Champ requis</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Unité:</label>
                            <div class="col-md-9">
                                <select class="form-control input-xlarge select2me" name="unite" required="">
                                    <option value="1">Kg</option>
                                    <option value="2">G</option>
                                    <option value="3">DG</option>
                                    <option value="6">MG</option>
                                    <option value="7">L</option>
                                    <option value="8">DL</option>
                                    <option value="9">CL</option>
                                    <option value="10">ML</option>
                                    <option value="11"></option>
                                    <option value="12">CL</option>
                                </select>
                                <span class="help-block">Requis</span>
                            </div>
                        </div>
                    </div>
                    <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Stock</h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Quantité en stock:</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="" />
                                <span class="help-block">exemple: 23</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Quantité max en stock:</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="nom_complet" id="nom_complet" value="<?php if ($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="" />
                                <span class="help-block">exemple: 40</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Quantité min en stock:</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" value="<?php if ($position == 'Modifier') echo $universites->VILLE; ?>" name="ville" id="ville" placeholder="" />
                                <span class="help-block">Champ requis</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date de péremption:</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input class="form-control" id="dateDebut" name="datPeremp" placeholder="Date de péremption" type="date" required="">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date de commande:</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input class="form-control" id="dateDebut" name="datPeremp" placeholder="Date de péremption" type="date" required="">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Prix</h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Prix public:</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="" />
                                <span class="help-block">exemple: 2000 FCFA</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Prix achat:</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="nom_complet" id="nom_complet" value="<?php if ($position == 'Modifier') echo $universites->NOM_COMPLET; ?>" placeholder="" />
                                <span class="help-block">exemple: 2000 FCFA</span>
                            </div>
                        </div>
                    </div>
                    <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Géo</h4>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Catégorie:</label>
                            <div class="col-md-9">
                                <select class="form-control input-xlarge select2me" name="cat">
                                    <option value="1">INDEXCAT</option>
                                    <option value="3">CAT</option>
                                    <option value="4">INDEXCAT</option>
                                    <option value="5">SODIUM</option>
                                    <option value="7">INDEXCAT</option>
                                    <option value="9">PARACETAMOL</option>
                                    <option value="10">PARFUMERIE</option>
                                    <option value="11">REHYDRATANT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Rayon:</label>
                            <div class="col-md-9">
                                <select class="form-control input-xlarge select2me" name="cat">
                                    <option value="1">INDEXCAT</option>
                                    <option value="3">CAT</option>
                                    <option value="4">INDEXCAT</option>
                                    <option value="5">SODIUM</option>
                                    <option value="7">INDEXCAT</option>
                                    <option value="9">PARACETAMOL</option>
                                    <option value="10">PARFUMERIE</option>
                                    <option value="11">REHYDRATANT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Magasin:</label>
                            <div class="col-md-9">
                                <select class="form-control input-xlarge select2me" name="cat">
                                    <option value="1">INDEXCAT</option>
                                    <option value="3">CAT</option>
                                    <option value="4">INDEXCAT</option>
                                    <option value="5">SODIUM</option>
                                    <option value="7">INDEXCAT</option>
                                    <option value="9">PARACETAMOL</option>
                                    <option value="10">PARFUMERIE</option>
                                    <option value="11">REHYDRATANT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Form:</label>
                            <div class="col-md-9">
                                <select class="form-control input-xlarge select2me" name="cat">
                                    <option value="1">INDEXCAT</option>
                                    <option value="3">CAT</option>
                                    <option value="4">INDEXCAT</option>
                                    <option value="5">SODIUM</option>
                                    <option value="7">INDEXCAT</option>
                                    <option value="9">PARACETAMOL</option>
                                    <option value="10">PARFUMERIE</option>
                                    <option value="11">REHYDRATANT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fabriquant:</label>
                            <div class="col-md-9">
                                <select class="form-control input-xlarge select2me" name="cat">
                                    <option value="1">INDEXCAT</option>
                                    <option value="3">CAT</option>
                                    <option value="4">INDEXCAT</option>
                                    <option value="5">SODIUM</option>
                                    <option value="7">INDEXCAT</option>
                                    <option value="9">PARACETAMOL</option>
                                    <option value="10">PARFUMERIE</option>
                                    <option value="11">REHYDRATANT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fournisseur:</label>
                            <div class="col-md-9">
                                <select class="form-control input-xlarge select2me" name="cat">
                                    <option value="1">INDEXCAT</option>
                                    <option value="3">CAT</option>
                                    <option value="4">INDEXCAT</option>
                                    <option value="5">SODIUM</option>
                                    <option value="7">INDEXCAT</option>
                                    <option value="9">PARACETAMOL</option>
                                    <option value="10">PARFUMERIE</option>
                                    <option value="11">REHYDRATANT</option>
                                </select>
                            </div>
                        </div>
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                            <button class="btn btn-success" type="submit">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->
<!-- END MODAL ICON PREVIEW -->