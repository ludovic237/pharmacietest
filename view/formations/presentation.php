<?php

$title_for_layout = $formations->NOM.' | Atlant-Front';
$page_for_layout = 'Formations';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $formations->NOM;
}
$position_for_layout = '<li><a href="#">Formations</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/scrolltotop/scrolltopcontrol.js"></script>';
?>


<div class="row">
    <div class="col-md-9">
        <div class="blog-content">
            <?php

                echo "<h2 class=\"humanst-police\" style=\"font-family: \"Humanst521 Lt BT\";\">".$formations->NOM."</h2>";

            ?>
            <blockquote class="blockquote-primary">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>

            <p>&nbsp</p>

            <div class="col-md-12">
                <!-- START ACCORDION -->
                <div class="panel-group accordion">
                <?php
                $region_i = 1;
                foreach ($region as $k => $v):
                    // Création des accordions pour chaque région différente
                    if($region_i == 1){
                        $ancre = 'accOneColOne';
                    }elseif($region_i == 2){
                        $ancre = 'accOneColTwo';
                    }elseif($region_i == 3){
                        $ancre = 'accOneColThree';
                    }elseif($region_i == 4){
                        $ancre = 'accOneColFour';
                    }elseif($region_i == 5){
                        $ancre = 'accOneColFive';
                    }elseif($region_i == 6){
                        $ancre = 'accOneColSix';
                    }elseif($region_i == 7){
                        $ancre = 'accOneColSeven';
                    }elseif($region_i == 8){
                        $ancre = 'accOneColEight';
                    }elseif($region_i == 9){
                        $ancre = 'accOneColNine';
                    }else{
                        $ancre = 'accOneColTen';
                    }
                $region_i++;
                ?>
                    <div class="panel panel-info">
                        <div class="panel-heading " style="background: #33414e;">
                            <h4 class="panel-title">
                                <a href="#<?php echo $ancre ?>" style="color: #ffffff">
                                    <?php echo $v->region ?>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-body <?php if($region_i == 2) echo 'panel-body-open'; ?> list-group list-group-contacts" id="<?php echo $ancre ?>">
                            <?php
                            $nbre = 0;
                            //print_r(${$v->region}['nomuniv'][0]->nom);
                            /*foreach (${$v->region}['nomuniv'] as $p => $q):
                            $univ[$nbre] = $q;
                            $nbre++;
                            endforeach;*/
                            //echo $${$v->region}['nomuniv'][0]->nom;
                                for($i = 0;$i < ${$v->region}['nombre']%3; $i++){
                                    ?><div class="row"><?php
                                    for($j = 0;$j < 3; $j++){
                                       ?>
                                        <div class="col-md-4">
                                            <a href="#" class="list-group-item" style="background: transparent">
                                                <img src="<?php echo BASE_URL.'/assets/images/users/no-image.jpg'; ?>" class="pull-left" alt="<?php print_r(${$v->region}['nomuniv'][$nbre]->nom); ?>"/>
                                                <span class="contacts-title"><?php print_r(${$v->region}['nomuniv'][$nbre]->nom); ?></span>
                                                <p style="font-size: 12px;"><?php print_r(${$v->region}['nomuniv'][$nbre]->nomc); ?></p>
                                            </a>
                                        </div>
                                        <?php
                                        $nbre++;
                                        if($nbre == ${$v->region}['nombre']){break;}
                                    }
                                ?></div><?php
                                }

                            ?>
                            </div>
                        </div>
                    <?php

                endforeach;
                ?>
                    </div>
                <!-- END ACCORDION -->
            </div>

        <div class="text-column">
            <h3>Commentaires</h3>
            <button id="ajouter_commentaire" type="<?php echo $formations->id; ?>" class="ajouter_commentaire btn btn-info btn-rounded btn-lg humanst-police h4">Ajouter un commentaire</button>
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
        </div>
    <div class="col-md-3">
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