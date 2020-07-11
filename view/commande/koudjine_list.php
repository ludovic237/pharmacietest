<!-- <?php

        $title_for_layout = ' Admin -' . 'Universités';
        $page_for_layout = 'Liste de commande';
        $action_for_layout = 'Ajouter';

        if ($this->request->action == "index") {
            $position = "Tout";
        } else {
            $position = $this->request->action;
        }
        $position_for_layout = '<li><a href="#">Commande</a></li><li class="active">Liste</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>';
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
                                <th width="100">Date de creation</th>
                                <th width="200">Date de livraison</th>
                                <th width="200">Note</th>
                                <th width="200">Fournisseur</th>
                                <th width="200">Quantite recu</th>
                                <th width="100">Quantite commande</th>
                                <th width="100">Montant recu</th>
                                <th width="100">Montant commande</th>
                                <th width="100">Etat</th>
                                <th width="100">Reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commande as $k => $v) : ?>
                                <tr id="<?php echo $v->id; ?>">
                                    <td><strong><?php echo $v->dateCreation; ?></strong></td>
                                    <td><?php echo $v->dateLivraison; ?></td>
                                    <td><?php echo $v->note; ?></td>
                                    <td>
                                        <?php echo $v->fournisseur_id; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->qtiteCmd; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->qtiteRecu; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->montantCmd; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->montantRecu; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->etat; ?>
                                    </td>
                                    <td>
                                        <?php echo $v->ref; ?>
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
<!-- END RESPONSIVE TABLES -->