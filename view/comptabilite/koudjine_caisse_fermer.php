<!-- <?php

$title_for_layout = ' ALSAS -' . 'Comptabilite';
$page_for_layout = 'Caisse fermer par : ' . $employe->nom;
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
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>';
if (isset($caisse) && $caisse == null) {
     $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisse").modal("show"); });</script>';
}
if (isset($caisseCheck) && $caisseCheck != null) {
     $script_for_layout = $script_for_layout . '<script type="text/javascript">  $(document).ready(function () { $("#iconPreviewCaisseFermer").modal("show"); });</script>';
}
?> -->




<!-- START RESPONSIVE TABLES -->

<div class="row">
<div class="col-md-12">
     <div class="panel panel-default">

          <div class="panel-body panel-body-table">

               <div class="panel-body">
                 
               </div>

          </div>
     </div>

</div>
</div>
