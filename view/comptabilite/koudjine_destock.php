<?php

$title_for_layout = ' Admin -' . 'Comptabilité';
$position = "Sortie";

$position_for_layout = '<li><a href="#">Comptabilité</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/sortie.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/functions.js"></script>';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouvelle sortie</h4>
            <form id="" role="form" class="form-horizontal">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Entrée Produit:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="nom" id="recherche" value="<?php if (isset($entree)) echo $entree; ?>" placeholder="Nom" />
                        </div>
                    </div>
                    <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                        <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                        <div style="display: flex;flex:1;margin-right: 30px;">
                            <div>

                                <div class="panel-body panel-body-table">

                                    <div class="">
                                        <table id="tab_Grecherche" style="display: block;height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                            <thead>
                                            <tr>
                                                <th width="200">Nom</th>
                                                <th width="100">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tab_Brecherche" >

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div style="width: 150px;">

                        </div>
                    </div>
                    <div  class="row">
                        <div class="col-md-6 control-label">
                            <label class="col-md-3 control-label">Selectionner parrain:</label>
                            <div class="col-md-9">
                                <select class="form-control question selectpicker" name="question" id="ort_question">
                                    <option value="0">Perimée</option>
                                    <option value="1">Expiré</option>
                                    <option value="2">Sortie</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 control-label">
                            <table class="table datatable table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th width="100">Prix</th>
                                        <th width="100">Quantité en stock</th>
                                        <th width="100">Quantité à convertir</th>
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
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary" style="margin-right: 20px" href="<?php echo Router::url('bouwou/catalogue/assureur'); ?>">Annuler</a>
                        <button class="btn btn-success" type="submit">Enregistrer</button>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>

</div>