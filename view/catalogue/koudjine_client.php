<!-- <?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Catalogue';
$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/Catalogue/functions"></script>';
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
                            <th width="200">Téléphpone</th>
                            <th width="200">Reglement mode</th>
                            <th width="200">Poid</th>
                            <th width="200">Taille</th>
                            <th width="200">reduction</th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($catalogue as $k => $v): ?>
                            <tr id="<?php echo $v->idcl; ?>">
                                <td><strong><?php echo $v->nomcl; ?></strong></td>
                                <td><?php echo $v->telephonecl; ?></td>
                                <td><?php echo $v->modeReglementcl; ?></td>
                                <td>
                                    <?php echo $v->poidcl; ?>
                                </td>
                                <td>
                                    <?php echo $v->taillecl; ?>
                                </td>
                                <td>
                                    <?php echo $v->reductioncl; ?>
                                </td>
                                <td>
                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_client(<?php echo $v->idcl; ?>)"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idcl; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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
