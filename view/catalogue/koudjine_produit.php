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
                            <th width="100">Laborex</th>
                            <th width="100">UbiPharm</th>
                            <th width="200">Quantité en stock</th>
                            <th width="200">Quantité max</th>
                            <th width="200">Quantité min</th>
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


<!-- END RESPONSIVE TABLES -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Université</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview"></div>
                    </div>
                    <div class="col-md-8 scroll">
                        <ul class="list-group border-bottom">
                            <h4>Informations générales</h4>
                            <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <td width="100">Nom:</td>
                                    <td class="nom"></td>
                                </tr>
                                <tr>
                                    <td width="100">Ville:</td>
                                    <td class="ville"></td>
                                </tr>
                                <tr>
                                    <td width="100">Région:</td>
                                    <td class="region"></td>
                                </tr>
                                <tr>
                                    <td width="100">Statut:</td>
                                    <td class="statut"></td>
                                </tr>
                                <tr>
                                    <td width="100">Type:</td>
                                    <td class="type"></td>
                                </tr>
                                <tr>
                                    <td width="50">Responsable:</td>
                                    <td class="responsable"></td>
                                </tr>
                                </tbody>
                            </table>
                            <h4>Informations de contact</h4>
                            <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <td width="100">B.P:</td>
                                    <td class="bp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Téléphone:</td>
                                    <td class="phone"></td>
                                </tr>
                                <tr>
                                    <td width="100">Email</td>
                                    <td class="email"></td>
                                </tr>
                                <tr>
                                    <td width="100">URL:</td>
                                    <td class="site"></td>
                                </tr>
                                </tbody>
                            </table>
                            <h4>Autres Informations</h4>
                            <table class="table table-bordered">

                                <tbody>
                                <tr>
                                    <td width="100">Cerification:</td>
                                    <td class="certif"></td>
                                </tr>
                                <tr>
                                    <td width="100">Parrain:</td>
                                    <td class="parrain"></td>
                                </tr>

                                </tbody>
                            </table>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->