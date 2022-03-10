<?php

$title_for_layout = $concours->nom.' | Atlant-Front';
$page_for_layout = 'Concours';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $concours->nom;
}
$position_for_layout = '<li><a href="#">Concours</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/js/plugins/knob/jquery.knob.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/mixitup/jquery.mixitup.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/appear/jquery.appear.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/owl/owl.carousel.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/jquery-validation/jquery.validate.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/setting/plugins.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/forms.js"></script>';
?>


<div class="row">
    <div class="col-md-8">
        <div class="blog-content">
            <?php
            //echo "<img src=\"".BASE_URL."/assets/".$concours->image."\" class=\"img-responsive\"/>";
            if($concours->nomc != null){
                echo "<h2 class=\"humanst-police\" style=\"font-family: \"Humanst521 Lt BT\";\">".$concours->nomc."</h2>";
                echo "<span class=\"blog-date\" style=\"font-weight: 600;\">".$concours->nom."</span>";
            }
            else {
                echo "<h2 class=\"humanst-police\">".$concours->nom."</h2>";
                echo "<span class=\"blog-date\">&nbsp;</span>";
            }
            ?>
            <div id="content">
                <?php
                echo $concours->DESCRIPTION;
                ?>
            </div>
            <?php

            ?>
            <p>&nbsp</p>
            <div class="panel panel-colorful">
                <div class="panel-heading">
                    <h3 class="panel-title">Modalités d’admission</h3>
                </div>
                <div class="panel-body">
                    <p>
                        <?php
                        echo $concours->MODALITE_ADMISSION;
                        ?>
                    </p>
                    &nbsp&nbsp<h4 class="humanst-police" style="text-decoration: underline;">Composition du dossier</h4>&nbsp&nbsp
                    <?php
                    //echo $concours->COMPOSITION_DOSSIER;
                    $list = explode(';',$concours->COMPOSITION_DOSSIER);
                    ?>
                    <ul class="list-group" style="font-size: 14px;">
                        <?php foreach ($list as $v){
                            ?>
                            <li class="list-group-item" style="border: none;"> <i class="fa fa-check-square-o"></i><?php echo $v; ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <p>Pour plus d'information télécharger l'arrêté en bas de page</p>
                </div>
            </div>
            <p>&nbsp</p>
            <?php if($concours->DATE_DEBUT_CONCOURS != NULL){ ?>
            <div class="panel panel-colorful">
                <div class="panel-heading">
                    <h3 class="panel-title">Le contenu des épreuves du concours</h3>
                </div>
                <div class="panel-body">
                    <p>Ce concours comporte 3 épreuves écrites :</p>
                    <ul style="font-weight: 600;">
                        <?php
                        foreach ($matiere as $k => $v):
                        ?>
                        <li><?php echo $v->NOM; ?> (durée <?php echo heure($v->DUREE); ?>)</li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                    <p>Toutes ces épreuves n'ont pas les mêmes coefficients. </p>
                </div>
            </div>
            <p>&nbsp</p>
            <div class="panel panel-colorful">
                <div class="panel-heading">
                    <h3 class="panel-title">Préparation au concours</h3>
                </div>
                <div class="panel-body">
                    <p>Pour vous entraîner aux épreuves du concours et mettre toutes les chances de votre côté, : accédez aux annales et corrigés du concours Accès </p>

                </div>
            </div>
            <p>&nbsp</p>
            <button class="btn btn-primary center-block"><i class="fa fa-download"></i> Télécharger l'arrêté</button>
            <?php } ?>
        </div>
        <div class="text-column">
            <h3>Commentaires</h3>
            <button id="ajouter_commentaire" type="<?php echo $concours->id; ?>" class="ajouter_commentaire btn btn-info btn-rounded btn-lg humanst-police h4">Ajouter un commentaire</button>
        </div>
        <div class="block">
            <ul class="media-list">
                <?php //affiche_commentaire($univ_id,"commentaire_universite") ?>
            </ul>
        </div>
        <div class="text-column">
            <h3>Nouveu Commentaire</h3>
            <div class="text-column-info">Vous devrez être <a href="#">connecté</a> pour poster un commentaire.</div>
        </div>
    </div>
    <div class="col-md-4">
        <!-- ./Affichage des facultés internes d'une université -->

        <?php


        ?>


        <!-- Annonces -->

        <div class="col-md-11">

            <!-- NEWS WIDGET -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="../article/list.php">A Lire</a></h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body scroll" style="height: 230px;">
                    <?php //a_lire(); ?>
                </div>
            </div>
            <!-- END NEWS WIDGET -->
            <?php
            
            ?>

        </div>

    </div>


</div>