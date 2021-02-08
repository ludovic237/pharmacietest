<?php

$title_for_layout = ' ALSAS -' . 'Universités';
// $page_for_layout = ($position == 'Ajouter') ? 'Ajouter un assureur' : 'Modifier un assureur';
$page_for_layout = 'Configuration';
// $action_for_layout = 'Ajouter';

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Pharmanet</a></li><li class="active">Configuration</li>';

$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/noty/themes/default.js"></script>

<script type="text/javascript">
                function notyConfirm(){
                    noty({
                        text: \'Do you want to continue?\',
                        layout: \'topRight\',
                        buttons: [
                                {addClass: \'btn btn-success btn-clean\', text: \'Ok\', onClick: function($noty) {
                                    $noty.close();
                                    noty({text: \'You clicked "Ok" button\', layout: \'topRight\', type: \'success\'});
                                }
                                },
                                {addClass: \'btn btn-danger btn-clean\', text: \'Cancel\', onClick: function($noty) {
                                    $noty.close();
                                    noty({text: \'You clicked "Cancel" button\', layout: \'topRight\', type: \'error\'});
                                    }
                                }
                            ]
                    })
                }
            </script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    region: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    telephone_1: {
                        required: true
                    },
                    ville: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    statut: {
                        required: true
                    },
                    "type[]": "required"

                }
            });

        </script>';
?>


<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">
                <!-- START MASKED INPUT PLUGIN -->
                <div class="block">
                    <h4>Recherche</h4>
                    <form class="form-horizontal" role="form">
                        <div class="col-md-6">

                            <div style="margin-bottom: 15px;" class="form-group">
                                <label class="col-md-3 control-label">Nom employé:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Saisir nom employé"
                                           id="search-employe-box"/>
                                    <div id="suggesstion-employe-box-block">
                                        <div id="suggesstion-employe-box"></div>
                                    </div>

                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Date:</label>
                                <div class="col-md-9">
                                    <div id="reportrangepharmanet" class="dtrange">
                                        <span></span><b class="caret"></b>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div style="margin-bottom: 15px;" class="form-group">
                                <label class="col-md-3 control-label">Catégorie:</label>
                                <div class="col-md-9">
                                    <select class="selectpicker form-control" name="pharmanettype" id="pharmanettype">
                                        <option value="depense">Depense</option>
                                        <option value="caisse">Caisse</option>
                                        <option value="vente">Vente</option>
                                        <option value="commande">Commandé</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END MASKED INPUT PLUGIN -->
            </div>
            <div class="panel-footer">

                <button class="btn btn-success" onclick="pharmanet_recherche_valide()">Recherche <span
                            class="fa fa-search"></span></button>

            </div>
        </div>


    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">
                <!-- START MASKED INPUT PLUGIN -->
                <div class="block">
                    <h4>Recherche</h4>
                    <form class="form-horizontal" role="form">
                        <div class="ts-button"><span class="fa fa-cog fa-spin"></span></div>
                        <div class="ts-body">
                            <div class="ts-title">Options</div>
                            <div class="ts-row"><label class="check">
                                    <div class="icheckbox_minimal-grey" style="position: relative;"><input
                                                type="checkbox" class="icheckbox" name="st_head_fixed" value="1"
                                                style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Fixed Header</label></div>
                            <div class="ts-row"><label class="check">
                                    <div class="icheckbox_minimal-grey checked" style="position: relative;"><input
                                                type="checkbox" class="icheckbox" name="st_sb_fixed" value="1"
                                                checked="" style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Fixed Sidebar</label></div>
                            <div class="ts-row"><label class="check">
                                    <div class="icheckbox_minimal-grey checked" style="position: relative;"><input
                                                type="checkbox" class="icheckbox" name="st_sb_scroll" value="1"
                                                style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Scroll Sidebar</label></div>
                            <div class="ts-row"><label class="check">
                                    <div class="icheckbox_minimal-grey" style="position: relative;"><input
                                                type="checkbox" class="icheckbox" name="st_sb_right" value="1"
                                                style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Right Sidebar</label></div>
                            <div class="ts-row"><label class="check">
                                    <div class="icheckbox_minimal-grey" style="position: relative;"><input
                                                type="checkbox" class="icheckbox" name="st_sb_custom" value="1"
                                                style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Custom Navigation</label></div>
                            <div class="ts-row"><label class="check">
                                    <div class="icheckbox_minimal-grey" style="position: relative;"><input
                                                type="checkbox" class="icheckbox" name="st_sb_toggled" value="1"
                                                style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Toggled Navigation</label></div>
                            <div class="ts-title">Layout</div>
                            <div class="ts-row"><label class="check">
                                    <div class="iradio_minimal-grey checked" style="position: relative;"><input
                                                type="radio" class="iradio" name="st_layout_boxed" value="0" checked=""
                                                style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Full Width</label></div>
                            <div class="ts-row"><label class="check">
                                    <div class="iradio_minimal-grey" style="position: relative;"><input type="radio"
                                                                                                        class="iradio"
                                                                                                        name="st_layout_boxed"
                                                                                                        value="1"
                                                                                                        style="position: absolute; opacity: 0;">
                                        <ins class="iCheck-helper"
                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                                    </div>
                                    Boxed</label></div>
                            <div class="ts-title">Themes</div>
                            <div class="ts-themes"><a href="#" class="active"
                                                      data-theme="/Site/koudjine/css/theme-default.css"><img
                                            src="/Site/koudjine/img/themes/default.jpg"></a><a href="#"
                                                                                               data-theme="/Site/koudjine/css/theme-forest.css"><img
                                            src="/Site/koudjine/img/themes/forest.jpg"></a><a href="#"
                                                                                              data-theme="/Site/koudjine/css/theme-dark.css"><img
                                            src="/Site/koudjine/img/themes/dark.jpg"></a><a href="#"
                                                                                            data-theme="/Site/koudjine/css/theme-night.css"><img
                                            src="/Site/koudjine/img/themes/night.jpg"></a><a href="#"
                                                                                             data-theme="/Site/koudjine/css/theme-serenity.css"><img
                                            src="/Site/koudjine/img/themes/serenity.jpg"></a><a href="#"
                                                                                                data-theme="/Site/koudjine/css/theme-default-head-light.css"><img
                                            src="/Site/koudjine/img/themes/default-head-light.jpg"></a><a href="#"
                                                                                                          data-theme="/Site/koudjine/css/theme-forest-head-light.css"><img
                                            src="/Site/koudjine/img/themes/forest-head-light.jpg"></a><a href="#"
                                                                                                         data-theme="/Site/koudjine/css/theme-dark-head-light.css"><img
                                            src="/Site/koudjine/img/themes/dark-head-light.jpg"></a><a href="#"
                                                                                                       data-theme="/Site/koudjine/css/theme-night-head-light.css"><img
                                            src="/Site/koudjine/img/themes/night-head-light.jpg"></a><a href="#"
                                                                                                        data-theme="/Site/koudjine/css/theme-serenity-head-light.css"><img
                                            src="/Site/koudjine/img/themes/serenity-head-light.jpg"></a></div>
                        </div>
                    </form>
                </div>
                <!-- END MASKED INPUT PLUGIN -->
            </div>
            <div class="panel-footer">

                <button class="btn btn-success" onclick="pharmanet_recherche_valide()">Recherche <span
                            class="fa fa-search"></span></button>

            </div>
        </div>


    </div>
</div>

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
