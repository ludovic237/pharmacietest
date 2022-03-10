<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Concours';
$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Concours</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>';
?>



<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>Université</th>
                            <th width="100">Date du début</th>
                            <th width="100">Date de fin</th>
                            <th width="250">Description</th>
                            <th width="200">Modalité d'admission</th>
                            <th width="100">Date pour dossier</th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($concours as $k => $v): ?>
                            <tr id="<?php echo $v->CONCOURS_ID; ?>">
                                <td><strong><?php echo $v->NOM; ?></strong></td>
                                <td><?php echo $v->DATE_DEBUT_CONCOURS; ?></td>
                                <td><?php echo $v->DATE_FIN_CONCOURS; ?></td>
                                <td>
                                    <?php echo $v->DESCRIPTION; ?>
                                </td>
                                <td>
                                    <?php echo $v->MODALITE_ADMISSION; ?>
                                </td>
                                <td>
                                    <?php echo $v->DATE_DOSSIER; ?>
                                </td>
                                <td>
                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_concours(<?php echo $v->CONCOURS_ID; ?>)"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->CONCOURS_ID; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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