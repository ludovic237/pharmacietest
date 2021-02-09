<?php

$title_for_layout = ' Admin -' . ' Orientation';
$page_for_layout = 'Configuration';

$position = "Configuration";

$position_for_layout = '<li><a href="#">Orientation</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/functions.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: []
            });

        </script>';
?>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Questions</h3>
                    <?php
                    echo $question->QUESTION;
                    ?>
                </div>
            </div>

        </div>
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Type</h3>
                    <strong><?php
                            echo $question->TYPE;
                            ?></strong>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <!-- START JQUERY VALIDATION PLUGIN -->
            <div class="block">
                <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_question('<?php echo $id; ?>','<?php echo $question->TYPE; ?>');">
                    <div class="panel-body col-md-6">

                        <?php
                        $div = $total / 2;
                        $mod = $total % 2;
                        $taux = null;
                        //echo $total;
                        for ($i = 0; $i <= ($div - 1 + $mod); $i++) {
                        ?>
                            <div class="form-group col-md-7" style="margin-top: 25px;">
                                <label class="check"><?php echo $categories[$i]->NOM; ?></label>
                            </div>

                            <div class="form-group col-md-2" style="margin-top: 30px;">
                                <input type="checkbox" class="icheckbox check-<?php echo $i; ?>" <?php foreach ($question_conf as $k => $v) if ($categories[$i]->CATEGORIE_ID == $v->CATEGORIE_ID) { ?> checked="checked" <?php } ?> id="<?php echo $categories[$i]->CATEGORIE_ID; ?>" />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Taux</label>
                                <input type="text" class="form-control <?php echo $categories[$i]->CATEGORIE_ID; ?> " value="<?php foreach ($question_conf as $k => $v) if ($categories[$i]->CATEGORIE_ID == $v->CATEGORIE_ID) {
                                                                                                                                    echo $v->TAUX;
                                                                                                                                }  ?>" />
                            </div>
                        <?php
                        }
                        ?>


                    </div>
                    <div class="panel-body col-md-6">

                        <?php
                        for ($i = ($div + $mod); $i <= ($total - 1); $i++) {
                        ?>
                            <div class="form-group col-md-7" style="margin-top: 25px;">
                                <label class="check"><?php echo $categories[$i]->NOM; ?></label>
                            </div>
                            <div class="form-group col-md-2" style="margin-top: 30px;">
                                <input type="checkbox" class="icheckbox check-<?php echo $i; ?>" <?php foreach ($question_conf as $k => $v) if ($categories[$i]->CATEGORIE_ID == $v->CATEGORIE_ID) { ?> checked="checked" <?php } ?> id="<?php echo $categories[$i]->CATEGORIE_ID; ?>" />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Taux</label>
                                <input type="text" class="form-control <?php echo $categories[$i]->CATEGORIE_ID; ?>" value="<?php foreach ($question_conf as $k => $v) if ($categories[$i]->CATEGORIE_ID == $v->CATEGORIE_ID) {
                                                                                                                                echo $v->TAUX;
                                                                                                                            }  ?>" />
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                    <p>&nbsp;</p>
                    <div class="btn-group pull-right">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>
                </form>
                <!-- END JQUERY VALIDATION PLUGIN -->
            </div>

        </div>

    </div>