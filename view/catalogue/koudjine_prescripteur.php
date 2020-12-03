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
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Catalogue/functions.js"></script>';
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
                                <th width="100">Nom</th>
                                <th width="200">Struture</th>
                                <th width="200">Adresse</th>
                                <th width="200">Téléphpone</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($catalogue as $k => $v) : ?>
                                <tr id="<?php echo $v->idpresc; ?>">
                                    <td><strong><?php echo $v->nompresc; ?></strong></td>
                                    <td><?php echo $v->structpresc; ?></td>
                                    <td><?php echo $v->adressepresc; ?></td>
                                    <td>
                                        <?php echo $v->telepresc; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Info" onclick="info_row(<?php echo $v->idpresc; ?>)">
                                            <span class="fa fa-info"></span>
                                        </button>
                                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_prescripteur(<?php echo $v->idpresc; ?>);">
                                            <span class="fa fa-pencil"></span>
                                        </button>
                                        <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idpresc; ?>','<?php echo $this->request->controller; ?>','prescripteur');">
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

<!-- END MODAL ICON PREVIEW -->