<!-- <?php

        $title_for_layout = ' Admin -' . 'Catalogue';
        $page_for_layout = 'Catalogue';
        $action_for_layout = 'Ajouter';

        if ($this->request->action == "index") {
            $position = "Tout";
        } else {
            $position = $this->request->action;
        }
        $position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script>
                                        window.onload = function () {
                                            document.getElementById("detail_recherche").focus();
                                        };
                                    </script>';
        ?> -->



<!-- START RESPONSIVE TABLES -->

<div class="row">
    <div class="col-md-12">
        <div class="panel-body" style="margin-bottom: 20px;background-color: #fff;
        border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);">
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;margin-bottom:0px">
                <label class="control-label" style="margin-right: 30px;width: 150px;">Recherche d'un médicament:</label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <input type="text" class="form-control col-md-4" name="nom" id="detail_recherche" value="" placeholder="Médicaments">
                </div>
                <div style="width: 150px;">
                </div>
            </div>
            <div class="form-group" style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <label class="control-label" style="margin-right: 30px;width: 150px;"></label>
                <div style="display: flex;flex:1;margin-right: 30px;">
                    <div>

                        <div class="panel-body panel-body-table">

                            <div class="table-responsive">
                                <table id="tab_produit_detail" style="display: block;height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
                                    <thead>
                                        <tr>
                                            <th width="800">Nom</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tab_produit_detail_data">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div style="width: 150px;">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table">
                <div class="panel-body">
                    <div class="panel panel-default tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Vente</a></li>
                            <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Commande</a></li>
                            <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false">Gestion de stock</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane panel-body active" id="tab1">
                                <div class="block">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table" id="produit_detail_a">

                                                    <div class="panel-body">
                                                        <table class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <th width="100">Nom</th>
                                                                    <th width="100">Nombre de vente du mois</th>
                                                                    <th width="100">Nombre de vente total</th>
                                                                    <th width="200">Quantité en stock</th>
                                                                    <th width="100">Reduction</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_detail_a">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table" id="produit_detail_b">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Vente du Mois en cours
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <th width="100">Vente id</th>
                                                                    <th width="100">En rayon</th>
                                                                    <th width="200">Prix unitaire</th>
                                                                    <th width="200">Quantité</th>
                                                                    <th width="100">Reduction</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_detail_b">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane panel-body" id="tab2">
                                <div class="block">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table" id="produit_commande_detail_a">

                                                    <div class="panel-body">
                                                        <table class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <th width="100">Nom</th>
                                                                    <th width="100">Nombre de Commande du mois</th>
                                                                    <th width="100">Nombre de Commande total</th>
                                                                    <th width="200">Quantité en stock</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_commande_detail_a">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body panel-body-table" id="produit_commande_detail_b">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Commande du Mois en cours
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <th width="100">Produit id</th>
                                                                    <th width="100">Commande id</th>
                                                                    <th width="200">Prix public</th>
                                                                    <th width="200">Quantite commande</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_commande_detail_b">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane panel-body" id="tab3">
                                <div class="block">

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>