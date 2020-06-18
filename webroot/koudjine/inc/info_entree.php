<?php
require_once('database.php');
require_once('../Class/produit.php');
require_once('../Class/fournisseur1.php');
require_once('../Class/en_rayon.php');

$id;
global $pdo;
global $conndb;
$managerProduit = new ProduitManager($pdo);
$managerFournisseur = new FournisseurManager($pdo);
$managerEnRayon = new En_rayonManager($pdo);


//echo "passe";
if (isset($_POST['id'])||isset($_GET['id'])){
    if (isset($_POST['id']))
        $id=$_POST['id'];
    if (isset($_GET['id']))
        $id=$_GET['id'];


    if($managerEnRayon->existsId($id)){
        $enrayon = $managerEnRayon->get($id);
        $fournisseur = $managerFournisseur->get($enrayon->fournisseur_id());
        $produit = $managerProduit->get($enrayon->produit_id());
        $datelivraison = $enrayon->dateLivraison();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
        $datel = $date->format('d-m-Y');
        $dateCl = $date->format('dmY');
        $dateperemption = $enrayon->datePeremption();
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateperemption);
        $datep = $date->format('d-m-Y');
        $dateCp = $date->format('mY');

    }

    //echo "passe";
    $code_barre = $produit->id().$dateCp.$dateCl;
    //$code = cb($code_barre);




    $donnees = array('nomP' => $produit->nom(), 'nomF' => $fournisseur->nom(), 'code' => $fournisseur->code(), 'datel' => $datel, 'datep' => $datep, 'prixa' =>  $enrayon->prixAchat(), 'prixv' =>  $enrayon->prixVente(), 'quantite' =>  $enrayon->quantite(), 'quantiter' =>  $enrayon->quantiteRestante(), 'reduction' => $enrayon->reduction(),'codebarre' =>$code_barre);
    if (isset($_POST['id']))
        echo json_encode($donnees);



}



?>

