<!-- <?php

     $title_for_layout = ' ALSAS -' . 'Universités';
     $page_for_layout = "Chiffre d'affaire";
     $action_for_layout = 'Ajouter';

     if ($this->request->action == "index") {
          $position = "Tout";
     } else {
          $position = $this->request->action;
     }
     $position_for_layout = "<li><a href='#'>Chiffre d'affaire</a></li><li class='active'>' . $position . '</li>";
     $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
     ?> -->


<!-- START WIDGETS -->
<div class="row">
     <div class="col-md-3">

          <!-- START WIDGET REGISTRED -->
          <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
               <!-- <div class="widget-item-left">
                <span class="fa fa-user"></span>
            </div> -->
               <div style="padding-top: 10px;">
                    <div class="widget-int num-count">375</div>
                    <div class="widget-title">Chiffre d'affaire</div>
                    <div class="widget-subtitle">Vente</div>
               </div>
               <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
               </div>
          </div>
          <!-- END WIDGET REGISTRED -->

     </div>
     <div class="col-md-3">

          <!-- START WIDGET REGISTRED -->
          <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
               <!-- <div class="widget-item-left">
                <span class="fa fa-user"></span>
            </div> -->
               <div style="padding-top: 10px;">
                    <div class="widget-int num-count">375</div>
                    <div class="widget-title">Benefice</div>
                    <div class="widget-subtitle">Vente</div>
               </div>
               <div class="widget-controls">
                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
               </div>
          </div>
          <!-- END WIDGET REGISTRED -->



     </div>
</div>
<!-- END WIDGETS -->

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
                                        <th width="100">Quantite</th>
                                        <th width="100">Prix d'achat</th>
                                        <th width="100">Total</th>
                                        <th width="100">Prix de vente</th>
                                        <th width="100">Bénéfice</th>
                                        <th width="100">Chiffre d'affaire</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <!-- <?php foreach ($concours as $k => $v) : ?> -->
                                   <tr id="<?php echo $v->CONCOURS_ID; ?>">
                                        <td>
                                             <!-- <strong><?php echo $v->NOM; ?></strong> -->
                                        </td>
                                        <td>
                                             <!-- <?php echo $v->DESCRIPTION; ?> -->
                                        </td>
                                        <td>
                                             <!-- <?php echo $v->DESCRIPTION; ?> -->
                                        </td>
                                        <td>
                                             <!-- <?php echo $v->DESCRIPTION; ?> -->
                                        </td>
                                        <td>
                                             <!-- <?php echo $v->DESCRIPTION; ?> -->
                                        </td>
                                        <td>
                                             <!-- <?php echo $v->DESCRIPTION; ?> -->
                                        </td>
                                        <td>
                                             <!-- <?php echo $v->DESCRIPTION; ?> -->
                                        </td>
                                        <td>
                                             <!-- <?php echo $v->DESCRIPTION; ?> -->
                                        </td>
                                   </tr>
                                   <!-- <?php endforeach; ?> -->
                              </tbody>
                         </table>
                    </div>

               </div>
          </div>

     </div>
</div>
<!-- END RESPONSIVE TABLES -->