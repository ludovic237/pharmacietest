<!-- <?php

$title_for_layout = ' ALSAS -' . 'Comptabilite';
$page_for_layout = 'Rapport : ' . $employe->nom;
$action_fermeture = (isset($caisse)) ? $caisse : $caisseCheck;
//if(isset($employe)) echo 'passe';

if ($this->request->action == "index") {
    $position = "Tout";
} else {
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Comptabilite</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/caisse.js"></script>';
if (isset($id)) {
    $script_for_layout = $script_for_layout . '<script type="text/javascript"> $(document).ready(function () {showRapportTest(' . $id . ')}) </script>';
}

?> -->


<div class="row">
    <div class="col-md-12">

        <!-- START SALES BLOCK -->
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row ">
                    <div class="col-md-12">
                        <div id="rapport_de_caisse">
                            <h4>Du <span id="dateOuvertRapportVente" style="font-weight: bolder"><?php echo $dateOuvert; ?></span> au <span
                                        style="font-weight: bolder" id="dateFermeRapportVente"><?php echo $dateFerme; ?></span></h4>

                            <div style="display: flex;justify-content: space-between">
                                <h4 class="modal-title">Caissier : <span style="font-weight: bolder"
                                                                         id="nameRapportVente"></span></h4>
                                <h4 class="modal-title">Session : <span style="font-weight: bolder"
                                                                        id="sessionRapportVente"><?php echo $session; ?></span></h4>
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
                                                <table class="table table-bordered table-striped" id="rapport_efc_espece">
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
                                                    </tbody>
                                                </table>
                                                <div style="display:flex;padding: 5px">
                                                    <p style="margin: 0px">Total: <span id="rapport_efc_total"></span></p>
                                                </div>
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

                                                    </tbody>
                                                </table>
                                                <div style="display:flex;padding: 5px">
                                                    <p style="margin: 0px">Total: <span id="rapport_bc_total"></span></p>
                                                </div>
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

                                                    </tbody>
                                                </table>
                                                <div style="display:flex;padding: 5px">
                                                    <p style="margin: 0px">Total: <span id="rapport_bc_total_genere"></span></p>
                                                </div>
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
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="panel panel-default">

                                        <div class="panel-heading" style="background: #333;">
                                            <div class="panel-title-box" style="color: aquamarine;">
                                                <h3 style="color: white;">Retour caisse</h3>
                                                <!-- <span>Projects activity</span> -->
                                            </div>
                                        </div>
                                        <div class="panel-body panel-body-table">
                                            <div class="table-responsive">
                                                <table  id="rapport_retour" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Quantité</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div style="display:flex;padding: 5px">
                                                    <p style="margin: 0px">Total: <span id="rapport_retour_total"></span></p>
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
            <div class="panel-footer">
                <a class="btn btn-circle blue"
                   style="text-align:center; float: left; font-size:10px; margin-top: 20px;"
                   onClick="imprimer_blocTest('rapport_de_caisse','rapport_de_caisse')"><i class="fa fa-print"
                                                                                           style="font-size:10px"></i>&nbsp;Imprimer</a>

            </div>
        </div>
        <!-- END SALES BLOCK -->

    </div>
</div>
