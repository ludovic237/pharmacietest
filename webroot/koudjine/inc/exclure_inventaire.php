<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/en_rayon.php');

global $pdo;


$manager = new ProduitManager($pdo);
$managerEn = new En_rayonManager($pdo);

$id = $_POST['id'];
echo 'passe';

$en_rayon = $managerEn->get($id);
$produit = $manager->get($en_rayon->produit_id());
$produit->setetat('Non utile');
$manager->update($produit);



// D'abord, on se connecte ?ySQL




?>