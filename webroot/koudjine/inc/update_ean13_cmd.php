<?php
require_once('database.php');
require_once('../Class/produit.php');

global $pdo;


$manager = new  ProduitManager($pdo);

$ean=$_POST['ean'];
$idp=$_POST['idp'];

$produit = $manager->get($idp);
$produit->setean13($ean);
$manager->update($produit);
echo 'ok';




?>