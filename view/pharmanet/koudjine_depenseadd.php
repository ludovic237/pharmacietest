 <!-- <?php

$title_for_layout = ' ALSAS -' . 'Universités';
// $page_for_layout = ($position == 'Ajouter') ? 'Ajouter un assureur' : 'Modifier un assureur';
$page_for_layout = 'Validation dépénse';
// $action_for_layout = 'Ajouter';

if ($_GET['id']) {
    $id = $_GET['id'];
} else { 
    $id = null;
}

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">about</li>';

$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/noty/jquery.noty.js"></script>
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
<script>
    var idfulldepense = "' . $id . '"
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
?>-->


<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" role="form">
                    <div class="col-md-12">
                        <p>Remplir les champs ci dessous</p>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Type de dépense</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_type" type="number" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Quantite</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_quantite" type="number" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Prix unitaire</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_prixunitaire" type="number" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Date de dépense</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_datedepense" style="line-height: 18px;" type="date" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Object</label>
                            <div class="col-md-6 col-xs-12">
                                <textarea id="depense_objet" class="form-control" rows="5"></textarea>
                                <span class="help-block">Somethink about your life</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Remis à M/Mme</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_remis" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Numéro CNI</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_cni" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Fait le</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_date" style="line-height: 18px;" type="date" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">A</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_lieu" type="text" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Société</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_societe" type="text" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="panel-footer">
                <a href="#" class="panel-refresh-depense btn btn-success">Enregistrer<span class="fa fa-save"></span></a>
            </div>
        </div>


    </div>
</div>