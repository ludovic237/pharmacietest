<?php

$title_for_layout = ' Admin -'.' Orientation';
$page_for_layout = 'Recapitulatif';

$position = "Recapitulatif";

$position_for_layout = '<li><a href="#">Orientation</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>';
?>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-8">

            <!-- START PANEL WITH REFRESH CALLBACKS -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Questions</h3>
                </div>
                <div class="panel-body">
                    <select class="form-control question selectpicker" name="question" id="ort_question">
                        <option <?php if($id == null || $option != 'question') echo "selected=\"selected\""; ?> value="0" ></option>
                        <?php
                        $i = 1;
                        foreach ($questions as $k => $v): ?>
                            <option <?php if($v->QUESTION_ID == $id && $option == 'question') echo "selected=\"selected\""; ?> value="<?php echo $v->QUESTION_ID; ?>" ><?php echo $i."- ".$v->QUESTION; ?></option>
                            <?php
                        $i++;
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary pull-right" onclick="charger_orientation('question');">Charger</button>
                </div>
            </div>
            <!-- END PANEL WITH REFRESH CALLBACKS -->

        </div>
        <div class="col-md-4">

            <!-- START PANEL WITH REFRESH CALLBACKS -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Categories</h3>
                </div>
                <div class="panel-body">
                    <select class="form-control question selectpicker" name="question" id="ort_categorie">
                        <option <?php if($id == null || $option != 'categorie') echo "selected=\"selected\""; ?> value="0" ></option>
                        <?php
                        foreach ($categories as $k => $v): ?>
                            <option <?php if($v->CATEGORIE_ID == $id && $option == 'categorie') echo "selected=\"selected\""; ?> value="<?php echo $v->CATEGORIE_ID; ?>" ><?php echo $v->NOM; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary pull-right" onclick="charger_orientation('categorie');">Charger</button>
                </div>
            </div>
            <!-- END PANEL WITH REFRESH CALLBACKS -->

        </div>
    </div>

    <div class="row">
        <?php
        if($option == 'categorie'){
            ?>
            <!-- START BORDERED TABLE SAMPLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php  echo $categorie->NOM; ?></h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="20">Id</th>
                            <th width="300">Questions</th>
                            <th width="100">Taux</th>
                            <th width="100">Type</th>
                            <th width="50">actions</th>
                        </tr>
                        </thead>
                        <tbody id="tableau">
                        <?php
                        //echo $total;
                        //print_r($faculte);
                        foreach ($quest_cat as $k => $v): ?>
                            <tr id="<?php echo  $v->QUESTION_ID ?>">
                                <td><?php echo  $v->QUESTION_ID ?></td>
                                <td><strong><?php echo  $v->QUESTION ?></strong></td>
                                <td><?php echo  $v->TAUX ?></td>
                                <td><?php echo  $v->TYPE ?></td>
                                <td><button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Configuration" onclick="conf_row_question(<?php echo $v->QUESTION_ID; ?>)"><span class="fa fa-cogs"></span></button></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END BORDERED TABLE SAMPLE -->
            <?php
        }
        else if($option == 'question'){
            ?>
            <!-- START BORDERED TABLE SAMPLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $question->QUESTION; ?></h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="20">Id</th>
                            <th width="300">Categories</th>
                            <th width="100">Taux</th>
                            <th width="100">Type</th>
                            <th width="50">actions</th>
                        </tr>
                        </thead>
                        <tbody id="tableau">
                        <?php
                        //echo $total;
                        //print_r($faculte);
                        foreach ($quest_cat as $k => $v): ?>
                            <tr id="<?php echo  $v->CATEGORIE_ID ?>">
                                <td><?php echo  $v->CATEGORIE_ID ?></td>
                                <td><strong><?php echo  $v->NOM ?></strong></td>
                                <td><?php echo  $v->TAUX ?></td>
                                <td><?php echo  $v->TYPE ?></td>
                                <td><button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Configuration" onclick="categorie_row_question(<?php echo $v->CATEGORIE_ID; ?>)"><span class="fa fa-info"></span></button></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END BORDERED TABLE SAMPLE -->
            <?php
        }
        ?>
    </div>