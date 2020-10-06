<?php

$title_for_layout = ' Admin -' . 'Accueil';
$page_for_layout = 'Tableau de bord';


$position_for_layout = '';
$script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/icheck/icheck.min.js"></script>        
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/morris/morris.min.js"></script>       
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/rickshaw/rickshaw.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/owl/owl.carousel.min.js"></script> 

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/icheck/icheck.min.js"></script>        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>                
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/owl/owl.carousel.min.js"></script>                 
        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/settings.js"></script>
        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins.js"></script>        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/actions.js"></script>
        
        <script type="text/javascript" src="' . BASE_URL . '/koudjine/js/demo_dashboard.js"></script>


<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/daterangepicker/daterangepicker.js"></script>
';
?>

<!-- START WIDGETS -->
<div class="row">
    <div class="col-md-3">

        <!-- START WIDGET SLIDER -->
        <div class="widget widget-default widget-carousel">
            <div class="owl-carousel" id="owl-example">
                <div>
                    <div class="widget-title">Total Visitors</div>
                    <div class="widget-subtitle">27/08/2014 15:23</div>
                    <div class="widget-int">3,548</div>
                </div>
                <div>
                    <div class="widget-title">Returned</div>
                    <div class="widget-subtitle">Visitors</div>
                    <div class="widget-int">1,695</div>
                </div>
                <div>
                    <div class="widget-title">New</div>
                    <div class="widget-subtitle">Visitors</div>
                    <div class="widget-int">1,977</div>
                </div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET SLIDER -->

    </div>
    <div class="col-md-3">

        <!-- START WIDGET CLOCK -->
        <div class="widget widget-danger widget-padding-sm">
            <div class="widget-big-int plugin-clock">00:00</div>
            <div class="widget-subtitle plugin-date">Loading...</div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
            <div class="widget-buttons widget-c3">
                <div class="col">
                    <a href="#"><span class="fa fa-clock-o"></span></a>
                </div>
                <div class="col">
                    <a href="#"><span class="fa fa-bell"></span></a>
                </div>
                <div class="col">
                    <a href="#"><span class="fa fa-calendar"></span></a>
                </div>
            </div>
        </div>
        <!-- END WIDGET CLOCK -->

    </div>
</div>
<!-- END WIDGETS -->

<div class="row">
    <div class="col-md-12">

        <!-- START SALES BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Vente</h3>
                    <span>Activité de vente</span>
                </div>
                <ul class="panel-controls panel-controls-title">
                    <li>
                        <div id="reportrange" class="dtrange">
                            <span></span><b class="caret"></b>
                        </div>
                    </li>
                    <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li>
                </ul>

            </div>
            <div class="panel-body">
                <div class="row">
                    <!-- <div class="col-md-3">

                
                        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                            <div class="widget-item-left">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int num-count"><?php echo $totalVente; ?></div>
                                <div class="widget-title">Vente total</div>
                                <div class="widget-subtitle">In your mailbox</div>
                            </div>
                            <div class="widget-controls">
                                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                            </div>
                        </div>
                       

                    </div> -->
                    <div class="col-md-3">

                        <!-- START WIDGET MESSAGES -->
                        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                            <div class="widget-item-left">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int num-count">*</div>
                                <div class="widget-title">De l'année</div>
                                <div class="widget-subtitle"><?php echo $totalVenteYear; ?> FCFA</div>
                            </div>
                            <div class="widget-controls">
                                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                            </div>
                        </div>
                        <!-- END WIDGET MESSAGES -->

                    </div>
                    <div class="col-md-3">

                        <!-- START WIDGET MESSAGES -->
                        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                            <div class="widget-item-left">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int num-count">*</div>
                                <div class="widget-title">Du mois</div>
                                <div class="widget-subtitle"><?php echo $totalVenteMonth; ?> FCFA</div>
                            </div>
                            <div class="widget-controls">
                                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                            </div>
                        </div>
                        <!-- END WIDGET MESSAGES -->

                    </div>
                    <div class="col-md-3">

                        <!-- START WIDGET MESSAGES -->
                        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                            <div class="widget-item-left">
                                <span class="fa fa-envelope"></span>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int num-count">*</div>
                                <div class="widget-title">De la semaine</div>
                                <div class="widget-subtitle"><?php echo $totalVenteWeek; ?> FCFA</div>
                            </div>
                            <div class="widget-controls">
                                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                            </div>
                        </div>
                        <!-- END WIDGET MESSAGES -->

                    </div>
                </div>
            </div>
        </div>
        <!-- END SALES BLOCK -->

    </div>
</div>