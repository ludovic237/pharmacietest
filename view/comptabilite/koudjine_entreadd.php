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
                    produit_id: {
                        required: true
                    },
                    fournisseur_id: {
                        required: true
                    },
                    dateLivraison: {
                        required: true
                    },
                    datePeremption: {
                        required: true
                    },
                    prixAchat: {
                        required: true
                    },
                    prixVente: {
                        required: true
                    },
                    reduction: {
                        required: true
                    },
                    quantite: {
                        required: true
                    },
                    quantiteRestante: {
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
                            <select class="selectpicker form-control input-xlarge " name="produit_id" id="produit_id">
                                <?php
                                foreach ($produit as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier') if ($v->id == $en_rayon->produit_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">founisseur:</label>
                        <div class="col-md-9">
                        <select class="selectpicker form-control input-xlarge " name="fournisseur_id" id="fournisseur_id">
                                <?php
                                foreach ($fournisseur as $k => $v) : ?>
                                    <option <?php if ($position == 'Modifier') if ($v->id == $en_rayon->fournisseur_id) echo "selected=\"selected\""; ?> value="<?php echo $v->id; ?>"><?php echo $v->nom; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
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
                        <label class="col-md-3 control-label">date peremption:</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="datePeremption" id="datePeremption" value="<?php if ($position == 'Modifier') echo $en_rayon->datePeremption; ?>" placeholder="datePeremption" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prix Achat:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="prixAchat" id="prixAchat" value="<?php if ($position == 'Modifier') echo $en_rayon->prixAchat; ?>" placeholder="prixAchat" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Prix Vente:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="prixVente" id="prixVente" value="<?php if ($position == 'Modifier') echo $en_rayon->prixVente; ?>" placeholder="prixVente" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">reduction:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="reduction" id="reduction" value="<?php if ($position == 'Modifier') echo $en_rayon->reduction; ?>" placeholder="reduction" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">quantite:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="quantite" id="quantite" value="<?php if ($position == 'Modifier') echo $en_rayon->quantite; ?>" placeholder="quantite" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Quantite Restante:</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="quantiteRestante" id="quantiteRestante" value="<?php if ($position == 'Modifier') echo $en_rayon->quantiteRestante; ?>" placeholder="quantiteRestante" />
                            <span class="help-block">exemple: Boris Daudga</span>
                        </div>
                    </div>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary" style="margin-right: 20px" href="<?php echo Router::url('bouwou/comptabilite/entre'); ?>">Annuler</a>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>

</div>