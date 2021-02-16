<!-- <?php

$title_for_layout = ' ALSAS -' . 'Comptabilite';
$page_for_layout = 'Caisse ouverte par : ' . $employe->nom . ' ' . $employe->prenom;
$action_fermeture = (isset($caisse)) ? $caisse : $caisseCheck;
//if(isset($employe)) echo 'passe';

if ($this->request->action == "index") {
    $position = "Tout";
} else {
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Comptabilite</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '
     <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/qrcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery.fittext.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/jquery-barcode.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/caisse.js"></script>
<script>
var qrcode = new QRCode(document.getElementById("codebarreimp"), {
     width: 30,
     height: 30
 });
                                    </script>
';
if (isset($caisse) && $caisse == null) {
    $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisse").modal("show"); });</script>';
}
if (isset($caisseCheck) && $caisseCheck != null) {
    if ($caisseCheck->etat == "En cours") {
        $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisseFermer").modal("show"); });</script>';
    } else {
        $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(open_rapport());</script>';
    }
}
?> -->


<?php if ($employe->identifiant == $_SESSION['Users']->identifiant || $_SESSION['Users']->type == 'Administrateur' || $_SESSION['Users']->type == 'Gestionnaire') { ?>

    <!-- START RESPONSIVE TABLES -->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body panel-body-table">

                    <div class="panel-body">
                        <div style="justify-content:space-evenly;display:flex; margin-bottom: 10px;">
                            <button class="btn btn-primary  pull-left" data="" id=""
                                    onclick="showRapportTest('<?php echo $caisse->id; ?>')">Test rapport caisse
                            </button>
                            <button class="btn btn-primary  pull-left" data="" id=""
                                    onclick="open_bon_caisse('<?php echo $action_fermeture->id; ?>')">Bon de caisse
                            </button>
                            <!--                              <button class="btn btn-primary  pull-left" data="" id="" onclick="open_rapport('<?php //echo $action_fermeture->id;
                            ?>//')">Rapport</button>-->
                            <button class="btn btn-primary  pull-left" data="" id=""
                                    onclick="open_depense('<?php echo $action_fermeture->id; ?>')">Entrez dépense
                            </button>

                            <button class="btn btn-primary  pull-right" data="" id=""
                                    onclick="rafraichir_vente('<?php echo $caisse->id; ?>')">Rafraichir
                            </button>
                            <button class="btn btn-primary btn-rounded  pull-right" data="" id=""
                                    onclick="liste_caisse('<?php echo $caisse->id; ?>')">Afficher vente
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table   table-bordered table-striped table-actions" id="">
                                <thead>
                                <tr>
                                    <th width="100">Prix Total</th>
                                    <th width="100">Reduction</th>
                                    <th width="100">Réference</th>
                                    <th>Info Clients</th>
                                    <th>Vendeur</th>
                                    <th>Commentaire</th>
                                    <th>Date vente</th>
                                    <th width="100">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tab_caisse">
                                <?php if (isset($vente)) {
                                    foreach ($vente as $k => $v) : ?>
                                        <tr id="<?php echo $v->id; ?>">
                                            <td><strong class='prixtotal'><?php echo $v->prixTotal; ?></strong></td>
                                            <td class="reduction"><?php echo $v->reduction; ?></td>
                                            <td><?php echo $v->reference; ?></td>
                                            <td><?php echo $v->nouveau_info; ?></td>
                                            <td><?php //echo $v->nouveau_info;
                                                ?></td>
                                            <td>
                                                <?php echo $v->commentaire; ?>
                                            </td>
                                            <td>
                                                <?php echo $v->dateVente; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip"
                                                        data-placement="top"
                                                        onclick="charger_vente(<?php echo $v->id; ?>)">
                                                    Charger
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body panel-body-table">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table  table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th width="200">Nom</th>
                                    <th width="100">Prix Unitaire</th>
                                    <th width="100">Quantité</th>
                                    <th width="100">Prix Total</th>
                                    <th width="100">Reduction</th>
                                </tr>
                                </thead>
                                <tbody id="tab_vente_caisse">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body panel-body-table">
                    <div class="panel-body">
                        <div style="display: flex;align-items: center;justify-content: space-evenly;">
                            <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;" id="fen_facture"
                                data="">Montant facture</h4>
                            <div>
                                <!-- <h2><span id="facture_caisse" data="" data1="<?php echo $action_fermeture->id; ?>">0</span> F CFA</h2> -->
                                <h2><span id="facture_caisse" data="">0</span> F CFA</h2>
                            </div>
                        </div>
                        <div class="panel panel-default tabs">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Espèce</a>
                                </li>
                                <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Electronique</a>
                                </li>
                                <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false">Ticket de
                                        caisse</a></li>
                                <li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false">Mixte</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- <div class="tab-pane panel-body active" id="tab1"=""> -->
                                <div class="tab-pane panel-body active" id="tab1">
                                    <div class="block">
                                        <!-- <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4> -->
                                        <div class="panel-body">

                                            <div class="form-group row">
                                                <label class="col-md-3 control-label">Montant en caissé:</label>
                                                <div class="col-md-9">
                                                    <input type="number" id="espececaisse1"
                                                           class="form-control montant caisse Espècecaisse1" data="1"
                                                           data1="Espèce" data2="1" data3="tab1" value=""
                                                           placeholder=""/>
                                                    <!--                                                            <input type="number" class="form-control montant" value="" placeholder="" />-->
                                                    <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 control-label">Rendu</label>
                                                <div class="col-md-9">
                                                    <input type="number" style="color: #383838;font-size:25px" disabled
                                                           class="form-control reste" value="" placeholder=""/>
                                                    <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                </div>
                                            </div>
                                            <div class="btn-group">
                                                <a class="btn btn-primary" style="margin-right: 20px"
                                                   href="<?php echo Router::url('bouwou/comptabilite/caisse'); ?>">Annuler</a>
                                                <button class="btn btn-success" style="margin-right: 20px"
                                                        onclick="valider_facture('Espèce','tab1', '<?php echo $action_fermeture->id; ?>', false)">
                                                    Valider
                                                </button>
                                                <button class="btn btn-success"
                                                        onclick="valider_facture('Espèce','tab1','<?php echo $action_fermeture->id; ?>', true)">
                                                    Imprimer
                                                </button>
                                            </div>
                                        </div>
                                        <!-- END JQUERY VALIDATION PLUGIN -->
                                    </div>
                                </div>
                                <div class="tab-pane panel-body" id="tab2">
                                    <div class="block">
                                        <div class="panel-body" style="display: flex;flex-direction: column;">

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Numéro de téléphone:</label>
                                                <div class="col-md-9">
                                                    <input type="number" id="Electroniquecaisse1"
                                                           class="form-control telephone caisse Electroniquecaisse1"
                                                           data="1" data1="Electronique" data2="2" data3="tab2" value=""
                                                           placeholder=""/>
                                                    <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Montant:</label>
                                                <div class="col-md-9">
                                                    <input type="number" id="Electroniquecaisse2"
                                                           class="form-control montant caisse Electroniquecaisse2"
                                                           data="2" data1="Electronique" data2="2" data3="tab2" value=""
                                                           placeholder=""/>
                                                    <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Frais:</label>
                                                <div class="col-md-9">
                                                    <input type="number" disabled class="form-control" value=""
                                                           placeholder=""/>
                                                    <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Rendu:</label>
                                                <div class="col-md-9">
                                                    <input type="number" style="color: #383838;font-size:25px" disabled
                                                           class="form-control reste" value="" placeholder=""/>
                                                    <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                </div>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <a class="btn btn-primary" style="margin-right: 20px"
                                                   href="<?php echo Router::url('bouwou/comptabilite/caisse'); ?>">Annuler</a>
                                                <button class="btn btn-success"
                                                        onclick="valider_facture('Electronique','tab2','<?php echo $action_fermeture->id; ?>', false)"
                                                        style="margin-right: 20px">Valider
                                                </button>
                                                <button class="btn btn-success"
                                                        onclick="valider_facture('Electronique','tab2','<?php echo $action_fermeture->id; ?>', true)">
                                                    Imprimer
                                                </button>
                                            </div>
                                        </div>
                                        <!-- END JQUERY VALIDATION PLUGIN -->
                                    </div>
                                </div>
                                <div class="tab-pane panel-body" id="tab3">
                                    <div class="block">
                                        <!-- <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4> -->
                                        <form role="form" class="form-horizontal">
                                            <div class="panel-body">

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Numéro de ticket:</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" value=""
                                                               placeholder=""/>
                                                        <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Montant:</label>
                                                    <div class="col-md-9">
                                                        <input type="number" disabled class="form-control" value=""
                                                               placeholder=""/>
                                                        <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Rendu:</label>
                                                    <div class="col-md-9">
                                                        <input type="number" style="color: #383838;font-size:25px"
                                                               disabled class="form-control" value="" placeholder=""/>
                                                        <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                    </div>
                                                </div>
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary" style="margin-right: 20px"
                                                       href="<?php echo Router::url('bouwou/comptabilite/caisse'); ?>">Annuler</a>
                                                    <button class="btn btn-success" type="submit"
                                                            style="margin-right: 20px">Valider
                                                    </button>
                                                    <button class="btn btn-success" type="submit">Imprimer</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END JQUERY VALIDATION PLUGIN -->
                                    </div>
                                </div>
                                <div class="tab-pane panel-body" id="tab4">
                                    <div class="block">
                                        <!-- <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Nouveau entrée</h4> -->
                                        <form role="form" class="form-horizontal">
                                            <div class="panel-body">
                                                <div>
                                                    <div style="background-color: #2d3945;color: white;width: 100%;padding:10px">
                                                        <p style="color: white;margin-bottom: 0px">Espèce</p>
                                                    </div>
                                                    <div style="border-style: solid;padding: 10px;border-width: 1px;margin-bottom: 10px;">

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Montant:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" value=""
                                                                       placeholder="">
                                                                <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div style="background-color: #2d3945;color: white;width: 100%;padding:10px">
                                                        <p style="color: white;margin-bottom: 0px">Electronique</p>
                                                    </div>
                                                    <div style="border-style: solid;padding: 10px;border-width: 1px;margin-bottom: 10px;">

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Numéro de
                                                                téléphone:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" value=""
                                                                       placeholder="">
                                                                <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Montant:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" value=""
                                                                       placeholder="">
                                                                <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Frais:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" value=""
                                                                       placeholder="">
                                                                <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div style="background-color: #2d3945;color: white;width: 100%;padding:10px">
                                                        <p style="color: white;margin-bottom: 0px">Ticket de caisse</p>
                                                    </div>
                                                    <div style="border-style: solid;padding: 10px;border-width: 1px;margin-bottom: 10px;">

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Numéro ticket:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" value=""
                                                                       placeholder="">
                                                                <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Montant:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" value=""
                                                                       placeholder="">
                                                                <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Total encaissé:</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" value=""
                                                               placeholder="">
                                                        <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Rendu:</label>
                                                    <div class="col-md-9">
                                                        <input type="number" style="color: #383838;font-size:25px"
                                                               class="form-control" value="" placeholder="">
                                                        <!-- <span class="help-block">exemple: Boris Daudga</span> -->
                                                    </div>
                                                </div>
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary" style="margin-right: 20px"
                                                       href="<?php echo Router::url('bouwou/comptabilite/caisse'); ?>">Annuler</a>
                                                    <button class="btn btn-success" type="submit"
                                                            style="margin-right: 20px">Valider
                                                    </button>
                                                    <button class="btn btn-success" type="submit">Imprimer</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END JQUERY VALIDATION PLUGIN -->
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['Users']->type == 'Administrateur' || $_SESSION['Users']->type == 'Gestionnaire') { ?>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-body panel-body-table">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table   table-bordered table-striped table-actions" id="">
                                    <thead>
                                    <tr>
                                        <th>Prix Total</th>
                                        <th>Etat</th>
                                        <th>Réference</th>
                                        <th>Date vente</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tab_caisse">
                                    <?php if (isset($vente_credit)) {
                                        foreach ($vente_credit as $k => $v) : ?>
                                            <tr id="<?php echo $v->id; ?>">
                                                <td><strong class='prixtotal'><?php echo $v->prixTotal; ?></strong></td>
                                                <td class="etat"><?php echo $v->etat; ?></td>
                                                <td><?php echo $v->reference; ?></td>
                                                <td>
                                                    <?php echo $v->dateVente; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-rounded btn-sm"
                                                            data-toggle="tooltip" data-placement="top"
                                                            onclick="envoyer_en_caisse(<?php echo $v->id; ?>,<?php echo $action_fermeture->id; ?>)">
                                                        Envoyer en caisse
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    <?php } ?>

    <!-- END RESPONSIVE TABLES -->
<?php } ?>

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewCaisse" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="">Ouvrir Caisse</h4>
            </div>
            <div class="modal-body" style="padding: 0px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default" style="margin-bottom: 0px;">

                            <div class="panel-body panel-body-table">

                                <div class="panel-body" style="display: flex;flex-direction: column;padding: 0px;">
                                    <!-- <div style="display: flex;align-items: center;">
                                    <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Session caisse</h4>
                               </div> -->
                                    <div>
                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Session:</label>
                                            <div class="col-md-9">
                                                <select class="form-control input-xlarge select2me session"
                                                        name="session" required="">
                                                    <?php
                                                    $time = date("H");
                                                    if ($time < 12) {
                                                        echo '<option value="Matin">Matin</option>';
                                                    } else if ($time >= 12) {
                                                        echo '<option value="Soir">Soir</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: flex;align-items: center;">
                                        <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Fond de
                                            caisse</h4>
                                    </div>
                                    <div>
                                        <table class="table  table-bordered table-striped table-actions">
                                            <thead>
                                            <tr>
                                                <th width="150" colspan="2">Piece</th>
                                                <th width="150" colspan="2">Billets</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent1 x"
                                                                                     data="1" value="0" id="argent_1"
                                                                                     placeholder=""></td>
                                                <td>500</td>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent6 x"
                                                                                     data="6" value="0" id="argent_2"
                                                                                     placeholder=""></td>
                                                <td>10000</td>
                                            </tr>
                                            <tr>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent2 x"
                                                                                     data="2" value="0" id="argent_3"
                                                                                     placeholder=""></td>
                                                <td>100</td>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent7 x"
                                                                                     data="7" value="0" id="argent_4"
                                                                                     placeholder=""></td>
                                                <td>5000</td>
                                            </tr>
                                            <tr>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent3 x"
                                                                                     data="3" value="0" id="argent_5"
                                                                                     placeholder=""></td>
                                                <td>50</td>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent8 x"
                                                                                     data="8" value="0" id="argent_6"
                                                                                     placeholder=""></td>
                                                <td>2000</td>
                                            </tr>
                                            <tr>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent4 x"
                                                                                     data="4" value="0" id="argent_7"
                                                                                     placeholder=""></td>
                                                <td>25</td>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent9 x"
                                                                                     data="9" value="0" id="argent_8"
                                                                                     placeholder=""></td>
                                                <td>1000</td>
                                            </tr>
                                            <tr>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent5 x"
                                                                                     data="5" value="0" id="argent_9"
                                                                                     placeholder=""></td>
                                                <td>10</td>
                                                <td class="inputcountdisable"><input type="number"
                                                                                     class="form-control argent argent10 x"
                                                                                     data="10" value="0" id="argent_10"
                                                                                     placeholder=""></td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h6>
                                                        Sous total
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 style="margin-bottom: 0px;"><span
                                                                class="soustotalaisse1">0</span></h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        Sous total
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6 style="margin-bottom: 0px;"><span
                                                                class="soustotalaisse2">0</span></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div style="justify-content: space-between;display:flex">
                                                        <p style="margin-bottom: 0px;"> Total</p>
                                                        <h4 style="margin-bottom: 0px;"><span
                                                                    class="totalaisse">0</span></h4>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" style="margin-right: 20px;"
                        onclick="close_caisse_row_valide('<?php echo $_SESSION["Users"]->id; ?>')">Valider
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

<?php if ($employe->identifiant == $_SESSION['Users']->identifiant || $_SESSION['Users']->type == 'Administrateur' || $_SESSION['Users']->type == 'Gestionnaire') { ?>
    <!-- START MODAL ICON PREVIEW -->
    <div class="modal fade" id="iconPreviewCaisseFermer" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Fermer Caisse</h4>
                </div>
                <div class="modal-body" style="padding: 0px;">
                    <div class="panel panel-default tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Monnaie</a></li>
                            <li><a href="#tab-second" role="tab" data-toggle="tab">Fiche </a></li>
                        </ul>
                        <div class="panel-body tab-content">
                            <div class="tab-pane active" id="tab-first">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default" style="margin-bottom: 0px;">

                                            <div class="panel-body panel-body-table">

                                                <div class="panel-body"
                                                     style="display: flex;flex-direction: column;padding: 0px;">
                                                    <!-- <div style="display: flex;align-items: center;">
                                <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">Session caisse</h4>
                           </div> -->

                                                    <div style="display: flex;align-items: center;">
                                                        <h4 style="padding: 10px 20px;background-color: #2d3945;color: white;">
                                                            Montant en caisse</h4>
                                                        <p>Entrez le montant restant dans votre caisse</p>
                                                    </div>
                                                    <div>
                                                        <table class="table  table-bordered table-striped table-actions">
                                                            <thead>
                                                            <tr>
                                                                <th width="150" colspan="2">Piece</th>
                                                                <th width="150" colspan="2">Billets</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent1 x"
                                                                                                     data="1" value="0"
                                                                                                     id="fargent_1"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>500</td>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent6 x"
                                                                                                     data="6" value="0"
                                                                                                     id="fargent_2"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>10000</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent2 x"
                                                                                                     data="2" value="0"
                                                                                                     id="fargent_3"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>100</td>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent7 x"
                                                                                                     data="7" value="0"
                                                                                                     id="fargent_4"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>5000</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent3 x"
                                                                                                     data="3" value="0"
                                                                                                     id="fargent_5"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>50</td>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent8 x"
                                                                                                     data="8" value="0"
                                                                                                     id="fargent_6"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>2000</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent4 x"
                                                                                                     data="4" value="0"
                                                                                                     id="fargent_7"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>25</td>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent9 x"
                                                                                                     data="9" value="0"
                                                                                                     id="fargent_8"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>1000</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent5 x"
                                                                                                     data="5" value="0"
                                                                                                     id="fargent_9"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>10</td>
                                                                <td class="inputcountdisable"><input type="number"
                                                                                                     class="form-control fargent fargent10 x"
                                                                                                     data="10" value="0"
                                                                                                     id="fargent_10"
                                                                                                     placeholder="">
                                                                </td>
                                                                <td>500</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h6>
                                                                        Sous total
                                                                    </h6>
                                                                </td>
                                                                <td>
                                                                    <h6 style="margin-bottom: 0px;"><span
                                                                                class="fsoustotalaisse1">0</span></h6>
                                                                </td>
                                                                <td>
                                                                    <h6>
                                                                        Sous total
                                                                    </h6>
                                                                </td>
                                                                <td>
                                                                    <h6 style="margin-bottom: 0px;"><span
                                                                                class="fsoustotalaisse2">0</span></h6>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <div style="justify-content: space-between;display:flex">
                                                                        <p style="margin-bottom: 0px;"> Total</p>
                                                                        <h4 style="margin-bottom: 0px;"><span
                                                                                    class="ftotalaisse">0</span></h4>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab-second">
                                <div class="panel panel-default">

                                    <div class="panel-body" style="display: flex;flex-direction: column;">

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">OM</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span
                                                                class="fa fa-credit-card"></span></span>
                                                    <input type="text" class="form-control"/>
                                                </div>
                                                <!-- <span class="help-block">This is sample of text field</span> -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Espece</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span
                                                                class="fa fa-money"></span></span>
                                                    <input class="form-control"/>
                                                </div>
                                                <!-- <span class="help-block">Password field sample</span> -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">En lettre</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">

                                                    <input class="form-control"/>
                                                </div>
                                                <!-- <span class="help-block">Password field sample</span> -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">En lettre</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">

                                                    <input class="form-control"/>
                                                </div>
                                                <!-- <span class="help-block">Password field sample</span> -->
                                            </div>
                                        </div>


                                    </div>
                                    <!-- <div class="panel-footer">
                               <button class="btn btn-default">Clear Form</button>
                               <button class="btn btn-primary pull-right">Submit</button>
                          </div> -->
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" style="margin-right: 20px; "
                            onclick="valider_fermeture('<?php echo $action_fermeture->id; ?>')">Valider
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- END MODAL ICON PREVIEW -->
<?php } ?>

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewFacture" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Produit</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <div style="width: 80mm;display:block;font-size: 10px;flex-direction: column;"
                                 class="ticketfacture" id="ticketCaisse">

                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Pharmacie ALSAS</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Dr GAMWO Sandrine</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        BP 38 FOUMBOT</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Tel :(+237) 233 267 487</p>
                                    <div style="display: flex;justify-content:space-between">
                                        <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                            Ticket N°: <span class="reference"></span></p>
                                        <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                            <span class="datevente"></span> à <span class="heurevente"></span></p>
                                    </div>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Vendeur: <span class="vendeur"></span></p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Acheteur: <span class="acheteur"></span></p>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-actions table-responsive"
                                           id="tab_GGBfactureImprimer">
                                        <thead>
                                        <tr>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="200">Libelle
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="150">Prix U.
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100">Qte
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="100">Total
                                            </th>
                                            <th style="background-color: white;color: black;font-weight: 400; text-align: end;padding: 4px; text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                width="50">Rd(%)
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_BfactureImprimer">

                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: start;font-family: 'Courier New', Courier, monospace;font-size: 10px;"
                                                scope="row">Montant Total
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;text-align: end;font-family: 'Courier New', Courier, monospace;font-size: 10px;">
                                                <span class="montanttotal"></span> FCFA
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: start;"
                                                scope="row">Remise
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: end;">
                                                <span class="remise"></span> FCFA
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: start;"
                                                scope="row">Net à payer
                                            </td>
                                            <td colspan="4"
                                                style=" background-color: white;color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 10px;text-align: end;">
                                                <span class="netapayer"></span> FCFA
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex;flex-direction:column;text-align: left;">
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Payer en espece : <span class="montantpercu"></span></p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Montant rendu : <span class="montantrendu"></span></p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Ce ticket vaut facture</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        Merci et bonne santé</p>
                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                        NoCT /P058512700488Z</p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-circle blue"
                                    style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                                    onClick="imprimer_bloc('ticket','ticket')"><i class="fa fa-print"
                                                                                  style="font-size:10px"></i>&nbsp;Imprimer
                            </button>
                        </div>
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
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewRapport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Rapport</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Entrée</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <!-- <tr>
                    <th>Entree</th>
               </tr> -->
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Espece</td>
                                            <td>
                                                <span id="espece_caisse_rapport">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>OM</td>
                                            <td>
                                                <span id="electronique_rapport">0</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>
                                                <span id="total_entree_rapport_caisse">0</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Depense</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                                <ul class="panel-controls" style="margin-top: 2px;">
                                    <!-- <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li> -->
                                    <li><a href="#" onclick="ajouter_une_depense()" class=""><span
                                                    class="fa fa-plus"></span></a></li>

                                </ul>
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width="50">N°</th>
                                            <th>Motifs</th>
                                            <th>Quantite</th>
                                            <th>Prix unitaire</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_RapportDepense">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title-box">
                                    <h3>Bon de caisse</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nom client</th>
                                            <th>Montant</th>
                                            <th>Type</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_RapportBon">


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

                            <div class="panel-heading" style="background: #333;">
                                <div class="panel-title-box" style="color: aquamarine;">
                                    <h3 style="color: white;">Recapitulatif</h3>
                                    <!-- <span>Projects activity</span> -->
                                </div>
                            </div>
                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Total entrée</th>
                                            <th>Total sortie</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Caisse</td>
                                            <td id="total_entree_caisse">1</td>
                                            <td id="total_sortie_caisse">
                                                0
                                            </td>
                                            <td id="total_tout_caisse">
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Systeme</td>
                                            <td id="total_entree_syst">1</td>
                                            <td id="total_sortie_syst">
                                                0
                                            </td>
                                            <td id="total_tout_syst">
                                                0
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Difference</td>
                                            <td id="diff_entree">1</td>
                                            <td id="diff_sortie">
                                                0
                                            </td>
                                            <td id="diff_total">
                                                0
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="valider_rapport()">Valider</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="iconPreviewBonCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Bon de caisse</h4>
                <div class="form-group row">
                    <label class="col-md-2 control-label">Scanner bon:</label>
                    <div class="col-md-3">
                        <input class="form-control " data="1" id="scanner_bon" value="" placeholder=""/>
                    </div>
                    <div class="col-md-7" style="display: flex;justify-content: flex-end;">
                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top"
                                onclick="showEncaissement()">
                            Encaisser bon
                        </button>
                        <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top"
                                onclick="ajouter_bon_caisse()">
                            Ajouter bon
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="panel panel-default tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#tab-bon-one" role="tab" data-toggle="tab">Bon</a></li>
                        <li><a href="#tab-bon-two" role="tab" data-toggle="tab">Liste</a></li>
                    </ul>
                    <div class="panel-body tab-content">
                        <div class="tab-pane active" id="tab-bon-one">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="panel panel-default">

                                            <div class="panel-body panel-body-table">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Nom client</th>
                                                            <th>Montant</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tab_GBonCaisse"
                                                               data="<?php echo $action_fermeture->id; ?>">

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- <div style="display: flex;justify-content: end; margin:50px 30px 0px 0px;">
                                                     <h6>Total <span>0000</span> </h6>
                                                </div> -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-bon-two">
                            <div class="panel-body">
                                hello
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-success" style="margin-right: 20px; ">Valider</button> -->
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="iconPreviewDepense" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="close_depense()"><span
                            aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Dépense</h4>
                <div style="display: flex;justify-content: flex-end;">
                    <a onclick="modify_depense('<?php echo $action_fermeture->id; ?>')" id="modifydepenseid" href="#"
                       class="btn btn-default btn-rounded btn-sm">Modifier</a>
                    <a onclick="ajouter_depense()" id="adddepenseid" href="#"
                       class="btn btn-default btn-rounded btn-sm">Ajouter</a>
                </div>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">

                            <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="tab_depense">
                                        <thead>
                                        <tr>
                                            <th>Designation</th>
                                            <th>Quantite</th>
                                            <th>Prix unitaire</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tab_Gdepense">

                                        </tbody>
                                    </table>
                                </div>
                                <div style="display: flex;justify-content: end; margin:50px 30px 0px 0px;">
                                    <h6>Total <span id="total_depense">0</span> FCFA </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id='savedepenseid' class="btn btn-success"
                        onclick="valider_depense('<?php echo $action_fermeture->id; ?>')" style="margin-right: 20px; ">
                    Enregistrer
                </button>
                <button type="button" class="btn btn-primary" onclick="close_depense()">Ferler</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->
<!-- <div class="message-box animated fadeIn" data-sound="alert" id="mb-confirmation-caisse" data="">
<div class="mb-container">
     <div class="mb-middle">
          <div class="mb-title"><span class="fa fa-sign-out"></span> Confirmation <strong>Paiement</strong> ?</div>
          <div class="mb-content">
               <p>Voulez-vous valider le paiement et l'impression d'un <strong><mark>Ticket de caisse</mark></strong>?</p>
               <p>Cliquez sur oui si vous le voulez ou sur non pour pas maintenant.</p>
          </div>
          <div class="mb-footer">
               <div class="pull-right">
                    <button class="btn btn-success btn-lg mb-control-yes">Oui</button>
                    <button class="btn btn-default btn-lg mb-control-close">Non</button>
               </div>
          </div>
     </div>
</div>
</div> -->

<!-- END MODAL ICON PREVIEW -->
<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewImprimerBonCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Impression bon de caisse</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">

                            <div class="panel-body panel-body-table">

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="tab_load_produit_caisse" style="height: 200px;overflow: auto;"
                                               class="table table-bordered table-actions">
                                            <thead>
                                            <tr>
                                                <th width="100">Montant</th>
                                                <th width="200">Montant percu</th>
                                                <th width="200">Date de vente</th>
                                                <th width="100">Etat</th>
                                                <th width="100">Ref</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tab_Bload_produit_caisse">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="previewImprimerBonCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Impression bon de caisse</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-preview">
                            <div style="width: 80mm;display:flex;flex-direction: column;text-align: left;" id="ticket">
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Pharmacie ALSAS</p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Dr GAMWO Sandrine</p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    BP 38 FOUMBOT</p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Tel :(+237) 233 267 487</p>
                                <h3 style="padding: 10px;text-align: center;margin-bottom: 0px;">
                                    Bon de caisse</h3>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Bon N° xxxxx</p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    <span id="dateimp"></span></p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Caissier : <span id="caissierimp"> <?php echo $employe->nom; ?> </span></p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Client : <span id="nomclientimp"></span></p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Montant : <span id="montantimp"></span> FCFA</p></p>
                                <div style="justify-content: left; display: flex;flex-direction: column;align-items: center;">
                                    <p style="font-weight: bold;text-align: center;margin-bottom: 0px;font-size: 12px;display: flex;margin: 0px;padding: 0px;overflow: auto;padding:4px"
                                       id="codebarreimp"></p>
                                    <p style="font-weight: bold;text-align: center;margin-bottom: 0px;font-size: 12px;display: flex;margin: 0px;padding: 0px;overflow: auto;padding:4px"
                                       id="codebarrenulimp"></p>
                                </div>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Bon à retourner</p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    Merci et bonne santé</p>
                                <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                    NoCT /P058512700488Z</p>

                                <!--<table style="table-layout: fixed; width: 80mm;display: flex;overflow: hidden;border-collapse: collapse;border-spacing: 0px;border: 0;">
                                    <tbody>
                                    <tr style="display: flex;table-layout: fixed; width: 80mm ;">
                                        <td style="width: 80mm;background-color: white;color: black;font-weight: 400;text-align: start;"
                                            colspan="2">

                                            <div style="display: flex;flex-direction: column;padding:5px">
                                                <div style="display: flex;flex-direction: row;justify-content: space-between;width:100%">
                                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                                        <span id="nomclientimp"></span></p>
                                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                                        <span id="montantimp"></span> FCFA</p>
                                                </div>
                                                <div style="justify-content: center; display: flex;flex-direction: column;align-items: center;">
                                                    <p style="font-weight: bold;text-align: center;margin-bottom: 0px;font-size: 12px;display: flex;margin: 0px;padding: 0px;overflow: auto;padding:4px"
                                                       id="codebarreimp"></p>
                                                    <p style="font-weight: bold;text-align: center;margin-bottom: 0px;font-size: 12px;display: flex;margin: 0px;padding: 0px;overflow: auto;padding:4px"
                                                       id="codebarrenulimp"></p>
                                                </div>
                                                <div style="display: flex;flex-direction: row;justify-content: space-between;width:100%">
                                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                                        <span id="dateimp"></span></p>
                                                    <p style="margin: 0px; color: black;font-weight: 400;font-family: 'Courier New', Courier, monospace;font-size: 12px;">
                                                        <span id="caissierimp"> <?php /*echo $employe->nom; */ ?> </span></p>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
-->
                            </div>
                            <button type="button" class="btn btn-circle blue"
                                    style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                                    onClick="imprimer_bloc('ticket','ticket')"><i class="fa fa-print"
                                                                                  style="font-size:10px"></i>&nbsp;Imprimer
                            </button>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="iconPreviewBonCaisse" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" style="width: 85%;">
          <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Caisse</h4>
               </div>
               <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                    <div class="row">
                         <div class="col-md-12 ">
                              <div class="panel panel-default">

                                   <div class="panel-body" style="display: flex;flex-direction: column;">


                                        <div class="form-group">
                                             <label class="col-md-3 col-xs-12 control-label">Montant</label>
                                             <div class="col-md-6 col-xs-12">
                                                  <div class="input-group">
                                                       <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                                       <input class="form-control" />
                                                  </div>
                                                  <!-- <span class="help-block">Password field sample</span>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label class="col-md-3 col-xs-12 control-label">En lettre</label>
                                             <div class="col-md-6 col-xs-12">
                                                  <div class="input-group" style="display: flex;">
                                                       <input class="form-control" />
                                                  </div>
                                                  <!-- <span class="help-block">Password field sample</span>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label class="col-md-3 col-xs-12 control-label">Objet</label>
                                             <div class="col-md-6 col-xs-12">
                                                  <div class="input-group" style="display: flex;">
                                                       <input class="form-control" />
                                                  </div>
                                                  <!-- <span class="help-block">Password field sample</span>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label class="col-md-3 col-xs-12 control-label">Remis à </label>
                                             <div class="col-md-6 col-xs-12">
                                                  <div class="input-group" style="display: flex;">
                                                       <input class="form-control" />
                                                  </div>

                                             </div>
                                        </div>
                                        <div class="form-group row">
                                             <label class="col-md-2 col-xs-4 control-label">N CNI</label>
                                             <div class="col-md-2 col-xs-3">
                                                  <div class="input-group">
                                                       <input class="form-control" />
                                                  </div>

                                             </div>
                                             <label class="col-md-2 col-xs-1 control-label">Fait le </label>
                                             <div class="col-md-2 col-xs-2">
                                                  <div class="input-group">
                                                       <input type="date" style="line-height: normal;" class="form-control" />
                                                  </div>

                                             </div>
                                             <label class="col-md-2 col-xs-1 control-label"> à </label>
                                             <div class="col-md-2 col-xs-2">
                                                  <div class="input-group">
                                                       <input class="form-control" />
                                                  </div>

                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <label class="col-md-3 col-xs-12 control-label">Remis à </label>
                                             <div class="col-md-6 col-xs-12">
                                                  <div class="input-group" style="display: flex;">
                                                       <input class="form-control" />
                                                  </div>

                                             </div>
                                        </div>



                                   </div>
                              </div>

                         </div>
                    </div>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-success" style="margin-right: 20px; ">Valider</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
               </div>
          </div>
     </div>
</div> -->

<div class="modal fade" id="iconPreviewListeCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Caisse</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">

                            <div class="panel-body panel-body-table">

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="tab_load_produit_caisse" style="height: 200px;overflow: auto;"
                                               class="table table-bordered table-actions">
                                            <thead>
                                            <tr>
                                                <th width="100">Montant</th>
                                                <th width="200">Montant percu</th>
                                                <th width="200">Date de vente</th>
                                                <th width="100">Etat</th>
                                                <th width="100">Ref</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tab_Bload_produit_caisse">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="iconPreviewEncaisserCaisse" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">Encaisser bon de caisse</h4>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <p>Entrez le code ou scanner le bon</p>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Code</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="text" class="form-control" id="encaisseCode">
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <div id="verification_code">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_encaissement" onclick="encaisser_bon_caisse()">
                    Encaisser
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<ul>
    <li onclick="selectemploye('<?php echo $employename; ?>')"></li>
</ul>

<!-- START MODAL ICON PREVIEW -->
<div class="modal fade" id="iconPreviewRapportTest" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></a>
                <h4 class="modal-title">Rapport caisse de <span style="font-weight: bolder" id="nameRapport"></span> du
                    : <span id="datesRapport" style="font-weight: bolder"></span> à <span style="font-weight: bolder"
                                                                                          id="heuresRapport"></span>
                </h4>
                <div style="display: flex;justify-content: space-between">
                    <h4 class="modal-title">Session : <span style="font-weight: bolder" id="sessionRapport"></span></h4>
                    <h4 class="modal-title"><span id="etatRapport" class="label label-success">' + data + '</span></h4>
                </div>
            </div>
            <div class="modal-body"
                 style="max-height: calc(100vh - 210px);overflow-y: auto;">
                <div id="rapport_de_caisse">
                    <h4>Du <span id="dateOuvertRapportVente" style="font-weight: bolder"></span> au <span
                                style="font-weight: bolder" id="dateFermeRapportVente"></span></h4>

                    <div style="display: flex;justify-content: space-between">
                        <h4 class="modal-title">Caissier : <span style="font-weight: bolder"
                                                                 id="nameRapportVente"></span></h4>
                        <h4 class="modal-title">Session : <span style="font-weight: bolder"
                                                                id="sessionRapportVente"></span></h4>
                    </div>
                    <div class="row divine">
                        <div class="col-md-6">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Recap vente par fournisseur</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>

                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Grossiste</td>
                                                <td>
                                                    <span id="rapport_vente_fournisseur_grossiste">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Detaillant</td>
                                                <td>
                                                    <span id="rapport_vente_fournisseur_detaillant">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>
                                                    <span id="rapport_vente_fournisseur_total">0</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Recap vente par type de vente</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>

                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Comptant</td>
                                                <td>
                                                    <span id="rapport_vente_comptant">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Crédit</td>
                                                <td>
                                                    <span id="rapport_vente_credit">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Assurance</td>
                                                <td>
                                                    <span id="rapport_vente_assurance">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>
                                                    <span id="rapport_vente_total">0</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row divine">
                        <div class="col-md-6">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Encaissement des ventes</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>

                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Espece</td>
                                                <td>
                                                    <span id="rapport_ev_espece">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Electronique</td>
                                                <td>
                                                    <span id="rapport_ev_electronique">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bon de caisse</td>
                                                <td>
                                                    <span id="rapport_ev_boncaisse">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>
                                                    <span id="rapport_ev_total">0</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Encaissement facture à crédit</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="rapport_ev_espece">
                                            <thead>
                                            <tr>
                                                <th>N° Facture</th>
                                                <th>Nom</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>

                                            </tr>
                                            <tr>
                                                <td colspan="4">Total</td>
                                                <td id="rapport_ev_total">0</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row divine">
                        <div class="col-md-6">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Bon de caisse généré</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="rapport_bc_genere">
                                            <thead>
                                            <tr>
                                                <th>Numéro de bon</th>
                                                <th>Nom client</th>
                                                <th>Montant</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>

                                            </tr>
                                            <tr>
                                                <td colspan="4">Total</td>
                                                <td id="rapport_bc_total">0</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Bon de caisse encaissé</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="rapport_bc_encaisse">
                                            <thead>
                                            <tr>
                                                <th>Numéro de bon</th>
                                                <th>Nom client</th>
                                                <th>Montant</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>

                                            </tr>
                                            <tr>
                                                <td colspan="4">Total</td>
                                                <td id="rapport_bc_total_genere">0</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="row divine">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Dépenses</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="rapport_depense">
                                            <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Motif(Désignation)</th>
                                                <th>Quantité</th>
                                                <th>Prix unitaire</th>
                                                <th>Prix total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>

                                            </tr>
                                            <tr>
                                                <td colspan="4">Total</td>
                                                <td id="rapport_total_depense">
                                                    0
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="row divine">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading" style="background: #333;">
                                    <div class="panel-title-box" style="color: aquamarine;">
                                        <h3 style="color: white;">Etat de caisse</h3>
                                        <!-- <span>Projects activity</span> -->
                                    </div>
                                </div>
                                <div class="panel-body panel-body-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Solde réel en caisse</th>
                                                <th>Solde système</th>
                                                <th>Différence</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td id="rapport_ec_solde_reel">0</td>
                                                <td id="rapport_ec_solde_system">
                                                    0
                                                </td>
                                                <td id="rapport_ec_difference">
                                                    0
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <a class="btn btn-circle blue"
                   style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                   onClick="imprimer_blocTest('rapport_de_caisse','rapport_de_caisse')"><i class="fa fa-print"
                                                                                           style="font-size:10px"></i>&nbsp;Imprimer</a>
                <a class="btn btn-primary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ICON PREVIEW -->

