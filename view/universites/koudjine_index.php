<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Universités';
$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">'.$position.'</li>';
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
                            <th>Nom</th>
                            <th width="150">Statut</th>
                            <th width="150">Ville</th>
                            <th width="150">Type</th>
                            <th width="200">Contacts</th>
                            <th width="100">Certification</th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($universites as $k => $v): ?>
                            <tr id="<?php echo $v->UNIVERSITE_ID; ?>">
                                <td><strong><?php echo $v->NOM; ?></strong></td>
                                <td><?php echo $v->STATUT; ?></td>
                                <td><?php echo $v->VILLE; ?></td>
                                <td>
                                    <?php
                                        foreach ($type[$v->UNIVERSITE_ID] as $p => $q):
                                            ?><span class="col-md-12"><?php echo $q->nom;  ?></span><?php
                                endforeach;
                                    ?>
                                </td>
                                <td>

                                        <span class="col-md-12"><?php echo $contact[$v->UNIVERSITE_ID]->BP;  ?></span>
                                    <?php
                                    if($contact[$v->UNIVERSITE_ID]->TELEPHONE_2 != NULL)
                                        $phone = $contact[$v->UNIVERSITE_ID]->TELEPHONE_1." / ".$contact[$v->UNIVERSITE_ID]->TELEPHONE_2;
                                    else $phone = $contact[$v->UNIVERSITE_ID]->TELEPHONE_1;
                                    ?>
                                        <span class="col-md-12"><?php echo $phone;  ?></span>
                                        <span class="col-md-12"><?php echo $contact[$v->UNIVERSITE_ID]->EMAIL;  ?></span>
                                        <span class="col-md-12"><?php echo $contact[$v->UNIVERSITE_ID]->SITE;  ?></span>

                                </td>
                                <?php
                                if($v->CERTIFICATION == 'Certifié')
                                {?><td><span class="label label-success"><?php echo $v->CERTIFICATION; ?></span></td> <?php ;}
                                else {?><td><span class="label label-warning"><?php echo $v->CERTIFICATION; ?></span></td> <?php ;}
                                ?>
                                <td>
                                    <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Info" onclick="info_row(<?php echo $v->UNIVERSITE_ID; ?>)"><span class="fa fa-info"></span></button>
                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_univ(<?php echo $v->UNIVERSITE_ID; ?>)"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->UNIVERSITE_ID; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Université</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
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