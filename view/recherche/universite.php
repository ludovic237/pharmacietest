<?php

function getSticky($case,$par,$value="",$initial=""){
    switch($case){
        case 1: // text field
            if(isset($_GET[$par])&& $_GET[$par]!=""){
                echo stripslashes($_GET[$par]);
            }
            break;
        case 2: // select
            if(isset($_GET[$par])&& $_GET[$par]==$value){
                echo "selected=\"selected\"";
            }
            break;
        case 3: // checkbox group
            if(isset($_GET[$par])&& $_GET[$par]!=""){
                echo "checked=\"checked\"";
            }
            break;
        case 4: // radio buttons
            if(isset($_GET[$par])&& $_GET[$par]==$value){
                echo "checked=\"checked\"";
            } else {
                if($initial !=""){
                    echo "checked=\"checked\"";
                }
            }
            break;
    }
}

$title_for_layout = 'Recherche'.' | Atlant-Front';
$page_for_layout = 'Recherche';

if($this->request->action == "index"){
    $position = "Filières";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Recherche</a>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/setting/plugins.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/scrolltotop/scrolltopcontrol.js"></script>';
?>

<!-- Affichage des résultats de la recherche-->


<?php if(!empty($recherche) && !empty($_GET)){ ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Résultats</h3>
            <ul class="panel-controls">
                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
            </ul>
        </div>
        <div class="panel-body">
            <table border="0" class="table datatable table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">Université(s)</th>
                    <th scope="col" class="">Ville</th>
                    <th scope="col" class="">Statut</th>
                    <th scope="col" class="">Type d'université</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($recherche as $k => $v): ?>
                    <a href="#"> <tr rel="<?php echo $v->id ?>" id="<?php echo $v->id_u ?>" style="cursor: pointer;">
                            <td><?php echo $v->Universite; ?></td>
                            <td><?php echo $v->Ville ?></td>
                            <td><?php echo $v->statut ?></td>
                            <td><?php echo $v->nomtype ?></td>
                        </tr></a>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
} else {
    if(!empty($_GET)){
        ?>
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Sorry!</strong> Pas de résultats concordant avec vos critères.
        </div>
    <?php
    }

    /*if(empty($queries)){
        ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Sorry!</strong> Pas de résultats disponible.
        </div>
        <?php
    }*/
}
?>

<form class="form-horizontal">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Recherche</strong> Avancée</h3>
        </div>
        <div class="panel-body form-group-separated">

            <div class="form-group" id="expression">
                <label class="col-md-3 col-xs-12 control-label">Expression</label>
                <div class="col-md-6 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                        <input type="text" name="srch_for" id="srch_for" class="form-control" value="<?php getSticky(1,'srch_for');?>"/>
                    </div>
                    <span class="help-block">Entrer l'expression à rechercher</span>
                </div>
            </div>

            <div class="form-group" id="niveau">
                <label class="col-md-3 col-xs-12 control-label">Niveau de formation</label>
                <div class="col-md-6 col-xs-12">
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-3" <?php getSticky(3,"srch_niveau-3","DUT");?> value="DUT" id="srch_niveau-3"/>DUT</label>
                    <span>&nbsp; &nbsp;</span>
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-1" <?php getSticky(3,"srch_niveau-1","BTS");?> value="BTS" id="srch_niveau-1"/>BTS</label>
                    <span>&nbsp; &nbsp;</span>
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-2" <?php getSticky(3,"srch_niveau-2","DSEP");?> value="DSEP" id="srch_niveau-2"/>DSEP</label>
                    <span>&nbsp; &nbsp;</span>
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-4" <?php getSticky(3,"srch_niveau-4","Licence");?> value="Licence" id="srch_niveau-4"/>Licence</label>
                    <span>&nbsp; &nbsp;</span>
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-5" <?php getSticky(3,"srch_niveau-5","Master");?> value="Master" id="srch_niveau-5"/>Master</label>
                    <span>&nbsp; &nbsp;</span>
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-6" <?php getSticky(3,"srch_niveau-6","Ingénieur");?> value="Ingenierie" id="srch_niveau-6"/>Ingenierie</label>
                    <span>&nbsp; &nbsp;</span>
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-7" <?php getSticky(3,"srch_niveau-7","Doctorat");?> value="Doctorat" id="srch_niveau-7"/>Doctorat</label>
                    <span>&nbsp; &nbsp;</span>
                    <label class="check"><input type="checkbox" class="icheckbox" name="srch_niveau-8" <?php getSticky(3,"srch_niveau-8","Spécialisation");?> value="specialisation" id="srch_niveau-8"/>Spécialisation</label>
                    <span>&nbsp; &nbsp;</span>

                    <span class="help-block">Sélectionner un ou plusieurs niveau d'étude</span>
                </div>
            </div>

            <div class="form-group" id="ville">
                <label class="col-md-3 col-xs-12 control-label">Ville</label>
                <div class="col-md-6 col-xs-12">
                    <select class="form-control select" name="srch_ville" id="srch_ville">
                        <?php echo "<option value=\"\">Tout&hellip;</option>\n"; ?>
                        <?php foreach ($ville as $k => $v):
                            echo "<option value=\"".$v->ville."\"";
                            getSticky(2,'srch_ville',$v->ville);
                            echo ">".$v->ville."</option>";
                        endforeach; ?>
                    </select>
                    <span class="help-block">Cibler une ville en particulier</span>
                </div>
            </div>

            <div class="form-group" id="type">
                <label class="col-md-3 col-xs-12 control-label">Type d'université</label>
                <div class="col-md-6 col-xs-12">
                    <?php foreach ($type as $k => $v): ?>
                        <label class="check"><input type="checkbox" class="icheckbox" name="srch_type-<?php echo $v->TYPE_ID; ?>" <?php getSticky(3,"srch_type-".$v->TYPE_ID,$v->NOM);?> value="<?php echo $v->TYPE_ID; ?>" id="srch_type-<?php echo $v->TYPE_ID; ?>"/><?php echo $v->NOM; ?></label>
                        <span>&nbsp; &nbsp;</span>
                    <?php endforeach; ?>
                    <span class="help-block">Sélectionner un ou plusieurs type</span>
                </div>
            </div>

            <div class="form-group" id="categorie">
                <label class="col-md-3 col-xs-12 control-label">Catégorie</label>
                <div class="col-md-6 col-xs-12">
                    <select class="form-control select" name="srch_categorie" id="srch_categorie">
                        <option value="">Tout&hellip;</option>
                        <?php foreach ($categorie as $k => $v): ?>
                            <option value="<?php echo $v->CATEGORIE_ID; ?>" <?php getSticky(2,'srch_categorie',$v->CATEGORIE_ID); ?>><?php echo $v->NOM; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="help-block">Quel categorie de formation ciblez-vous </span>
                </div>
            </div>

            <div class="form-group" id="filiere">
                <label class="col-md-3 col-xs-12 control-label">Filière</label>
                <div class="col-md-6 col-xs-12">
                    <select class="form-control select" name="srch_filiere" id="srch_filiere">
                        <option value="">Tout&hellip;</option>
                        <?php foreach ($categorie as $k => $v): ?>
                            <option value="<?php echo $v->CATEGORIE_ID; ?>" <?php getSticky(2,'srch_categorie',$v->CATEGORIE_ID); ?>><?php echo $v->NOM; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="help-block">Avez-vous une filière précise en tête</span>
                </div>
            </div>


            <div class="panel-footer">
                <button class="btn btn-primary pull-right" data-toggle="tooltip" data-placement="top" title="Rechercher">Rechercher</button>
            </div>
        </div>
</form>