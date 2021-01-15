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
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/caisse.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/Comptabilite/functions.js"></script>';
     if (isset($id)) {
          $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(open_rapport(' . $id . '))</script>';
     }

     ?> -->



<div class="modal-content">
    <div class="modal-body">
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
                        <!--<ul class="panel-controls" style="margin-top: 2px;">
                             <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                            <li><a href="#" onclick="ajouter_une_depense()" class=""><span class="fa fa-plus"></span></a></li>
                        </ul>-->
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
                                    <th>Nom client </th>
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
                                    <th> </th>
                                    <th>Total entrée </th>
                                    <th>Total sortie</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Caisse</td>
                                    <td id="total_entree_caisse">0</td>
                                    <td id="total_sortie_caisse">
                                        0
                                    </td>
                                    <td id="total_tout_caisse">
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <td>Systeme</td>
                                    <td id="total_entree_syst">0</td>
                                    <td id="total_sortie_syst">
                                        0
                                    </td>
                                    <td id="total_tout_syst">
                                        0
                                    </td>
                                </tr>
                                <tr>
                                    <td>Difference</td>
                                    <td id="diff_entree">0</td>
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
</div>