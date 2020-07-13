<?php

$title_for_layout = ' Admin -' . 'Stock';
$page_for_layout =  'Inventaire';
if (isset($inventaire) && empty($inventaire)) {
    $action_for_layout = 'Démarrer inventaire';
} else {
    $action_for_layout = 'Terminer inventaire';
}



$position_for_layout = '<li><a href="#">Stock</a></li><li><a href="#">Inventaire</a></li>';
$script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/inventaire.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script>
                                        window.onload = function () {
                                            document.getElementById("recherche_inventaire").focus();
                                        };
                                    </script>
';
if (isset($inventaire) && !empty($inventaire)) {


?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
                <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                    <label class="control-label" style="margin-right: 30px;width: 150px;">Scanner un médicament:</label>
                    <div style="display: flex;flex:1;margin-right: 30px;">
                        <input type="text" class="form-control col-md-4" name="<?php echo $_SESSION['Users']->type; ?>" data="<?php echo $_SESSION['Users']->id; ?>" data1="<?php echo $_SESSION['Users']->identifiant; ?>" id="recherche_inventaire" value="" placeholder="Médicaments">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="div_inventaire">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body panel-body-table">

                    <div class="panel-body">
                        <table class="table datatable table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th width="200">Nom</th>
                                    <th width="100">Prix Unitaire</th>
                                    <th width="100">Quantité avant inventaire</th>
                                    <th width="100">Quantité en cours</th>
                                    <th width="100">Date de Livraison</th>
                                    <th width="100">Inventorié par</th>
                                    <th width="100">Quantité inventaire</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tab_Binventaire">
                                <?php if (isset($produits)) foreach ($produits as $k => $v) :
                                    $datelivraison = $v->dateLivraison;
                                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
                                    $datel = $date->format('d-m-Y');
                                ?>
                                    <tr id="<?php echo $v->en_rayon_id; ?>">
                                        <td><strong><?php echo $v->nom; ?></strong></td>
                                        <td><?php echo $v->prixVente; ?></td>
                                        <td><?php echo $v->stockAvant; ?></td>
                                        <td>
                                            <?php echo $v->quantiteRestante; ?>
                                        </td>
                                        <td>
                                            <?php echo $datel; ?>
                                        </td>
                                        <td><?php echo $v->identifiant; ?></td>
                                        <td><?php echo $v->stockValide; ?></td>
                                        <td>
                                            <button class="btn btn-success btn-rounded btn-sm valider_inventaire" disabled data-toggle="tooltip" data-placement="top" onclick="valider_row_inventaire(<?php echo $v->en_rayon_id; ?>)">
                                                Valider
                                            </button>
                                            <button class="btn btn-primary btn-rounded btn-sm ajouter_inventaire" <?php if ($_SESSION['Users']->type != 'Administrateur') echo 'disabled';  ?> data-toggle="tooltip" data-placement="top" onclick="ajouter_row_inventaire(<?php echo $v->en_rayon_id; ?>)">
                                                Ajouter
                                            </button>
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
<?php } ?>

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewEntree" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form >
                            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Inventaire</h4>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Quantite ajouté:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="identifiant" id="identifiant" value="" placeholder="" />
                                        <span class="help-block">exemple: identifiant - Champ requis</span>
                                    </div>
                                </div>
                            </div>


                            <div class="btn-group pull-right">
                                <button class="btn btn-primary" style="margin-right: 20px">Fermer</button>
                                <button class="btn btn-success" type="submit">valider</button>
                            </div>

                        </form>
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