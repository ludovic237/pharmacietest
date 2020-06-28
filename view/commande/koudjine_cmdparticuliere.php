<?php

$title_for_layout = ' Admin -' . 'Catalogue';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un entrée' : 'Modifier un entrée';


if ($this->request->action == "index") {
    $position = "Toutes les universités";
} else {
    //$position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript">
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    note: {
                        required: true
                    },
                    fournisseur_id: {
                        required: true
                    },
                    dateLivraison: {
                        required: true
                    },
                    dateCreation: {
                        required: true
                    },
                    qtiteCmd: {
                        required: true
                    },
                    qtiteRecu: {
                        required: true
                    },
                    montantCmd: {
                        required: true
                    },
                    montantRecu: {
                        required: true
                    },
                    etat: {
                        required: true
                    },
                    ref: {
                        required: true
                    },
                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4>
            <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_en_rayon('<?php echo $position; ?>','<?php if ($position == 'Modifier')  echo $en_rayon->id;
                                                                                                                                            else echo ""; ?>');">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">produit:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="note" id="note" value="<?php if ($position == 'Modifier') echo $en_rayon->note; ?>" placeholder="produit" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">founisseur:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="founisseur_id" id="founisseur_id" value="<?php if ($position == 'Modifier') echo $en_rayon->founisseur_id; ?>" placeholder="founisseur" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">date livraison:</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="dateLivraison" id="dateLivraison" value="<?php if ($position == 'Modifier') echo $en_rayon->dateLivraison; ?>" placeholder="dateLivraison" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">date Creation:</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="dateCreation" id="dateCreation" value="<?php if ($position == 'Modifier') echo $en_rayon->dateCreation; ?>" placeholder="dateCreation" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prix Achat:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="qtiteCmd" id="qtiteCmd" value="<?php if ($position == 'Modifier') echo $en_rayon->qtiteCmd; ?>" placeholder="qtiteCmd" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prix Vente:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="qtiteRecu" id="qtiteRecu" value="<?php if ($position == 'Modifier') echo $en_rayon->qtiteRecu; ?>" placeholder="qtiteRecu" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">montantCmd:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="montantCmd" id="montantCmd" value="<?php if ($position == 'Modifier') echo $en_rayon->montantCmd; ?>" placeholder="montantCmd" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">montantRecu:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="montantRecu" id="montantRecu" value="<?php if ($position == 'Modifier') echo $en_rayon->montantRecu; ?>" placeholder="montantRecu" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Etat:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="etat" id="etat" value="<?php if ($position == 'Modifier') echo $en_rayon->etat; ?>" placeholder="etat" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Reference:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="ref" id="ref" value="<?php if ($position == 'Modifier') echo $en_rayon->ref; ?>" placeholder="ref" />
                            <span class="help-block">exemple: Boris Daudga</span>
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