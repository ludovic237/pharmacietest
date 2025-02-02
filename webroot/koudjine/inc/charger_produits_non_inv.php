<?php
require_once('database.php');
require_once('../Class/en_rayon.php');
require_once('../Class/produit.php');

global $pdo;
global $conndb;
$managerEnRayon = new En_rayonManager($pdo);
$managerProduit = new ProduitManager($pdo);

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    //echo $motclef;

    $sth = $pdo->prepare("
              SELECT distinct produit.id as id, nom, stock,etat FROM produit, en_rayon WHERE produit.supprimer = 0 AND en_rayon.supprimer = 0 AND produit.id=en_rayon.produit_id AND produit.id NOT IN (select produit.id from produit, en_rayon,produit_inventaire where inventaire_id = :inventaire AND produit_inventaire.en_rayon_id=en_rayon.id AND en_rayon.produit_id=produit.id); 
            ");
    //echo $sth;
    $sth->bindValue('inventaire', $id);
    $sth->execute();
    $count = $sth->rowCount();
    //$ids = $sth->fetchAll(PDO::FETCH_COLUMN);
    $donnees = [];
    $data = [];
    //print_r($ids);

/*    foreach ($ids as $k =>$v){
        $en_rayon = $managerEnRayon->get($v);

        //echo $v;
        $produit = $managerProduit->get($en_rayon->produit_id());
        $data[] = $en_rayon->produit_id();

        if (!in_array($en_rayon->produit_id(), $donnees)) {
            $donnees[$produit->id()][] = array(
                "DT_RowId" => $produit->id(),
                "id" => $produit->id(),
                "nom" => $produit->nom(),
                "qte" => $produit->stock()
            );
        }
    }*/

    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
            $donnees[] = array(
                "DT_RowId" => $result->id,
                "id" =>  $result->id,
                "nom" =>  $result->nom,
                "datel" =>  $result->etat,
                "qte" => $result->stock
            );

            /*$datelivraison = $result->dateLivraison;
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
            $datel = $date->format('d-m-Y');

            $donnees[] = array('erreur' =>'non', 'find' => 'oui',
                'nom' => "<span ><strong class='nom'>" . $result->nom . "</strong></span>",
                'prix' => $result->prixVente, 'datel' => $datel, 'quantiteRestante' => $result->quantiteRestante, 'id' => $result->id);*/

        }
    }
    $donnees1 = array(
        'data' => $data,
        'data1' => $donnees,
    );
    echo json_encode($donnees);



}

?>