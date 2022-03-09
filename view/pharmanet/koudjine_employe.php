<!-- <?php

     $title_for_layout = ' ALSAS -' . 'Employé';
     $page_for_layout = 'Liste';
     $action_for_layout = 'Ajouter';

     $position_for_layout = '<li><a href="#">Pharmanet</a></li><li class="active">' . $position . '</li>';
     $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
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
                                        <th width="100">Identifiant</th>
                                        <th width="100">code barre</th>
                                        <th width="100">Type</th>
                                        <th width="100">User id</th>
                                        <th width="100">Etat</th>
                                        <th width="100">Réduction max</th>
                                        <th width="100">Actions</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php foreach ($pharmanet as $k => $v) : ?>
                                        <tr id="<?php echo $v->idemploye; ?>">
                                             <td><strong><?php echo $v->identifiantemploye; ?></strong></td>
                                             <td><?php echo $v->codebarreidemploye; ?></td>
                                             <td><?php echo $v->typeemploye; ?></td>
                                             <td>
                                                  <?php echo $v->useridemploye; ?>
                                             </td>
                                             <td>
                                                  <?php echo $v->etatemploye; ?>
                                             </td>
                                             <td>
                                                  <?php echo $v->reductionemploye; ?>
                                             </td>
                                             <td>
                                                  <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_employe(<?php echo $v->idemploye; ?>)"><span class="fa fa-pencil"></span></button>
                                                  <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idemploye; ?>','<?php echo $this->request->controller; ?>','employe');"><span class="fa fa-times"></span></button>
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