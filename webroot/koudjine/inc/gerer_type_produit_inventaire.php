<?php
require_once('database.php');
require_once('../Class/inventaire.php');
require_once('../Class/produit_inventaire.php');
require_once('../Class/produit.php');
require_once('../Class/rayon.php');
require_once('../Class/forme.php');
require_once('../Class/categorie.php');
require_once('../Class/fabriquant.php');
require_once('../Class/fournisseur.php');
require_once('../Class/magasin.php');

global $pdo;


$manager = new InventaireManager($pdo);
$managerPi = new Produit_inventaireManager($pdo);
$managerPr = new ProduitManager($pdo);
$managerRayon = new RayonManager($pdo);
$managerFabriquant = new FabriquantManager($pdo);

$managerMagasin = new MagasinManager($pdo);
$managerForme = new FormeManager($pdo);
$managerFournisseur= new FournisseurManager($pdo);
$managerCategorie = new CategorieManager($pdo);

$datasForme = [];
$forme =  $managerForme->getList();
foreach ($forme as $k => $c) :
    $datasForme[] = array(
        'id' => $c->id() ,
        'nom' => $c->nom() ,
        'code' => $c->code() ,
    );
endforeach;

$datasCategorie = [];
$categorie =  $managerCategorie->getList();
foreach ($categorie as $k => $c) :
    $datasCategorie[] = array(
        'id' => $c->id() ,
        'nom' => $c->nom() ,
    );
endforeach;

$datasRayon = [];
$rayon =  $managerRayon->getList();
foreach ($rayon as $k => $c) :
    $datasRayon[] = array(
        'id' => $c->id() ,
        'nom' => $c->nom() ,
        'code' => $c->code() ,
    );
endforeach;

$datasMagasin = [];
$magasin =  $managerMagasin->getList();
foreach ($magasin as $k => $c) :
    $datasMagasin[] = array(
        'id' => $c->id() ,
        'nom' => $c->nom() ,
        'code' => $c->code() ,
    );
endforeach;

$donnees = array(
    'datasForme' => $datasForme,
    'datasCategorie' => $datasCategorie,
    'datasRayon' => $datasRayon,
    'datasMagasin' => $datasMagasin
);
echo json_encode($donnees);


?>