<!-- <?php

     $title_for_layout = ' Admin -' . 'Comptabilite';
     $page_for_layout = 'Caisse ouverte par : '.$employe->nom;
     if(isset($employe)) echo 'passe';

     if ($this->request->action == "index") {
          $position = "Tout";
     } else {
          $position = $this->request->action;
     }
     $position_for_layout = '<li><a href="#">Comptabilite</a></li><li class="active">' . $position . '</li>';
     $script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
     if(isset($caisse) && $caisse == null){
         $script_for_layout = $script_for_layout.'<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisse").modal("show"); });</script>';
     }
     ?> -->



<!-- START RESPONSIVE TABLES -->
<div class="row">
     <div class="col-md-12">
          <div class="panel panel-default">

               <div class="panel-body panel-body-table">

                    <div class="panel-body">
                         <div style="justify-content:space-evenly;display:flex; margin-bottom: 10px;">
                              <button class="btn btn-primary  pull-right" data="" id="" onclick="close_caisse_row()">Fermer caisse</button>

                              <button class="btn btn-primary  pull-right"  data="" id="" onclick="rafraichir_vente('<?php echo $caisse->id; ?>')">Rafraichir</button>
                         </div>
                         <table class="table   table-bordered table-striped table-actions" id="">
                              <thead>
                                   <tr>
                                        <th width="100">Prix Total</th>
                                        <th width="100">Reduction</th>
                                        <th>Type</th>
                                        <th>Info Clients</th>
                                        <th>Commentaire</th>
                                        <th>Date vente</th>
                                        <th width="100">Actions</th>
                                   </tr>
                              </thead>
                              <tbody id="tab_caisse">
                              <?php if(isset($vente)){ foreach ($vente as $k => $v) : ?>
                                  <tr id="<?php echo $v->id; ?>">
                                      <td><?php echo $v->prixTotal; ?></td>
                                      <td><?php echo $v->reduction; ?></td>
                                      <td><?php echo $v->etat; ?></td>
                                      <td><?php echo $v->nouveau_info; ?></td>
                                      <td>
                                          <?php echo $v->commentaire; ?>
                                      </td>
                                      <td>
                                          <?php echo $v->dateVente; ?>
                                      </td>
                                      <td>
                                          <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="load_vente(<?php echo $v->id; ?>)">
                                              Charger
                                          </button>
                                      </td>
                                  </tr>
                              <?php endforeach; } ?>
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
                         <table class="table  table-bordered table-striped table-actions">
                              <thead>
                                   <tr>
                                        <th width="200">Nom</th>
                                        <th width="100">Prix Unitaire</th>
                                        <th width="100">Quantité</th>
                                        <th width="100">Prix Total</th>
                                        <th width="100">Reduction</th>
                                   </tr>
                              </thead>
                              <tbody id="tab_vente_caisse">

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
                                             <form role="form" class="form-horizontal">
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
                                             <form role="form" class="form-horizontal">
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
                                             <form role="form" class="form-horizontal">
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
                                             <form role="form" class="form-horizontal">
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


<!-- END RESPONSIVE TABLES -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewCaisse" tabindex="-1" role="dialog" aria-hidden="false">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="">Caisse</h4>
               </div>
               <div class="modal-body" style="padding: 0px;">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="panel panel-default" style="margin-bottom: 0px;">

                                   <div class="panel-body panel-body-table">

                                        <div class="panel-body" style="display: flex;flex-direction: column;padding: 0px;">
                                             <!-- <div style="display: flex;align-items: center;">
                                                  <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Session caisse</h4>
                                             </div> -->
                                             <div>
                                                  <div class="form-group row">
                                                       <label class="col-md-3 control-label">Session:</label>
                                                       <div class="col-md-9">
                                                            <select class="form-control input-xlarge select2me session" name="session" required="">
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
                                                  <table class="table  table-bordered table-striped table-actions">
                                                       <thead>
                                                            <tr>
                                                                 <th width="150" colspan="2">Piece</th>
                                                                 <th width="150" colspan="2">Billets</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                            <tr>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_1" placeholder=""></td>
                                                                 <td>500</td>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_2" placeholder=""></td>
                                                                 <td>10000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_3" placeholder=""></td>
                                                                 <td>100</td>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_4" placeholder=""></td>
                                                                 <td>5000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_5" placeholder=""></td>
                                                                 <td>50</td>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_6" placeholder=""></td>
                                                                 <td>2000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_7" placeholder=""></td>
                                                                 <td>25</td>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_8" placeholder=""></td>
                                                                 <td>1000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_9" placeholder=""></td>
                                                                 <td>10</td>
                                                                 <td><input type="number" class="form-control argent x" value="0" id="argent_10" placeholder=""></td>
                                                                 <td>500</td>
                                                            </tr>
                                                            <tr>
                                                                 <td>
                                                                      <h6>
                                                                           Sous total
                                                                      </h6>
                                                                 </td>
                                                                 <td>
                                                                      <h6 style="margin-bottom: 0px;"><span class="soustotalaisse1">0</span></h6>
                                                                 </td>
                                                                 <td>
                                                                      <h6>
                                                                           Sous total
                                                                      </h6>
                                                                 </td>
                                                                 <td>
                                                                      <h6 style="margin-bottom: 0px;"><span class="soustotalaisse2">0</span></h6>
                                                                 </td>
                                                            </tr>
                                                            <tr>
                                                                 <td colspan="4">
                                                                      <div style="justify-content: space-between;display:flex">
                                                                           <p style="margin-bottom: 0px;"> Total</p>
                                                                           <h4 style="margin-bottom: 0px;"><span class="totalaisse">0</span></h4>
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
                    <button type="button" class="btn btn-success" style="margin-right: 20px;" onclick="close_caisse_row_valide('<?php echo $_SESSION["Users"]->int; ?>')">Valider</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>
<!-- END MODAL ICON PREVIEW -->


<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewCaisseFermer" tabindex="-1" role="dialog" aria-hidden="false">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Caisse</h4>
               </div>
               <div class="modal-body" style="padding: 0px;">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="panel panel-default" style="margin-bottom: 0px;">

                                   <div class="panel-body panel-body-table">

                                        <div class="panel-body" style="display: flex;flex-direction: column;padding: 0px;">
                                             <!-- <div style="display: flex;align-items: center;">
                                                  <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Session caisse</h4>
                                             </div> -->

                                             <div style="display: flex;align-items: center;">
                                                  <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Fond de caisse</h4>
                                             </div>
                                             <div>
                                                  <table class="table  table-bordered table-striped table-actions">
                                                       <thead>
                                                            <tr>
                                                                 <th width="150" colspan="2">Piece</th>
                                                                 <th width="150" colspan="2">Billets</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                            <tr>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_1" placeholder=""></td>
                                                                 <td>500</td>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_2" placeholder=""></td>
                                                                 <td>10000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_3" placeholder=""></td>
                                                                 <td>100</td>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_4" placeholder=""></td>
                                                                 <td>5000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_5" placeholder=""></td>
                                                                 <td>50</td>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_6" placeholder=""></td>
                                                                 <td>2000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_7" placeholder=""></td>
                                                                 <td>25</td>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_8" placeholder=""></td>
                                                                 <td>1000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_9" placeholder=""></td>
                                                                 <td>10</td>
                                                                 <td><input type="number" class="form-control fargent x" value="0" id="fargent_10" placeholder=""></td>
                                                                 <td>500</td>
                                                            </tr>
                                                            <tr>
                                                                 <td>
                                                                      <h6>
                                                                           Sous total
                                                                      </h6>
                                                                 </td>
                                                                 <td>
                                                                      <h6 style="margin-bottom: 0px;"><span class="fsoustotalaisse1">0</span></h6>
                                                                 </td>
                                                                 <td>
                                                                      <h6>
                                                                           Sous total
                                                                      </h6>
                                                                 </td>
                                                                 <td>
                                                                      <h6 style="margin-bottom: 0px;"><span class="fsoustotalaisse2">0</span></h6>
                                                                 </td>
                                                            </tr>
                                                            <tr>
                                                                 <td colspan="4">
                                                                      <div style="justify-content: space-between;display:flex">
                                                                           <p style="margin-bottom: 0px;"> Total</p>
                                                                           <h4 style="margin-bottom: 0px;"><span class="ftotalaisse">0</span></h4>
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
                    <button type="button" class="btn btn-success" style="margin-right: 20px; " onclick="valider_fermeture('<?php echo $caisse->id; ?>')">Valider</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>
<!-- END MODAL ICON PREVIEW -->