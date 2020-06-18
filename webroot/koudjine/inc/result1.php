<?php
require_once('database.php');

global $pdo;
global $conndb;


    if (isset($_GET["motclef"])) {
        $motclef = $_GET["motclef"];
        //echo $motclef;

        $sth = $pdo->prepare("
              SELECT *
              FROM en_rayon, produit
              WHERE produit.id = en_rayon.produit_id AND en_rayon.id = :motclef
            ");
        //echo $sth;
        $sth->bindValue('motclef', $motclef);
        $sth->execute();
        $count = $sth->rowCount();

        if ($count) {
            while ($result = $sth->fetch(PDO::FETCH_OBJ)) {
                $datelivraison = $result->dateLivraison;
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $datelivraison);
                $datel = $date->format('d-m-Y');
                $donnees = array('erreur' =>'non', 'nom' => $result->nom, 'prix' => $result->prixVente, 'reduction' => $result->reduction, 'datel' => $datel, 'stock' => $result->stock-1);
                    echo json_encode($donnees);
            }
        }
        else{
            //echo "Aucun résultat pour l'id: ".$motclef;
            $donnees = array('erreur' =>"Aucun résultat pour l'id: ".$motclef);
            echo json_encode($donnees);
        }


    }

        ?>