<?php

$title_for_layout = 'Universités'.' | Atlant-Front';
$page_for_layout = 'Universités';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Universités</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/js/plugins/mixitup/jquery.mixitup.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/appear/jquery.appear.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/knob/jquery.knob.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/owl/owl.carousel.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/scrolltotop/scrolltopcontrol.js"></script>';
?>
<div class="block-heading this-animate" data-animate="fadeInLeft">
    <h2>Catalogue d'universités</h2>
    <div class="block-heading-text">
        Listes de tous les universités existant sur le territoire camerounais avec leurs écoles partenaires, la ville où vous pouvez les trouver, le type d'enseignement qu'il donne ainsi que le secteur auquel ils appartiennent.
    </div>
</div>

<div class="row">
    <div class="col-md-9">

        <div class="row">
            <div class="col-md-12 gallery-filter">
                <div class="button-panel">
                    <button data-filter="all" class="btn btn-primary filter">Tout</button>
                    <button data-filter=".cat_Public" class="btn btn-primary filter">Public</button>
                    <button data-filter=".cat_Privée" class="btn btn-primary filter">Privée</button>
                </div>
            </div>


            <div class="row mix-grid thumbnails">
                <?php
                foreach ($universites as $k => $v):
                    echo"<div class=\"col-md-3 col-xs-3 mix cat_".$v->statut." cat_all\">"."\n";
                    echo "<a class=\"thumbnail-item\">"."\n";
                    echo "<img src=\"".BASE_URL."/assets/img/gallery/music-1.jpg\" alt=\"Space 2\"/>"."\n";
                    echo "</a>"."\n";
                    echo "<div class=\"blog-data\">"."\n";
                    echo "<h6><a href=\"".Router::url('universites/presentation/').$v->id."\">".$v->nom."</a></h6>"."\n";
                    echo "<span class=\"blog-date\">".$v->ville."</span>"."\n";
                    echo "<p class=\"type\">".$type[$v->id]."</p>"."\n";
                    echo "</div>"."\n";
                    echo "</div>"."\n";
                endforeach; ?>
                </div>
            <?php

                if($pages >= 1 && $this->request->page <= $pages){

                    $suivant = $this->request->page + 1 ;
                    $precedent = $this->request->page - 1;
                    echo "<ul class=\"pagination pagination-sm pull-right\">";
                    if($this->request->page != 1){
                        if(isset($_GET['type'])){
                            $type = $_GET['type'];
                            echo "<li class=\"\"><a href=\"?page=".$precedent."&type=".$type."\">«</a></li>";
                        }
                        else {
                            echo "<li class=\"\"><a href=\"?page=".$precedent."\">«</a></li>";
                        }
                    }
                    else {
                        echo "<li class=\"disabled\"><a>«</a></li>";
                    }
                    for ($x=1; $x<=$pages; $x++){
                        if(isset($_GET['type'])){
                            $type = $_GET['type'];
                            echo ($x == $this->request->page) ? '<li class="active"><a href="?page='.$x.'&type='.$type.'">'.$x.'</a></li>' : '<li><a href="?page='.$x.'&type='.$type.'">'.$x.'</a></li>';
                        }
                        else {
                            echo ($x == $this->request->page) ? '<li class="active"><a href="?page='.$x.'">'.$x.'</a></li>' : '<li><a href="?page='.$x.'">'.$x.'</a></li>';
                        }
                    }
                    if($this->request->page != $pages){
                        if(isset($_GET['type'])){
                            $type = $_GET['type'];
                            echo "<li class=\"\"><a href=\"?page=".$suivant."&type=".$type."\">»</a></li>";
                        }
                        else {
                            echo "<li class=\"\"><a href=\"?page=".$suivant."\">»</a></li>";
                        }
                    }
                    else {
                        echo "<li class=\"disabled\"><a>»</a></li>";
                    }
                    echo "</ul>";
                }
                ?>


            </div>
        </div>
        <div class="col-md-3">

            <div class="text-column this-animate" data-animate="fadeInRight">
                <h4>Categories</h4>
                <div class="list-links">
                    <a href="<?php echo BASE_URL.'/universites'; ?>">Tout</a>
                    <a href="<?php echo BASE_URL.'/universites/categorie/Universite-Etat-1'; ?>">Universités d'état</a>
                    <a href="<?php echo BASE_URL.'/universites/categorie/Ecole-medecine-3'; ?>">Ecoles de médécine</a>
                    <a href="<?php echo BASE_URL.'/universites/categorie/Ecole-ingenierie-2'; ?>">Ecoles d'ingénierie</a>
                    <a href="<?php echo BASE_URL.'/universites/categorie/Autre-universite-4'; ?>">Autres Universités</a>
                </div>
            </div>

            <div class="col-md-12">

                <!-- NEWS WIDGET -->
                <div class="panel panel-default">
                    <div class="panel-heading" data-toggle="tooltip" data-placement="top" title="Cliquer pour voir toutes les annonces">
                        <h3 class="panel-title"><a href="../article/list.php">A lire</a></h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body scroll" style="height: 230px;">
                        <?php //a_lire(); ?>
                    </div>
                </div>
                <!-- END NEWS WIDGET -->
                <div class="panel panel-danger">
                    <div class="panel-body panel-body-pricing">
                        <h2>Accès &<br/><small class="pull-right">Concours</small></h2>
                        <div style="border-bottom: 1px dotted #AAA;"></div>
                        <?php
                        $i = 1;
                        $today = new DateTime();
                        foreach ($concours as $k => $v):
                            if($v->DATE_DEBUT_CONCOURS!=null){
                                list($year, $month, $day) = explode("-", $v->DATE_DEBUT_CONCOURS);
                                $date = mktime(0, 0, 0, $month, $day, $year);
                                $date1 = new DateTime($v->DATE_DEBUT_CONCOURS);

                                if($date1 > $today){

                                    ?>
                                    <p data-toggle="tooltip" data-placement="top" title="<?php echo $rows['DESCRIPTION'] ?>"><h6><span class="fa fa-ellipsis-h text-success"></span>  <strong style="color: black;"><?php echo dateFrancais($date); ?></strong><p>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $v->NOM; ?></p></h6></p>
                                    <?php
                                    // limite le nombre d'affichages de la liste de concours
                                    if($i == 5) break;
                                    $i++;
                                }
                            }
                        endforeach;
                        ?>
                    </div>
                    <div class="panel-footer">
                        <a href="../concours.php"><button class="btn btn-danger btn-block">Tous les concours</button></a>
                        <style>
                            .panel-footer a:hover{
                                text-decoration: none;
                            }
                        </style>
                    </div>
                </div>

            </div>

        </div>
</div>