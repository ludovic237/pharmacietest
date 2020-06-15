<?php
require_once('inc/functions_universite.php');
require_once('Class/universite.php');
require_once('Class/contact.php');
require_once('Class/type_universite.php');
if (!isset($_GET['p']))
    header('Location: edit_universite.php?p=ajouter');
 $page = $_GET['p'];



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $managerContact = new ContactManager($pdo);
    $managerUniversite = new UniversiteManager($pdo);
    $managerTU = new TypeUniversiteManager($pdo);
    if($managerUniversite->existsId($id)){
        $univ = $managerUniversite->get($id);
        $contact = $managerContact->get($univ->CONTACT_ID());
        $tu = $managerTU->getList($id);
        if($univ->NOM_COMPLET() != NULL){
            $nom = $univ->NOM_COMPLET()." (".$univ->NOM().")";
        }
        else $nom = $univ->NOM();
        //echo $nom;

        if($contact->TELEPHONE_2() != NULL)
            $phone = $contact->TELEPHONE_1()." / ".$contact->TELEPHONE_2();
        else $phone = $contact->TELEPHONE_1();
    }
    else echo "N existe pas";
}
//echo $id;


?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Atlant - Responsive Bootstrap Admin Template</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="index.html">ATLANT</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="assets/images/users/avatar.jpg" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="assets/images/users/avatar.jpg" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">John Doe</div>
                                <div class="profile-data-title">Web Developer/Designer</div>
                            </div>
                            <div class="profile-controls">
                                <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>
                        </div>                                                                        
                    </li>
                    <li>
                        <a href="index.html"><span class="fa fa-desktop"></span> <span class="xn-text">Tableau de bord</span></a>
                    </li>
                    <li class="xn-title">Etudes</li>
                    <li class="xn-openable active">
                        <a href="#"><span class="fa fa-home"></span> <span class="xn-text">Universités</span></a>
                        <ul>
                            <li><a href="universites.php"> Toutes les universités</a></li>
                            <li class="active"><a href="edit_universite.php?p=ajouter"><span class="fa icone">A</span> Ajouter</a></li>
                            <li><a href="faculte_universite.php"> Facultés</a></li>
                            <li><a href="type_universite.php"> Types</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Formations</span></a>
                        <ul>
                            <li><a href="formations.php"> Toutes les formations</a></li>
                            <li><a href="ajouter_formation.php"> Ajouter</a></li>
                            <li><a href="categorie_formation.php"> Catégories</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Concours</span></a>
                        <ul>
                            <li><a href="concours.php"> Tous les concours</a></li>
                            <li><a href="ajouter_concours.php"> Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Articles</span></a>
                        <ul>
                            <li><a href="articles.php"> Tous les articles</a></li>
                            <li><a href="ajouter_article.php"> Ajouter</a></li>
                            <li><a href="categorie_article.php"> Catégories</a></li>
                        </ul>
                    </li>
                    <li class="xn-title">Métiers</li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Débouchés</span></a>
                        <ul>
                            <li><a href="debouches.php"> Toutes les débouchés</a></li>
                            <li><a href="ajouter_debouche.php"> Ajouter</a></li>
                            <li><a href="souscategorie_debouche.php"> Sous-Catégories</a></li>
                            <li><a href="categorie_debouche.php"> Catégories</a></li>
                        </ul>
                    </li>
                    <li class="xn-title">Autres</li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Commentaires</span></a>
                        <ul>
                            <li><a href="commentaire_universite"> Université</a></li>
                            <li><a href="commentaire_article"> Article</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Utilisateurs</span></a>
                        <ul>
                            <li><a href="utilisateurs.php"> Tous les utilisateurs</a></li>
                            <li><a href="ajouter_utilisateur.php"> Ajouter</a></li>
                            <li><a href="profil_utilisateur.php"> Votre profil</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-comments"></span></a>
                        <div class="informer informer-danger">4</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                                <div class="pull-right">
                                    <span class="label label-danger">4 new</span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <!-- <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/>
                                    <span class="contacts-title">John Doe</span>
                                    <p>Praesent placerat tellus id augue condimentum</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk"/>
                                    <span class="contacts-title">Dmitry Ivaniuk</span>
                                    <p>Donec risus sapien, sagittis et magna quis</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali"/>
                                    <span class="contacts-title">Nadia Ali</span>
                                    <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-offline"></div>
                                    <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/>
                                    <span class="contacts-title">Darth Vader</span>
                                    <p>I want my money back!</p>
                                </a> -->
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-messages.html">Show all messages</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-tasks"></span></a>
                        <div class="informer informer-warning">3</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>                                
                                <div class="pull-right">
                                    <span class="label label-warning">3 active</span>
                                </div>
                            </div>
                            <div class="panel-body list-group scroll" style="height: 200px;">                                
                                <a class="list-group-item" href="#">
                                    <strong>Phasellus augue arcu, elementum</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Aenean ac cursus</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                    </div>
                                    <small class="text-muted">Dmitry Ivaniuk, 24 Sep 2014 / 80%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Lorem ipsum dolor</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 23 Sep 2014 / 95%</small>
                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Cras suscipit ac quam at tincidunt.</strong>
                                    <div class="progress progress-small">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 21 Sep 2014 /</small><small class="text-success"> Done</small>
                                </a>                                
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-tasks.html">Show all tasks</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Accueil</a></li>
                    <li>Universités</li>
                    <?php if(!isset($_GET['id'])){ ?>
                        <li class="active">Ajouter</li>
                    <?php } ?>
                    <?php if(isset($_GET['id'])){ ?>
                        <li class="active">Modifier</li>
                    <?php } ?>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <?php if(!isset($_GET['id'])){ ?>
                    <h2><span class="fa fa-arrow-circle-o-left"></span>Ajouter une université</h2>
                    <?php } ?>
                    <?php if(isset($_GET['id'])){ ?>
                    <h2><span class="fa fa-arrow-circle-o-left"></span>Modifier une université</h2>
                    <?php } ?>
                </div>
                <!-- END PAGE TITLE -->

                <div class="page-content-wrap">

                    <div class="row">
                        <div class="col-md-6">

                            <!-- START JQUERY VALIDATION PLUGIN -->
                            <div class="block">
                                <h4>Informations générales</h4>
                                <form id="jvalidate" role="form" class="form-horizontal" action="javascript:enregistrer_universite('<?php  echo $page; ?>','<?php if(isset($_GET['id']))  echo $_GET['id']; else echo ""; ?>');">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nom:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="nom" id="nom" value="<?php if(isset($_GET['id'])) echo $univ->NOM(); ?>" placeholder="Nom ou Sigle"/>
                                                <span class="help-block">exemple: UDM</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nom Complet:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="nom_complet" id="nom_complet" value="<?php if(isset($_GET['id'])) echo $univ->NOM_COMPLET(); ?>" placeholder="Définition sigle" />
                                                <span class="help-block">exemple: Université Des Montagnes</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Ville:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php if(isset($_GET['id'])) echo $univ->VILLE(); ?>" name="ville" id="ville" placeholder="Ville"/>
                                                <span class="help-block">Champ requis</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Région:</label>
                                            <div class="col-md-9">
                                                <input type="text" value="<?php if(isset($_GET['id'])) echo $univ->REGION(); ?>" name="region" id="region" class="form-control" placeholder="Région"/>
                                                <span class="help-block">Champ requis</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Statut:</label>
                                            <div class="col-md-9">
                                                <select class="select" name="statut" id="statut" >
                                                    <option <?php if(!isset($_GET['id'])) echo "selected=\"selected\""; ?> value="">Choisir Statut</option>
                                                    <option <?php if(isset($_GET['id'])&&$univ->STATUT()=='Public') echo "selected=\"selected\""; ?> value="1">Public</option>
                                                    <option <?php if(isset($_GET['id'])&&$univ->STATUT()=='Privée') echo "selected=\"selected\""; ?> value="0">Privée</option>
                                                </select>
                                                <span class="help-block">Requis</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Type:</label>
                                            <div class="col-md-3">
                                                <select multiple class="select" name="type[]" id="type">
                                                    <option
                                                        <?php
                                                        if(isset($_GET['id']))
                                                        foreach ($tu as $key => $value)
                                                        {
                                                            if($value->TYPE_ID()==3){
                                                                echo "selected=\"selected\"";
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                        value="3">Ecole de médécine </option>
                                                    <option
                                                        <?php
                                                        if(isset($_GET['id']))
                                                        foreach ($tu as $key => $value)
                                                        {
                                                            if($value->TYPE_ID()==2){
                                                                echo "selected=\"selected\"";
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                        value="2">Ecole d'ingénierie </option>
                                                    <option
                                                        <?php
                                                        if(isset($_GET['id']))
                                                        foreach ($tu as $key => $value)
                                                        {
                                                            if($value->TYPE_ID()==1){
                                                                echo "selected=\"selected\"";
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                        value="1">Université d'état </option>
                                                    <option
                                                        <?php
                                                        if(isset($_GET['id']))
                                                        foreach ($tu as $key => $value)
                                                        {
                                                            if($value->TYPE_ID()==4){
                                                                echo "selected=\"selected\"";
                                                                break;
                                                            }
                                                        }
                                                        ?>
                                                        value="4">Autre université</option>
                                                </select>
                                                <span class="help-block">Choix multiple</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Responsable:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="responsable" id="responsable" placeholder="Recteur ou Doyen"/>
                                                <span class="help-block">Responsable facultatif</span>
                                            </div>
                                        </div>
                                        <p>&nbsp;</p>
                                        <h4 style="margin:0 0 30px -15px">Informations de contact</h4>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">B.P:</label>
                                            <div class="col-md-9">
                                                <input type="text" value="<?php if(isset($_GET['id'])) echo $contact->BP(); ?>" name="bp" id="bp" class="form-control" placeholder="B.P"/>
                                                <span class="help-block">Exemple: 90 Douala</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Téléphone 1:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="mask_phone form-control" name="telephone_1" id="telephone_1" value="<?php if(isset($_GET['id'])) echo $contact->TELEPHONE_1(); ?>"/>
                                                <span class="help-block">Exemple:  666-66-66-66</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Téléphone 2:</label>
                                            <div class="col-md-9">
                                                <input type="text" class="mask_phone form-control" name="telephone_2" id="telephone_2" value="<?php if(isset($_GET['id'])) echo $contact->TELEPHONE_2(); ?>"/>
                                                <span class="help-block">Exemple:  666-66-66-66</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email:</label>
                                            <div class="col-md-9">
                                                <input type="text" value="<?php if(isset($_GET['id'])) echo $contact->EMAIL(); ?>" name="email" id="email" class="form-control" placeholder="Email"/>
                                                <span class="help-block">Email requis</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Site:</label>
                                            <div class="col-md-9">
                                                <input type="text" value="<?php if(isset($_GET['id'])) echo $contact->SITE(); ?>" name="site" id="site" class="form-control"/>
                                                <span class="help-block">URL Facultatif</span>
                                            </div>
                                        </div>
                                        <p>&nbsp;</p>
                                        <h4 style="margin:0 0 30px -15px">Autres Informations</h4>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">LOGO:</label>
                                            <div class="col-md-9">
                                                <?php if(isset($_GET['id'])&&$univ->LOGO()!=null)  ?>
                                                <input type="file" class="fileinput btn-danger" value="<?php if(isset($_GET['id'])&&$univ->LOGO()!=null) echo $univ->LOGO(); ?>" name="logo" id="logo" data-filename-placement="inside" title="Parcourir"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="check"><input type="checkbox" <?php if(isset($_GET['id'])&&$univ->PARRAIN_ID()!=null) echo "checked=\"checked\"" ?> id="tutelle" name="tutelle" onchange="change();" /> Est-il sous tutelle</label>
                                        </div>
                                        <div class="form-group" style="">
                                            <label class="col-md-3 control-label">Université:</label>
                                            <div class="col-md-3">
                                                <select class="" <?php if(isset($_GET['id'])&&$univ->PARRAIN_ID()!=null) echo ""; else echo "disabled=\"disabled\""; ?> id="universite">
                                                    <?php
                                                    if(isset($_GET['id']))$param = $univ->PARRAIN_ID();
                                                    else $param = "";
                                                    getUniversiteSelect($param);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-primary"  type="submit">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- END JQUERY VALIDATION PLUGIN -->
                            </div>

                    </div>

                </div>
                <!-- PAGE CONTENT WRAPPER -->
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>


        <script type="text/javascript" src="js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.js"></script>
            <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
            <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
            <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
            <script type="text/javascript" src="js/functions.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->
        <script type="text/javascript">
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {
                    nom: {
                        required: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    region: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    telephone_1: {
                        required: true
                    },
                    ville: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    statut: {
                        required: true
                    },
                    "type[]": "required"

                }
            });

        </script>
    <!-- END SCRIPTS -->         
    </body>
</html>






