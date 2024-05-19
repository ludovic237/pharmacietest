<?php
$title_for_layout = ' Admin -' . 'Catalogue';
$page_for_layout = ($position == 'Ajouter') ? 'Ajouter un produit detail' : 'Modifier un produit detail;';


if ($this->request->action == "index") {
    $position = "Produit";
} else {
    //$position = $this->request->action; $position
}

$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Catalogue/produitdetail.js"></script>
<script type="text/javascript">

            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    },
                    reference: {
                        required: false,
                    },
                    stockmin: {
                        required: true
                    },
                    stockmax: {
                        required: true,
                    },
                    stock: {
                        required: true,
                    },
                    prix: {
                        required: true,
                    },
                    reduction: {
                        required: true
                    }

                }
            });

        </script>';
?>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- START JQUERY VALIDATION PLUGIN -->
                <div class="block">

                    <form id="jvalidate" role="form" class="form-horizontal"
                          action="javascript:enregistrer_produit_detail('<?php echo $position; ?>',
 '<?php if ($position == 'Modifier') echo $produit->id;
                          else echo ""; ?>');">
                        <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Informations
                            générales</h4>
                        <div style="background: white;" class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Référence:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="reference" id="reference"
                                           value="<?php if ($position == 'Modifier') echo $produit->reference; ?>"
                                           placeholder=""/>
                                    <span class="help-block">exemple: AXA - Champ requis</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nom:</label>
                                <div class="col-md-9">
                                    <input type="text" onfocusout="charger_select_produit()" class="form-control"
                                           value="<?php if ($position == 'Modifier') echo $produit->nom; ?>" name="nom"
                                           id="nom" placeholder=""/>
                                    <span class="help-block">Champ requis</span>
                                </div>
                            </div>
                        </div>
                        <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Stock</h4>
                        <div style="background: white;" class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Quantité en stock:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="stock" id="stock"
                                           value="<?php if ($position == 'Modifier') echo $produit->stock;
                                           else echo '0'; ?>" placeholder=""/>
                                    <span class="help-block">exemple: 23 - Champ requis</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Quantité max en stock:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="stockmax" id="stockmax"
                                           value="<?php if ($position == 'Modifier') echo $produit->stockMax;
                                           else echo 10;?>"
                                           placeholder=""/>
                                    <span class="help-block">exemple: 40 - Champ requis</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Quantité min en stock:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control"
                                           value="<?php if ($position == 'Modifier') echo $produit->stockMin;else echo 2; ?>"
                                           name="stockmin" id="stockmin" placeholder=""/>
                                    <span class="help-block">Champ requis - Champ requis</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Réduction Max Appliquable:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control"
                                           value="<?php if ($position == 'Modifier') echo $produit->reductionMax;
                                           else echo 0; ?>" name="reduction" id="reduction" placeholder=""/>
                                    <span class="help-block">Champ requis</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Prix:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control"
                                           value="<?php if ($position == 'Modifier') echo $produit->prix; ?>"
                                           name="prix" id="prix_detail" placeholder=""/>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <!--<div class="form-group">
            <label class="col-md-3 control-label">Date de péremption:</label>
            <div class="col-md-9 col-xs-12">
                <div class="input-group ">
                    <input type="text" id="dp-3" class="form-control" value="<?php /* if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->datePeremption != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->datePeremption);echo $date->format('d-m-Y');}} */ ?>" data-date="<?php /*if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->datePeremption != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->datePeremption);echo $date->format('d-m-Y');}} */ ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Date de commande:</label>
            <div class="col-md-9">
                <div class="input-group ">
                    <input type="text" id="dp-3" class="form-control" value="<?php /* if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->dateCmd != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->dateCmd);echo $date->format('d-m-Y');}} */ ?>" data-date="<?php /*if($position != 'Modifier') echo date('d-m-Y'); else {if($produit->dateCmd != null) {$date = DateTime::createFromFormat('Y-m-d H:i:s', $produit->dateCmd);echo $date->format('d-m-Y');}} */ ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years"/>
                     <span class="input-group-addon datepicker">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>-->
                        </div>

                        <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                            <h4 style="background-color: #2d3945;color: white;">Grossiste produit </h4>
                            <!--<span>
            <input type="checkbox" id="check_compo-1">
        </span>-->
                        </div>
                        <div style="background: white;" class="panel-body">
                            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                                <label class="col-md-3 control-label" style="margin-right: 30px;width: 150px;">Ajouter un médicament:</label>
                                <div style="display: flex;flex:1;margin-right: 30px;">
                                    <input type="text" class="form-control col-md-9" id="recherche_grossiste" value="" autocomplete="off" placeholder="">
                                </div>
                                <div style="width: 150px;">
                                </div>
                            </div>
                            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                                <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                                <div style="display: flex;flex:1;margin-right: 30px;">

                                    <div class="panel-body panel-body-table" style="width: 100%;" >

                                        <div class="table-responsive">
                                            <table id="tab_Grecherche_grossiste" style="display: block;max-height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                                <thead>
                                                <tr>
                                                    <th style="width: 100%;">Nom</th>
                                                    <th>Contenu</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tab_Brecherche_grossiste">

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div style="width: 150px;">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">

                                        <div class="panel-body panel-body-table">

                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table id="add_grossiste" class="table table-bordered table-striped table-actions">
                                                        <thead>
                                                        <tr>
                                                            <th width="200">Nom</th>
                                                            <th width="100">Contenu Detail</th>
                                                            <th width="100">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tab_grossiste">
                                                        <?php if(isset($grossiste)) foreach ($grossiste as $k => $v) : ?>
                                                            <tr id="<?php echo $v->id; ?>">
                                                                <td><?php echo $v->nom; ?></td>
                                                                <td><?php echo $v->contenuDetail; ?></td>
                                                                <td>
                                                                    <button class="btn btn-default btn-rounded btn-sm" onclick="update_row_produit(<?php echo $v->id; ?>, event)"><span class="fa fa-pencil"></span></button>
                                                                    <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('<?php echo $v->id; ?>', event);"><span class="fa fa-times"></span></button>
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

                            </div>


                            <div class="btn-group pull-right">
                                <a class="btn btn-primary" style="margin-right: 20px"
                                   href="<?php echo Router::url('bouwou/catalogue/produit'); ?>">Annuler</a>
                                <button class="btn btn-success" type="submit">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</div>