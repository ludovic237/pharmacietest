<?php
require_once('database.php');

global $pdo;
global $conndb;

//On sélectionne tous les users dont le nom = Pierre
if (isset($_POST["motclef"])) {
    $motclef = $_POST["motclef"];

    $sth = $pdo->prepare("
              SELECT p.nom, r.quantite, r.reduction, p.reductionMax, r.prixAchat, r.prixVente, r.id as id, r.dateLivraison, p.id as idp 
              FROM produit p, en_rayon r
              WHERE p.ean13 = :motclef AND p.id = r.produit_id AND p.supprimer = 0 AND r.dateLivraison IN (select max(dateLivraison) from en_rayon e where r.produit_id = e.produit_id )
               ");
    //echo $sth;
    $sth->bindValue('motclef', $motclef);
    $sth->execute();
    $count = $sth->rowCount();
    if ($count) {
        while ($result = $sth->fetch(PDO::FETCH_OBJ)) {

            $donnees = array('erreur' =>'non', 'find' => 'oui','id' => $result->idp, 'nom' => $result->nom, 'prixV' => $result->prixVente, 'prixA' => $result->prixAchat, 'reduction' => $result->reductionMax);
            echo json_encode($donnees);
        }

    } else {
        $donnees = array('erreur' =>"Aucun résultat pour l'id: ".$motclef);
        echo json_encode($donnees);
    }
}
