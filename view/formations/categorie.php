<?php

$title_for_layout = 'Formations'.' | Atlant-Front';
$page_for_layout = 'Formations';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = $this->request->action;
}
$position_for_layout = '<li><a href="#">Formations</a></li><li class="active">'.$titre->NOM.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/js/plugins/tocify/jquery.tocify.min.js"></script><script>
            $(function() {
                var toc = $("#tocify").tocify({context: ".tocify-content", showEffect: "fadeIn",extendPage:false,selectors: "h2, h3, h4" });
            });
        </script>';
?>

<div class="content-frame">

<!-- START CONTENT FRAME TOP -->
<div class="content-frame-top">
    <div class="page-title">
        <h2><span class=""></span><a href="<?php echo BASE_URL."/formations/" ?>"> Liste des filières</a></h2>

    </div>

    <?php
    /*if(isset($_GET['param'])){
        extract($_GET);
        if($param==1){
            echo "<div class=\"pull-right\">";
            echo "<div class=\"btn-group btn-rounded alphabet\">";
            echo "<a href=\"?param=1\"><button class=\"btn btn-default active\">A - D</button></a>";
            echo "<a href=\"?param=2\"><button class=\"btn btn-default\">E - H</button></a>";
            echo "<a href=\"?param=3\"><button class=\"btn btn-default\">I - L</button></a>";
            echo "<a href=\"?param=4\"><button class=\"btn btn-default\">M - P</button></a>";
            echo "<a href=\"?param=5\"><button class=\"btn btn-default\">Q - Z</button></a>";
            echo "</div>";
            echo "</div>";
        }
        if($param==2){
            echo "<div class=\"pull-right\">";
            echo "<div class=\"btn-group btn-rounded alphabet\">";
            echo "<a href=\"?param=1\"><button class=\"btn btn-default\">A - D</button></a>";
            echo "<a href=\"?param=2\"><button class=\"btn btn-default active\">E - H</button></a>";
            echo "<a href=\"?param=3\"><button class=\"btn btn-default\">I - L</button></a>";
            echo "<a href=\"?param=4\"><button class=\"btn btn-default\">M - P</button></a>";
            echo "<a href=\"?param=5\"><button class=\"btn btn-default\">Q - Z</button></a>";
            echo "</div>";
            echo "</div>";
        }
        if($param==3){
            echo "<div class=\"pull-right\">";
            echo "<div class=\"btn-group btn-rounded alphabet\">";
            echo "<a href=\"?param=1\"><button class=\"btn btn-default\">A - D</button></a>";
            echo "<a href=\"?param=2\"><button class=\"btn btn-default\">E - H</button></a>";
            echo "<a href=\"?param=3\"><button class=\"btn btn-default active\">I - L</button></a>";
            echo "<a href=\"?param=4\"><button class=\"btn btn-default\">M - P</button></a>";
            echo "<a href=\"?param=5\"><button class=\"btn btn-default\">Q - Z</button></a>";
            echo "</div>";
            echo "</div>";
        }
        if($param==4){
            echo "<div class=\"pull-right\">";
            echo "<div class=\"btn-group btn-rounded alphabet\">";
            echo "<a href=\"?param=1\"><button class=\"btn btn-default\">A - D</button></a>";
            echo "<a href=\"?param=2\"><button class=\"btn btn-default\">E - H</button></a>";
            echo "<a href=\"?param=3\"><button class=\"btn btn-default\">I - L</button></a>";
            echo "<a href=\"?param=4\"><button class=\"btn btn-default active\">M - P</button></a>";
            echo "<a href=\"?param=5\"><button class=\"btn btn-default\">Q - Z</button></a>";
            echo "</div>";
            echo "</div>";
        }
        if($param==5){
            echo "<div class=\"pull-right\">";
            echo "<div class=\"btn-group btn-rounded alphabet\">";
            echo "<a href=\"?param=1\"><button class=\"btn btn-default\">A - D</button></a>";
            echo "<a href=\"?param=2\"><button class=\"btn btn-default\">E - H</button></a>";
            echo "<a href=\"?param=3\"><button class=\"btn btn-default\">I - L</button></a>";
            echo "<a href=\"?param=4\"><button class=\"btn btn-default\">M - P</button></a>";
            echo "<a href=\"?param=5\"><button class=\"btn btn-default active\">Q - Z</button></a>";
            echo "</div>";
            echo "</div>";
        }
    }
    else {
        echo "<div class=\"pull-right\">";
        echo "<div class=\"btn-group btn-rounded alphabet\">";
        echo "<a href=\"?param=1\"><button class=\"btn btn-default active\">A - D</button></a>";
        echo "<a href=\"?param=2\"><button class=\"btn btn-default\">E - H</button></a>";
        echo "<a href=\"?param=3\"><button class=\"btn btn-default\">I - L</button></a>";
        echo "<a href=\"?param=4\"><button class=\"btn btn-default\">M - P</button></a>";
        echo "<a href=\"?param=5\"><button class=\"btn btn-default\">Q - Z</button></a>";
        echo "</div>";
        echo "</div>";
    }*/
    ?>

</div>
<!-- END CONTENT FRAME TOP -->

<!-- START CONTENT FRAME LEFT -->
<div class="content-frame-left">
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 class="push-up-0" >Categories</h3>
            <?php
            echo "<div class=\"list-group border-bottom\" id=\"categorie\">";
            foreach ($categorie as $k => $v):

                if ($paramcategorie==$v->SLUG) {
                    echo "<a href=\"".BASE_URL."/formations/categorie/".$v->SLUG."\" class=\"list-group-item category active\" style=\"border: none;\"><span class=\"fa fa-angle-double-right text-success\"></span>".$v->NOM."</a>";
                }
                else {

                    echo "<a href=\"".BASE_URL."/formations/categorie/".$v->SLUG."\" class=\"list-group-item category\" style=\"border: none;\"><span class=\"fa fa-angle-double-right text-success\"></span>".$v->NOM."</a>";

                }

            endforeach;
            echo "</div>";
            ?>
        </div>
    </div>
</div>
<!-- END CONTENT FRAME LEFT -->

<!-- START CONTENT FRAME BODY -->
<div class="content-frame-body">
    <div class="panel panel-default">

        <div class="row" id="content" style="">
            <?php

            if(isset($_GET['param'])){
                extract($_GET);
            }
            else {
                $param=1;
            }

            echo "<div class=\"col-md-11\">";
            echo "<div class=\"panel panel-default\">";
            echo "<div class=\"panel-body\">";
            echo "<div class=\"tocify-content\">";

                for ($i="A"; $i <= "Z" ; $i++) {
                    if(!empty($formations[$i])){
                        echo"<div class=\"list-group-contacts\" style=\"margin-bottom: 20px;\">";
                        echo "<h2 style=\"border-bottom: 1px solid black;\">".$i."</h2>";
                        foreach ($formations[$i] as $k => $v):
                            //echo $v->NOM;
                            $variable = $i.$v->id;
                            echo "<li class=\"list-group-item\">";
                            echo "<span class=\"contacts-title\">".$v->NOM."</span>";
                            echo "<p class=\"text-success\">".${$variable}['nomcategorie']->NOM."</p>";
                            echo "<div class=\"list-group-controls\">";
                            ?>
                            <span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="
                                <?php
                            foreach (${$variable}['nomuniv'] as $p => $q):
                                echo $q->NOM;
                                echo '';
                            endforeach;
                            ?>
                                        "><?php echo ${$variable}['nombre'] ?></span>
                            <?php
                            echo "</div>";
                            echo "</li>";
                        endforeach;
                        echo "</div>";
                    }
                    if($i=="Z"){break;}
                }


            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"col-md-1\" style=\"position: relative;\">";
            echo "<div id=\"tocify\"></div>";
            echo "</div>";
            ?>
        </div>
    </div>
</div>
<!-- END CONTENT FRAME BODY -->
</div>