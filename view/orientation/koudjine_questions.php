<?php

$title_for_layout = ' Admin -'.' Orientation';
$page_for_layout = 'Questions';

$position = "Questions";

$position_for_layout = '<li><a href="#">Orientation</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/formsQuestion.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script>
                $(window).load(function(){
                    $(\'#form6\').forms({
                        ownerEmail:\'#\'
                    })
                })
            </script>';
?>




<div class="row">
    <div class="col-md-4">

        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="block">
            <h4 class="titre">Ajouter une nouvelle question</h4>

            <form id="form6" class="form-horizontal"method="post">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="question Required col-md-12">
                            <textarea class="form-control">Question:</textarea>
                            <span class="empty">*Veuillez remplir ce champ.</span>
                            <span class="help-block">Question pour le test d'orientation</span>
                        </label><br>
                    </div>
                    <div class="form-group">
                        <label class="type col-md-12">
                            <select class="selectpicker" name="type" id="type">
                                <option  value="0">General</option>
                                <option  value="1">Personnalite</option>
                                <option  value="2">Categorie</option>
                            </select>
                            <span class="help-block">Permet de définir  de quel type de question il s'agit</span>
                        </label><br>
                    </div>
                    <!--<div class="form-group" id="categorie" style="display: none;">
                        <label class="categorie col-md-12">
                            <select class="form-control categorie selectpicker" title='Categorie' name="categorie" id="categories">
                                <option value="defaut" ></option>
                                <?php
                                /*foreach ($categories as $k => $v): ?>
                                    <option value="<?php echo $v->CATEGORIE_ID; ?>" ><?php echo $v->NOM; ?></option>
                                    <?php
                                endforeach;*/
                                ?>
                            </select>
                            <span class="help-block">Permet de définir  les questions liés à une catégorie précise</span>
                        </label><br>
                    </div>-->
                    <div class="btn-group pull-left">
                        <div class="btns"><a href="#" class="button btn btn-primary pull-left" data-type="submit">Ajouter</a></div>
                    </div>
                </div>
            </form>
            <!-- END JQUERY VALIDATION PLUGIN -->
        </div>

    </div>
    <div class="col-md-8">
        <div class="panel panel-default">

            <div class="panel-body panel-body-table">

                <div class="panel-body">
                    <table class="table table-bordered table-actions">
                        <thead>
                        <tr>
                            <th width="20">N°</th>
                            <th width="300">Questions</th>
                            <th width="100">Type</th>
                            <th width="50">actions</th>
                        </tr>
                        </thead>
                        <tbody id="tableau">
                        <?php
                        $i = 1;
                        //echo $total;
                        //print_r($faculte);
                        foreach ($questions as $k => $v): ?>
                            <tr id="<?php echo  $v->QUESTION_ID ?>">
                                <td><?php echo  $i ?></td>
                                <td><strong><?php echo  $v->QUESTION ?></strong></td>
                                <td><?php echo  $v->TYPE ?></td>
                                <td>
                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onClick="update_row_question('<?php echo  $v->QUESTION_ID ?>');"><span class="fa fa-pencil"></span></button>
                                    <button class="btn btn-info btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Configuration" onclick="conf_row_question(<?php echo $v->QUESTION_ID; ?>)"><span class="fa fa-cogs"></span></button>
                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row('<?php echo  $v->QUESTION_ID ?>','question_orientation');"><span class="fa fa-times"></span></button>
                                </td>
                            </tr>
                            <?php
                        $i++;
                        endforeach;
                        ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>
