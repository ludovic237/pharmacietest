<!-- <?php

$title_for_layout = ' Admin -' . 'Catalogue';
$page_for_layout = 'Produit Detail';

if ($this->request->action == "index") {
    $position = "Tout";
} else {
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-blockui/jquery.blockUI.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/myFunction.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Catalogue/functions.js"></script>';
?> -->

<!-- START RESPONSIVE TABLES -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <table class="table datatable table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th width="100">Reference</th>
                            <th width="200">Quantité en stock</th>
                            <th width="250">Produit Grossiste | Contenu Grossite</th>
                            <th width="100">Reduction</th>
                            <th width="100">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; foreach ($catalogue as $k => $v) : ?>
                            <tr id="<?php echo $v->id; ?>">
                                <td><strong><?php echo $v->nom; ?></strong></td>
                                <td><?php echo $v->reference; ?></td>
                                <td><?php echo $v->stock; ?></td>
                                <td>
                                    <?php foreach ($produit_list[$i] as $a => $b):
                                        echo $b->nom. ' | ['. $b->contenuDetail.']';
                                        echo '<br>';
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $v->reductionMax; ?>
                                </td>
                                <td>

                                    <div>
                                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_produitDet(<?php echo $v->id; ?>)">
                                            <span class="fa fa-pencil"></span>
                                        </button>
                                        <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo $v->id; ?>','<?php echo $this->request->controller; ?>','produit_detail');">
                                            <span class="fa fa-times"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- END RESPONSIVE TABLES -->


<!-- END RESPONSIVE TABLES -->


<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <ul class="list-group border-bottom">
                            <h4>Informations Codebarre</h4>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td style="padding: 0px;" colspan="2">
                                        <h4 style="padding: 20px;background-color: #2d3945;color: white;margin-bottom: 0px;">Informations générales</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100">ean13:</td>
                                    <td class="ean13p"></td>
                                </tr>
                                <tr>
                                    <td width="100">Référence:</td>
                                    <td class="referencep"></td>
                                </tr>
                                <tr>
                                    <td width="100">Code Laborex:</td>
                                    <td class="codelaborexp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Code Ubiform:</td>
                                    <td class="codeubiformp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Nom:</td>
                                    <td class="nomp"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px;" colspan="2">
                                        <h4 style="padding: 20px;background-color: #2d3945;color: white;margin-bottom: 0px;">Stock</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100">Quantité en stock:</td>
                                    <td class="stockp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Quantité max en stock:</td>
                                    <td class="stockmaxp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Quantité min en stock:</td>
                                    <td class="stockminp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Réduction Max Appliquable:</td>
                                    <td class="reductionmaxp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Contenu detail:</td>
                                    <td class="contenudetailp"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px;" colspan="2">
                                        <h4 style="padding: 20px;background-color: #2d3945;color: white;margin-bottom: 0px;">Géo</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100">Catégorie:</td>
                                    <td class="categoriep"></td>
                                </tr>
                                <tr>
                                    <td width="100">Rayon:</td>
                                    <td class="rayonp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Etagère:</td>
                                    <td class="etagerep"></td>
                                </tr>
                                <tr>
                                    <td width="100">Magasin:</td>
                                    <td class="magasinp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Forme:</td>
                                    <td class="formep"></td>
                                </tr>
                                <tr>
                                    <td width="100">Fabriquant:</td>
                                    <td class="fabriquantp"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px;" colspan="2">
                                        <h4 style="padding: 20px;background-color: #2d3945;color: white;margin-bottom: 0px;">Détail produit</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100">Produit:</td>
                                    <td class="produitp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Prix detail:</td>
                                    <td class="prixdetailp"></td>
                                </tr>
                                <tr>
                                    <td width="100">Etat:</td>
                                    <td class="etatp"></td>
                                </tr>
                                </tbody>
                            </table>

                        </ul>

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

