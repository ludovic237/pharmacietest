<!-- <?php

     $title_for_layout = ' Admin -' . 'Catalogue';
     $page_for_layout = 'Catalogue';
     $action_for_layout = 'Ajouter';

     if ($this->request->action == "index") {
          $position = "Tout";
     } else {
          $position = $this->request->action;
     }
     $position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
     $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
     ?> -->



<!-- START RESPONSIVE TABLES -->
<div class="row">
     <div class="col-md-6">
          <div class="panel panel-default">

               <div class="panel-body panel-body-table">

                    <div class="panel-body">
                         <table class="table datatable table-bordered table-striped table-actions">
                              <thead>
                                   <tr>
                                        <th width="100">Nom</th>
                                        <th width="100">Actions</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php foreach ($catalogue as $k => $v) : ?>
                                        <tr id="<?php echo $v->idcat; ?>">
                                             <td><strong><?php echo $v->nomcat; ?></strong></td>
                                             <td>
                                                  <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_categorie(<?php echo $v->idcat; ?>)"><span class="fa fa-pencil"></span></button>
                                                  <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idcat; ?>','<?php echo $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
                                             </td>
                                        </tr>
                                   <?php endforeach; ?>
                              </tbody>
                         </table>
                    </div>

               </div>
          </div>

     </div>
     <div class="col-md-6">
          <div class="panel panel-default">
               <!-- START JQUERY VALIDATION PLUGIN -->
               <div class="block">
                    <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouvelle catégorie</h4>
                    <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_universite('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $universites->UNIVERSITE_ID;
                                                                                                                                                      else echo ""; ?>');">
                         <div class="panel-body">
                              <div class="form-group">
                                   <label class="col-md-3 control-label">Nom:</label>
                                   <div class="col-md-9">
                                        <input type="text" class="form-control" name="nom" id="nom" value="<?php if ($position == 'Modifier') echo $universites->NOM; ?>" placeholder="" />
                                        <span class="help-block">Boris Daudga</span>
                                   </div>
                              </div>
                              <div class="btn-group pull-right">
                                   <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                                   <button class="btn btn-success" type="submit">Enregistrer</button>
                              </div>
                         </div>
                    </form>
                    <!-- END JQUERY VALIDATION PLUGIN -->
               </div>
          </div>
     </div>
</div>
<!-- END RESPONSIVE TABLES -->