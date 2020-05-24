<?php

$title_for_layout = ' Admin -'.'Utilisateurs';
$page_for_layout = 'Utilisateurs';
$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Utilisateurs</a></li><li class="active">'.$position.'</li>';
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
                            <th width="250">Noms</th>
                            <th width="250">Prénoms</th>
                            <th width="150">Identifiant</th>
                            <th>Contact</th>
                            <th width="150">Statut</th>
                            <th width="150">Fonction</th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($utilisateurs as $k => $v): ?>
                            <tr id="<?php echo $v->PERSONNE_ID; ?>">
                                <td><?php echo $v->NOM; ?></td>
                                <td><?php echo $v->PRENOM; ?></td>
                                <td>
                                    <strong><?php echo $v->IDENTIFIANT; ?></strong>
                                </td>
                                <td>

                                    <span class="col-md-12"><?php echo $contact[$v->PERSONNE_ID]->BP;  ?></span>
                                    <?php
                                    if($contact[$v->PERSONNE_ID]->TELEPHONE_2 != NULL)
                                        $phone = $contact[$v->PERSONNE_ID]->TELEPHONE_1." / ".$contact[$v->PERSONNE_ID]->TELEPHONE_2;
                                    else $phone = $contact[$v->PERSONNE_ID]->TELEPHONE_1;
                                    ?>
                                    <span class="col-md-12"><?php echo $phone;  ?></span>
                                    <span class="col-md-12"><?php echo $contact[$v->PERSONNE_ID]->EMAIL;  ?></span>
                                    <span class="col-md-12"><?php echo $contact[$v->PERSONNE_ID]->SITE;  ?></span>

                                </td>
                                <td><?php echo $v->STATUT; ?></td>
                                <td><?php echo $v->FONCTION; ?></td>
                                <td>
                                    <?php if($this->Session->user('STATUT') == 'Administrateur'){ ?>
                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_user(<?php echo $v->PERSONNE_ID; ?>)"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->PERSONNE_ID; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
                                    <?php } ?>
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