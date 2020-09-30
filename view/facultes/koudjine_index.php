<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Facultés';

if($this->request->action == "index"){
    $position = "Facultés";
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/forms.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script>
                $(window).load(function(){
                    $(\'#form1\').forms({
                        ownerEmail:\'#\'
                    })
                })
            </script>';
?>


<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group" id="ville">
                <label class="col-md-3 col-xs-12 control-label">Sélectionner une université</label>
                <div class="col-md-6 col-xs-12">
                    <select class="form-control select" name="srch_universite" id="srch_universite">
                        <?php
                        foreach ($universites as $k => $v): ?>
                            <option <?php if($v->UNIVERSITE_ID == $id) echo "selected=\"selected\""; ?> value="<?php echo $v->UNIVERSITE_ID; ?>" ><?php echo $v->NOM; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="col-md-3 col-xs-12">
                    <button id="charger" class="btn btn-primary pull-right" onclick="charger_faculte();">Charger</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if($id != null) {

    ?>

    <div class="row">
        <div class="col-md-4">

            <!-- START JQUERY VALIDATION PLUGIN -->
            <div class="block">
                <h4 class="titre">Ajouter une nouvelle faculté</h4>

                <form id="form1" class="form-horizontal" method="post">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="name col-md-12">
                                <input class="form-control" type="text" value="Nom:">
                                                    <span
                                                        class="help-block">Nom complet de la faculté sans abréviation</span>
                                <span class="error">*Ce nom n'est pas valide.</span> <span
                                    class="empty">*Veuillez remplir ce champ.</span></label><br>
                        </div>
                        <div class="form-group">
                            <label class="sigle notRequired col-md-12">
                                <input class="form-control" type="text" value="Sigle:">
                                <span class="help-block">Sigle de la faculté s'il en existe</span>
                                <span class="error">*Ce sigle n'est pas valide.</span> <span
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
                                <th width="100">Sigle</th>
                                <th width="350">Description</th>
                                <th width="100">actions</th>
                            </tr>
                            </thead>
                            <tbody id="tableau">
                            <?php
                            //echo $total;
                            //print_r($faculte);
                            if($total > 0){
                                foreach ($facultesList as $k => $v): ?>
                                    <tr id="<?php echo  $v->DEPARTEMENT_ID ?>">
                                        <td><strong><?php echo  $v->NOM ?></strong></td>
                                        <td><?php echo  $v->SIGLE ?></td>
                                        <td><?php echo  $v->DESCRIPTION ?></td>
                                        <td>
                                            <button class="btn btn-default btn-rounded btn-sm" onClick="update_row('<?php echo  $v->DEPARTEMENT_ID ?>');"><span class="fa fa-pencil"></span></button>
                                            <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('<?php echo  $v->DEPARTEMENT_ID ?>','<?php echo  $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
                                            <button class="btn btn-info btn-rounded btn-sm" onClick="filiere_row('<?php echo  $v->UNIVERSITE_ID ?>','<?php echo  $v->DEPARTEMENT_ID ?>');">Filières</button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            }
                            else{
                                ?>
                                <tr class="default" id="<?php echo  $faculte->DEPARTEMENT_ID; ?>">
                                    <td><strong class="nom_dept">Par défaut</strong></td>
                                    <td></td>
                                    <td>Cette faculté est créée de façon automatique à la créatio d'une université et ne disparait que dès lors qu'on ajoute une nouvelle faculté.<?php echo "\n" ?> Et si l'université en question n'est pas subdivisé en faculté comme tel est le cas pour beaucoup, il suffira de servir de celui-ci pour ajouter les filières présentent dans cette université. </td>
                                    <td>
                                        <button class="btn btn-info btn-rounded btn-sm" onClick="filiere_row('<?php echo  $faculte->UNIVERSITE_ID; ?>','<?php echo  $faculte->DEPARTEMENT_ID; ?>');">Filières</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
<?php
}

?>