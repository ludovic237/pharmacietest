<!-- <?php

     $title_for_layout = ' ALSAS -' . 'Utilisateur';
     $page_for_layout = 'Liste';
     $action_for_layout = 'Ajouter';

     if ($this->request->action == "index") {
          $position = "Tout";
     } else {
          $position = $this->request->action;
     }
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
                                        <th width="100">Nom</th>
                                        <th width="100">Prenom</th>
                                        <th width="100">Email</th>
                                        <th width="100">Fonction</th>
                                        <th width="100">Téléphone</th>
                                        <th width="100">reduction</th>
                                        <th width="100">Actions</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php foreach ($pharmanet as $k => $v) : ?>
                                        <tr id="<?php echo $v->iduser; ?>">
                                             <td><strong><?php echo $v->nomuser; ?></strong></td>
                                             <td><?php echo $v->prenomuser; ?></td>
                                             <td><?php echo $v->emailuser; ?></td>
                                             <td>
                                                  <?php echo $v->fonctionuser; ?>
                                             </td>
                                             <td>
                                                  <?php echo $v->telephoneuser; ?>
                                             </td>
                                             <td>
                                                  <?php echo $v->reductionuser; ?>
                                             </td>
                                             <td>
                                                  <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_user(<?php echo $v->iduser; ?>)"><span class="fa fa-pencil"></span></button>
                                                  <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->iduser; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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