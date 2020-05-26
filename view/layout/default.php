<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title><?php echo isset($title_for_layout) ? $title_for_layout : 'Atlant - Front'; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- END META SECTION -->
    <link rel="icon" href="<?php echo BASE_URL . '/koudjine/favicon.ico'; ?>" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . '/css/styles.css'; ?>" media="screen" />
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo BASE_URL . '/css/theme-default.css'; ?>" />

</head>

<body class="">

    <div class="page-container">

        <!-- page header -->
        <div class="page-header">

            <!-- page header holder -->
            <div class="page-header-holder">

                <!-- page logo -->
                <div class="logo">
                    <a href="index.html">Atlant - Front-end Template</a>
                </div>
                <!-- ./page logo -->

                <!-- search -->
                <div class="search">
                    <div class="search-button"><span class="fa fa-search"></span></div>
                    <div class="search-container animated fadeInDown">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." />
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ./search -->

                <!-- nav mobile bars -->
                <div class="navigation-toggle">
                    <div class="navigation-toggle-button"><span class="fa fa-bars"></span></div>
                </div>
                <!-- ./nav mobile bars -->

                <!-- navigation -->
                <ul class="navigation">
                    <li>
                        <a href="./">Accueil</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL . '/universites'; ?>">Universités</a>
                        <ul>
                            <li><a href="<?php echo BASE_URL . '/universites/categorie/Universite-Etat-1'; ?>">Universités d'état</a></li>
                            <li><a href="<?php echo BASE_URL . '/universites/categorie/Ecole-medecine-3'; ?>">Ecoles de médécine</a></li>
                            <li><a href="<?php echo BASE_URL . '/universites/categorie/Ecole-ingenierie-2'; ?>">Ecoles d'ingenierie</a></li>
                            <li><a href="<?php echo BASE_URL . '/universites/categorie/Autre-universite-4'; ?>">Autres Universités</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL . '/formations'; ?>">Formations</a>
                    </li>
                    <li><a href="<?php echo BASE_URL . '/orientation'; ?>/">Conseil d'orientation</a></li>
                    <li>
                        <a href="#">Pages</a>
                        <ul>
                            <li><a href="<?php echo BASE_URL . '/concours'; ?>">Concours</a></li>
                            <li><a href="<?php echo BASE_URL . '/recherche/filiere'; ?>">Recherche Avancée</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Vie étudiante</a>
                        <ul>
                            <li><a href="<?php echo BASE_URL . '/vie_etudiante/actualite'; ?>">Toute l'actualité étudiante</a></li>
                            <li><a href="<?php echo BASE_URL . '/vie_etudiante/service_rendu'; ?>">Service rendu</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- ./navigation -->


            </div>
            <!-- ./page header holder -->

        </div>
        <!-- ./page header -->

        <!-- page content -->
        <div class="page-content">

            <!-- page content wrapper -->
            <div class="page-content-wrap bg-light">
                <!-- page content holder -->
                <div class="page-content-holder no-padding">
                    <!-- page title -->
                    <div class="page-title">
                        <h1><?php echo isset($page_for_layout) ? $page_for_layout : 'Error'; ?></h1>
                        <!-- breadcrumbs -->
                        <?php if (isset($position_for_layout)) { ?>
                            <ul class="breadcrumb">
                                <li><a href="index.html">Accueil</a></li>
                                <?php echo $position_for_layout; ?>
                            </ul>
                        <?php } ?>
                        <!-- ./breadcrumbs -->
                    </div>
                    <!-- ./page title -->
                </div>
                <!-- ./page content holder -->
            </div>
            <!-- ./page content wrapper -->


            <!-- page content wrapper -->
            <div class="page-content-wrap">
                <!-- page content holder -->
                <div class="page-content-holder padding-v-30">
                    <?php echo $content_for_layout; ?>
                </div>
                <!-- ./page content holder -->
            </div>
            <!-- ./page content wrapper -->

        </div>
        <!-- ./page content -->

        <!-- page footer -->
        <div class="page-footer">

            <!-- page footer wrap -->
            <div class="page-footer-wrap bg-dark-gray">
                <!-- page footer holder -->
                <div class="page-footer-holder page-footer-holder-main">

                    <div class="row">

                        <!-- about -->
                        <div class="col-md-3">
                            <h3>About Template</h3>
                            <p>Lorem ipsum dolor natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
                        </div>
                        <!-- ./about -->

                        <!-- quick links -->
                        <div class="col-md-3">
                            <h3>Quick links</h3>

                            <div class="list-links">
                                <a href="#">Home</a>
                                <a href="#">Pages</a>
                                <a href="#">Portfolio</a>
                                <a href="#">Shortcodes</a>
                            </div>
                        </div>
                        <!-- ./quick links -->

                        <!-- recent tweets -->
                        <div class="col-md-3">
                            <h3>Recent Tweets</h3>

                            <div class="list-with-icon small">
                                <div class="item">
                                    <div class="icon">
                                        <span class="fa fa-twitter"></span>
                                    </div>
                                    <div class="text">
                                        <a href="#">@JohnDoe</a> Hello, here is my new front-end template. Check it out
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="icon">
                                        <span class="fa fa-twitter"></span>
                                    </div>
                                    <div class="text">
                                        <a href="#">@Aqvatarius</a> Release of new update for Atlant is done and ready to use
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="icon">
                                        <span class="fa fa-twitter"></span>
                                    </div>
                                    <div class="text">
                                        <a href="#">@Aqvatarius</a> Check out my new admin template Atlant, it's realy awesome template
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- ./recent tweets -->

                        <!-- contacts -->
                        <div class="col-md-3">
                            <h3>Contacts</h3>

                            <div class="footer-contacts">
                                <div class="fc-row">
                                    <span class="fa fa-home"></span>
                                    000 StreetName, Suite 111,<br />
                                    City Name, ST 01234
                                </div>
                                <div class="fc-row">
                                    <span class="fa fa-phone"></span>
                                    (123) 456-7890
                                </div>
                                <div class="fc-row">
                                    <span class="fa fa-envelope"></span>
                                    <strong>John Doe</strong><br>
                                    <a href="mailto:#">johndoe@domain.com</a>
                                </div>
                            </div>

                            <h3>Subscribe</h3>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your email" />
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><span class="fa fa-paper-plane"></span></button>
                                </div>
                            </div>

                        </div>
                        <!-- ./contacts -->

                    </div>

                </div>
                <!-- ./page footer holder -->
            </div>
            <!-- ./page footer wrap -->

            <!-- page footer wrap -->
            <div class="page-footer-wrap bg-darken-gray">
                <!-- page footer holder -->
                <div class="page-footer-holder">

                    <!-- copyright -->
                    <div class="copyright">
                        &copy; 2014 Atlant Theme by <a href="#">Aqvatarius</a> - All Rights Reserved
                    </div>
                    <!-- ./copyright -->

                    <!-- social links -->
                    <div class="social-links">
                        <a href="#"><span class="fa fa-facebook"></span></a>
                        <a href="#"><span class="fa fa-twitter"></span></a>
                        <a href="#"><span class="fa fa-google-plus"></span></a>
                        <a href="#"><span class="fa fa-linkedin"></span></a>
                        <a href="#"><span class="fa fa-vimeo-square"></span></a>
                        <a href="#"><span class="fa fa-dribbble"></span></a>
                    </div>
                    <!-- ./social links -->

                </div>
                <!-- ./page footer holder -->
            </div>
            <!-- ./page footer wrap -->

        </div>
        <!-- ./page footer -->

    </div>
    <!-- ./page container -->

    <!-- START SCRIPTS -->
    <!-- START PLUGINS -->
    <script type="text/javascript" src="<?php echo BASE_URL . '/js/plugins/jquery/jquery.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/js/plugins/jquery/jquery-ui.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/js/plugins/bootstrap/bootstrap.min.js'; ?>"></script>
    <!-- END PLUGINS -->

    <script type='text/javascript' src="<?php echo BASE_URL . '/js/plugins/icheck/icheck.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'; ?>"></script>

    <!-- THIS PAGE PLUGINS -->
    <?php if (isset($script_for_layout)) echo $script_for_layout; ?>
    <!-- END THIS PAGE PLUGINS -->

    <!-- START TEMPLATE -->


    <script type="text/javascript" src="<?php echo BASE_URL . '/js/plugins.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/js/actions.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/js/script.js'; ?>"></script>
    <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

</body>

</html>