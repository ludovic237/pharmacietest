<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Types d\'universités';

if($this->request->action == "index"){
    $position = "Types";
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/demo_tables.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/formsType.js"></script>
<script>
                $(window).load(function(){
                    $(\'#form2\').forms({
                        ownerEmail:\'#\'
                    })
                })
            </script>';
?>






    <div class="row">
        <div class="col-md-4"> 

            <!-- START JQUERY VALIDATION PLUGIN -->
            <div class="block">
                <h4 class="titre">Proposer une nouveau Type d'université</h4>

                <form id="form2" class="form-horizontal" method="post">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="name col-md-12">
                                <input class="form-control" type="text" value="Nom:">
                                <span class="help-block">Nom complet du dit type d'université</span>
                                <span class="error">*Ce nom n'est pas valide.</span>
                                <span class="empty">*Veuillez remplir ce champ.</span></label><br>
                        </div>
                        <div class="form-group">
                            <label class="description col-md-12">
                                <textarea class="form-control">Description:</textarea>
                                <span class="empty">*Veuillez remplir ce champ.</span>
                                <span class="help-block">Description detaillée ci possible en vue de mieux aider l'internaute</span>
                            </label><br>
                        </div>
                        <div class="form-group" <?php if($this->Session->user('STATUT') != 'Administrateur'){ ?>style="visibility: hidden;"<?php } ?>>
                            <label class="certification col-md-12">
                                <select class="selectpicker" name="certif" id="certif" >
                                    <option  value="1">En attente</option>
                                    <option  value="0">Certifié</option>
                                </select>
                                <span class="help-block">Permet de définir si le type est certifié (Certification) ou pas</span>
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
                <div class="panel-heading">
                    <h3 class="panel-title">Types Proposés</h3>
                </div>

                <div class="panel-body panel-body-table">

                    <div class="panel-body">
                        <table class="table table-bordered table-actions">
                            <thead>
                            <tr>
                                <th width="200">Nom</th>
                                <th width="350">Description</th>
                                <th width="100">Slug</th>
                                <th width="100">Certification</th>
                                <th width="100">actions</th>
                            </tr>
                            </thead>
                            <tbody id="tableau">
                            <?php
                            //echo $total;
                            //print_r($faculte);

                                foreach ($typesnoncertif as $k => $v): ?>
                                    <tr id="<?php echo  $v->TYPE_ID ?>">
                                        <td><strong><?php echo  $v->NOM ?></strong></td>
                                        <td><?php echo  $v->DESCRIPTION ?></td>
                                        <td><?php echo  $v->SLUG ?></td>
                                        <?php
                                        if($v->CERTIFICATION == 'Certifié')
                                        {?><td><span class="label label-success"><?php echo $v->CERTIFICATION; ?></span></td> <?php ;}
                                        else {?><td><span class="label label-warning"><?php echo $v->CERTIFICATION; ?></span></td> <?php ;}
                                        ?>
                                        <td>
                                            <button class="btn btn-default btn-rounded btn-sm" onClick="update_row_type('<?php echo  $v->TYPE_ID ?>');"><span class="fa fa-pencil"></span></button>
                                            <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('<?php echo  $v->TYPE_ID ?>','<?php echo  $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Types Fonctionnels</h3>
        </div>

        <div class="panel-body panel-body-table">

            <div class="panel-body">
                <table class="table table-bordered table-actions">
                    <thead>
                    <tr>
                        <th width="200">Nom</th>
                        <th width="350">Description</th>
                        <th width="100">Slug</th>
                        <th width="100">Certification</th>
                        <th width="100">actions</th>
                    </tr>
                    </thead>
                    <tbody id="tableau1">
                    <?php
                    //echo $total;
                    //print_r($faculte);

                    foreach ($typescertif as $k => $v): ?>
                        <tr id="<?php echo  $v->TYPE_ID ?>">
                            <td><strong><?php echo  $v->NOM ?></strong></td>
                            <td><?php echo  $v->DESCRIPTION ?></td>
                            <td><?php echo  genererSlug($v->NOM) ?></td>
                            <?php
                            if($v->CERTIFICATION == 'Certifié')
                            {?><td><span class="label label-success"><?php echo $v->CERTIFICATION; ?></span></td> <?php ;}
                            else {?><td><span class="label label-warning"><?php echo $v->CERTIFICATION; ?></span></td> <?php ;}
                            ?>
                            <td>
                                <button class="btn btn-default btn-rounded btn-sm" onClick="update_row_type('<?php echo  $v->TYPE_ID ?>');"><span class="fa fa-pencil"></span></button>
                                <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('<?php echo  $v->TYPE_ID ?>','<?php echo  $this->request->controller; ?>');"><span class="fa fa-times"></span></button>
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


