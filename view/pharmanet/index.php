<?php

$title_for_layout = 'Concours'.' | Atlant-Front';
$page_for_layout = 'Concours';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Concours</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/js/plugins/bootstrap/bootstrap-select.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tableexport/tableExport.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tableexport/jquery.base64.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tableexport/html2canvas.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tableexport/jspdf/jspdf.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tableexport/jspdf/libs/base64.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/scrolltotop/scrolltopcontrol.js"></script>';
?>


    <!-- Affichage des résultats de la recherche-->

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Etablissements Publics</h3>
            <div class="btn-group pull-right">
                <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Enregistrer Sous</button>
                <ul class="dropdown-menu">
                    <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                    <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                    <li><a href="#" onClick ="$('#customers2').tableExport({type:'powerpoint',escape:'false'});"><img src='img/icons/ppt.png' width="24"/> PowerPoint</a></li>
                    <li class="divider"></li>
                    <li><a href="#" onClick ="$('#customers2').tableExport({type:'txt',escape:'false'});"><img src='img/icons/txt.png' width="24"/> TXT</a></li>
                    <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                    <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='img/icons/pdf.png' width="24"/> PDF</a></li>
                </ul>
            </div>

        </div>
        <div class="panel-body">
            <table id="customers2" class="table datatable table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">Etablissement</th>
                    <th scope="col" class="">Date du Concours</th>
                    <th scope="col" class="">Description</th>
                    <th scope="col" class="">Date limite pour Dossier</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($concours as $k => $v):

                    if($v->DATE_DEBUT_CONCOURS != NULL){
                        list($year, $month, $day) = explode("-", $v->DATE_DEBUT_CONCOURS);
                        $date_d = mktime(0, 0, 0, $month, $day, $year);
                    }
                    else {
                        $date_d = "Entrée sous étude de dossier";
                    }
                    if($v->DATE_FIN_CONCOURS != NULL){
                        list($year, $month, $day) = explode("-", $v->DATE_FIN_CONCOURS);
                        $date_f = mktime(0, 0, 0, $month, $day, $year);
                    }
                    else {
                        $date_f = "Entrée sous étude de dossier";
                    }
                    if($v->DATE_DOSSIER != NULL){
                        list($year, $month, $day) = explode("-", $v->DATE_DOSSIER);
                        $date_dos = mktime(0, 0, 0, $month, $day, $year);
                    }
                    ?>
                    <tr class="concours" id="<?php echo BASE_URL.'/concours/'.strtolower(str_replace(' ','_',$v->NOM ))."-".$v->CONCOURS_ID; ?>" style="cursor:pointer;">
                        <?php
                        if($v->DATE_DEBUT_CONCOURS!=$v->DATE_FIN_CONCOURS&&$v->DATE_DEBUT_CONCOURS!=null){

                            $date = "du ".dateJourFrancais($date_d)." au ".dateFrancais($date_f);
                        }
                        elseif ($v->DATE_DEBUT_CONCOURS!=null) {
                            $date = dateFrancais($date_f);
                        }
                        else {
                            $date = $date_d;
                        }
                        ?>
                        <td><?php echo $v->NOM; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo $v->DESCRIPTION; ?></td>
                        <td><?php ($v->DATE_DOSSIER == NULL) ? $dossier="indisponible" : $dossier=dateFrancais($date_dos); echo $dossier; ?></td>

                        <?php
                        ?>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php


