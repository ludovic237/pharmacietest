<!-- <?php

        $title_for_layout = ' Admin -' . 'Catalogue';
        $page_for_layout = 'Catalogue';
        $action_for_layout = 'Ajouter';
        if (isset($id)) {
            $add_script = '<script>load_produit_detail(' . $id . ')</script>';
        } else {
            $add_script = '';
        }

        if ($this->request->action == "index") {
            $position = "Tout";
        } else {
            $position = $this->request->action;
        }
        $position_for_layout = '<li><a href="#">Catalogue</a></li><li class="active">' . $position . '</li>';
        $script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script>
                                        window.onload = function () {
                                            document.getElementById("detail_recherche").focus();
                                        };
                                        
                                    </script>' . $add_script;
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
                                <table id="tab_produit_detail" style="display: block;max-height: 200px;overflow: auto;" class="table table-bordered table-striped table-actions">
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
<div class="row" id="detailTab">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body panel-body-table">
                <div class="panel-body">
                    <div class="panel panel-default tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Vente</a></li>
                            <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Commande</a></li>
                            <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false">Gestion de stock</a></li>
                            <li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false">Sortie</a></li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane panel-body active" id="tab1">
                                <div class="block">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" >

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <table id="produit_detail_a" class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <th width="100">Nom</th>
                                                                    <th width="100">Nombre de vente du mois</th>
                                                                    <th width="100">Nombre de vente total</th>
                                                                    <th width="200">Quantité en stock</th>
                                                                    <th width="100">Reduction</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody >

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" >

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Vente du Mois en cours
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_detail_b" class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <th width="100">Vente id</th>
                                                                    <th width="100">Date et heure</th>
                                                                    <th width="100">En rayon</th>
                                                                    <th width="200">Prix unitaire</th>
                                                                    <th width="200">Quantité</th>
                                                                    <th width="100">Reduction</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

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
                                            <div class="panel panel-default" >

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <table id="produit_commande_detail_a" class="table datatable table-bordered table-striped table-actions">
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
                                            <div class="panel panel-default" >

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Commande du Mois en cours
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_commande_detail_b" class="table datatable table-bordered table-striped table-actions">
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" id="produit_stock_detail_a">

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <h1>Stock total :
                                                            <span id="tab_produit_stock_detail_a">
                                                            </span>
                                                        </h1>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" >

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Entrée en rayon
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_stock_detail_b" class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <th width="100">Nom</th>
                                                                    <th width="100">Fournisseur id</th>
                                                                    <th width="200">Date livraison</th>
                                                                    <th width="200">Date peremption</th>
                                                                    <th width="200">Prix achat</th>
                                                                    <th width="200">Prix vente</th>
                                                                    <th width="200">Quantité restante</th>
                                                                    <th width="200">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tab_produit_stock_detail_b">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane panel-body" id="tab4">
                                <div class="block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" id="produit_stock_detail_sortie_a">

                                                <div class="panel-body panel-body-table">

                                                    <div class="panel-body">
                                                        <h1>Stock total :
                                                            <span id="tab_produit_stock_detail_sortie_a">
                                                            </span>
                                                        </h1>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default" >

                                                <div class="panel-body panel-body-table">

                                                    <div style="padding: 10px 20px;background-color: #2d3945;color: white;display:flex;justify-content: space-between;align-items: center;">
                                                        <h1 style="color:#fff">
                                                            Sortie
                                                        </h1>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="produit_stock_detail_sortie_b" class="table datatable table-bordered table-striped table-actions">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th width="200">Nom</th> -->
                                                                    <th width="100">Date de sortie</th>
                                                                    <th width="100">Quantite</th>
                                                                    <th width="200">Id en rayon</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewDetailModif" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Detail</h4> <span id="id"></span>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Prix d'achat:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control erprixachat" name="erprixachat" id="erprixachat" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Prix de vente:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control erprixvente" name="erprixvente" id="erprixvente" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Quantité:</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control erquantite" name="erquantite" id="erquantite" value="" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Date de peremption:</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control erdatePeremption" name="erdatePeremption" id="erdatePeremption" value="" placeholder="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" onclick="save_produit_detail()">Sauvegarder</a>
                <a class="btn btn-primary" data-dismiss="modal">Annuler</a>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->