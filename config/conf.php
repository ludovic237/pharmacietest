<?php

class Conf
{

    static $debug = 1;
    static $database = array(
        'default' => array(
            'host' => 'localhost',
            'database' => 'pharmanet1',
            'login' => 'root',
            'password' => ''
        ),
        'front' => array(
            'host' => 'localhost',
            'database' => 'conseil_d_orientation',
            'login' => 'root',
            'password' => ''
        )
    );
    static $acces = array(
        'universites' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur'
        ),
        'facultes' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur'
        ),
        'types' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur'
        ),
        'formations' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire'
        ),
        'orientation' => array(
            '0' => 'Administrateur',
        ),
        'medias' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire'
        ),
        'concours' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire',
            '3' => 'Informateur'
        ),
        'catalogue' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire',
            '3' => 'Informateur'
        ),
        'vente' => array(
            '0' => 'Administrateur',
            '1' => 'Caissier',
            '2' => 'Gestionnaire',
            '3' => 'Informateur'
        ),
        'geonetliste' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire',
            '3' => 'Informateur'
        ),
        'pharmanet' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire',
            '3' => 'Informateur'
        ),
        'commande' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire',
            '3' => 'Informateur'
        ),
        'stock' => array(
            '0' => 'Administrateur',
            '2' => 'Gestionnaire',
            '3' => 'Informateur'
        ),
        'comptabilite' => array(
            '0' => 'Administrateur',
            '1' => 'Caissier',
            '2' => 'Gestionnaire',
            '3' => 'Informateur'
        ),
        'statistique' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire',
            '3' => 'Informateur'
        ),
        'users' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur'
        ),
        'home' => array(
            '0' => 'Administrateur',
            '1' => 'Superviseur',
            '2' => 'Universitaire',
            '3' => 'Informateur'
        )
    );
}

// Universités
Router::prefix('bouwou', 'koudjine');
Router::connect('/universites', 'universites/index');
Router::connect('universites/categorie/:slug-:id', 'universites/categorie/id:([0-9]+)/slug:([A-Za-z0-9\-\_]+)');
//Router::connect('formations/:name','formations/categorie/name:([A-Za-z0-9\-\_]+)');
//Router::connect('formations/presentation/:slug','formations/presentation/slug:([A-Za-z0-9\-\_]+)');
Router::connect('universites/presentation/:slug-:id', 'universites/presentation/id:([0-9]+)/slug:([A-Za-z0-9\-\_]+)');
Router::connect('concours/:slug-:id', 'concours/presentation/id:([0-9]+)/slug:([A-Za-z0-9\-\_]+)');
// Blog
Router::connect('/posts', 'posts/index');
Router::connect('posts/view/:slug-:id', 'posts/view/id:([0-9]+)/slug:([A-Za-z0-9\-]+)');
Router::connect('blog/:action', 'posts/:action');
