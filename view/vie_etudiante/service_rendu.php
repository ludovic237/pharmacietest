<?php

$title_for_layout = 'Service rendu'.' | Atlant-Front';
$page_for_layout = 'Service rendu';

if($this->request->action == "index"){
    $position = "Tout";
}else{
    $position = 'Service rendu';
}
$position_for_layout = '<li><a href="#">Vie étudiante</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/js/plugins/mixitup/jquery.mixitup.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/appear/jquery.appear.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/knob/jquery.knob.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/owl/owl.carousel.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/scrolltotop/scrolltopcontrol.js"></script>';
?>
<!-- page content holder -->
<div class="page-content-holder">

    <div class="block-heading block-heading-centralized this-animate" data-animate="fadeInDown">
        <h2 class="heading-underline">Welcome at our Agency</h2>
        <div class="block-heading-text">
            Aenean enim ipsum, suscipit sit amet nisl vitae, convallis vehicula urna. Duis iaculis nunc at enim ultrices pharetra. Maecenas consectetur orci ut condimentum porttitor. Vivamus massa lorem, sollicitudin ac rhoncus ut, fringilla eget purus. In finibus nisl sed neque pulvinar.
        </div>
    </div>

</div>
<!-- ./page content holder -->
</div>
</div>


<!-- page content wrapper -->
<div class="page-content-wrap bg-light">

    <div class="divider"><div class="box"><span class="fa fa-angle-down"></span></div></div>

    <!-- page content holder -->
    <div class="page-content-holder">

        <div class="row">

            <div class="col-md-4">
                <div class="text-column text-column-centralized this-animate" data-animate="fadeInLeft">
                    <div class="text-column-icon">
                        <span class="fa fa-star"></span>
                    </div>
                    <h4>Company Mission</h4>
                    <div class="text-column-info">
                        Fugiat dapibus, tellus ac cursus commodo, mauris sit condim eser ntumsi nibh, uum a justo vitaes amet risus amets un. Posi sectetut amet fermntum orem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia nons.
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-column text-column-centralized this-animate" data-animate="fadeInUp">
                    <div class="text-column-icon">
                        <span class="fa fa-hand-o-up"></span>
                    </div>
                    <h4>Our Skills</h4>
                    <div class="text-column-info">
                        Donec eget bibendum purus. Pellentesque risus dui, fringilla et luctus sit amet, pulvinar eget ante. Nulla a venenatis metus. Vivamus dignissim urna eget velit luctus, ut vestibulum mi dignissim. Maecenas imperdiet.
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="text-column text-column-centralized this-animate" data-animate="fadeInRight">
                    <div class="text-column-icon">
                        <span class="fa fa-clock-o"></span>
                    </div>
                    <h4>Work Progress</h4>
                    <div class="text-column-info">
                        Morbi iaculis finibus nisi sed convallis. Sed id ex varius, suscipit orci in, rhoncus magna. Aliquam aliquam magna felis, ac euismod ligula blandit id. Praesent ac mollis enim, eget euismod ligula.
                    </div>
                </div>
            </div>

        </div>