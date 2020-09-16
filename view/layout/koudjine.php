<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title><?php echo isset($title_for_layout) ? $title_for_layout : 'Atlant - Front'; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL . '/koudjine/css/print.css'; ?>" media="print" />
    <link rel="icon" href="<?php echo BASE_URL . '/koudjine/favicon.ico'; ?>" type="image/x-icon" />
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo BASE_URL . '/koudjine/css/theme-default.css'; ?>" />
    <!-- EOF CSS INCLUDE -->
</head>

<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container <?php if ($this->request->controller == 'medias') {
                                    echo 'page-navigation-toggled';
                                } ?> ">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar scroll">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation">
                <li class="xn-logo">
                    <a href="index.html">ATLANT</a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="<?php echo BASE_URL . '/koudjine/assets/images/users/' . $this->Session->user('PHOTO_PROFIL'); ?>" alt="<?php echo $this->Session->user('NOM') . ' ' . $this->Session->user('PRENOM'); ?>" />
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="<?php echo BASE_URL . '/koudjine/assets/images/users/' . $this->Session->user('PHOTO_PROFIL'); ?>" alt="<?php echo $this->Session->user('NOM') . ' ' . $this->Session->user('PRENOM'); ?>" />
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name"><?php echo $this->Session->user('identifiant') ?></div>
                            <div class="profile-data-title"><?php echo $this->Session->user('type') . ' ' ?><?php if ($this->Session->user('FONCTION') != null) echo ' / ' . $this->Session->user('FONCTION') ?></div>
                        </div>
                        <div class="profile-controls">
                            <a href="<?php echo Router::url('bouwou/pharmanet/userprofile/'.$_SESSION["Users"]->id); ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                            <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                        </div>
                    </div>
                </li>
                <li <?php if ($this->request->controller == 'home') { ?>class="active" <?php } ?>>
                    <a href="<?php echo Router::url('bouwou/home'); ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Tableau de bord</span></a>
                </li>
                <li class="xn-title">Etudes</li>

                <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['vente'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'vente') { ?>active<?php } ?>">
                    <a href="#"><span class="fa fa-shopping-cart "></span> <span class="xn-text">Vente</span></a>
                    <ul>
                        <li <?php if ($this->request->controller == 'vente' && $this->request->action == 'vente') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/vente/vente'); ?>"><span class="fa lettre">V</span>Vente</a></li>
                        <li <?php if ($this->request->controller == 'vente' && $this->request->action == 'venteadd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/vente/venteadd'); ?>"><span class="fa lettre">A</span>Ajouter</a></li>
                        <li <?php if ($this->request->controller == 'vente' && $this->request->action == 'reglement') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/vente/reglement'); ?>"><span class="fa lettre">R</span> Règlement</a></li>
                        <li <?php if ($this->request->controller == 'vente' && $this->request->action == 'chiffreaffaire') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/vente/chiffreaffaire'); ?>"><span class="fa lettre">C</span> Chiffre d'affaire</a></li>
                    </ul>
                </li>
                <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['catalogue'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'catalogue') { ?>active<?php } ?>">
                    <a href="#"><span class="fa fa-book"></span> <span class="xn-text">Catalogue</span></a>
                    <ul>
                        <li class="xn-openable <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'produit' || $this->request->controller == 'catalogue' && $this->request->action == 'produitadd') { ?>active <?php } ?>">
                            <a href="#"><span class="fa lettre">E</span> Produit</a>
                            <ul>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'produit') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/produit'); ?>"><span class="fa lettre">L</span> Lister</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'produitdetail') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/produitdetail'); ?>"><span class="fa lettre">L</span> Lister detail</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'produitadd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/produitadd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'produitimpression') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/produitimpression'); ?>"><span class="fa lettre">I</span> Impression code</a></li>
                            </ul>
                        </li>
                        <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'categorie') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/categorie'); ?>"><span class="fa lettre">C</span> Categorie</a></li>
                        <li class="xn-openable <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'prescripteur' || $this->request->controller == 'catalogue' && $this->request->action == 'prescripteuradd') { ?>active <?php } ?>">
                            <a href="#"><span class="fa lettre">P</span> Prescripteur</a>
                            <ul>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'prescripteur') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/prescripteur'); ?>"><span class="fa lettre">L</span> Lister</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'prescripteuradd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/prescripteuradd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                            </ul>
                        </li>
                        <li class="xn-openable <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'assureur' || $this->request->controller == 'catalogue' && $this->request->action == 'assureuradd') { ?>active <?php } ?>">
                            <a href="#"><span class="fa lettre">A</span> Assureur</a>
                            <ul>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'assureur') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/assureur'); ?>"><span class="fa lettre">L</span> Lister</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'assureuradd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/assureuradd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                            </ul>
                        </li>
                        <li class="xn-openable <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'client' || $this->request->controller == 'catalogue' && $this->request->action == 'clientadd') { ?>active <?php } ?>">
                            <a href="#"><span class="fa lettre">C</span> Client</a>
                            <ul>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'client') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/client'); ?>"><span class="fa lettre">L</span> Lister</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'clientadd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/clientadd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                            </ul>
                        </li>
                        <li class="xn-openable <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'fabriquant' || $this->request->controller == 'catalogue' && $this->request->action == 'fabriquantadd') { ?>active <?php } ?>">
                            <a href="#"><span class="fa lettre">F</span> Fabriquant</a>
                            <ul>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'fabriquant') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/fabriquant'); ?>"><span class="fa lettre">L</span> Lister</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'fabriquantadd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/fabriquantadd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                            </ul>
                        </li>
                        <li class="xn-openable <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'fournisseur' || $this->request->controller == 'catalogue' && $this->request->action == 'fournisseuradd') { ?>active <?php } ?>">
                            <a href="#"><span class="fa lettre">F</span> Fournisseur</a>
                            <ul>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'fournisseur') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/fournisseur'); ?>"><span class="fa lettre">L</span> Lister</a></li>
                                <li <?php if ($this->request->controller == 'catalogue' && $this->request->action == 'fournisseuradd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/catalogue/fournisseuradd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['geonetliste'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'geonetliste') { ?>active<?php } ?>">
                    <a href="#"><span class="fa fa-archive"></span> <span class="xn-text">Géonetliste</span></a>
                    <ul>
                        <li <?php if ($this->request->controller == 'geonetliste' && $this->request->action == 'rayon') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/geonetliste/rayon'); ?>"> <span class="fa lettre">R</span>Rayon</a></li>
                        <li <?php if ($this->request->controller == 'geonetliste' && $this->request->action == 'magasin') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/geonetliste/magasin'); ?>"> <span class="fa lettre">M</span>Magasin</a></li>
                        <li <?php if ($this->request->controller == 'geonetliste' && $this->request->action == 'forme') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/geonetliste/forme'); ?>"><span class="fa lettre">F</span> Forme</a></li>
                        <li <?php if ($this->request->controller == 'geonetliste' && $this->request->action == 'unite') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/geonetliste/unite'); ?>"> <span class="fa lettre">U</span>Unite</a></li>
                        <li <?php if ($this->request->controller == 'geonetliste' && $this->request->action == 'ville') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/geonetliste/ville'); ?>"> <span class="fa lettre">V</span>Ville</a></li>
                </li>
            </ul>
            </li>
            <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['comptabilite'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'comptabilite') { ?>active<?php } ?>">
                <a href="#"><span class="fa fa-credit-card"></span> <span class="xn-text">Comptabilite</span></a>
                <ul>
                    <li <?php if ($this->request->controller == 'comptabilite' && $this->request->action == 'budget') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/comptabilite/budget'); ?>"><span class="fa lettre">B</span>budget</a></li>
                    <li <?php if ($this->request->controller == 'comptabilite' && $this->request->action == 'caisse') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/comptabilite/caisse'); ?>"><span class="fa lettre">C</span>Caisse</a></li>
                    <li <?php if ($this->request->controller == 'comptabilite' && $this->request->action == 'consultation') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/comptabilite/consultation'); ?>"><span class="fa lettre">C</span> Consultation</a></li>
                    <li class="xn-openable <?php if ($this->request->controller == 'comptabilite' && $this->request->action == 'entre' || $this->request->controller == 'comptabilite' && $this->request->action == 'entreadd') { ?>active <?php } ?>">
                        <a href="#"><span class="fa lettre">E</span> Entrée</a>
                        <ul>
                            <li <?php if ($this->request->controller == 'comptabilite' && $this->request->action == 'entre') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/comptabilite/entre'); ?>"><span class="fa lettre">L</span> Liste</a></li>
                            <li <?php if ($this->request->controller == 'comptabilite' && $this->request->action == 'entreadd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/comptabilite/entreadd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                        </ul>
                    </li>
                    <li <?php if ($this->request->controller == 'comptabilite' && $this->request->action == 'sotie' ) { ?>active <?php } ?>><a href="<?php echo Router::url('bouwou/comptabilite/sortie'); ?>"><span class="fa lettre">S</span> Sortie</a></li>
                </ul>
            </li>
            <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['commande'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'commande') { ?>active<?php } ?>">
                <a href="#"><span class="fa fa-truck"></span> <span class="xn-text">Commande</span></a>
                <ul>
                    <li <?php if ($this->request->controller == 'commande' && $this->request->action == 'simplereappro') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/commande/simplereappro'); ?>"><span class="fa lettre">S</span>Simple réappro</a></li>
                    <li <?php if ($this->request->controller == 'commande' && $this->request->action == 'cmdprogramme') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/commande/cmdprogramme'); ?>"><span class="fa lettre">C</span>Commande programmée</a></li>
                    <li <?php if ($this->request->controller == 'commande' && $this->request->action == 'list') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/commande/list'); ?>"><span class="fa lettre">L</span>Liste de commande</a></li>
                    <li <?php if ($this->request->controller == 'commande' && $this->request->action == 'cmdparticuliere') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/commande/cmdparticuliere'); ?>"><span class="fa lettre">C</span>Commande particulière</a></li>
                </ul>
            </li>
            <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['stock'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'stock') { ?>active<?php } ?>">
                <a href="#"><span class="fa fa-bank"></span> <span class="xn-text">Stock</span></a>
                <ul>
                    <li <?php if ($this->request->controller == 'stock' && $this->request->action == 'inventaire') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/stock/inventaire'); ?>"><span class="fa lettre">I</span>Inventaire</a></li>
                </ul>
            </li>
            <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['statistique'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'statistique') { ?>active<?php } ?>">
                <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Statistique</span></a>
                <ul>
                    <li <?php if ($this->request->controller == 'statistique' && $this->request->action == 'produitplusvendu') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/statistique/produitplusvendu'); ?>"><span class="fa lettre">P</span>Produit plus vendu</a></li>
                    <li <?php if ($this->request->controller == 'statistique' && $this->request->action == 'chiffre') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/statistique/chiffre'); ?>"><span class="fa lettre">C</span>Chiffre</a></li>
                </ul>
            </li>
            <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['pharmanet'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'pharmanet') { ?>active<?php } ?>">


            <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['pharmanet'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'pharmanet') { ?>active<?php } ?>">

                <a href="#"><span class="fa fa-folder-open"></span> <span class="xn-text">pharmanet</span></a>
                <ul>
                    <li class="xn-openable <?php if ($this->request->controller == 'pharmanet' && $this->request->action == 'employe' || $this->request->controller == 'pharmanet' && $this->request->action == 'employeadd') { ?>active <?php } ?>">
                        <a href="#"><span class="fa lettre">E</span> Employé</a>
                        <ul>
                            <li <?php if ($this->request->controller == 'pharmanet' && $this->request->action == 'employe') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/pharmanet/employe'); ?>"><span class="fa lettre">L</span> Lister</a></li>
                            <li <?php if ($this->request->controller == 'pharmanet' && $this->request->action == 'employeadd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/pharmanet/employeadd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable <?php if ($this->request->controller == 'pharmanet' && $this->request->action == 'user' || $this->request->controller == 'pharmanet' && $this->request->action == 'useradd') { ?>active <?php } ?>">
                        <a href="#"><span class="fa lettre">U</span> Utilisateur</a>
                        <ul>
                            <li <?php if ($this->request->controller == 'pharmanet' && $this->request->action == 'user') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/pharmanet/user'); ?>"> <span class="fa lettre">L</span>Lister</a></li>
                            <li <?php if ($this->request->controller == 'pharmanet' && $this->request->action == 'useradd') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/pharmanet/useradd'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                        </ul>
                    </li>
                    <li <?php if ($this->request->controller == 'pharmanet' && $this->request->action == 'aboutus') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/pharmanet/aboutus'); ?>"><span class="fa lettre">A</span>About us</a></li>
                </ul>
            </li>

            <!-- <li class="xn-openable">
                    <a href="#"><span class="fa fa-suitcase"></span> <span class="xn-text">Vie étudiante</span></a>
                    <ul>
                        <li><a href="articles.php"><span class="fa">P</span> Présentation</a></li>
                        <li><a href="ajouter_article.php"><span class="fa">A</span> Toute l’actualité étudiante</a></li>
                        <li><a href="categorie_article.php"><span class="fa">T</span> Trouver un sponsor</a></li>
                        <li><a href="categorie_article.php"><span class="fa">S</span> Santé et danger urbain</a></li>
                        <li><a href="categorie_article.php"><span class="fa">M</span> Mode et beauté</a></li>
                        <li><a href="categorie_article.php"><span class="fa">C</span> Concours pour étudiants</a></li>
                    </ul>

                </li> -->
            <!-- <li class="xn-title">Autres</li>
                <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['medias'])) { ?>style="display: none" <?php } ?> class=" <?php if ($this->request->controller == 'medias') { ?>active<?php } ?>">

                </li>
                <li class="xn-title">Autres</li>
                <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['medias'])) { ?>style="display: none" <?php } ?> class=" <?php if ($this->request->controller == 'medias') { ?>active<?php } ?>">

                    <a href="<?php echo Router::url('bouwou/medias'); ?>"><span class="fa fa-image"></span> <span class="xn-text">Medias</span></a>
                </li>
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-comment"></span> <span class="xn-text">Commentaires</span></a>
                    <ul>
                        <li><a href="commentaire_universite"> Université</a></li>
                        <li><a href="commentaire_article"> Article</a></li>
                    </ul>
                </li>
                <li <?php if (!in_array($this->Session->user('type'), Conf::$acces['users'])) { ?>style="display: none" <?php } ?> class="xn-openable <?php if ($this->request->controller == 'users') { ?>active<?php } ?>">
                    <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Utilisateurs</span></a>
                    <ul>
                        <li <?php if ($this->request->controller == 'users' && $this->request->action == 'index') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/users'); ?>"><span class="fa lettre">U</span> Tous les utilisateurs</a></li>
                        <li <?php if ($this->request->controller == 'users' && $this->request->action == 'edit') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/users/edit'); ?>"><span class="fa lettre">A</span> Ajouter</a></li>
                        <li <?php if ($this->request->controller == 'users' && $this->request->action == 'profile') { ?>class="active" <?php } ?>><a href="<?php echo Router::url('bouwou/users/profile/' . $this->Session->user('PERSONNE_ID')); ?>"><span class="fa lettre">P</span> Profil</a></li>
                    </ul>
                </li> -->

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
                        <input type="text" name="search" placeholder="Search..." />
                    </form>
                </li>
                <!-- END SEARCH -->
                <!-- SIGN OUT -->
                <li class="xn-icon-button pull-right">
                    <a href="<?php echo Router::url('users/logout'); ?>" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out" data-toggle="tooltip" data-placement="bottom" title="Déconnexion"></span></a>
                </li>
                <!-- END SIGN OUT -->
                <!-- MESSAGES -->
                <!-- <li class="xn-icon-button pull-right">
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
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-online"></div>
                                <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe" />
                                <span class="contacts-title">John Doe</span>
                                <p>Praesent placerat tellus id augue condimentum</p>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-away"></div>
                                <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk" />
                                <span class="contacts-title">Dmitry Ivaniuk</span>
                                <p>Donec risus sapien, sagittis et magna quis</p>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-away"></div>
                                <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali" />
                                <span class="contacts-title">Nadia Ali</span>
                                <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="list-group-status status-offline"></div>
                                <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader" />
                                <span class="contacts-title">Darth Vader</span>
                                <p>I want my money back!</p>
                            </a>
                        </div>
                        <div class="panel-footer text-center">
                            <a href="pages-messages.html">Show all messages</a>
                        </div>
                    </div>
                </li> -->
                <!-- END MESSAGES -->
                <!-- TASKS -->
                <!-- <li class="xn-icon-button pull-right">
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
                </li> -->
                <!-- END TASKS -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->

            <!-- START BREADCRUMB -->
            <?php if (isset($position_for_layout)) { ?>
                <ul class="breadcrumb">
                    <li><a href="#">Accueil</a></li>
                    <?php echo $position_for_layout; ?>
                </ul>
            <?php } ?>
            <!-- END BREADCRUMB -->

            <!-- PAGE TITLE -->
            <div class="page-title">
                <?php if (isset($page_for_layout)) { ?>
                    <h2><span class=" <?php
                                        if ($this->request->controller == 'universites' && $this->request->action == 'index' || $this->request->controller == 'facultes' && $this->request->action == 'index' || $this->request->controller == 'types' && $this->request->action == 'index') {
                                        ?>
                    fa fa-home
                    <?php
                                        } elseif ($this->request->controller == 'concours' && $this->request->action == 'index') {
                    ?>
                    fa fa-edit
                    <?php
                                        } elseif ($this->request->controller == 'vie-etudiante' && $this->request->action == 'index') {
                    ?>
                    fa fa-suitcase
                    <?php
                                        } elseif ($this->request->controller == 'users' && $this->request->action == 'index') {
                    ?>
                    fa fa-users
                    <?php
                                        } elseif ($this->request->controller == 'formations' && $this->request->action == 'index') {
                    ?>
                    glyphicon glyphicon-book
                    <?php
                                        } elseif ($this->request->controller == 'comments' && $this->request->action == 'index') {
                    ?>
                    fa fa-comments
                    <?php
                                        } else {
                    ?>
                    fa fa-arrow-circle-o-left
                    <?php
                                        }
                    ?>"></span> <?php echo $page_for_layout; ?></h2> <?php } ?>
                <?php if (isset($action_for_layout)) { ?><button class="btn btn-primary ajouter pull-right" controller="<?php echo $this->request->controller; ?>" data="<?php if (isset($this->request->params[0])) echo $this->request->params[0]; ?>" id="<?php echo $this->request->url; ?>"><?php echo $action_for_layout; ?></button> <?php } ?>
            </div>
            <!-- END PAGE TITLE -->

            <!-- PAGE CONTENT WRAPPER -->
            <div class="<?php if ($this->request->controller == 'medias') echo 'content-frame';
                        else echo 'page-content-wrap' ?>">
                <?php echo $content_for_layout; ?>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- MESSAGE BOX-->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                <div class="mb-content">
                    <p>Are you sure you want to remove this row?</p>
                    <p>Press Yes if you sure.</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MESSAGE BOX-->

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
                        <a href="<?php echo Router::url('users/logout'); ?>" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MESSAGE BOX-->
    <!-- danger -->
    <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="message-box-danger">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Danger</div>
                <div class="mb-content">
                    <p></p>
                </div>
                <div class="mb-footer">
                    <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end danger -->



    <!-- START PRELOADS -->
    <audio id="audio-alert" src="<?php echo BASE_URL . '/koudjine/audio/alert.mp3'; ?>" preload="auto"></audio>
    <audio id="audio-fail" src="<?php echo BASE_URL . '/koudjine/audio/fail.mp3'; ?>" preload="auto"></audio>
    <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
    <!-- START PLUGINS -->
    <script type="text/javascript" src="<?php echo BASE_URL . '/koudjine/js/plugins/jquery/jquery.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/koudjine/js/plugins/jquery/jquery-ui.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/koudjine/js/plugins/bootstrap/bootstrap.min.js'; ?>"></script>
    <!-- END PLUGINS -->

    <script type='text/javascript' src="<?php echo BASE_URL . '/koudjine/js/plugins/icheck/icheck.min.js'; ?>"></script>
    <script type='text/javascript' src="<?php echo BASE_URL . '/koudjine/js/plugins/scrolltotop/scrolltopcontrol.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/koudjine/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'; ?>"></script>

    <!-- THIS PAGE PLUGINS -->
    <?php echo $script_for_layout; ?>
    <!-- END THIS PAGE PLUGINS -->

    <!-- START TEMPLATE -->


    <script type="text/javascript" src="<?php echo BASE_URL . '/koudjine/js/plugins.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/koudjine/js/actions.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo BASE_URL . '/koudjine/js/settings.js'; ?>"></script>
    <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
</body>

</html>