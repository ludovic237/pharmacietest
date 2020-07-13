<?php

$title_for_layout = ' Admin -' . 'Stock';
$page_for_layout =  'Inverntaire';
if(isset($inventaire) && empty($inventaire) ){
    $action_for_layout = 'Démarrer inventaire';
}



$position_for_layout = '<li><a href="#">Inventaire</a></li>';
$script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
';
?>

<div class="row">
    <div class="col-md-8">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">A propos de Pharma'Net</h4>
                </div>
                <div class="alert alert-info">
                    Pharma'Net version 1.0, tout droit réservé.<br>
                    <h3> Nos modules </h3>
                    <ul>
                        <li>Stock</li>
                        <li>Inventaire</li>
                        <li>Vente</li>
                        <li>Statistique</li>
                        <li>Consultation en ligne</li>
                        <li>Geo Net</li>
                    </ul>
                </div>
                <div class="alert alert-danger">
                    Ce logiciel est protégé par la loi du copyright et par des conventions internationales.
                    Toute Reproduction ou distribution partielle ou totale du logiciel est strictement interdite.
                </div>
                <div class="alert alert-info">
                    Contact : andersonazotsie@gmail.com +237 693 406 034
                </div>
                <div class="form-actions modal-footer">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="button" class="btn default" data-dismiss="modal">O.K</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>