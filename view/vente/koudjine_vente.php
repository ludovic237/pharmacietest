<!-- <?php

        $title_for_layout = ' ALSAS -' . 'Vente';
        $page_for_layout = 'Vente';
        $action_for_layout = 'Ajouter';

        $position_for_layout = '<li><a href="#">Vente</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
        ?> -->



<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">
                <div class="btn-group pull-right">
                    <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                    <ul class="dropdown-menu">
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'json',escape:'false'});"><img src="img/icons/json.png" width="24"> JSON</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src="img/icons/json.png" width="24"> JSON (ignoreColumn)</a></li>
                        <li><a href="#" onclick="$('#customers2'). tableExport({type:'json',escape:'true'});"><img src="img/icons/json.png" width="24"> JSON (with Escape)</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'xml',escape:'false'});"><img src="img/icons/xml.png" width="24"> XML</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'sql'});"><img src="img/icons/sql.png" width="24"> SQL</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'csv',escape:'false'});"><img src="img/icons/csv.png" width="24"> CSV</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src="img/icons/txt.png" width="24"> TXT</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src="img/icons/xls.png" width="24"> XLS</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src="img/icons/word.png" width="24"> Word</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'powerpoint',escape:'false'});"><img src="img/icons/ppt.png" width="24"> PowerPoint</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'png',escape:'false'});"><img src="img/icons/png.png" width="24"> PNG</a></li>
                        <li><a href="#" onclick="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src="img/icons/pdf.png" width="24"> PDF</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="customers2" class="table datatable table-bordered table-striped table-actions export tableExport">
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
                                <?php $i = 0;
                                if (isset($ventes)) foreach ($ventes as $k => $v) : ?>
                                    <tr id="<?php echo $v->idv; ?>">
                                        <td><strong><?php echo $v->prixTotal; ?></strong></td>
                                        <td><?php echo $v->prixPercu; ?></td>
                                        <td><?php if (isset($user)) echo $user[$i]; ?></td>
                                        <td><?php echo $v->commentaire; ?></td>
                                        <td>
                                            <?php echo $v->dateVente; ?>
                                        </td>
                                        <td>
                                            <?php echo $v->etat; ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<p style="font-size: 14px;">' . $v->reference . '</p>';
                                            $count = 0;
                                            if (isset($produits)) foreach ($produits[$i] as $p => $q) :
                                                if ($count == 3) break;
                                                echo '<p style="font-size: 8px;font-weight: bold;margin-bottom: 0px;">' . $q->nom . '</p>';
                                                //echo $q->nom."\n";
                                                if ($count == 2)
                                                    echo '<p style="font-size: 8px;font-weight: bold;margin-bottom: 0px;">' . $q->nom . '</p>';
                                                $count++;
                                            endforeach;
                                            $i++;
                                            ?>
                                        </td>
                                        <td>
                                            <!-- <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_concours(<?php echo $v->CONCOURS_ID; ?>)"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->CONCOURS_ID; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button> -->
                                        </td>
                                        <p></p>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
<!-- END RESPONSIVE TABLES -->