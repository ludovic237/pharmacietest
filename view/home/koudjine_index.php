<?php

$title_for_layout = ' Admin -' . 'Accueil';
// $page_for_layout = 'Tableau de bord';


$position_for_layout = '';
$script_for_layout = '
<script type="text/javascript" src="' . BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>

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

';
?>

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
        </div>
        <!-- END SALES BLOCK -->

    </div>
</div>
<!-- START WIDGETS -->
<div class="row">

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
    <div class="col-md-3">

        <!-- START WIDGET REGISTRED -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
            <!-- <div class="widget-item-left">
                <span class="fa fa-user"></span>
            </div> -->
            <div style="padding-top: 10px;">
                <div class="widget-int num-count "><span id="nbrVente">0</span> FCFA</div>
                <div class="widget-title">Chiffre d'affaire</div>
                <div class="widget-subtitle">Vente</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET REGISTRED -->



    </div>
    <div class="col-md-3">

        <!-- START WIDGET REGISTRED -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
            <!-- <div class="widget-item-left">
                <span class="fa fa-user"></span>
            </div> -->
            <div style="padding-top: 10px;">
                <div class="widget-int num-count"><span id="beneficeTotal">0</span> FCFA</div>
                <div class="widget-title">Benefice</div>
                <div class="widget-subtitle">Vente</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET REGISTRED -->



    </div>
    <div class="col-md-3">

        <!-- START WIDGET REGISTRED -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
            <!-- <div class="widget-item-left">
                <span class="fa fa-user"></span>
            </div> -->
            <div style="padding-top: 10px;">
                <div class="widget-int num-count " id="nbrProduit">0</div>
                <div class="widget-title">Total d'article</div>
                <div class="widget-subtitle">Vente</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET REGISTRED -->



    </div>
</div>
<!-- END WIDGETS -->


<div class="row">

    <div class="col-md-4">

        <!-- START PROJECTS BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Projects</h3>
                    <span>Projects activity</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body panel-body-table">

                <div class="progress-list">
                    <div class="pull-left"><strong>In Queue</strong></div>
                    <div class="pull-right">75%</div>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">75%</div>
                    </div>
                </div>
                <div class="progress-list">
                    <div class="pull-left"><strong>Shipped Products</strong></div>
                    <div class="pull-right">450/500</div>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
                    </div>
                </div>
                <div class="progress-list">
                    <div class="pull-left"><strong class="text-danger">Returned Products</strong></div>
                    <div class="pull-right">25/500</div>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">5%</div>
                    </div>
                </div>
                <div class="progress-list">
                    <div class="pull-left"><strong class="text-warning">Progress Today</strong></div>
                    <div class="pull-right">75/150</div>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                    </div>
                </div>
                <p><span class="fa fa-warning"></span> Data update in end of each hour. You can update it manual by pressign update button</p>
            </div>
        </div>
        <!-- END PROJECTS BLOCK -->

    </div>
    <div class="col-md-4">

        <!-- START SALES & EVENTS BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Sales & Event</h3>
                    <span>Event "Purchase Button"</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body padding-0">
                <div class="chart-holder" id="dashboard-line-1" style="height: 200px;"></div>
            </div>
        </div>
        <!-- END SALES & EVENTS BLOCK -->

    </div>
    <div class="col-md-4">

        <!-- START PROJECTS BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Projects</h3>
                    <span>Projects activity</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body panel-body-table">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50%">Employé</th>
                                <th width="20%">Quantité vendu</th>
                                <th width="30%">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Atlant</strong></td>
                                <td><span class="label label-danger">Developing</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">85%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gemini</strong></td>
                                <td><span class="label label-warning">Updating</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">40%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Taurus</strong></td>
                                <td><span class="label label-warning">Updating</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">72%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Leo</strong></td>
                                <td><span class="label label-success">Support</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Virgo</strong></td>
                                <td><span class="label label-success">Support</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Aquarius</strong></td>
                                <td><span class="label label-success">Support</span></td>
                                <td>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END PROJECTS BLOCK -->

    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <!-- START USERS ACTIVITY BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Users Activity</h3>
                    <span>Users vs returning</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body padding-0">
                <div class="chart-holder" id="dashboard-bar-1" style="height: 200px;"></div>
            </div>
        </div>
        <!-- END USERS ACTIVITY BLOCK -->

    </div>
    <div class="col-md-6">

        <!-- START VISITORS BLOCK -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title-box">
                    <h3>Methode de paiement</h3>
                    <span>Paiement le plus utilisé</span>
                </div>
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="panel-body padding-0">
                <div class="chart-holder" id="dashboard-donut-1" style="height: 200px;"></div>
            </div>
        </div>
        <!-- END VISITORS BLOCK -->

    </div>
</div>