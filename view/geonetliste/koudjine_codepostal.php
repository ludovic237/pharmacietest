<!-- <?php

        $title_for_layout = ' ALSAS -' . 'Geonetliste';
        $page_for_layout = 'Geonetliste';
        // $action_for_layout = 'Ajouter';

        if ($this->request->action == "index") {
            $position = "Tout";
        } else {
            $position = $this->request->action;
        }
        $position_for_layout = '<li><a href="#">Geonetliste</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Geonetliste/functions.js"></script>';
        ?> -->



<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-4">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau assureur</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_universite('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $universites->UNIVERSITE_ID;
                                                                                                                                            else echo ""; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nom:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Nom" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Téléphone:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Téléphone" />
                            <span class="help-block">exemple: 89489233</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Taux:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Taux" />
                            <span class="help-block">exemple: 10</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code postal:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="Code postal" />
                            <span class="help-block">exemple: 44444</span>
                        </div>
                    </div>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary" style="margin-right: 20px" href="<?php echo Router::url('bouwou/catalogue/assureur'); ?>">Annuler</a>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>
    <div class="col-md-8">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="100">Nom</th>
                                <th width="200">code</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableau">
                            <?php foreach ($geonetliste as $k => $v) : ?>
                                <tr id="<?php echo $v->idcode; ?>">
                                    <td><strong><?php echo $v->nomcode; ?></strong></td>
                                    <td><?php echo $v->codecode; ?></td>
                                    <td>
                                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_codepostal(<?php echo $v->idcode; ?>)"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idcode; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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