<!-- <?php

     $title_for_layout = ' ALSAS -' . 'Comptabilite';
     $page_for_layout = 'Caisse ouverte par : ' . $employe->nom;
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
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>';
     if (isset($caisse) && $caisse == null) {
          $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisse").modal("show"); });</script>';
     }
     if (isset($caisseCheck) && $caisseCheck != null) {
          $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisseFermer").modal("show"); });</script>';
     }
     ?> -->




<!-- START RESPONSIVE TABLES -->

<div class="row">
     <div class="col-md-12">
          <div class="panel panel-default">

               <div class="panel-body panel-body-table">

                    <div class="panel-body">
                         <div style="justify-content:space-evenly;display:flex; margin-bottom: 10px;">
                              <button class="btn btn-primary  pull-left" data="" id="" onclick="close_caisse_row()">Fermer caisse</button>

                              <button class="btn btn-primary  pull-right" data="" id="" onclick="rafraichir_vente('<?php echo $caisse->id; ?>')">Rafraichir</button>
                              <button class="btn btn-primary btn-rounded  pull-right" data="" id="" onclick="liste_caisse('<?php echo $caisse->id; ?>')">Afficher vente</button>
                         </div>
                         <div class="table-responsive">
                              <table class="table   table-bordered table-striped table-actions" id="">
                                   <thead>
                                        <tr>
                                             <th width="100">Prix Total</th>
                                             <th width="100">Reduction</th>
                                             <th width="100">Réference</th>
                                             <th>Info Clients</th>
                                             <th>Vendeur</th>
                                             <th>Commentaire</th>
                                             <th>Date vente</th>
                                             <th width="100">Actions</th>
                                        </tr>
                                   </thead>
                                   <tbody id="tab_caisse">
                                        <?php if (isset($vente)) {
                                             foreach ($vente as $k => $v) : ?>
                                                  <tr id="<?php echo $v->id; ?>">
                                                       <td><strong class='prixtotal'><?php echo $v->prixTotal; ?></strong></td>
                                                       <td class="reduction"><?php echo $v->reduction; ?></td>
                                                       <td><?php echo $v->reference; ?></td>
                                                       <td><?php echo $v->nouveau_info; ?></td>
                                                       <td><?php //echo $v->nouveau_info; 
                                                            ?></td>
                                                       <td>
                                                            <?php echo $v->commentaire; ?>
                                                       </td>
                                                       <td>
                                                            <?php echo $v->dateVente; ?>
                                                       </td>
                                                       <td>
                                                            <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="charger_vente(<?php echo $v->id; ?>)">
                                                                 Charger
                                                            </button>
                                                       </td>
                                                  </tr>
                                        <?php endforeach;
                                        } ?>
                                   </tbody>
                              </table>
                         </div>

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
                         <div class="table-responsive">
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
     </div>
     <div class="col-md-6">
          <div class="panel panel-default">
               <div class="panel-body panel-body-table">
                    <div class="panel-body">
                         <div style="display: flex;align-items: center;justify-content: space-evenly;">
                              <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;" id="fen_facture" data="">Montant facture</h4>
                              <div>
                                   <h2><span id="facture_caisse" data="">0</span> F CFA</h2>
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
                                             <div class="panel-body">

                                                  <div class="form-group row">
                                                       <label class="col-md-3 control-label">Montant en caissé:</label>
                                                       <div class="col-md-9">
                                                            <input type="number" class="form-control montant" value="" placeholder="" />
                                                            <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                       </div>
                                                  </div>
                                                  <div class="form-group row">
                                                       <label class="col-md-3 control-label">Rendu</label>
                                                       <div class="col-md-9">
                                                            <input type="number" style="color: #383838;" disabled class="form-control reste" value="" placeholder="" />
                                                            <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                       </div>
                                                  </div>
                                                  <div class="btn-group pull-right">
                                                       <button class="btn btn-primary" style="margin-right: 20px">Annuler</button>
                                                       <button class="btn btn-success" style="margin-right: 20px" onclick="valider_facture('Espèce','tab1', '<?php echo $action_fermeture->id; ?>', false)">Valider</button>
                                                       <button class="btn btn-success" onclick="valider_facture('Espèce','tab1','<?php echo $action_fermeture->id; ?>', true)">Imprimer</button>
                                                  </div>
                                             </div>
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
                                                            <button class="btn btn-success" style="margin-right: 20px">Valider</button>
                                                            <button class="btn btn-success">Imprimer</button>
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
                                                                 <input type="number" disabled class="form-control" value="" placeholder="" />
                                                                 <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Rendu:</label>
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
<?php if ($_SESSION['Users']->type == 'Administrateur' || $_SESSION['Users']->type == 'Gestionnaire') { ?>


     <div class="row">
          <div class="col-md-12">
               <div class="panel panel-default">

                    <div class="panel-body panel-body-table">

                         <div class="panel-body">
                              <div class="table-responsive">
                                   <table class="table   table-bordered table-striped table-actions" id="">
                                        <thead>
                                             <tr>
                                                  <th>Prix Total</th>
                                                  <th>Etat</th>
                                                  <th>Réference</th>
                                                  <th>Date vente</th>
                                                  <th>Actions</th>
                                             </tr>
                                        </thead>
                                        <tbody id="tab_caisse">
                                             <?php if (isset($vente_credit)) {
                                                  foreach ($vente_credit as $k => $v) : ?>
                                                       <tr id="<?php echo $v->id; ?>">
                                                            <td><strong class='prixtotal'><?php echo $v->prixTotal; ?></strong></td>
                                                            <td class="etat"><?php echo $v->etat; ?></td>
                                                            <td><?php echo $v->reference; ?></td>
                                                            <td>
                                                                 <?php echo $v->dateVente; ?>
                                                            </td>
                                                            <td>
                                                                 <button class="btn btn-primary btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" onclick="envoyer_en_caisse(<?php echo $v->id; ?>,<?php echo $action_fermeture->id; ?>)">
                                                                      Envoyer en caisse
                                                                 </button>
                                                            </td>
                                                       </tr>
                                             <?php endforeach;
                                             } ?>
                                        </tbody>
                                   </table>
                              </div>

                         </div>

                    </div>
               </div>

          </div>
     </div>
<?php } ?>

<!-- END RESPONSIVE TABLES -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewCaisse" tabindex="-1" role="dialog" aria-hidden="false">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="">Ouvrir Caisse</h4>
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
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_1" placeholder=""></td>
                                                                 <td>500</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_2" placeholder=""></td>
                                                                 <td>10000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_3" placeholder=""></td>
                                                                 <td>100</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_4" placeholder=""></td>
                                                                 <td>5000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_5" placeholder=""></td>
                                                                 <td>50</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_6" placeholder=""></td>
                                                                 <td>2000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_7" placeholder=""></td>
                                                                 <td>25</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_8" placeholder=""></td>
                                                                 <td>1000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_9" placeholder=""></td>
                                                                 <td>10</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control argent x" value="0" id="argent_10" placeholder=""></td>
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
                    <button type="button" class="btn btn-success" style="margin-right: 20px;" onclick="close_caisse_row_valide('<?php echo $_SESSION["Users"]->id; ?>')">Valider</button>
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
                    <h4 class="modal-title">Fermer Caisse</h4>
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
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent1 x" data="1" value="0" id="fargent_1" placeholder=""></td>
                                                                 <td>500</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent6 x" data="6" value="0" id="fargent_2" placeholder=""></td>
                                                                 <td>10000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent2 x" data="2" value="0" id="fargent_3" placeholder=""></td>
                                                                 <td>100</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent7 x" data="7" value="0" id="fargent_4" placeholder=""></td>
                                                                 <td>5000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent3 x" data="3" value="0" id="fargent_5" placeholder=""></td>
                                                                 <td>50</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent8 x" data="8" value="0" id="fargent_6" placeholder=""></td>
                                                                 <td>2000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent4 x" data="4" value="0" id="fargent_7" placeholder=""></td>
                                                                 <td>25</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent9 x" data="9" value="0" id="fargent_8" placeholder=""></td>
                                                                 <td>1000</td>
                                                            </tr>
                                                            <tr>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent5 x" data="5" value="0" id="fargent_9" placeholder=""></td>
                                                                 <td>10</td>
                                                                 <td class="inputcountdisable"><input type="number" class="form-control fargent fargent10 x" data="10" value="0" id="fargent_10" placeholder=""></td>
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
                    <button type="button" class="btn btn-success" style="margin-right: 20px; " onclick="valider_fermeture('<?php echo $action_fermeture->id; ?>')">Valider</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div>

<!-- END MODAL ICON PREVIEW -->

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewFacture" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Produit</h4>
               </div>
               <div class="modal-body">
                    <div class="row">
                         <div class="col-md-4">
                              <div class="icon-preview">
                                   <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;" class="ticketfacture" id="ticketCaisse">

                                        <div style="display: flex;flex-direction:column;text-align: left;">
                                             <p style="margin: 0px; color: black;font-weight: 400;">Pharmacie ALSAS</p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">Dr GAMWO Sandrine</p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">BP 38 FOUMBOT</p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">Tel :(+237) 233 267 487</p>
                                             <div style="display: flex;justify-content:space-between">
                                                  <p style="margin: 0px; color: black;font-weight: 400;">Ticket N°: <span class="reference"></span></p>
                                                  <p style="margin: 0px; color: black;font-weight: 400;"><span class="datevente"></span> à <span class="heurevente"></span> </p>
                                             </div>
                                             <p style="margin: 0px; color: black;font-weight: 400;">Vendeur: <span class="vendeur"></span> </p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">Acheteur: <span class="acheteur"></span> </p>
                                        </div>
                                        <div>
                                             <table class="table table-bordered table-striped table-actions table-responsive">
                                                  <thead>
                                                       <tr>
                                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="200">Libelle</th>
                                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Prix U.</th>
                                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Qte</th>
                                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Total</th>
                                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px;  border-color: #333;border-width: 1px;border-style: solid;text-align: start;" width="100">Rd(%)</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody id="tab_BfactureImprimer">

                                                       <tr>
                                                            <td colspan="3" style=" background-color: white;color: black;font-weight: 400;text-align: end;" scope="row">Montant Total</td>
                                                            <td colspan="2" style=" background-color: white;color: black;font-weight: 400;text-align: end;"><span class="montanttotal"></span> FCFA</td>
                                                       </tr>
                                                       <tr>
                                                            <td colspan="3" style=" background-color: white;color: black;font-weight: 400;text-align: end;" scope="row">Remise</td>
                                                            <td colspan="2" style=" background-color: white;color: black;font-weight: 400;text-align: end;"><span class="remise"></span> FCFA</td>
                                                       </tr>
                                                       <tr>
                                                            <td colspan="3" style=" background-color: white;color: black;font-weight: 400;text-align: end;" scope="row">Net à payer</td>
                                                            <td colspan="2" style=" background-color: white;color: black;font-weight: 400;text-align: end;"><span class="netapayer"></span> FCFA</td>
                                                       </tr>
                                                  </tbody>
                                             </table>
                                        </div>
                                        <div style="display: flex;flex-direction:column;text-align: left;">
                                             <p style="margin: 0px; color: black;font-weight: 400;">Payer en espece : <span class="montantpercu"></span> </p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">Montant rendu : <span class="montantrendu"></span> </p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">Ce ticket vaut facture</p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">Merci et bonne santé</p>
                                             <p style="margin: 0px; color: black;font-weight: 400;">NoCT /rtdrstrdsy</p>
                                        </div>
                                   </div>
                                   <button type="button" class="btn btn-circle blue" style="text-align:center; float: left; font-size:10px; margin-top: 20px;" onClick="imprimer_bloc('ticket','ticket')"><i class="fa fa-print" style="font-size:10px"></i>&nbsp;Imprimer</button>
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
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewListeCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Caisse</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">

                            <div class="panel-body panel-body-table">

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="tab_load_produit_caisse" style="height: 200px;overflow: auto;" class="table table-bordered table-actions">
                                            <thead>
                                            <tr>
                                                <th width="100">Montant</th>
                                                <th width="200">Montant percu</th>
                                                <th width="200">Date de vente</th>
                                                <th width="100">Etat</th>
                                                <th width="100">Ref</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tab_Bload_produit_caisse">

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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->