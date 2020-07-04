<!-- <?php

     $title_for_layout = ' Admin -' . 'Universités';
     $page_for_layout = 'Caisse';
     $action_for_layout = 'Fermer caisse';

     if ($this->request->action == "index") {
          $position = "Tout";
     } else {
          $position = $this->request->action;
     }
     $position_for_layout = '<li><a href="#">Concours</a></li><li class="active">' . $position . '</li>';
     $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>';
     ?> -->



<!-- START RESPONSIVE TABLES -->
<div class="row">
     <div class="col-md-12">
          <div class="panel panel-default">

               <div class="panel-body panel-body-table">

                    <div class="panel-body">
                         <div style="justify-content: flex-end;display:flex">
                              <button class="btn btn-primary ajouter pull-right" controller="comptabilite" data="" id="">Rafraichir</button>
                         </div>
                         <table class="table datatable table-bordered table-striped table-actions">
                              <thead>
                                   <tr>
                                        <th>Nom</th>
                                        <th width="100">Code</th>
                                        <th width="100">Nom</th>
                                        <th width="100">Actions</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php foreach ($concours as $k => $v) : ?>
                                        <tr id="<?php echo $v->CONCOURS_ID; ?>">
                                             <td><strong><?php echo $v->NOM; ?></strong></td>
                                             <td><?php echo $v->DATE_DEBUT_CONCOURS; ?></td>
                                             <td><?php echo $v->DATE_FIN_CONCOURS; ?></td>
                                             <td>
                                                  <?php echo $v->DESCRIPTION; ?>
                                             </td>
                                             <td>
                                                  <?php echo $v->MODALITE_ADMISSION; ?>
                                             </td>
                                             <td>
                                                  <?php echo $v->DATE_DOSSIER; ?>
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
<div class="row">
     <div class="col-md-6">
          <div class="panel panel-default">
               <div class="panel-body panel-body-table">
                    <div class="panel-body">
                         <table class="table datatable table-bordered table-striped table-actions">
                              <thead>
                                   <tr>
                                        <th width="200">Nom</th>
                                        <th width="100">Prix Unitaire</th>
                                        <th width="100">Quantité</th>
                                        <th width="100">Prix Total</th>
                                        <th width="100">Reduction</th>
                                   </tr>
                              </thead>
                              <tbody id="tab_vente">

                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-md-6">
          <div class="panel panel-default">
               <div class="panel-body panel-body-table">
                    <div class="panel-body">
                         <div style="display: flex;align-items: center;justify-content: space-evenly;">
                              <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Montant facture</h4>
                              <div>
                                   <h2>3000</h2>
                              </div>
                         </div>
                         <div class="panel panel-default tabs">
                              <ul class="nav nav-tabs">
                                   <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Espèce</a></li>
                                   <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Electronique</a></li>
                                   <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false">Ticket de caisse</a></li>
                                   <li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false">Mixte</a></li>
                              </ul>
                              <div class="tab-content">
                                   <div class="tab-pane panel-body active" id="tab1">
                                        <div class="block">
                                             <!-- <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4> -->
                                             <form  role="form" class="form-horizontal" >
                                                  <div class="panel-body">

                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Montant en caisse:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Rendu</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" disabled class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="btn-group pull-right">
                                                            <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                                                            <button class="btn btn-success" type="submit" style="margin-right: 20px">Valider</button>
                                                            <button class="btn btn-success" type="submit">Imprimer</button>
                                                       </div>
                                                  </div>
                                             </form>
                                             <!-- END JQUERY VALIDATION PLUGIN -->
                                        </div>
                                   </div>
                                   <div class="tab-pane panel-body" id="tab2">
                                        <div class="block">
                                             <!-- <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4> -->
                                             <form  role="form" class="form-horizontal" >
                                                  <div class="panel-body">

                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Numéro de téléphone:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Montant:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Frais:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Rendu:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="btn-group pull-right">
                                                            <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                                                            <button class="btn btn-success" type="submit" style="margin-right: 20px">Valider</button>
                                                            <button class="btn btn-success" type="submit">Imprimer</button>
                                                       </div>
                                                  </div>
                                             </form>
                                             <!-- END JQUERY VALIDATION PLUGIN -->
                                        </div>
                                   </div>
                                   <div class="tab-pane panel-body" id="tab3">
                                        <div class="block">
                                             <!-- <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4> -->
                                             <form  role="form" class="form-horizontal" >
                                                  <div class="panel-body">

                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Numéro de ticket:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Montant:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Rendu:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="btn-group pull-right">
                                                            <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                                                            <button class="btn btn-success" type="submit" style="margin-right: 20px">Valider</button>
                                                            <button class="btn btn-success" type="submit">Imprimer</button>
                                                       </div>
                                                  </div>
                                             </form>
                                             <!-- END JQUERY VALIDATION PLUGIN -->
                                        </div>
                                   </div>
                                   <div class="tab-pane panel-body" id="tab4">
                                        <div class="block">
                                             <!-- <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4> -->
                                             <form  role="form" class="form-horizontal" >
                                                  <div class="panel-body">
                                                       <div>
                                                            <div style="background-color: #2d3945;color: white;width: 100%;padding:10px">
                                                                 <p style="color: white;margin-bottom: 0px">Espèce</p>
                                                            </div>
                                                            <div style="border-style: solid;padding: 10px;border-width: 1px;margin-bottom: 10px;">

                                                                 <div class="form-group">
                                                                      <label class="col-md-3 control-label">Montant:</label>
                                                                      <div class="col-md-9">
                                                                           <input type="number" class="form-control" value="" placeholder="">
                                                                           <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>

                                                       <div>
                                                            <div style="background-color: #2d3945;color: white;width: 100%;padding:10px">
                                                                 <p style="color: white;margin-bottom: 0px">Electronique</p>
                                                            </div>
                                                            <div style="border-style: solid;padding: 10px;border-width: 1px;margin-bottom: 10px;">

                                                                 <div class="form-group">
                                                                      <label class="col-md-3 control-label">Numéro de téléphone:</label>
                                                                      <div class="col-md-9">
                                                                           <input type="number" class="form-control" value="" placeholder="">
                                                                           <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                                      </div>
                                                                 </div>
                                                                 <div class="form-group">
                                                                      <label class="col-md-3 control-label">Montant:</label>
                                                                      <div class="col-md-9">
                                                                           <input type="number" class="form-control" value="" placeholder="">
                                                                           <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                                      </div>
                                                                 </div>
                                                                 <div class="form-group">
                                                                      <label class="col-md-3 control-label">Frais:</label>
                                                                      <div class="col-md-9">
                                                                           <input type="number" class="form-control" value="" placeholder="">
                                                                           <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div>
                                                            <div style="background-color: #2d3945;color: white;width: 100%;padding:10px">
                                                                 <p style="color: white;margin-bottom: 0px">Ticket de caisse</p>
                                                            </div>
                                                            <div style="border-style: solid;padding: 10px;border-width: 1px;margin-bottom: 10px;">

                                                                 <div class="form-group">
                                                                      <label class="col-md-3 control-label">Numéro ticket:</label>
                                                                      <div class="col-md-9">
                                                                           <input type="number" class="form-control" value="" placeholder="">
                                                                           <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                                      </div>
                                                                 </div>
                                                                 <div class="form-group">
                                                                      <label class="col-md-3 control-label">Montant:</label>
                                                                      <div class="col-md-9">
                                                                           <input type="number" class="form-control" value="" placeholder="">
                                                                           <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Total encaissé:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="">
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Rendu:</label>
                                                            <div class="col-md-9">
                                                                 <input type="number" class="form-control" value="" placeholder="">
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="btn-group pull-right">
                                                            <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                                                            <button class="btn btn-success" type="submit" style="margin-right: 20px">Valider</button>
                                                            <button class="btn btn-success" type="submit">Imprimer</button>
                                                       </div>
                                                  </div>
                                             </form>
                                             <!-- END JQUERY VALIDATION PLUGIN -->
                                        </div>
                                   </div>

                              </div>

                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-md-12">
          <div class="panel panel-default">

               <div class="panel-body panel-body-table">

                    <div class="panel-body" style="display: flex;flex-direction: column;">
                         <div style="display: flex;align-items: center;">
                              <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Session caisse</h4>
                         </div>
                         <div>
                              <div class="form-group">
                                   <label class="col-md-3 control-label">Session:</label>
                                   <div class="col-md-9">
                                        <select class="form-control input-xlarge select2me" name="session" required="">
                                             <option value="Matin">Matin</option>
                                             <option value="Soir">Soir</option>
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <div style="display: flex;align-items: center;">
                              <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Fond de caisse</h4>
                         </div>
                         <div>
                              <table class="table datatable table-bordered table-striped table-actions">
                                   <thead>
                                        <tr>
                                             <th width="150" colspan="2">Piece</th>
                                             <th width="150" colspan="2">Billets</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_1" placeholder=""></td>
                                             <td>500</td>
                                             <td><input type="number" class="form-control argent"  value="0" id="argent_2" placeholder=""></td>
                                             <td>10000</td>
                                        </tr>
                                        <tr>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_3" placeholder=""></td>
                                             <td>100</td>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_4" placeholder=""></td>
                                             <td>5000</td>
                                        </tr>
                                        <tr>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_5" placeholder=""></td>
                                             <td>50</td>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_6" placeholder=""></td>
                                             <td>2000</td>
                                        </tr>
                                        <tr>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_7" placeholder=""></td>
                                             <td>25</td>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_8" placeholder=""></td>
                                             <td>1000</td>
                                        </tr>
                                        <tr>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_9" placeholder=""></td>
                                             <td>10</td>
                                             <td><input type="number" class="form-control argent" value="0" id="argent_10" placeholder=""></td>
                                             <td>500</td>
                                        </tr>
                                        <tr>
                                             <td>
                                                  <h6>
                                                       Sous total
                                                  </h6>
                                             </td>
                                             <td>10</td>
                                             <td>
                                                  <h6>
                                                       Sous total
                                                  </h6>
                                             </td>
                                             <td>500</td>
                                        </tr>
                                        <tr>
                                             <td colspan="4">
                                                  <div style="justify-content: space-between;display:flex">
                                                       <p> Total</p>
                                                       <h1>1000</h1>
                                                  </div>
                                             </td>
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                    </div>

               </div>
          </div>

     </div>
</div>
<!-- END RESPONSIVE TABLES -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewCaisse" tabindex="-1" role="dialog" aria-hidden="false">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Caisse</h4>
               </div>
               <div class="modal-body">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="panel panel-default">

                                   <div class="panel-body panel-body-table">

                                        <div class="panel-body" style="display: flex;flex-direction: column;">
                                             <div style="display: flex;align-items: center;">
                                                  <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Session caisse</h4>
                                             </div>
                                             <div>
                                                  <div class="form-group">
                                                       <label class="col-md-3 control-label">Session:</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control input-xlarge select2me" name="session" required="">
                                                                 <option value="Matin">Matin</option>
                                                                 <option value="Soir">Soir</option>
                                                            </select>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div style="display: flex;align-items: center;margin-top:20px">
                                                  <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Fond de caisse</h4>
                                             </div>
                                             <div>
                                                  <table class="table datatable table-bordered table-striped table-actions">
                                                       <thead>
                                                            <tr>
                                                                 <th width="150" colspan="2">Piece</th>
                                                                 <th width="150" colspan="2">Billets</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                            <tr>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>500</td>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>10000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>100</td>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>5000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>50</td>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>2000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>25</td>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>1000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>10</td>
                                                                 <td><input type="number" class="form-control" value="" placeholder=""></td>
                                                                 <td>500</td>
                                                            </tr>
                                                            <tr>
                                                                 <td>
                                                                      <h6>
                                                                           Sous total
                                                                      </h6>
                                                                 </td>
                                                                 <td>10</td>
                                                                 <td>
                                                                      <h6>
                                                                           Sous total
                                                                      </h6>
                                                                 </td>
                                                                 <td>500</td>
                                                            </tr>
                                                            <tr>
                                                                 <td colspan="4">
                                                                      <div style="justify-content: space-between;display:flex">
                                                                           <p> Total</p>
                                                                           <h1>1000</h1>
                                                                      </div>
                                                                 </td>
                                                            </tr>
                                                       </tbody>
                                                  </table>
                                             </div>
                                        </div>

                                   </div>
                              </div>

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