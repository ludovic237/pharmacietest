<!-- <?php

$title_for_layout = ' Admin -'.'Universités';
$page_for_layout = 'Catalogue';
$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Categorie</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>';
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
                            <th width="200">Prix public</th>
                            <th width="200">Catégorie</th>
                            <th width="100">Rayon</th>
                            <th width="200">Date de péremption</th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($catalogue as $k => $v): ?>
                            <tr id="<?php echo $v->idp; ?>">
                                <td><strong><?php echo $v->nomp; ?></strong></td>
                                <td><?php echo $v->ean13; ?></td>
                                <td><?php echo $v->stock; ?></td>
                                <td><?php echo $v->prixPublic; ?></td>
                                <td>
                                    <?php echo $v->nomc; ?>
                                </td>
                                <td>
                                    <?php echo $v->nomr; ?>
                                </td>
                                <td>
                                    <?php echo $v->datePeremption; ?>
                                </td>
                                <td>
                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_concours(<?php echo $v->idp; ?>)"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idp; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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