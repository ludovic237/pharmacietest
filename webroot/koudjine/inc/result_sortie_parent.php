<?php
require_once('database.php');

global $pdo;
global $conndb;


if (isset($_GET["motclef"])) {
    $motclef = $_GET["motclef"];
    $id_detail = $_GET["id_detail"];
    $idp_parent = substr($motclef, 0, 4);
    //echo $idp_parent;

    $sth = $pdo->prepare("
              SELECT *
              FROM produit
              WHERE id = :id_detail AND grossiste_id like '%".$idp_parent."%'
            ");
    //echo $sth;
    $sth->bindValue('id_detail', $id_detail);
    $sth->execute();
    $count = $sth->rowCount();
    //echo $count;
    if($count){
        $sth1 = $pdo->prepare("
              SELECT *
              FROM en_rayon, produit
              WHERE produit.id = en_rayon.produit_id AND en_rayon.id = :motclef AND produit.supprimer = 0
            ");
        //echo $sth;
        $sth1->bindValue('motclef', $motclef);
        $sth1->execute();
        $count1 = $sth1->rowCount();
    }

    if ($count1) {

        while ($result = $sth1->fetch(PDO::FETCH_OBJ)) {
            $datelivraison = $result->dateLivraison;
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
            $datel = $date->format('d-m-Y');
            $donnees = array('erreur' =>'non', 'find' => 'oui','nom' => $result->nom, 'datel' => $datel, 'contenu' => $result->contenuDetail, 'stock' => $result->stock-1);
            echo json_encode($donnees);
        }

    }
    else{
        //echo "Aucun résultat pour l'id: ".$motclef;
        $donnees = array('erreur' =>"Pas de grossiste trouvé pour l'id: ".$motclef, 'find' => 'non');
        echo json_encode($donnees);

    }


}

?>