<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Formations';
$action_for_layout = 'Ajouter';

if($this->request->action == "index"){
    $position = "Formations";
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
';
?>


    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group" id="">
                    <label class="col-md-2 col-xs-12 control-label">Sélectionner une université</label>
                    <div class="col-md-3 col-xs-12">
                        <select class="form-control selectpicker universite col-md-6" name="srch_universite" id="srch_universite">
                            <option <?php if($id_univ == null || $id_univ == 0) echo "selected=\"selected\""; ?> value="defaut" >Tout...</option>
                            <?php

                            foreach ($universites as $k => $v): ?>
                                <option <?php if($v->UNIVERSITE_ID == $id_univ) echo "selected=\"selected\""; ?> value="<?php echo $v->UNIVERSITE_ID; ?>" ><?php echo $v->NOM; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <label class="col-md-2 col-xs-12 control-label">Choisir une faculté</label>
                    <div class="col-md-3 col-xs-12">
                        <select class="form-control selectpicker faculte col-md-6" title='Tout...' name="srch_faculte" id="srch_faculte">
                            <option <?php if($id_fac == null||$id_fac == 0) echo "selected=\"selected\""; ?> value="defaut" >Tout...</option>
                            <?php
                            if(!empty($facultesList)){
                            foreach ($facultesList as $k => $v): ?>
                                <option <?php if($v->DEPARTEMENT_ID == $id_fac) echo "selected=\"selected\""; ?> value="<?php echo $v->DEPARTEMENT_ID; ?>" ><?php echo $v->NOM; ?></option>
                            <?php
                            endforeach;
                            }
                            else{
                                if($id_univ != null&&$id_univ != 0){
                                ?>
                                <option <?php if($faculte->DEPARTEMENT_ID == $id_fac) echo "selected=\"selected\""; ?> value="<?php echo $faculte->DEPARTEMENT_ID; ?>" ><?php echo 'Par Défaut'; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div style="padding-top: 40px;"></div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Sélectionner une catégorie</label>
                    <div class="col-md-6 col-xs-12">
                        <select class="form-control categorie selectpicker" title='Tout...' name="categorie" id="srch_categorie">
                            <option <?php if($id_cat == null || $id_cat == 0) echo "selected=\"selected\""; ?> value="defaut" >Tout...</option>
                            <?php
                            foreach ($categories as $k => $v): ?>
                                <option <?php if($v->CATEGORIE_ID == $id_cat) echo "selected=\"selected\""; ?> value="<?php echo $v->CATEGORIE_ID; ?>" ><?php echo $v->NOM; ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <button id="charger" class="btn btn-primary pull-right" onclick="lister_formations();">Charger</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
if($id_univ != null) {

    ?>

    <!-- START RESPONSIVE TABLES -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body panel-body-table">

                    <div class="panel-body">
                        <table class="table datatable table-bordered table-striped table-actions">
                            <thead>
                            <tr>
                                <th width="200">Nom</th>
                                <th width="150">Sigle</th>
                                <th width="250">Faculté</th>
                                <th width="150">Catégorie</th>
                                <th width="150">Niveau de formation</th>
                                <th width="250">Description</th>
                                <th width="100">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            if($id_fac != null){

                                //debug($filierecat);
                                foreach ($filiere as $k => $v): ?>
                                    <tr id="<?php echo $v->id; ?>">
                                        <td><strong><?php echo $v->nomf; ?></strong></td>
                                        <td><?php echo $v->sigle; ?></td>
                                        <td><?php
                                            if($v->sigled != null)
                                            echo $v->nomd.' ('.$v->sigled.')';
                                            else echo $v->nomd;
                                            ?>

                                        </td>
                                        <td><?php echo $v->nomc; ?></td>
                                        <td><?php
                                            $niveau = array();
                                            $niveau = explode(';',$v->niveau);
                                            foreach($niveau as $a => $b){
                                                ?><span class="col-md-12"><?php echo $b;  ?></span><?php
                                            }

                                            ?>

                                        </td>
                                        <td><?php echo $v->description; ?></td>
                                        <td>
                                            <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_filiere(<?php echo $v->id; ?>)"><span class="fa fa-pencil"></span></button>
                                            <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row_filiere('<?php echo $v->id; ?>','filiere');"><span class="fa fa-times"></span></button>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            }else{
                                //foreach()
                                if(!empty($facultesList)){
                                    foreach($facultesList as $p => $q){
                                        foreach ($filiere[$q->DEPARTEMENT_ID] as $k => $v): ?>
                                            <tr id="<?php echo $v->id; ?>">
                                                <td><strong><?php echo $v->nomf; ?></strong></td>
                                                <td><?php echo $v->sigle; ?></td>
                                                <td>
                                                    <?php
                                                    if($q->SIGLE != null)
                                                        echo $q->NOM.' ('.$q->SIGLE.')';
                                                    else echo $q->NOM;
                                                    ?>
                                                </td>
                                                <td><?php echo $v->nomc; ?></td>
                                                <td><?php
                                                    $niveau = array();
                                                    $niveau = explode(';',$v->niveau);
                                                    foreach($niveau as $a => $b){
                                                        ?><span class="col-md-12"><?php echo $b;  ?></span><?php
                                                    }

                                                    ?>

                                                </td>
                                                <td><?php echo $v->description; ?></td>
                                                <td>
                                                    <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_filiere(<?php echo $v->id; ?>)"><span class="fa fa-pencil"></span></button>
                                                    <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row_filiere('<?php echo $v->id; ?>','filiere');"><span class="fa fa-times"></span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    }
                                }elseif(!empty($faculte)){
                                    foreach ($filiere as $k => $v): ?>
                                        <tr id="<?php echo $v->id; ?>">
                                            <td><strong><?php echo $v->nomf; ?></strong></td>
                                            <td><?php echo $v->sigle; ?></td>
                                            <td>
                                                <?php
                                                if($faculte->SIGLE != null)
                                                    echo $faculte->NOM.' ('.$faculte->SIGLE.')';
                                                else echo $faculte->NOM;
                                                ?>
                                            </td>
                                            <td><?php echo $v->nomc; ?></td>
                                            <td><?php
                                                $niveau = array();
                                                $niveau = explode(';',$v->niveau);
                                                foreach($niveau as $a => $b){
                                                    ?><span class="col-md-12"><?php echo $b;  ?></span><?php
                                                }

                                                ?>

                                            </td>
                                            <td><?php echo $v->description; ?></td>
                                            <td>
                                                <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_univ(<?php echo $v->id; ?>)"><span class="fa fa-pencil"></span></button>
                                                <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row_filiere('<?php echo $v->id; ?>','filiere');"><span class="fa fa-times"></span></button>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                }

                            }

                             ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- END RESPONSIVE TABLES -->
<?php
}
elseif($id_cat != null){
    ?>
    <!-- START RESPONSIVE TABLES -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body panel-body-table">

                    <div class="panel-body">
                        <table class="table datatable table-bordered table-striped table-actions">
                            <thead>
                            <tr>
                                <th width="200">Nom</th>
                                <th width="150">Sigle</th>
                                <th width="250">Faculté</th>
                                <th width="150">Catégorie</th>
                                <th width="150">Niveau de formation</th>
                                <th width="250">Description</th>
                                <th width="100">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                                //debug($filierecat);
                                foreach ($filiere as $k => $v): ?>
                                    <tr id="<?php echo $v->id; ?>">
                                        <td><strong><?php echo $v->nomf; ?></strong></td>
                                        <td><?php echo $v->sigle; ?></td>
                                        <td><?php
                                            if($v->sigled != null)
                                                echo $v->nomd.' ('.$v->sigled.')';
                                            else echo $v->nomd;
                                            ?>

                                        </td>
                                        <td><?php echo $v->nomc; ?></td>
                                        <td><?php
                                            $niveau = array();
                                            $niveau = explode(';',$v->niveau);
                                            foreach($niveau as $a => $b){
                                                ?><span class="col-md-12"><?php echo $b;  ?></span><?php
                                            }

                                            ?>

                                        </td>
                                        <td><?php echo $v->description; ?></td>
                                        <td>
                                            <button class="btn btn-default btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Modifier" onclick="update_row_filiere(<?php echo $v->id; ?>)"><span class="fa fa-pencil"></span></button>
                                            <button class="btn btn-danger btn-rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Supprimer" onClick="delete_row_filiere('<?php echo $v->id; ?>','filiere');"><span class="fa fa-times"></span></button>
                                        </td>
                                    </tr>
                                <?php endforeach;

                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- END RESPONSIVE TABLES -->
<?php
}

?>