<?php

$title_for_layout = ' Admin -'.'Accueil';
$page_for_layout = 'Tableau de bord';


$position_for_layout = '';
$script_for_layout = '
<script>
            $("#pc_refresh").click(function(){
                function p_refresh_shown(){
                    alert("shown");
                    panel_refresh($("#pc_refresh").parents(".panel"),"hidden",function(){alert("hidden")});
                }
                panel_refresh($("#pc_refresh").parents(".panel"),"shown",p_refresh_shown);

            });

            $("#pc_collapse").click(function(){
                function p_collapse_hidden(){
                    alert("hidden");
                    panel_collapse($("#pc_collapse").parents(".panel"),"shown",function(){alert(\'shown\')});
                }
                panel_collapse($("#pc_collapse").parents(".panel"),"hidden",p_collapse_hidden);
            });

            $("#pc_remove").click(function(){
                function p_remove_before(){
                    alert("before");
                    panel_remove($("#pc_remove").parents(".panel"),"after",function(){alert("after")});
                }
                panel_remove($("#pc_remove").parents(".panel"),"before",p_remove_before);

            });
        </script>';
?>

<!-- START PANELS WITH CONTROLS -->
<div class="row">
    <div class="col-md-12">



        <!-- START PANEL WITH HIDDEN CONTROLS -->
        <div class="panel panel-default panel-hidden-controls">
            <div class="panel-heading">
                <h3 class="panel-title">Bienvenue dans la zone d'administration</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span> Refresh</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="row help-block">
                    <span style="font-size: 14px;">Quelques liens pour vous aider à démarer</span>
                    <p>&nbsp;</p>
                </div>
                <div class="row faq">
                    <div class="col-md-4">
                        <div class=" faq-item">
                            <p class="col-md-12" style="font-size: 16px; font-weight: bold;">Commencez ici !</p>
                            <div class="btn-group" style="font-size: 18px;margin-bottom: 10px; width: 75%; padding: 15px 0 15px 0">
                                <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle" style="font-size: 18px;margin-bottom: 10px; width: 100%; padding: 17px 0 17px 0">Vie étudiante &nbsp; &nbsp;<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" style="font-size: 14px">Actualité étudiante</a></li>
                                    <li><a href="#" style="font-size: 14px">Trouver un sponsor</a></li>
                                    <li><a href="#" style="font-size: 14px">Santé et danger</a></li>
                                    <li><a href="#" style="font-size: 14px">Mode et beauté</a></li>
                                    <li><a href="#" style="font-size: 14px">Concours pour étudiants</a></li>
                                </ul>
                            </div>
                            <p class="col-md-12">ou alors, <a href="#"><code>faites nous une suggestion</code></a></p>
                            <p style="margin-bottom: 33px;">&nbsp;</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class=" faq-item">
                            <p class="col-md-12" style="font-size: 16px; font-weight: bold;">Etapes suivantes</p>
                            <a href="<?php echo Router::url('bouwou/universites/edit'); ?>" class="col-md-12 faq-title" style="margin-bottom: 5px;"><span class="fa fa-edit"></span> <span class="">Inscrire une nouvelle université</span></a>
                            <a href="<?php echo Router::url('bouwou/formations'); ?>" class="col-md-12 faq-title" style="margin-bottom: 5px;"><span class="fa fa-external-link-square"></span> <span class="">Mettre à jour vos formations</span></a>
                            <a href="<?php echo Router::url('bouwou/concours/edit'); ?>" class="col-md-12 faq-title" style="margin-bottom: 5px;"><span class="fa fa-plus"></span> <span class="">Ajouter un concours</span></a>
                            <a href="<?php echo Router::url(''); ?>" class="col-md-12 faq-title" style="margin-bottom: 5px;"><span class="fa fa-laptop"></span> <span class="">Accéder au site web</span></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class=" faq-item">
                            <p class="col-md-12" style="font-size: 16px; font-weight: bold;">Plus d'actions</p>
                            <a href="#" class="col-md-12 faq-title" style="margin-bottom: 5px;"><span class="fa fa-bug"></span> <span class="">Signaler un bug</span></a>
                            <a href="#" class="col-md-12 faq-title" style="margin-bottom: 5px;"><span class="fa fa-exclamation"></span> <span class="">Proposez nous vos idées</span></a>
                            <p style="margin-bottom: 53px;">&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PANEL WITH HIDDEN CONTROLS -->



    </div>
    <div class="col-md-6">

        <!-- START PANEL WITH REFRESH CALLBACKS -->
        <div class="panel panel-primary">
            <div class="panel-heading" style="background: #ffffff">
                <h3 class="panel-title">D'un coup d'oeil</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="row" >
                    <div class="col-md-6">
                        <a href="<?php echo Router::url('bouwou/universites'); ?>" class="col-md-12" style="margin-bottom: 5px;"><span class="fa fa-home fa-2x" style="color: #22262e;margin: 0 5px 10px 0;"></span> <span class="" style="font-size: 14px;text-decoration: none;"> <?php echo $total_univ; ?> Universités</span></a>
                        <a href="<?php echo Router::url('bouwou/formations'); ?>" class="col-md-12" style="margin-bottom: 5px;"><span class="glyphicon glyphicon-book fa-2x" style="color: #22262e;margin: 0 5px 10px 0;"></span> <span class="" style="font-size: 14px;text-decoration: none;"><?php echo $total_formations; ?> Formations</span></a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo Router::url('bouwou/concours'); ?>" class="col-md-12" style="margin-bottom: 5px;"><span class="glyphicon glyphicon-edit fa-2x" style="color: #22262e;margin: 0 5px 10px 0;"></span> <span class="" style="font-size: 14px;text-decoration: none;"><?php echo $total_concours; ?> Concours</span></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PANEL WITH REFRESH CALLBACKS -->

        <!-- START PANEL WITH COLLAPSE CALLBACKS -->
        <div class="panel panel-primary">
            <div class="panel-heading" style="background: #ffffff">
                <h3 class="panel-title">Activité Etudiante</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="row" >
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
        <!-- END PANEL WITH REMOVE CALLBACKS -->

    </div>
    <div class="col-md-6">

        <!-- START PANEL WITH REFRESH CALLBACKS -->
        <div class="panel panel-primary">
            <div class="panel-heading" style="background: #ffffff">
                <h3 class="panel-title">Quelques suggestions</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                </ul>
            </div>
            <div class="panel-body faq">
                <div class="faq-item">
                    <blockquote style="border: none;">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>Proposé par <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                </div>

                <div class="faq-item">
                    <blockquote style="border: none;">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>Proposé par <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                </div>
                <div class="faq-item">
                    <blockquote style="border: none;">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>Proposé par <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
        <!-- END PANEL WITH REFRESH CALLBACKS -->



    </div>
</div>
<!-- END PANELS WITH CONTROLS -->

