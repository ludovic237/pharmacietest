<!-- <?php

$title_for_layout = ' ALSAS -'.'Vente';
$page_for_layout = 'Vente';
$action_for_layout = 'Ajouter';

$position_for_layout = '<li><a href="#">Vente</a></li><li class="active">'.$position.'</li>';
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
                            <th width="100">Montant</th>
                            <th width="200">Montant percu</th>
                            <th width="200">Client</th>
                            <th width="200">Commentaire</th>
                            <th width="200">Date de vente</th>
                            <th width="100">Etat</th>
                            <th width="100">Ref</th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; if(isset($ventes)) foreach ($ventes as $k => $v): ?>
                            <tr id="<?php echo $v->idv; ?>">
                                <td><strong><?php echo $v->prixTotal; ?></strong></td>
                                <td><?php echo $v->prixPercu; ?></td>
                                <td><?php if(isset($user)) echo $user[$i]; ?></td>
                                <td><?php echo $v->commentaire; ?></td>
                                <td>
                                    <?php echo $v->dateVente; ?>
                                </td>
                                <td>
                                    <?php echo $v->etat; ?>
                                </td>
                                <td>
                                    <?php echo $v->reference;
                                    echo "\n";
                                    $count = 0;
                                    if(isset($produits)) foreach ($produits[$i] as $p => $q):
                                        if($count == 3) break;
                                        echo $q->nom."\n";
                                        if($count == 2)
                                        echo $q->nom;
                                        $count++;
                                    endforeach;
                                    $i++;
                                    ?>
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