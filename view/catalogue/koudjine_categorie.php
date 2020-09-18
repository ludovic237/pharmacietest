<!-- <?php

     $title_for_layout = ' Admin -' . 'Catalogue';
     $page_for_layout = 'Catalogue';
     // $action_for_layout = 'Ajouter';

     if ($this->request->action == "index") {
          $position = "Tout";
     } else {
          $position = $this->request->action;
     }
     $position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
     $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
                <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
                <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
                <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/formsCategorie.js"></script>
                <script>
                                $(window).load(function(){
                                    $(\'#form2\').forms({
                                        ownerEmail:\'#\'
                                    })
                                })
                            </script>';
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
                              <tbody id="tableau_categorie">
                                   <?php foreach ($catalogue as $k => $v) : ?>
                                        <tr id="<?php echo $v->idcat; ?>">
                                             <td><strong><?php echo $v->nomcat; ?></strong></td>
                                             <td>
                                                  <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_categorie(<?php echo $v->idcat; ?>)"><span class="fa fa-pencil"></span></button>
                                                  <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->idcat; ?>','<?php echo $this->request->controller; ?>', 'categorie');"><span class="fa fa-times"></span></button>
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
                    <h4 class="titre" style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau categorie</h4>
                    <form id="form2" class="form-horizontal" method="post">
                         <div class="panel-body">
                              <div class="form-group">
                                   <label style="width: 100%;display: flex;" class="name col-md-3 ">Nom:
                                        <div class="col-md-9">
                                             <input type="text" class="form-control" name="nom" id="nom" value="" placeholder="" />
                                             <span class="help-block">exemple: Boris Daudga</span>
                                        </div>
                                   </label>
                              </div>
                              <div class="btn-group pull-left">
                                   <div class="btns"><a href="#" class="button btn btn-primary pull-left" data-type="submit">Ajouter</a></div>
                              </div>
                         </div>
                    </form>
                    <!-- END JQUERY VALIDATION PLUGIN -->
               </div>
          </div>
     </div>
</div>
<!-- END RESPONSIVE TABLES -->