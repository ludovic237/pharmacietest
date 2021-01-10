<!-- <?php

     $title_for_layout = ' ALSAS -' . 'Comptabilite';
     $page_for_layout = 'Rapport : ' . $employe->nom;
     $action_fermeture = (isset($caisse)) ? $caisse : $caisseCheck;
     //if(isset($employe)) echo 'passe';

     if ($this->request->action == "index") {
          $position = "Tout";
     } else {
          $position = $this->request->action;
     }
     $position_for_layout = '<li><a href="#">Comptabilite</a></li><li class="active">' . $position . '</li>';
     $script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/caisse.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/functions.js"></script>';
     if (isset($caisse) && $caisse == null) {
          $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisse").modal("show"); });</script>';
     }
     if (isset($caisseCheck) && $caisseCheck != null) {
          $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisseFermer").modal("show"); });</script>';
     }
     ?> -->




<!-- START RESPONSIVE TABLES -->

<div class="row">
     <div class="col-md-4">
          <div class="panel panel-default">

               <div class="panel-heading">
                    <div class="panel-title-box">
                         <h3>Entrée</h3>
                         <!-- <span>Projects activity</span> -->
                    </div>
               </div>
               <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                         <table class="table table-bordered table-striped">
                              <thead>
                                   <!-- <tr>
                                        <th>Entree</th>
                                   </tr> -->
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>Espece</td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>OM</td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>Total</td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>

     </div>
     <div class="col-md-4">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <div class="panel-title-box">
                         <h3>Depense</h3>
                         <!-- <span>Projects activity</span> -->
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                         <!-- <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li> -->
                         <li><a href="#" class="panel-refresh"><span class="fa fa-plus"></span></a></li>

                    </ul>
               </div>
               <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                         <table class="table table-bordered table-striped">
                              <thead>
                                   <tr>
                                        <th width="50">N°</th>
                                        <th>Motifs</th>
                                        <th>Montant</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>1</td>
                                        <td>
                                             0
                                        </td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>2</td>
                                        <td>
                                             0
                                        </td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                                   <tr>
                                        <td colspan="2">Total</td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>

     </div>
     <div class="col-md-4">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <div class="panel-title-box">
                         <h3>Bon de caisse</h3>
                         <!-- <span>Projects activity</span> -->
                    </div>
                    <ul class="panel-controls" style="margin-top: 2px;">
                         <li><a href="#" class="panel-refresh"><span class="fa fa-plus"></span></a></li>
                    </ul>
               </div>
               <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                         <table class="table table-bordered table-striped">
                              <thead>
                                   <tr>
                                        <th>Nom client </th>
                                        <th>Montant</th>
                                        <th>Type</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>1</td>
                                        <td>
                                             0
                                        </td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>2</td>
                                        <td>
                                             0
                                        </td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                                   <tr>
                                        <td colspan="2">Total</td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>

     </div>
     <div class="col-md-4">
          <div class="panel panel-default">
               <div class="panel-heading">
                    <div class="panel-title-box">
                         <h3>Recapitulatif</h3>
                         <!-- <span>Projects activity</span> -->
                    </div>
               </div>
               <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                         <table class="table table-bordered table-striped">
                              <thead>
                                   <tr>
                                        <th>Total entrée </th>
                                        <th>Total sortie</th>
                                        <th>Difference</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>1</td>
                                        <td>
                                             0
                                        </td>
                                        <td>
                                             0
                                        </td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>

     </div>
</div>