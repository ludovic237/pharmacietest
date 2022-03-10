<?php

$title_for_layout = $universites->nom.' | Atlant-Front';
$page_for_layout = 'Universités';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $universites->nom;
}
$position_for_layout = '<li><a href="#">Universités</a></li><li class="active">'.$position.'</li>';
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
    <div class="col-md-9">
        <div class="blog-content">
            <?php
            if(!empty($universites->image))
            echo "<img src=\"".BASE_URL."/assets/".$universites->image."\" class=\"img-responsive\"/>";
            if($universites->nomc != null){
                echo "<h2 class=\"humanst-police\" style=\"font-family: \"Humanst521 Lt BT\";\">".$universites->nomc."</h2>";
                echo "<span class=\"blog-date\">".$universites->nom."</span>";
            }
            else {
                echo "<h2>".$universites->nom."</h2>";
                echo "<span class=\"blog-date\">&nbsp;</span>";
            }
            ?>
            <div id="content" style="margin-top: 30px;">
                <?php
                if(!empty($universites->image))
                echo $universites->contenu;
                ?>
            </div>
            <?php
            echo "<blockquote class=\"footer-contacts\">";
            echo "<div class=\"fc-row\">";
            echo "<span class=\"fa fa-home\"></span>";

            echo $contact->BP."<br/>";
            echo $universites->region;
            echo "</div>";
            echo "<div class=\"fc-row\">";
            echo "<span class=\"fa fa-phone\"></span>";
            if($contact->TELEPHONE_2 != null){
                $contact->TELEPHONE_1 .= ' \/ '.$contact->TELEPHONE_2;
            }
            echo $contact->TELEPHONE_1;
            echo "</div>";
            echo "<div class=\"fc-row\">";
            echo "<span class=\"fa fa-envelope\"></span>";
            echo "<strong>Email</strong><br>";
            echo "<a href=\"mailto:#\">".$contact->EMAIL."</a>";
            echo "</div>";
            echo "<div class=\"fc-row\">";
            echo "<span class=\"fa fa-link\"></span>";
            echo "<a href=\"http://".$contact->SITE."\">".$contact->SITE."</a>";
            echo "</div>";
            ?>
        </div>
        <div class="text-column">
            <h3>Commentaires</h3>
            <button id="ajouter_commentaire" type="<?php echo $universites->id; ?>" class="ajouter_commentaire btn btn-info btn-rounded btn-lg humanst-police h4">Ajouter un commentaire</button>
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
    <div class="col-md-3">
        <!-- ./Affichage des facultés internes d'une université -->

        <?php
        if($tout > 1){ // permet de savoir si une université contient des facultés internes
            ?>
            <div class="text-column this-animate" data-animate="fadeInRight">
                <h4>Facultés</h4>
                <div class="list-links">
                    <?php
                    foreach ($faculte as $k => $v):
                        ?>
                        <a href="#ancre" class="faculte"  id="<?php echo $v->iddept; ?>"><?php echo $v->nom; ?></a>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        <?php
        }else {
            if (!empty($filiere)) {
                echo "<div class=\"text-column this-animate\" data-animate=\"fadeInRight\">"."\n";
                echo "<h4>Filières</h4>"."\n";
                echo "<div class=\"list-links\"><br>"."\n";
                foreach ($filiere as $k => $v):
                    echo "<p style=\"color:#000000\">".$v->nom."</p>"."\n";
                endforeach;
                echo "</div>";
                echo "</div>";
            }
        }

        ?>


        <!-- ./Affichage des grandes écoles d'une université s'il en contient -->
        <?php
        if (!empty($ecole)) {
            echo "<div class=\"text-column this-animate\" data-animate=\"fadeInRight\">";
            echo "<h4 class=\"active\">Grandes Ecoles</h4>";
            echo "<div class=\"list-links\">";
            foreach ($ecole as $k => $v):
                $slug_univ = str_replace(' ','-',$v->nom );
                echo "<a  href=\"".BASE_URL."/universites/presentation/".$slug_univ."-" . $v->id . "\">" . $v->nom . "</a>";
            endforeach;
            echo "</div>";
            echo "</div>";
        }
        ?>

        <!-- Annonces -->

        <div class="col-md-12">

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
            if(!empty($concours)){
                if(!empty($concours)){
                    ?>
                    <div class="widget widget-success widget-carousel concours" style="cursor: pointer;">
                        <div class="owl-carousel" id="owl-example">
                            <?php
                            foreach ($concours as $k => $v):
                                list($year, $month, $day) = explode("-", $v->DATE_DOSSIER);
                                $date = $day."/".$month."/".$year;

                                ?>
                                <div>
                                    <div class="widget-title">Depot des dossiers</div>
                                    <div class="widget-subtitle">Date</div>
                                    <div class="widget-int"><?php echo $date; ?></div>
                                </div>
                            <?php

                            endforeach;
                            ?>
                        </div>
                        <div class="widget-controls">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                <?php
                }
                else {
                    ?>
                    <div class="widget widget-success widget-carousel concours" style="cursor: pointer;">
                        <div class="owl-carousel" id="owl-example">
                            <?php
                            foreach ($concours as $k => $v):
                                list($year, $month, $day) = explode("-", $v->DATE_DEBUT_CONCOURS);
                                $date = $day."/".$month."/".$year;

                                ?>
                                <div>
                                    <div class="widget-title">Depot des dossiers</div>
                                    <div class="widget-subtitle">Date</div>
                                    <div class="widget-int"><?php echo $date; ?></div>
                                </div>
                            <?php

                            endforeach;
                            ?>
                        </div>
                        <div class="widget-controls">
                            <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                <?php
                }
            }
            ?>

        </div>

    </div>


</div>