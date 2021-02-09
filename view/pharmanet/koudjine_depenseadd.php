<!-- <?php

$title_for_layout = ' ALSAS -' . 'Pharmanet';
// $page_for_layout = ($position == 'Ajouter') ? 'Ajouter un assureur' : 'Modifier un assureur';
$page_for_layout = 'Validation dépénse';
// $action_for_layout = 'Ajouter';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}

if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Pharmanet</a></li><li class="active">Depense</li>';

$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/fileinput/fileinput.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>

<script>
    var idfulldepense = "' . $id . '"
</script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                 
                }
            });

        </script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Pharmanet/depenseadd.js"></script>';
?>-->


<div class="row">
    <div class="col-md-12">
<div></div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" id="jvalidate" role="form" class="form-horizontal"
                      action="javascript:enregistrer_depense('<?php echo $position; ?>','<?php if ($position == 'Modifier') echo $depense->id; else echo ""; ?>');">
                    <div class="col-md-12">
                        <p>Remplir les champs ci dessous</p>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Type de dépense</label>
                            <div class="col-md-6 col-xs-12">
                                <select class="selectpicker form-control input-xlarge " name="fabproduit"
                                        id="depense_type">
                                    <?php
                                    foreach ($type_depense as $k => $v) : ?>
                                        <option <?php if ($position == 'Modifier') if ($v->id == $depense->typeDepense) echo "selected=\"selected\""; ?>
                                                value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Quantite</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_quantite" name="quantite" type="number"
                                       value="<?php if ($position == 'Modifier') echo $depense->quantite; ?>"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Prix unitaire</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_prixunitaire" name="prix" type="number"
                                       value="<?php if ($position == 'Modifier') echo $depense->prixUnitaire; ?>"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Date de dépense</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_datedepense" style="line-height: 18px;" type="date" name="datedep"
                                       value="<?php if ($position == 'Modifier') echo $depense->dateDepense; ?>"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Object</label>
                            <div class="col-md-6 col-xs-12">
                                <textarea id="depense_objet" data="<?php echo $_SESSION['Users']->id ?>" name="objet"
                                          class="form-control"
                                          rows="5"><?php if ($position == 'Modifier') echo $depense->designation; ?></textarea>
                                <span class="help-block">Objet de la dépense</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Remis à M/Mme</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_remis" type="text"
                                       value="<?php if ($position == 'Modifier') echo $depense->beneficiaire; ?>"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Numéro CNI</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_cni" type="text"
                                       value="<?php if ($position == 'Modifier') echo $depense->numeroCni; ?>"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Fait le</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_date" style="line-height: 18px;" type="date"
                                       value="<?php if ($position == 'Modifier') echo $depense->dateDelivrance; ?>"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">A</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_lieu" type="text"
                                       value="<?php if ($position == 'Modifier') echo $depense->lieuDelivrance; ?>"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Société</label>
                            <div class="col-md-6 col-xs-12">
                                <input id="depense_societe" type="text"
                                       value="<?php if ($position == 'Modifier') echo $depense->societe; ?>"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class=" btn btn-success" type="submit">Enregistrer<span class="fa fa-save"></span>
                        </button>
                    </div>
                </form>

            </div>

        </div>


    </div>
</div>