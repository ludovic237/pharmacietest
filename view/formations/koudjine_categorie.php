<?php

$title_for_layout = ' Admin -'.'Formations';
$page_for_layout = 'Categories';

if($this->request->action == "index"){
    $position = "Categories";
}
$position = "Categories";
$position_for_layout = '<li><a href="#">Formations</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/formsCategorie.js"></script>
<script>
                $(window).load(function(){
                    $(\'#form3\').forms({
                        ownerEmail:\'#\'
                    })
                })
            </script>';
?>




    <div class="row">
        <div class="col-md-4">

            <!-- START JQUERY VALIDATION PLUGIN -->
            <div class="block">
                <h4 class="titre">Ajouter une nouvelle catégorie</h4>

                <form id="form3" class="form-horizontal" method="post">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="name col-md-12">
                                <input class="form-control" type="text" value="Nom:">
                                                    <span
                                                        class="help-block">Nom complet de la catégorie</span>
                                <span class="error">*Ce nom n'est pas valide.</span> <span
                                    class="empty">*Veuillez remplir ce champ.</span></label><br>
                        </div>

                        <div class="form-group">
                            <label class="description notRequired col-md-12">
                                <textarea class="form-control">Description:</textarea>
                                <span class="help-block">Description detaillée ci possible en vue de mieux aider l'internaute</span>
                            </label><br>
                        </div>
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
                                <th width="200">Nom</th>
                                <th width="100">Slug</th>
                                <th width="350">Description</th>
                                <th width="100">actions</th>
                            </tr>
                            </thead>
                            <tbody id="tableau">
                            <?php
                            //echo $total;
                            //print_r($faculte);
                                foreach ($categories as $k => $v): ?>
                                    <tr id="<?php echo  $v->CATEGORIE_ID ?>">
                                        <td><strong><?php echo  $v->NOM ?></strong></td>
                                        <td><?php echo  $v->SLUG ?></td>
                                        <td><?php echo  $v->DESCRIPTION ?></td>
                                        <td>
                                            <button class="btn btn-default btn-rounded btn-sm" onClick="update_row_categorie('<?php echo  $v->CATEGORIE_ID ?>');"><span class="fa fa-pencil"></span></button>
                                            <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row_filiere('<?php echo  $v->CATEGORIE_ID ?>','categorie');"><span class="fa fa-times"></span></button>
                                            <button class="btn btn-info btn-rounded btn-sm" onClick="filiere_categorie_row('<?php echo  $v->CATEGORIE_ID ?>');">Filières</button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
